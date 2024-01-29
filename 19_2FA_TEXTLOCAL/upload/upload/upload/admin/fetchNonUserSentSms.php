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
$Statement = $pdo->prepare("SELECT * FROM send_nonuser_sms WHERE 1 order by id desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0;
if($total > 0) {
	$statuss = "";
	foreach($result as $row) {
		$sum = $sum + 1 ;
		$countrycode = _e($row['nonuser_country_code']);
		$mobile = _e($row['nonuser_mobile']);
		$smsText = strip_tags($row['nonuser_sms_text']);
		$smsDate = _e($row['nonuser_sms_date']);
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