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
$Statement = $pdo->prepare("SELECT item_id, txn_id, txn_type, address_country, total_amt, payer_email, payment_status, pay_date, sub_name FROM payments left join subscription_plan on ( payments.item_id = subscription_plan.id) WHERE 1 order by payments.id desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$sum = 0;
$output = array('data' => array());
if($total > 0) {
	$statuss = "";
	foreach($result as $row) {
		$sum = $sum + 1;
		$item_id = _e($row['item_id']);
		$sub_name = _e($row['sub_name']);
		$price = "$" ;
		$price .= _e($row['total_amt']);
		$date = _e($row['pay_date']);
		$date =  date('d F, Y',strtotime($date));
		$statuss = _e($row['payment_status']);
		$txn_id = _e($row['txn_id']);
		$txn_type = _e($row['txn_type']);
		$address_country = _e($row['address_country']);
		$payer_email = _e($row['payer_email']);
		
		$output['data'][] = array( 		
		$sum, 
		$item_id,
		$sub_name,
		$date,
		$txn_id,
		$txn_type,
		$address_country,
		$payer_email,
		$price,
		$statuss		
		); 	
	}
}
echo json_encode($output);
?>