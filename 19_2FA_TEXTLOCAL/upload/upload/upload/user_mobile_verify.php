<?php 
include_once("admin/db/config.php");
include_once("admin/db/function_xss.php");
require_once('api/api_otp_generate.php');
$err = 0 ;
	if( !empty($_POST['mobile']) ){
		$mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_NUMBER_INT) ;
		$id = filter_var($_POST['uid'], FILTER_SANITIZE_NUMBER_INT) ;
		$countryCode = filter_var($_POST['country_code'], FILTER_SANITIZE_NUMBER_INT) ;
		//check this new mobile is already registered or not
		$checkUser =  $pdo->prepare("SELECT * FROM customer_active WHERE user_mobile=?");
		$checkUser->execute(array($mobile));
		$user_ok = $checkUser->rowCount();
		if($user_ok > 0) {
			echo $err ;
		} else {
			$err = $mobile ;
			$otp = filter_var(code(4), FILTER_SANITIZE_NUMBER_INT) ;
			$msg = "".$otp." is your OTP for Verification.";
			$update_tmp_mobile = $pdo->prepare("UPDATE customer_active SET user_otp = ? , user_tmp_mobile = ? WHERE user_id=?");
			$update_tmp_mobile->execute(array($otp,$mobile,$id));
			//call api and send otp message
			require_once('api/api_sms.php');
			echo $err ;
		}
	
	} else {
		header('location: '.BASE_URL.'manage_phone.php');
	}

?>
