<?php
ob_start();
session_start();
require_once('db/config.php');
require_once("db/function_xss.php");
$err = '0' ;
	//check fullname, email, password should not be empty
	if( !empty($_POST['username']) && !empty($_POST['mobile']) && !empty($_POST['password']) && !empty($_POST['countryCode']) ){
		$fullname = filter_var($_POST['username'], FILTER_SANITIZE_STRING) ;
		$mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_NUMBER_INT) ;
		$countryCode = filter_var($_POST['countryCode'], FILTER_SANITIZE_NUMBER_INT) ;
		$password = filter_var($_POST['password'], FILTER_SANITIZE_STRING) ;
		$uppercase = preg_match('@[A-Z]@', $password);
		$lowercase = preg_match('@[a-z]@', $password);
		$number    = preg_match('@[0-9]@', $password);
		//validate password
		if(!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
		  $err = 1 ;
		  echo $err ;
		} else {
				//checking database for already registered mobile
				$checkUser =  $pdo->prepare("SELECT * FROM customer_active WHERE user_mobile=?");
		 		$checkUser->execute(array($mobile));
		 		$user_ok = $checkUser->rowCount();
				if($user_ok > 0) {
					$err = 2 ;
		 		    echo $err ;
				} else {
					$msg = "Hello ".$fullname.", You are active User Now. Login Details are Mobile : ".$mobile.", Password : ".$password." & Login Link is ".BASE_URL."";
					
					$ins = $pdo->prepare("INSERT INTO customer_active (user_fullname, user_mobile, user_authpass,active_status,user_countrycode) VALUES (?,?,?,?,?)");
					$ins->execute(array($fullname,$mobile,password_hash($password, PASSWORD_DEFAULT),'1',$countryCode));
					if($ins){
						//call api and send otp message
						require_once('../api/api_sms.php');
					}
					$output = array( 
								'error' => 0
							) ;
					echo json_encode($output);
					
				}
			
		}
	
	} 

?>
