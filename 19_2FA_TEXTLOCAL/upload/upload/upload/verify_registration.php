<?php
ob_start();
session_start();
require_once('admin/db/config.php');
require_once("admin/db/function_xss.php");
require_once('api/api_otp_generate.php');
require_once("admin/db/CSRF_Protect.php");
$csrf = new CSRF_Protect();
$err = '0' ;
	//check fullname, mobile, password & confirm password should not be empty
	if( !empty($_POST['fullname']) && !empty($_POST['mobile']) && !empty($_POST['password']) && !empty($_POST['repassword']) ){
		$fullname = filter_var($_POST['fullname'], FILTER_SANITIZE_STRING) ;
		$mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_NUMBER_INT) ;
		$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING) ;
		$repassword = filter_var($_POST['repassword'], FILTER_SANITIZE_STRING) ;
		$countryCode = filter_var($_POST['country_code'], FILTER_SANITIZE_NUMBER_INT) ;
		$uppercase = preg_match('@[A-Z]@', $password);
		$lowercase = preg_match('@[a-z]@', $password);
		$number    = preg_match('@[0-9]@', $password);
		$output = '' ;
		//validate password
		if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
		  $err = 1 ;
		  echo $err ;
		} else {
			//check password and confirm password are same
			if($password == $repassword) {
				//checking database for already registered mobile
				$checkUser =  $pdo->prepare("SELECT * FROM customer_active WHERE user_mobile=?");
		 		$checkUser->execute(array($mobile));
		 		$user_ok = $checkUser->rowCount();
				if($user_ok > 0) {
					$err = 3 ;
		 		    echo $err ;
				} else {
					$otp = filter_var(code(4), FILTER_SANITIZE_NUMBER_INT) ;
					$msg = "".$otp." is your OTP for Verification.";
					//first we insert/update user into temp table until they verify OTP
					$chkUserTmp = $pdo->prepare("SELECT * FROM customer_tmp WHERE user_mobile=?");
					$chkUserTmp->execute(array($mobile));
					$tmp_user = $chkUserTmp->rowCount();
					if($tmp_user > 0) {
						$update_tmp_user = $pdo->prepare("UPDATE customer_tmp SET user_fullname=? , user_countrycode=? , user_authpass=? , user_otp=? WHERE user_mobile=?");
						$update_tmp_user->execute(array($fullname,$countryCode,password_hash($password, PASSWORD_DEFAULT),$otp,$mobile));
					} else {
						$ins_in_tmp = $pdo->prepare("INSERT INTO customer_tmp (user_fullname, user_countrycode, user_mobile, user_authpass, user_otp) VALUES (?,?,?,?,?)");
						$ins_in_tmp->execute(array($fullname,$countryCode,$mobile,password_hash($password, PASSWORD_DEFAULT),$otp));
					}
					//call api and send otp message
					require_once('api/api_sms.php');
					$output = array( 
									'countryCode' => $countryCode,
									'fullname'    => $fullname,
									'password'    => $password,
									'mobile'      => $mobile,
									'error'       => 0
								) ;
						echo json_encode($output);
				}
			} else {
				$err = 2 ;
				echo $err ;
			}
		}
	
	} else {
		header('location: '.BASE_URL.'index.php');
	}


?>
