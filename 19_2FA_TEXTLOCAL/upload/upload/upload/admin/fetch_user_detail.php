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
if(isset($_POST['btn_action_sms']))
{
	if($_POST['btn_action_sms'] == 'fetchUserdetail')
	{
		if(!empty($_POST['userId'])){
			$userId = filter_var($_POST['userId'], FILTER_SANITIZE_NUMBER_INT) ;
			$statement = $pdo->prepare("select user_id, user_fullname, user_countrycode, user_mobile from customer_active where user_id = '".$userId."'");
			$statement->execute();
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
			foreach($result as $row) {
				$output['userId'] = _e($row['user_id']) ;
				$output['smsusername'] = _e($row['user_fullname']) ;
				$output['smscountryCode'] = _e($row['user_countrycode']) ;
				$output['smsmobile'] = _e($row['user_mobile']) ;
			}
			echo json_encode($output) ;
		}
	}
	if($_POST['btn_action_sms'] == 'SendSMS')
	{
		if(!empty($_POST['userId']) && !empty($_POST['username']) && !empty($_POST['mobile']) && !empty($_POST['smstext']) && !empty($_POST['countryCode'])){
			
			$userId = filter_var($_POST['userId'], FILTER_SANITIZE_NUMBER_INT) ;
			$username = filter_var($_POST['username'], FILTER_SANITIZE_STRING) ;
			$mobile = filter_var($_POST['mobile'], FILTER_SANITIZE_NUMBER_INT) ;
			$countryCode = filter_var($_POST['countryCode'], FILTER_SANITIZE_NUMBER_INT) ;
			$msg = filter_var($_POST['smstext'], FILTER_SANITIZE_STRING) ;
			$date = filter_var(date("Y-m-d"), FILTER_SANITIZE_STRING) ;
			$statement = $pdo->prepare("insert into send_user_sms (user_id, user_name, country_code, user_mobile, sms_text, sms_date) values(?,?,?,?,?,?)") ;
			$statement->execute(array($userId,$username,$countryCode,$mobile,$msg,$date));
			if($statement){
				//call api and send otp message
				require_once('../api/api_sms.php');
				echo "SMS sent successfully. Please check Sent SMS Option.";
			}
		} else {
			echo "All Fields are mandatory to Send SMS." ;
		}
	}
	
}
?>