<?php
include_once("admin/db/config.php");
include_once("admin/db/function_xss.php");
$err = 0 ;
if( !empty($_POST['mobile']) && !empty($_POST['id']) && !empty($_POST['otp']) ){
	$id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT) ;
	$mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_NUMBER_INT) ;
	$otp = filter_var($_POST['otp'], FILTER_SANITIZE_NUMBER_INT);
	$otpAuthentication =  $pdo->prepare("SELECT * FROM customer_active WHERE user_id=? and user_otp=? and active_status=?");
	$otpAuthentication->execute(array($id,$otp,filter_var("1", FILTER_SANITIZE_NUMBER_INT)));
	$otp_ok = $otpAuthentication->rowCount();
	$userData = $otpAuthentication->fetchAll(PDO::FETCH_ASSOC);
	if($otp_ok > 0) 
	{
		$err = 1 ;
		echo $err ;
	}
	else {
		echo $err ;
	}

} else {
	header('location: '.BASE_URL.'user_password.php');
}
?>