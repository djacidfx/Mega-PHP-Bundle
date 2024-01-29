<?php
include("database.php") ;
$err = 0;
if( !empty($_POST['email']) && !empty($_POST['password']) ){
    if(isset($_POST['g-recaptcha-response'])){
            $captcha=$_POST['g-recaptcha-response'];
    }
    $secretKey = SECRET_KEY ;
    $ip = $_SERVER['REMOTE_ADDR'];
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
    $response = file_get_contents_ssl($url);
    $responseKeys = json_decode($response,true);
    if($responseKeys["success"]) {
		 $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) ;
		 $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
		 $checkUser =  $pdo->prepare("SELECT * FROM ot_admin WHERE adm_email=?");
		 $checkUser->execute(array($email));
		 $user_ok = $checkUser->rowCount();
		 $user_data = $checkUser->fetchAll(PDO::FETCH_ASSOC);
		 //checking admin credential
		 if($user_ok > 0){
			foreach($user_data as $row){
				$auth_pass = _e($row['adm_password']);
			}
			if(password_verify($password, $auth_pass)) {
				$err = 1 ;
				echo $err ;
				$_SESSION['boss'] = $row;
			} else {
				echo $err ; 
			}
		}
    } else {
        $err = 2 ;
        echo $err ;
    }
} else {
    header("location: ".ADMIN_URL."signout");
}
?>