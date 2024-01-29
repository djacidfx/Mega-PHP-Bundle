<?php
ob_start();
session_start();
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ;
// For Live payments you want to disable the sandbox mode i.e. false. If you want to check Sanbox Mode
// For Live Mode it should be: true
$enableSandbox = false;

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
	$payment_id = parse_str(trim($_POST['custom']),$_MYVAR) ;
	$txn_type = filter_var($_POST['txn_type'], FILTER_SANITIZE_STRING) ;
	$country = filter_var($_POST['address_country'], FILTER_SANITIZE_STRING) ;
	$total_amt = filter_var($_POST['mc_gross'], FILTER_SANITIZE_STRING) ;
	$payment_status = "Completed" ;
    if(!empty($_MYVAR['wpus'])){
        $wallet_payment_id = $_MYVAR['wpus'] ;
		$planAmount = $_MYVAR['planAmount'] ;
		$total_amount = $_MYVAR['total_amount'] ;
        
        $check_transaction = $pdo->prepare("select * from ot_wallet where w_txn_id = '".$txn_id."'");
		$check_transaction->execute();
		$numRow = $check_transaction->rowCount();
		
		if($numRow == 0){
            $complete_status = "1";
            $User = $pdo->prepare("select w_user_id from ot_wallet where wallet_id = '".$wallet_payment_id."'");
			$User->execute();
			$resultUser = $User->fetchAll(PDO::FETCH_ASSOC); 
			foreach($resultUser as $oldUser){
				$user_id = $oldUser['w_user_id'];
			}
            $userWalletAmt = find_userwallet_amt($pdo,$user_id) ;
            $newWalletAmt = ($userWalletAmt + $total_amount) ;
            
            $updateUser = $pdo->prepare("update ot_users set user_wallet = '".$newWalletAmt."' where id='".$user_id."'");
            $updateUser->execute();
            
            $statement = $pdo->prepare("update ot_wallet set w_txn_id = '".$txn_id."', w_complete_status = '".$complete_status."', w_payment_status = 'Completed' where wallet_id = '".$wallet_payment_id."'");
			$statement->execute();
        }
    } else {
        $payment_id = $_MYVAR['pus'] ;
		$check_transaction = $pdo->prepare("select * from ot_payments where txn_id = '".$txn_id."'");
		$check_transaction->execute();
		$numRow = $check_transaction->rowCount();
		
		if($numRow == 0){
			$complete_status = "1";
            $User = $pdo->prepare("select p_user_id,p_author_earning from ot_payments where payment_id = '".$payment_id."'");
			$User->execute();
			$resultUser = $User->fetchAll(PDO::FETCH_ASSOC); 
			foreach($resultUser as $oldUser){
				$user_id = $oldUser['p_user_id'];
                $authorEarning = $oldUser['p_author_earning'];
			}
            
            $saleCount = (active_itemsales_by_id($pdo,$item_id) + 1 ) ;
            $userPurchaseCount = (count_user_all_purchases($pdo,$user_id) + 1) ;
            $authorId = find_user_id_by_itemid($pdo,$item_id) ;
            $authorEmail = useremail_by_id($pdo,$authorId) ;
            $authorWantEmail = want_email_on_item_sales($pdo,$authorId) ;
            $authorUsername = get_username_by_itemid($pdo,$item_id) ;
            $authorSaleCount = (user_solditems_by_username($pdo,$authorUsername) + 1) ;
            $authorSoldAmount = (count_author_sold_amount($pdo,$authorId) + $total_amt) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$item_id) ;
            $imageName = find_live_image($pdo,$item_id) ;
            $adminName = admin_name($pdo) ;
            $adminCopyrightName = admin_copyright_name($pdo);
            $nLink = BASE_URL.'payouts' ;
            
			$statement = $pdo->prepare("update ot_payments set txn_id = '".$txn_id."', payment_status = '".$payment_status."', complete_status = '".$complete_status."' where payment_id = '".$payment_id."'");
			$sql = $statement->execute();
            
            $updateSale = $pdo->prepare("update ot_users_video set item_sale = '".$saleCount."' where item_id = '".$item_id."'");
            $updateSale->execute() ;

            $updateUser = $pdo->prepare("update ot_users set user_purchased_items = '".$userPurchaseCount."' where id='".$user_id."'");
            $updateUser->execute();

            $updateAuthor = $pdo->prepare("update ot_users set user_sold_items = '".$authorSaleCount."' , user_sold_price = '".$authorSoldAmount."' where id='".$authorId."'");
            $updateAuthor->execute();

            $updatePurchase = $pdo->prepare("insert into ot_user_purchases (purchase_item_id, purchase_user_id) values ('".$item_id."','".$user_id."')");
            $updatePurchase->execute();

            $updateAuthorStatement = $pdo->prepare("insert into ot_author_statement (s_txn_id, author_id, s_item_id, s_author_earning) values ('".$txn_id."', '".$authorId."' , '".$item_id."' , '".$authorEarning."') ") ;
            $updateAuthorStatement->execute();
            
            $insNotification = $pdo->prepare("insert into ot_notifications (n_type, n_user_id, n_link ) values ('1', '".$authorId."', '".$nLink."' ) ");
            $insNotification->execute();
            
            
            //*********************SEND EMAIL to Author***************************
			if($authorWantEmail == '1'){
                $userfullname = user_fullname_by_id($pdo,$authorId) ;
                $to = $authorEmail ;
                $subject = "Congrats! You have 1 New Sale.";
                $headers  = 'MIME-Version: 1.0' . "\r\n";
                $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                $headers .= 'From: '.$adminName.'' . "\r\n" . 'Reply-To: '.$authorEmail.'' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
                include("emailTemplates/send_itemsale_email_to_author.php");
                mail($to, $subject, $body, $headers);
            }
            //*********************SEND EMAIL to User***************************
            $useremail = useremail_by_id($pdo,$user_id) ;
            $userfullname = user_fullname_by_id($pdo,$user_id) ;
            $to = $useremail ;
            $subject = "Congrats! You Purchase is Successful.";
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
            $headers .= 'From: '.$adminName.'' . "\r\n" . 'Reply-To: '.$useremail.'' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
            include("emailTemplates/send_item_purchase_email.php");
            mail($to, $subject, $body, $headers);
		}
    }
    
		
	

}
?>