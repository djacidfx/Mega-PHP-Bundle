<?php
// For Live payments we want to disable the sandbox mode i.e. false. If you want to put Sanbox Mode
// payments through then this setting needs changing to `true`.
$enableSandbox = false;

include("_adminarea_/db/config.php");
include("_adminarea_/db/function_xss.php");

$business_email = $pdo->prepare("select * from ot_admin where id='1'");
$business_email->execute();
$result = $business_email->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $row){
	$bEmail = _e($row['paypal_business_email']) ;
}
$paypalConfig = [
	'email' => $bEmail,
	'return_url' => BASE_URL.'paySuccess.php',
	'cancel_url' => BASE_URL,
	'notify_url' => BASE_URL.'verify_process.php'
];

$paypalUrl = $enableSandbox ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';

// Product being purchased.
$itemNumber = $_POST['item_number'] ; 
$itemName = $_POST['item_name'] ;
$itemAmount = $_POST['item_amount'] ;  
$itemLicense = $_POST['item_license'] ;
$uid = $_POST['uid'] ;
$date = date("Y-m-d") ;

// Check if paypal request or response
if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])) {
	if($itemLicense == '1'){
		$itemLicense = "Regular" ;
	} else {
		$itemLicense = "Extended" ;
	}
	$statement = $pdo->prepare("insert into ot_payments (p_user_id, p_item_id, p_total_amt, txn_id, payment_status, payment_date, p_license) values ('".$uid."' , '".$itemNumber."', '".$itemAmount."', '', 'Failed', '".$date."', '".$itemLicense."')");
	$statement->execute();
	$orderstatement = $pdo->query("SELECT LAST_INSERT_ID()");
	$payment_id = $orderstatement->fetchColumn();
	// Grab the post data so that we can set up the query string for PayPal.
	// Ideally we'd use a whitelist here to check nothing is being injected into
	// our post data.
	$data = [];
	foreach ($_POST as $key => $value) {
		$data[$key] = stripslashes($value);
	}

	// Set the PayPal account.
	$data['business'] = $paypalConfig['email'];

	// Set the PayPal return addresses.
	$data['return'] = stripslashes($paypalConfig['return_url']);
	$data['cancel_return'] = stripslashes($paypalConfig['cancel_url']);
	$data['notify_url'] = stripslashes($paypalConfig['notify_url']);

	// Set the details about the product being purchased, including the amount
	// and currency so that these aren't overridden by the form data.
	$data['item_name'] = $itemName;
	$data['amount'] = $itemAmount;
	$data['item_number'] = $itemNumber ;
	$data['custom'] = $payment_id ;
	$data['currency_code'] = 'USD';

	// Build the query string from the data.
	$queryString = http_build_query($data);

	// Redirect to paypal IPN
	header('location:' . $paypalUrl . '?' . $queryString);
	exit();

}

?>