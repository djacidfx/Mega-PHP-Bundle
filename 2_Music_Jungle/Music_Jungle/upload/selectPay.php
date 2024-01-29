<?php
ob_start();
session_start();
include("_adminarea_/db/config.php");
include("_adminarea_/db/item_functions.php");
if(!isset($_SESSION['user']['user_id'])){
	header("location: ".BASE_URL.""); 
}
if(isset($_POST['btn_action'])){
	if($_POST['btn_action'] == 'selectPayment') {
		if(!empty($_POST['itemNumber']) && !empty($_POST['userId']) && !empty($_POST['itemAmount']) && !empty($_POST['paymentMethod'])){
			$itemNumber = filter_var($_POST['itemNumber'], FILTER_SANITIZE_NUMBER_INT);
			$userId = filter_var($_POST['userId'], FILTER_SANITIZE_NUMBER_INT);
			$itemAmount = filter_var($_POST['itemAmount'], FILTER_SANITIZE_NUMBER_INT);
			$paymentMethod = filter_var($_POST['paymentMethod'], FILTER_SANITIZE_NUMBER_INT);
			$userWallet = user_wallet_amount($pdo) ;
			if($paymentMethod == '3') {
				if($userWallet >= $itemAmount) {
					$output['itemNumber'] = $itemNumber ;
					$output['userId'] = $userId ;
					$output['itemAmount'] = $itemAmount ;
					$output['paymentMethod'] = $paymentMethod ;
					echo json_encode($output) ;
				} else {
					$output['paymentMethod'] = '4' ;
					echo json_encode($output) ;
				}
			} else {
				$output['itemNumber'] = $itemNumber ;
				$output['userId'] = $userId ;
				$output['itemAmount'] = $itemAmount ;
				$output['paymentMethod'] = $paymentMethod ;
				echo json_encode($output) ;
			}
			
			
		}
	}
} else {
	header("location: ".BASE_URL.""); 
}

?>