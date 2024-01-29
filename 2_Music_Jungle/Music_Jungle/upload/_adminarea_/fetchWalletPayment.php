<?php
ob_start();
session_start();
include("db/config.php");
include("db/item_functions.php");
// Checking Admin is logged in or not
if(!isset($_SESSION['admin'])) {
	header("location: ".ADMIN_URL."login.php");
	exit;
} 
$Statement = $pdo->prepare("SELECT * FROM ot_user_wallet WHERE wallet_complete_status = '1' order by wallet_id desc ");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
if($total > 0) {
	$active = "";
	foreach($result as $row) {
		$sum = $sum + 1 ;
		$planId = _e($row['planId']) ;
		$plan_name = get_wallet_plan_name($pdo,$planId) ; ;
		$date = _e($row['wallet_date']);
		$date =  date('d F, Y',strtotime($date));
		$amount = _e($row['planAmt']) ;
		$amount = "$".$amount ;
		$bonusAmt = '$'._e($row['bonusAmt']) ;
		$creditedAmt = '<b>$'._e($row['wallet_amt']).'</b>' ;
		$txn_id = _e($row['wallet_txn_id']) ;
		$uid = _e($row['wallet_user_id']);
		$username = get_userfullname_byid($pdo,$uid) ;
		$useremail = get_useremail_byid($pdo,$uid);
		$paymentMethod = '<b class="text-success">'._e($row['wallet_method']).'</b>';
		$output['data'][] = array( 		
		$sum,
		$date,
		$uid,
		$username,
		$useremail,
		$paymentMethod,
		$txn_id,
		$plan_name,
		$amount,
		$bonusAmt,
		$creditedAmt
		
		); 	
	}
}
echo json_encode($output);
?>