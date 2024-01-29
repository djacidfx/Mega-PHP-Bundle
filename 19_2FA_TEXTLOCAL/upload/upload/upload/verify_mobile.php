<?php
ob_start();
session_start();
require_once('admin/db/config.php');
require_once('api/api_otp_generate.php');
require_once("admin/db/function_xss.php");
require_once("admin/db/CSRF_Protect.php");
$csrf = new CSRF_Protect();
$err = 0 ;
	if( !empty($_POST['mobile']) ) {
		$mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_NUMBER_INT) ;
		//first we check mobile is registered and active
		$checkUser =  $pdo->prepare("SELECT * FROM customer_active WHERE user_mobile = ? and active_status = ?");
		$checkUser->execute(array($mobile,filter_var("1", FILTER_SANITIZE_NUMBER_INT)));
		$user_ok = $checkUser->rowCount();
		$user_data = $checkUser->fetchAll(PDO::FETCH_ASSOC);
		if($user_ok > 0) {
			foreach($user_data as $userData) {
				$countryCode = _e($userData['user_countrycode']);
			}
			$otp = filter_var(code(4), FILTER_SANITIZE_NUMBER_INT);
			$msg = "".$otp." is your OTP for Verification.";
			$update_user_otp = $pdo->prepare("UPDATE customer_active SET user_otp=? WHERE user_mobile=?");
			$update_user_otp->execute(array($otp,$mobile));
			//call api and send otp message
			require_once('api/api_sms.php');
			$err = $mobile ;
			echo $err ;
		} else {
			echo $err ;
		}
	
	} else {
		header('location: '.BASE_URL.'index.php');
	}


?>