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
$Statement = $pdo->prepare("SELECT item_number, txn_id, name, email, item_price, item_price_currency, payment_status, created_date, sub_name FROM payments left join subscription_plan on ( payments.item_number = subscription_plan.id) WHERE 1 order by payments.id desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$sum = 0;
$output = array('data' => array());
if($total > 0) {
	$statuss = "";
	foreach($result as $row) {
		$sum = $sum + 1;
		$item_id = _e($row['item_number']);
		$sub_name = _e($row['sub_name']);
		$price = "$" ;
		$price .= _e($row['item_price']);
		$date = _e($row['created_date']);
		$date =  date('d F, Y',strtotime($date));
		$statuss = _e(strtoupper($row['payment_status']));
		$txn_id = _e($row['txn_id']);
		$name = _e($row['name']);
		$email = _e($row['email']);
		
		$output['data'][] = array( 		
		$sum, 
		$item_id,
		$sub_name,
		$date,
		$txn_id,
		$name,
		$email,
		$price,
		$statuss		
		); 	
	}
}
echo json_encode($output);
?>