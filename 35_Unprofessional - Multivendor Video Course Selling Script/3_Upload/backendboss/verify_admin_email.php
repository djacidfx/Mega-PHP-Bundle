<?php
ob_start();
session_start();
require_once('config/db.php');
include("controller/functions.php") ; 
$err = 0;
if( !empty($_POST['email']) ){
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
         $checkUser =  $pdo->prepare("SELECT * FROM ot_admin WHERE adm_email=? ");
         $checkUser->execute(array($email));
         $user_ok = $checkUser->rowCount();
         $user_data = $checkUser->fetchAll(PDO::FETCH_ASSOC);
         //checking user credential
         if($user_ok > 0){
            $otp = filter_var(code(4), FILTER_SANITIZE_NUMBER_INT) ;
            $upd = $pdo->prepare("update ot_admin set otp = '".$otp."' where adm_email = '".$email."'") ;
            $upd->execute() ;
             
            $adminName = admin_name($pdo) ;
            $adminCopyrightName = admin_copyright_name($pdo);
            $to = $email ;
            $subject = "Reset Admin Password OTP.";
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
            $headers .= 'From: '.$adminName.'' . "\r\n" . 'Reply-To: '.$email.'' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
            include("../emailTemplates/send_recoverpass_admin_otp_email.php");
            mail($to, $subject, $body, $headers);
             $output = array( 
                                'email' => $email,
                                'err' => '1'

                            ) ;
            echo json_encode($output);
        } else {
             echo $err ;
        }
    } else {
        $err = 2 ;
        echo $err ;
    }
} 
?>