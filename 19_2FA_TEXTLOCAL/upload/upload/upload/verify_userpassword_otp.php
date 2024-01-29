<?php 
include_once("admin/db/config.php");
include_once("admin/db/function_xss.php");
require_once('api/api_otp_generate.php');
$err = 0;
	if( !empty($_POST['mobile']) && !empty($_POST['country_code']) ){
		$mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_NUMBER_INT) ;
		$countryCode = filter_var($_POST['country_code'], FILTER_SANITIZE_NUMBER_INT) ;
		$checkUser = $pdo->prepare("SELECT * FROM customer_active WHERE user_mobile = ? and active_status = ?");
		$checkUser->execute(array($mobile,filter_var("1", FILTER_SANITIZE_NUMBER_INT)));
		$user_ok = $checkUser->rowCount();
		if($user_ok > 0) {
			$otp = filter_var(code(4), FILTER_SANITIZE_NUMBER_INT) ;
			$msg = "".$otp." is your OTP for Verification.";
			$update_otp = $pdo->prepare("UPDATE customer_active SET user_otp = ? WHERE user_mobile=?");
			$update_otp->execute(array($otp,$mobile));
			//call api and send otp message
			require_once('api/api_sms.php');
			$err = $mobile ;
			echo $err ;
		} else {
			echo $err ;
		}
	} else {
		header('location: '.BASE_URL.'user_password.php');
	}

?>
