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
$Statement = $pdo->prepare("SELECT * FROM subscription_plan WHERE 1 order by id desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$sum = 0;
$output = array('data' => array());
if($total > 0) {
	$statuss = "";
	foreach($result as $row) {
		$sum = $sum + 1;
		$id = _e($row['id']);
		$sub_name = _e($row['sub_name']);
		$price = "$" ;
		$price .= _e($row['sub_price']);
		
		$date = _e($row['sub_date']);
		$date =  date('d F, Y',strtotime($date));
		$statuss = _e($row['sub_status']);
		if($statuss == 1) {
			// Deactivate Subscription Plan
			$statuss = "<b>Active</b>";
			$myLink = '<button type="button" name="changeSubscriptionStatus" id="'.$id.'" class="btn btn-danger btn-sm changeSubscriptionStatus" data-status="0"><i class="fa fa-ban"></i></button>';
			
		} else {
			// Activate Subscription Plan
			$statuss = "Not Active";
			$myLink = '<button type="button" name="changeSubscriptionStatus" id="'.$id.'" class="btn btn-success btn-sm changeSubscriptionStatus" data-status="1"><i class="fa fa-check-circle"></i></button>';
			
		}
		$editSubscription = '<button type="button" name="editSubscription" id="'.$id.'" class="btn btn-default btn-sm editSubscription"><i class="fa fa-pencil-alt"></i></button>';
		$output['data'][] = array( 		
		$sum, 
		$id,
		$date,
		$sub_name,
		$price,
		$statuss,
		$editSubscription,
		$myLink		
		); 	
	}
}
echo json_encode($output);
?>