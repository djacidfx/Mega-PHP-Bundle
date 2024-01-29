<?php
ob_start();
session_start();
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ;
// For Live payments you want to disable the sandbox mode i.e. false. If you want to check Sanbox Mode
// For Live Mode it should be: true
$enableSandbox = false;


check_user_logged_in($pdo) ;
$admin = $pdo->prepare("SELECT * FROM ot_admin WHERE id = '1'");
$admin->execute();   
$admin_result = $admin->fetchAll(PDO::FETCH_ASSOC);
$total = $admin->rowCount();
foreach($admin_result as $adm) {
//escape all  data
	$pay_email = _e($adm['pay_email']);
	$rec_email = _e($adm['rec_email']);
    $adminCommission = _e($adm['commission']) ;
    $adminCommissionRate = ($adminCommission/100) ;
	$forAdminRate = (1 - $adminCommissionRate) ;
    $minAmt = _e($adm['min_wallet']) ;
    $maxAmt = _e($adm['max_wallet']) ;
}

$paypalConfig = [
	'email' => PAYPAL_BUSINESS_EMAIL,
	'return_url' => BASE_URL.'paypalsuccess',
	'cancel_url' => BASE_URL,
	'notify_url' => BASE_URL.'paypalverify'
];

$paypalUrl = $enableSandbox ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';

// Product being purchased.

$uid = $_SESSION['unprofessional']['id'] ;
$only_Wallet = $_POST['only_Wallet'] ;

//double check Item Price to Prevent Fraud


// Check if paypal request or response
if (!isset($_POST["txn_id"]) && !isset($_POST["txn_type"])) {
    $txn_id = '' ;
    if(empty($only_Wallet)) {
        $itemNumber = $_POST['item_number'] ; 
        $itemName = $_POST['item_name'] ;
        $itemAmount = $_POST['item_amount'] ;
        $checkPrice = find_activeitem_price($pdo,$itemNumber) ;
        $authorId = find_user_id_by_itemid($pdo,$itemNumber) ;
        $authorEarning = ($itemAmount - ($itemAmount * $adminCommissionRate));
        $adminEarning = ($itemAmount - ($itemAmount * $forAdminRate));
        if($checkPrice == $itemAmount){
            $statement = $pdo->prepare("insert into ot_payments (p_user_id, p_author_id, p_item_id, p_total_amt, p_commission, p_admin_earning, p_author_earning, txn_id, payment_status, payment_method) values ('".$uid."', '".$authorId."', '".$itemNumber."', '".$itemAmount."', '".$adminCommission."', '".$adminEarning."', '".$authorEarning."', '".$txn_id."', 'Failed', 'Paypal')");
            $statement->execute();
            $orderstatement = $pdo->query("SELECT LAST_INSERT_ID()");
            $newpayment_id = $orderstatement->fetchColumn();
            $payment_id = 'pus='.$newpayment_id.'&wpus=' ;
        } else {
            header("location: ".BASE_URL."paypalerror");
            exit;
        }
    } else {
        $itemNumber = "WL20" ;
        $itemName = "Wallet" ;
        $itemAmount = $_POST['rechargeAmt'] ;
        $payment_status = "Failed"; 
        $complete_status = "0";
        if($itemAmount >= $minAmt){
            $statement = $pdo->prepare("insert into ot_wallet (w_user_id, w_amt, w_txn_id, w_payment_status, w_complete_status, w_payment_method) values ('".$uid."', '".$itemAmount."', '".$txn_id."', '".$payment_status."', '".$complete_status."','Paypal')");
            $statement->execute();
            $orderstatement = $pdo->query("SELECT LAST_INSERT_ID()");
            $wallet_payment_id = $orderstatement->fetchColumn();
            $payment_id = 'wpus='.$wallet_payment_id.'&planAmount='.$itemAmount.'&total_amount='.$itemAmount ;
        } else {
            header("location: ".BASE_URL."paypalerror");
            exit;
        }
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