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
$Statement = $pdo->prepare("SELECT * FROM send_user_sms WHERE 1 order by id desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
if($total > 0) {
	$statuss = "";
	foreach($result as $row) {
		$customerId = _e($row['user_id']);
		$fullname = _e($row['user_name']);
		$countrycode = _e($row['country_code']);
		$mobile = _e($row['user_mobile']);
		$smsText = strip_tags($row['sms_text']);
		$smsDate = _e($row['sms_date']);
		$smsDate =  date('d F, Y',strtotime($smsDate));
		$output['data'][] = array( 		
		$customerId,
		$smsDate,
		$fullname,
		$countrycode, 
		$mobile,
		$smsText
		); 	
	}
}
echo json_encode($output);
?>