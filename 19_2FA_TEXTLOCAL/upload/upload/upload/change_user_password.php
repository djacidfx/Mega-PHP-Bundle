<?php
ob_start();
session_start();
require_once('admin/db/config.php');
if(!isset($_SESSION['customer'])) {
	header('location: '.BASE_URL.'index.php');
	exit;
}
$err = 0 ;
if( !empty($_POST['mobile']) && !empty($_POST['newpassword']) && !empty($_POST['confirmnewpassword'])){
	$mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_NUMBER_INT) ;
	$newpassword = filter_var($_POST['newpassword'], FILTER_SANITIZE_STRING);
	$confirmnewpassword = filter_var($_POST['confirmnewpassword'], FILTER_SANITIZE_STRING) ;
	$uppercase = preg_match('@[A-Z]@', $newpassword);
	$lowercase = preg_match('@[a-z]@', $newpassword);
	$number    = preg_match('@[0-9]@', $newpassword);
	//validate password
	if(!$uppercase || !$lowercase || !$number || strlen($newpassword) < 8) {
		echo $err ;
	} else {
		//check password and confirm password are same
		if($newpassword == $confirmnewpassword) {
			$update_user_otp = $pdo->prepare("UPDATE customer_active SET user_authpass=? WHERE user_mobile=?");
			$update_user_otp->execute(array(password_hash($newpassword, PASSWORD_DEFAULT),$mobile));
			$err = 2 ;
			echo $err ;
		
		} else {
			$err = 1 ;
			echo $err ;
		}
	
	}

} else {
	header("location: user_password.php");
}
?>