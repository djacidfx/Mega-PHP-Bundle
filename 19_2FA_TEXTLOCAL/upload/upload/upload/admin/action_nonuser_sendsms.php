<?php
ob_start();
session_start();
include("db/config.php");
include("db/function_xss.php") ;
// Checking Admin is logged in or not
if(!isset($_SESSION['admin'])) {
	header("location: ".ADMIN_URL."/login.php");
	exit;
}
if(isset($_POST['btn_action_nonuser']))
{
	if($_POST['btn_action_nonuser'] == 'SendSms')
	{
		if(!empty($_POST['countryCode']) && !empty($_POST['mobile'])  && !empty($_POST['smstext']) ){
		
			$mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_NUMBER_INT) ;
			$countryCode = filter_var($_POST['countryCode'], FILTER_SANITIZE_NUMBER_INT) ;
			$msg = filter_var($_POST['smstext'], FILTER_SANITIZE_STRING) ;
			$date = filter_var(date("Y-m-d"), FILTER_SANITIZE_STRING) ;
			$statement = $pdo->prepare("insert into send_nonuser_sms (nonuser_country_code, nonuser_mobile, nonuser_sms_text, nonuser_sms_date) values(?,?,?,?)") ;
			$statement->execute(array($countryCode,$mobile,$msg,$date));
			if($statement){
				//call api and send otp message
				require_once('../api/api_sms.php');
				echo "SMS sent successfully. Please check Sent SMS Option.";
			}
		
		} else {
			echo "Error: All fields are mandatory to send sms.";
		}
	}
}
?>