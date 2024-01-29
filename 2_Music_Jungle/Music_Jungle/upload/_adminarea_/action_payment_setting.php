<?php
ob_start();
session_start();
include("db/config.php");
include("db/item_functions.php") ;
// Checking Admin is logged in or not
if(!isset($_SESSION['admin'])) {
	header("location: login.php"); 
	exit;
} 
if(isset($_POST['stripe_submit_pr'])){
	if($_POST['stripe_submit_pr'] == 'Submit') {
		if(!empty($_POST['stripePubKey']) && !empty($_POST['stripeSecKey']) && isset($_POST['stripe_on'])){
			$stripeSecKey = filter_var($_POST['stripeSecKey'], FILTER_SANITIZE_STRING);
			$stripePubKey = filter_var($_POST['stripePubKey'], FILTER_SANITIZE_STRING);
			$stripeOn = filter_var($_POST['stripe_on'], FILTER_SANITIZE_NUMBER_INT);
			$upd = $pdo->prepare("update ot_admin set STRIPE_SECRET_KEY = '".$stripeSecKey."' , STRIPE_PUBLISHABLE_KEY = '".$stripePubKey."' , stripe_on = '".$stripeOn."' where id='1'");
			$upd->execute();
			$form_message = "Stripe Settings Updated Successfully.";
			$output = array( 
					'form_message' => $form_message
					) ;
			echo json_encode($output);
		} else {
			$form_message = "Mandatory Field is Missing. Try Again.";
			$output = array( 
					'form_message' => $form_message
					) ;
			echo json_encode($output);
		}
	
	} 
}
if(isset($_POST['paypal_submit_pr'])){
	if($_POST['paypal_submit_pr'] == 'Submit') {
		if(!empty($_POST['paypalEmail'])  && isset($_POST['paypal_on'])){
			$paypalEmail = filter_var($_POST['paypalEmail'], FILTER_SANITIZE_EMAIL);
			$paypal_on = filter_var($_POST['paypal_on'], FILTER_SANITIZE_NUMBER_INT);
			$upd = $pdo->prepare("update ot_admin set PAYPAL_BUSINESS_EMAIL = '".$paypalEmail."' , paypal_on = '".$paypal_on."' where id='1'");
			$upd->execute();
			$form_message = "Paypal Settings Updated Successfully.";
			$output = array( 
					'form_message' => $form_message
					) ;
			echo json_encode($output);
		} else {
			$form_message = "Mandatory Field is Missing. Try Again.";
			$output = array( 
					'form_message' => $form_message
					) ;
			echo json_encode($output);
		}
	}
	
} 
if(isset($_POST['transaction_submit_pr'])){
	if($_POST['transaction_submit_pr'] == 'Submit') {
		if(isset($_POST['transactionFee'])){
			$transactionFee = filter_var($_POST['transactionFee'], FILTER_SANITIZE_NUMBER_INT);
			$upd = $pdo->prepare("update ot_admin set txn_fee = '".$transactionFee."' where id='1'");
			$upd->execute();
			$form_message = "Transaction Fee Updated Successfully.";
			$output = array( 
					'form_message' => $form_message
					) ;
			echo json_encode($output);
		} else {
			$form_message = "Mandatory Field is Missing. Try Again.";
			$output = array( 
					'form_message' => $form_message
					) ;
			echo json_encode($output);
		}
	
	} 
}
?>