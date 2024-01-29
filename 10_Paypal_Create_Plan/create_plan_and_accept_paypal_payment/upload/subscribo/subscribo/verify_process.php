<?php
// For Live payments we want to disable the sandbox mode i.e. false. If you want to put Sanbox Mode
// payments through then this setting needs changing to `true`.
$enableSandbox = false;

require_once("admin/db/config.php");

$paypalURL = $enableSandbox ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';

$raw_post_data = file_get_contents('php://input');
$raw_post_array = explode('&', $raw_post_data);
$myPost = array();
foreach ($raw_post_array as $keyval) {
    $keyval = explode ('=', $keyval);
    if (count($keyval) == 2)
        $myPost[$keyval[0]] = urldecode($keyval[1]);
}

// Read the post from PayPal system and add 'cmd'
$req = 'cmd=_notify-validate';
if(function_exists('get_magic_quotes_gpc')) {
    $get_magic_quotes_exists = true;
}
foreach ($myPost as $key => $value) {
    if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
        $value = urlencode(stripslashes($value));
    } else {
        $value = urlencode($value);
    }
    $req .= "&$key=$value";
}

// Post IPN data back to PayPal to validate the IPN data is genuine Without this step anyone can fake IPN data

$ch = curl_init($paypalURL);
if ($ch == FALSE) {
    return FALSE;
}
curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
curl_setopt($ch, CURLOPT_SSLVERSION, 6);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close', 'User-Agent: company-name'));
$res = curl_exec($ch);
$tokens = explode("\r\n\r\n", trim($res));
$res = trim(end($tokens));
if (strcmp($res, "VERIFIED") == 0 || strcasecmp($res, "VERIFIED") == 0) {
	
	$txn_id = filter_var($_POST['txn_id'], FILTER_SANITIZE_STRING) ;
	$payer_email = filter_var($_POST['payer_email'], FILTER_SANITIZE_EMAIL) ;
	$item_id = filter_var($_POST['item_number'], FILTER_SANITIZE_NUMBER_INT) ;
	$txn_type = filter_var($_POST['txn_type'], FILTER_SANITIZE_STRING) ;
	$country = filter_var($_POST['address_country'], FILTER_SANITIZE_STRING) ;
	$total_amt = filter_var($_POST['mc_gross'], FILTER_SANITIZE_STRING) ;
	$payment_status = filter_var($_POST['payment_status'], FILTER_SANITIZE_STRING) ;
	$payDate = filter_var(date("Y-m-d"), FILTER_SANITIZE_STRING) ;
	$check_transaction = $pdo->prepare("select * from payments where txn_id = '".$txn_id."'");
	$check_transaction->execute();
	$numRow = $check_transaction->rowCount();
	
	if($numRow == 0){
		$statement = $pdo->prepare("INSERT INTO payments (item_id, txn_id, txn_type, address_country, total_amt, payer_email, payment_status, pay_date) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
		$sql = $statement->execute(array($item_id, $txn_id, $txn_type, $country, $total_amt, $payer_email, $payment_status, $payDate));
	}

}
?>