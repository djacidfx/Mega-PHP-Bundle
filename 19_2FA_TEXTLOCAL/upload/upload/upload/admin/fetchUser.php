<?php
ob_start();
session_start();
include("db/config.php");
include("db/function_xss.php");
// Checking Admin is logged in or not
if(!isset($_SESSION['admin'])) {
	header("location: ".ADMIN_URL."/login.php"); 
	exit;
}
$Statement = $pdo->prepare("SELECT * FROM customer_active WHERE 1 order by user_id desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
if($total > 0) {
	$statuss = "";
	foreach($result as $row) {
		$customerId = _e($row['user_id']);
		$fullname = _e($row['user_fullname']);
		$countrycode = _e($row['user_countrycode']);
		$mobile = _e($row['user_mobile']);
		$address = _e($row['user_address']);
		$state = _e($row['user_state']);
		$city = _e($row['user_city']);
		$zipcode = _e($row['user_zipcode']);
		$statuss = _e($row['active_status']);
		if($statuss == 1) {
			// Deactivate User
			$statuss = "<b>Active</b>";
			$myLink = '<button type="button" name="changeUserStatus" id="'.$customerId.'" class="btn btn-danger btn-sm changeUserStatus" data-status="0"><i class="fa fa-ban"></i></button>';
		} else {
			// Activate User
			$statuss = "Not Active";
			$myLink = '<button type="button" name="changeUserStatus" id="'.$customerId.'" class="btn btn-success btn-sm changeUserStatus" data-status="1"><i class="fa fa-check"></i></button>';
		}
		$sendSMS = '<button type="button" name="sendSMS" id="'.$customerId.'" class="btn btn-light btn-sm sendSMS"><i class="fa fa-comments text-muted"></i></button>';
		$output['data'][] = array( 		
		$customerId,
		$fullname,
		$countrycode, 
		$mobile,
		$address,		
		$state,
		$city,
		$zipcode,
		$statuss,
		$myLink,
		$sendSMS
		); 	
	}
}
echo json_encode($output);
?>