<?php
ob_start();
session_start();
include("admin/db/config.php");
include("admin/db/function_xss.php");
// Checking Admin is logged in or not
if(!isset($_SESSION['customer'])) {
	header("location: ".BASE_URL."index.php");
	exit;
}
$Statement = $pdo->prepare("SELECT * FROM send_user_sms WHERE user_id = '".$_SESSION['customer']['user_id']."' order by id desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0;
if($total > 0) {
	$statuss = "";
	foreach($result as $row) {
		$sum = $sum + 1 ;
		$countrycode = _e($row['country_code']);
		$mobile = _e($row['user_mobile']);
		$smsText = strip_tags($row['sms_text']);
		$smsDate = _e($row['sms_date']);
		$smsDate =  date('d F, Y',strtotime($smsDate));
		$output['data'][] = array( 		
		$sum,
		$smsDate,
		$countrycode, 
		$mobile,
		$smsText
		); 	
	}
}
echo json_encode($output);
?>