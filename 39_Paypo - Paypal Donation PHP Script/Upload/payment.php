<?php 
ob_start();
session_start();
include("setup.php") ; 
// For Live payments we want to disable the sandbox mode i.e. false. If you want to put Sanbox Mode
// payments through then this setting needs changing to `true`.
$enableSandbox = false;
$bEmail = PAYPAL_BUSINESS_EMAIL ;

$paypalConfig = [
	'email' => $bEmail,
	'return_url' => BASE_URL.'success',
	'cancel_url' => BASE_URL,
    'notify_url' => BASE_URL.'success',
];

$paypalUrl = $enableSandbox ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';

// Product being purchased.
$userName = filter_var($_POST['name'], FILTER_SANITIZE_STRING) ;
$userEmail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL) ;
$amount = filter_var($_POST['amount'], FILTER_SANITIZE_NUMBER_INT) ;
$iname = "cord" ;
// Check if paypal request or response
if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])) {

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
	$data['username'] = $userName;
	$data['useremail'] = $userEmail;
	$data['amount'] = $amount ;
	$data['iname'] = $iname ;
	$data['currency_code'] = CURRENCY_TYPE ;

	// Build the query string from the data.
	$queryString = http_build_query($data);

	// Redirect to paypal IPN
	header('location:' . $paypalUrl . '?' . $queryString);
	exit();

}
?>