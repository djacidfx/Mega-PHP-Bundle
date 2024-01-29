<?php
ob_start();
session_start();
require_once('backendboss/config/db.php');
function _e($string) {
	return htmlentities(strip_tags($string), ENT_QUOTES, 'UTF-8');
}
$err = 0;
if( !empty($_POST['email']) && !empty($_POST['password']) ){
    if(isset($_POST['g-recaptcha-response'])){
            $captcha=$_POST['g-recaptcha-response'];
    }
    $secretKey = SECRET_KEY ;
    $ip = $_SERVER['REMOTE_ADDR'];
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
    $response = file_get_contents($url);
    $responseKeys = json_decode($response,true);
    if($responseKeys["success"]) {
         $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) ;
         $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
         $checkUser =  $pdo->prepare("SELECT * FROM ot_users WHERE (user_email = '".$email."' or user_name='".$email."') and user_blocked = '0'");
         $checkUser->execute();
         $user_ok = $checkUser->rowCount();
         $user_data = $checkUser->fetchAll(PDO::FETCH_ASSOC);
         //checking user credential
         if($user_ok > 0){
            foreach($user_data as $row){
                $auth_pass = _e($row['user_auth']);
            }
            if(password_verify($password, $auth_pass)) {
                $err = 1 ;
                echo $err ;
                $_SESSION['unprofessional'] = $row;
            } else {
                echo $err ; 
            }
        } else {
             echo $err ;
        }
    } else {
        $err = 2 ;
        echo $err ;
    }
} 
?>