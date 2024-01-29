<?php
ob_start();
session_start();
include("db/config.php");
include("db/function_xss.php");
// Checking Admin is logged in or not
if( empty($_SESSION['admin']['id'])  ){
	header('location: '.ADMIN_URL.'/index.php');
	exit;
}
if(isset($_POST['btn_action_subscribe']))
{
	if($_POST['btn_action_subscribe'] == 'AddSubscription')
	{
		if( isset($_POST['sname']) && isset($_POST['sdate']) && isset($_POST['price'])){
			$sname = filter_var($_POST['sname'], FILTER_SANITIZE_STRING);
			$sdate = filter_var(date($_POST['sdate']), FILTER_SANITIZE_STRING) ;
			$price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
			$ins = $pdo->prepare("insert into subscription_plan (sub_name, sub_date, sub_price) values (?,?,?)");
			$ins->execute(array($sname, $sdate, $price));
			echo "New Plan Added Successfully and Live Now.";
		} else {
			echo "All Fields are Mandatory. Try Again.";
		}
	}
	if($_POST['btn_action_subscribe'] == 'EditSubscription')
	{
		if( isset($_POST['sid']) && isset($_POST['sname']) && isset($_POST['sdate']) && isset($_POST['price'])){
			$sid = filter_var($_POST['sid'], FILTER_SANITIZE_NUMBER_INT);
			$sname = filter_var($_POST['sname'], FILTER_SANITIZE_STRING);
			$sdate = filter_var(date($_POST['sdate']), FILTER_SANITIZE_STRING) ;
			$price = filter_var($_POST['price'], FILTER_SANITIZE_NUMBER_INT);
			$ins = $pdo->prepare("update subscription_plan set sub_name =? , sub_date=? , sub_price=? where id= ?");
			$ins->execute(array($sname, $sdate, $price, $sid));
			echo "Plan Edited Successfully.";
		} else {
			echo "All Fields are Mandatory. Try Again.";
		}
	}
	
	if($_POST['btn_action_subscribe'] == 'fetch_subscription')
	{	
		$subscriptionId = filter_var($_POST['subscriptionId'], FILTER_SANITIZE_NUMBER_INT) ;
		$fetch_subscription = $pdo->prepare("select * from subscription_plan where id = ?");
		$fetch_subscription->execute(array($subscriptionId));
		$subscriptionData = $fetch_subscription->fetchAll(PDO::FETCH_ASSOC);
		foreach($subscriptionData as $row) {
			$output['sid'] = _e($row['id']) ;
			$output['sname'] = _e($row['sub_name']) ;
			$output['sdate'] = _e($row['sub_date']) ;
			$output['price'] = _e($row['sub_price']) ;
		}
		echo json_encode($output);
	}
	if($_POST['btn_action_subscribe'] == 'changeSubscriptionStatus')
	{
		$subscriptionId = filter_var($_POST['subscriptionId'], FILTER_SANITIZE_NUMBER_INT);
		$status = filter_var($_POST['status'], FILTER_SANITIZE_NUMBER_INT);
		if($subscriptionId) { 
			$update = $pdo->prepare("UPDATE subscription_plan SET sub_status=?   WHERE id=?");
			$result_new = $update->execute(array($status,$subscriptionId));
			if($result_new) {
				echo 'Success : Plan status changed .' ;		
			}
		}
	}
}
?>