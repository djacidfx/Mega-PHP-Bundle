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
$err = "" ;
if($_POST['resend_email']){
	if($_POST['resend_email'] == 'Submit') {
        $fullname = username_by_id($pdo,$_SESSION['unprofessional']['id']) ;
        $email = useremail_by_id($pdo,$_SESSION['unprofessional']['id']) ;
        $otp = filter_var(code(4), FILTER_SANITIZE_NUMBER_INT) ;
        $statement = $pdo->prepare("update ot_users set user_otp = '".$otp."' where id = '".$_SESSION['unprofessional']['id']."'");
        $statement->execute() ;
        $form_message = "OTP has been resend successfully.";
        $output = array( 
                        'form_message' => $form_message
                    ) ;
        echo json_encode($output);
        
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
?>