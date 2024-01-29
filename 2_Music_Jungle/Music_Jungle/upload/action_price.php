<?php
ob_start();
session_start();
include("_adminarea_/db/config.php");
include("_adminarea_/db/item_functions.php");
// Checking User is logged in or not
if(!isset($_SESSION['user'])) {
	unset($_SESSION['user']);
	header("location: ".BASE_URL."");
	exit;
}
if(isset($_POST['btn_action']))
{
	if($_POST['btn_action'] == 'load_price')
	{
		if(!empty($_POST['sub_id']) && !empty($_POST['status'])){
			$payM = filter_var($_POST['sub_id'], FILTER_SANITIZE_NUMBER_INT);
			$itemId = filter_var($_POST['status'], FILTER_SANITIZE_NUMBER_INT);
			$itemPrice = get_item_price($pdo,$itemId) ;
			$statement = $pdo->prepare("select txn_fee from ot_admin where id='1'");
			$statement->execute();
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
			foreach($result as $row) {
				$txnFee = (int)_e($row['txn_fee']) ;
			}
			if($payM == '3') {
				$total = $itemPrice ;
				$output = array( 
							'transactionFee' => '0',
							'total' => $total
							) ;
					echo json_encode($output);
			} else {
				$total = $itemPrice + $txnFee ;
				$output = array( 
							'transactionFee' => $txnFee,
							'total' => $total
							) ;
					echo json_encode($output);
			} 
			
		} 
	}
	
	if($_POST['btn_action'] == 'load_plan')
	{
		if(!empty($_POST['planId'])){
			$planId = filter_var($_POST['planId'], FILTER_SANITIZE_NUMBER_INT);
			$statement = $pdo->prepare("select plan_amt, bonus_amt from ot_wallet_plan where plan_id='".$planId."' and plan_status='1'");
			$statement->execute();
			$result = $statement->fetchAll(PDO::FETCH_ASSOC);
			foreach($result as $row) {
				$planAmt = (int)_e($row['plan_amt']) ;
				$bonusAmt = (int)_e($row['bonus_amt']) ;
			}
				$output = array( 
							'planAmt' => $planAmt,
							'bonusAmt' => $bonusAmt
							) ;
				echo json_encode($output);
			
		} 
	}
}
?>