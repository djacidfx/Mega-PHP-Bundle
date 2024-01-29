<?php
// For Live payments we want to disable the sandbox mode i.e. false. If you want to put Sanbox Mode
// payments through then this setting needs changing to `true`.
$enableSandbox = false;

include("_adminarea_/db/config.php");
include("_adminarea_/db/item_functions.php");

$admin = $pdo->prepare("SELECT * FROM ot_admin WHERE id = '1'");
$admin->execute();   
$admin_result = $admin->fetchAll(PDO::FETCH_ASSOC);
$total = $admin->rowCount();
foreach($admin_result as $adm) {
//escape all  data
	$pay_email = _e($adm['pay_email']);
	$rec_email = _e($adm['rec_email']);
	$adminName = _e($adm['adm_name']);
	$admin_email   = _e($adm['adm_email']);
}
$headers = "";

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
	$item_id = filter_var($_POST['item_number'], FILTER_SANITIZE_NUMBER_INT) ;
	$payment_id = parse_str($_POST['custom'],$_MYVAR) ;
	$txn_type = filter_var($_POST['txn_type'], FILTER_SANITIZE_STRING) ;
	$country = filter_var($_POST['address_country'], FILTER_SANITIZE_STRING) ;
	$total_amt = filter_var($_POST['mc_gross'], FILTER_SANITIZE_STRING) ;
	$payment_status = "Completed" ;
	$payDate = filter_var(date("Y-m-d"), FILTER_SANITIZE_STRING) ;
	if(!empty($_MYVAR['wpus'])){
		$wallet_payment_id = $_MYVAR['wpus'] ;
		$Bonus_Amount = $_MYVAR['Bonus_Amount'] ;
		$planAmount = $_MYVAR['planAmount'] ;
		$planId = $_MYVAR['planId'] ;
		$total_amount = $_MYVAR['total_amount'] ;
		
		$check_transaction = $pdo->prepare("select * from ot_user_wallet where wallet_txn_id = '".$txn_id."'");
		$check_transaction->execute();
		$numRow = $check_transaction->rowCount();
		
		if($numRow == 0){
			$complete_status = "1";
			$User = $pdo->prepare("select wallet_user_id from ot_user_wallet where wallet_id = '".$wallet_payment_id."'");
			$User->execute();
			$resultUser = $User->fetchAll(PDO::FETCH_ASSOC); 
			foreach($resultUser as $oldUser){
				$user_id = $oldUser['wallet_user_id'];
			}
			$userWallet = user_wallet_amount_by_id($pdo,$user_id) ;
			$newWallet = $userWallet + $total_amount ;
			$statement = $pdo->prepare("update ot_user_wallet set wallet_txn_id = '".$txn_id."', wallet_date = '".$payDate."', wallet_complete_status = '".$complete_status."' where wallet_id = '".$wallet_payment_id."'");
			$sql = $statement->execute();
			$updWallet = $pdo->prepare("update ot_user set user_wallet = '".$newWallet."' where user_id = '".$user_id."'");
			$updWallet->execute();
			if($sql){
				if($pay_email == '1') {
						$userName = get_userfullname_byid($pdo,$user_id) ;
						$userEmail = get_useremail_byid($pdo,$user_id) ;
						$planName = get_wallet_plan_name($pdo,$planId) ;
						$bonusAmount = $Bonus_Amount ;
						$payMe = 'Paypal' ;
						$itemPrice = $total_amount ;
						$to = $rec_email ;
						$subject = "Congratulation! New Wallet Payment via Paypal";
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
						$headers .= 'From: '.$adminName.'' . "\r\n" . 'Reply-To: '.$admin_email.'' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
						include("email_for_wallet.php");
						mail($to, $subject, $body, $headers);
				}
			}
		} else {
			$statement = $pdo->prepare("delete from ot_user_wallet where wallet_id = '".$wallet_payment_id."' and wallet_complete_status = '0'");
			$statement->execute();
		}
	} else {
		$payment_id = $_MYVAR['pus'] ;
		$check_transaction = $pdo->prepare("select * from ot_payments where txn_id = '".$txn_id."'");
		$check_transaction->execute();
		$numRow = $check_transaction->rowCount();
		
		if($numRow == 0){
			$complete_status = "1";
			$User = $pdo->prepare("select p_user_id from ot_payments where payment_id = '".$payment_id."'");
			$User->execute();
			$resultUser = $User->fetchAll(PDO::FETCH_ASSOC); 
			foreach($resultUser as $oldUser){
				$user_id = $oldUser['p_user_id'];
			}
			$statement = $pdo->prepare("update ot_payments set txn_id = '".$txn_id."', payment_status = '".$payment_status."', payment_date = '".$payDate."', complete_status = '".$complete_status."' where payment_id = '".$payment_id."'");
			$sql = $statement->execute();
			$item_sale = get_item_sale($pdo,$item_id) + 1 ;
			$item_sale_upd = $pdo->prepare("update item_db set item_sale = '".$item_sale."' where item_Id = '".$item_id."'");
			$item_sale_upd->execute();
			if($sql){
				if($pay_email == '1') {
						$userName = get_userfullname_byid($pdo,$user_id) ;
						$userEmail = get_useremail_byid($pdo,$user_id) ;
						$itemName = get_item_title($pdo,$item_id) ;
						$webUrl = BASE_URL.'item/'.$item_id ;
						$to = $rec_email ;
						$subject = "Congratulation! New Sale of an Item via Paypal";
						$headers  = 'MIME-Version: 1.0' . "\r\n";
						$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
						$headers .= 'From: '.$adminName.'' . "\r\n" . 'Reply-To: '.$admin_email.'' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
						include("email_for_sale.php");
						mail($to, $subject, $body, $headers);
				}
			}
		} else {
			$statement = $pdo->prepare("delete from ot_payments where payment_id = '".$payment_id."' and payment_status = 'Failed'");
			$statement->execute();
		}
	}

}
?>