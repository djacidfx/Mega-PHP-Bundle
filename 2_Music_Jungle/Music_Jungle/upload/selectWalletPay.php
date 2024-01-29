<?php
ob_start();
session_start();
include("_adminarea_/db/config.php");
if(!isset($_SESSION['user']['user_id'])){
	header("location: ".BASE_URL.""); 
}
if(isset($_POST['addwallet_submit_pr'])){
	if($_POST['addwallet_submit_pr'] == 'Submit') {
		if(!empty($_POST['uid']) && !empty($_POST['addWallet']) && !empty($_POST['choosePayment']) && !empty($_POST['planAmt'])){
			$userId = filter_var($_POST['uid'], FILTER_SANITIZE_NUMBER_INT);
			$planAmount = filter_var($_POST['planAmt'], FILTER_SANITIZE_NUMBER_INT);
			$planId = filter_var($_POST['addWallet'], FILTER_SANITIZE_NUMBER_INT);
			$bonusAmount = filter_var($_POST['bonusAmt'], FILTER_SANITIZE_NUMBER_INT);
			$choosePayment = filter_var($_POST['choosePayment'], FILTER_SANITIZE_NUMBER_INT);
			$totalCredit = $planAmount + $bonusAmount ;
				$output['userId'] = $userId ;
				$output['planAmount'] = $planAmount ;
				$output['bonusAmount'] = $bonusAmount ;
				$output['planId'] = $planId ;
				$output['choosePayment'] = $choosePayment ;
				$output['totalCredit'] = $totalCredit ;
			
			echo json_encode($output) ;
		}
	}
} else {
	header("location: ".BASE_URL.""); 
}

?>