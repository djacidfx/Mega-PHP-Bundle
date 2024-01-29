<?php
ob_start();
session_start();
require_once('admin/db/config.php');
require_once('api/api_otp_generate.php');
require_once("admin/db/function_xss.php");
require_once("admin/db/CSRF_Protect.php");
$csrf = new CSRF_Protect();
$err = 0 ;
	if( !empty($_POST['mobile']) && !empty($_POST['password']) ){
		 $mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_NUMBER_INT) ;
		 $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING);
		 $checkUser =  $pdo->prepare("SELECT * FROM customer_active WHERE user_mobile=? and active_status=?");
		 $checkUser->execute(array($mobile,filter_var("1", FILTER_SANITIZE_NUMBER_INT)));
		 $user_ok = $checkUser->rowCount();
		 $user_data = $checkUser->fetchAll(PDO::FETCH_ASSOC);
		 //check mobile & password is correct and user is active
		 if($user_ok > 0){
			$otp = filter_var(code(4), FILTER_SANITIZE_NUMBER_INT);
			$msg = "".$otp." is your OTP for Verification.";
			foreach($user_data as $row){
				$countryCode = _e($row['user_countrycode']);
				$auth_pass = _e($row['user_authpass']);
			}
			if(password_verify($password, $auth_pass)) {
				$err = $mobile ;
				$update_otp = $pdo->prepare("UPDATE customer_active SET user_otp=? WHERE user_mobile=?");
				$update_otp->execute(array($otp,$mobile));
				//call api and send otp message
				require_once('api/api_sms.php');
				echo $err ;
			} else {
				echo $err ;
			}
					
		} else {
			echo $err ;
		}
	
	} else {
		header("location: ".BASE_URL."");
	
	}

?>
