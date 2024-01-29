<?php
// For Live payments we want to disable the sandbox mode i.e. false. If you want to put Sanbox Mode
// payments through then this setting needs changing to `true`.
$enableSandbox = false;

include("_adminarea_/db/config.php");
include("_adminarea_/db/item_functions.php");

$business_email = $pdo->prepare("select * from ot_admin where id='1'");
$business_email->execute();
$result = $business_email->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $row){
	$bEmail = _e($row['PAYPAL_BUSINESS_EMAIL']) ;
}
$paypalConfig = [
	'email' => $bEmail,
	'return_url' => BASE_URL.'paypalSuccess/',
	'cancel_url' => BASE_URL,
	'notify_url' => BASE_URL.'verify_process.php'
];

$paypalUrl = $enableSandbox ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';

// Product being purchased.

$only_Wallet = $_POST['only_Wallet'] ;
$uid = $_POST['uid'] ;
$date = date("Y-m-d") ;

// Check if paypal request or response
if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])) {
	if(empty($only_Wallet)) {
		$itemNumber = $_POST['item_number'] ; 
		$itemName = $_POST['item_name'] ;
		$itemAmount = $_POST['item_amount'] ; 
		$statement = $pdo->prepare("insert into ot_payments (p_user_id, p_item_id, p_total_amt, txn_id, payment_status, payment_date, payment_method) values ('".$uid."' , '".$itemNumber."', '".$itemAmount."', '', 'Failed', '".$date."', 'Paypal')");
		$statement->execute();
		$orderstatement = $pdo->query("SELECT LAST_INSERT_ID()");
		$newpayment_id = $orderstatement->fetchColumn();
		$payment_id = 'pus='.$newpayment_id.'&wpus=' ;
	} else {
		$planId = $_POST['planId'] ; 
		$planName = get_wallet_plan_name($pdo,$planId) ;
		$planAmount = $_POST['planAmount'] ;
		$bonusAmount = $_POST['bonusAmount'] ;
		$itemNumber = $planId ; 
		$itemName = $planName ;
		$itemAmount = $planAmount ;
		$totalAmount = $planAmount + $bonusAmount ;
		$statement = $pdo->prepare("insert into ot_user_wallet (wallet_user_id, planId, planAmt, bonusAmt, wallet_amt, wallet_txn_id, wallet_method, wallet_complete_status, wallet_date) values (?,?,?,?,?,?,?,?,?)");
		$statement->execute(array($uid, $planId, $planAmount, $bonusAmount, $totalAmount, '', 'Paypal', '0', $date)); 
		$orderstatement = $pdo->query("SELECT LAST_INSERT_ID()");
		$wallet_payment_id = $orderstatement->fetchColumn();
		$payment_id = 'wpus='.$wallet_payment_id.'&Bonus_Amount='.$bonusAmount.'&planAmount='.$planAmount.'&planId='.$planId.'&total_amount='.$totalAmount ;
	}
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