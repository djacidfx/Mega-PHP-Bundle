<?php
ob_start();
session_start();
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ; 
$admin = $pdo->prepare("SELECT * FROM ot_admin WHERE id = ?");
$admin->execute(array("1"));   
$admin_result = $admin->fetchAll(PDO::FETCH_ASSOC);
$total = $admin->rowCount();
foreach($admin_result as $adm) {
//escape all  data
	$user_chance = _e($adm['user_chance']) ;
}
if(isset($_POST['btn_action']))
{
    if($_POST['btn_action'] == 'fetch_username')
        {
            if(!empty($_POST['value'])){
                $value =  filter_var($_POST['value'], FILTER_SANITIZE_STRING);
                $chk = $pdo->prepare("select * from ot_users where user_name = ?") ;
                $chk->execute(array($value)) ;
                $ok = $chk->rowCount();
                $output = "";
                if($ok > 0) {
                    $output = array( 
                                'form_msg' => 'Username is Not Available.',
                                'err' => '1'

                            ) ;
                    echo json_encode($output);
                } else {
                    $output = array( 
                                'form_msg' => 'Username is Available.',
                                'err' => '0'

                            ) ;
                    echo json_encode($output);
                }
            } 
        }
    
}
$err = "" ;
if( !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['username']) && !empty($_POST['userfullname']) ){
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
         $fullname = filter_var($_POST['userfullname'], FILTER_SANITIZE_STRING);
         $username = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $uppercase = preg_match('@[A-Z]@', $password);
		$lowercase = preg_match('@[a-z]@', $password);
		$number    = preg_match('@[0-9]@', $password);
         $checkUser =  $pdo->prepare("SELECT * FROM ot_users WHERE (user_email='".$email."' or user_name = '".$username."')");
         $checkUser->execute();
         $user_ok = $checkUser->rowCount();
         $user_data = $checkUser->fetchAll(PDO::FETCH_ASSOC);
         //checking user credential
         if($user_ok > 0){
             $err = 0;
             echo $err ;
        } else {
            if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
                $err = 3;
                echo $err ;
            } else {
                
                $otp = filter_var(code(4), FILTER_SANITIZE_NUMBER_INT) ;
                $password = password_hash($password, PASSWORD_DEFAULT) ;
                $ins = $pdo->prepare("insert into ot_users (user_email, user_name, user_fullname, user_auth, user_otp, u_chance) values ('".$email."' , '".$username."' , '".$fullname."' , '".$password."' , '".$otp."' , '".$user_chance."') ");
                $ins->execute() ;
                $statement_active = $pdo->prepare("SELECT * FROM ot_users WHERE user_email=?");
				$statement_active->execute(array($email));   
				$result_active = $statement_active->fetchAll(PDO::FETCH_ASSOC);
				foreach($result_active as $row){
				    $_SESSION['unprofessional'] = $row;
				}
                $err = 1 ;
                echo $err ;
                
                $adminName = admin_name($pdo) ;
                $adminCopyrightName = admin_copyright_name($pdo);
                $to = $email ;
                $subject = "SignUp Verification OTP.";
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                $headers .= 'From: '.$adminName.'' . "\r\n" . 'Reply-To: '.$email.'' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
                include("emailTemplates/send_signup_otp_email.php");
                mail($to, $subject, $body, $headers);
                
            }
         }
        
    } else {
        $err = 2 ;
        echo $err ;
    }
}
?>