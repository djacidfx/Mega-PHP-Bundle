<?php
ob_start();
session_start();
require_once('admin/db/config.php');
$err = 0;
if( !empty($_POST['mobile']) && !empty($_POST['otp']) ){
	$mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_NUMBER_INT) ;
	$otp = filter_var($_POST['otp'], FILTER_SANITIZE_NUMBER_INT) ;
	$otpAuthentication =  $pdo->prepare("SELECT * FROM customer_active WHERE user_mobile=? and user_otp=? and active_status=?");
	$otpAuthentication->execute(array($mobile,$otp,filter_var("1", FILTER_SANITIZE_NUMBER_INT)));
	$otp_ok = $otpAuthentication->rowCount();
	$userData = $otpAuthentication->fetchAll(PDO::FETCH_ASSOC);
	if($otp_ok > 0) {
	$err = 1 ;
		foreach($userData as $row){
			$_SESSION['customer'] = $row;
		}
	echo $err ;
	}
	else {
		echo $err ; 
	}

} else {
	header('location: '.BASE_URL.'index.php');
}
?>