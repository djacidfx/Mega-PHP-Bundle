<?php 
ob_start();
session_start();
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ;
check_user_logged_in($pdo) ;
$nt = '1' ;
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

$payment_id = $statusMsg = $payment_status = ''; 
$ordStatus = 'error'; 

// Check whether stripe token is not empty 
if(!empty($_POST['tokenStripe'])){ 
     
	$item_id = $_POST['itemNumber'] ; 
	$itemName = long_title_by_id($pdo,$item_id) ;
    $authorId = find_user_id_by_itemid($pdo,$item_id) ;
    $authorEmail = useremail_by_id($pdo,$authorId) ;
    $authorWantEmail = want_email_on_item_sales($pdo,$authorId) ;
    $authorUsername = get_username_by_itemid($pdo,$item_id) ;
    $authorSaleCount = (user_solditems_by_username($pdo,$authorUsername) + 1) ;
    
    $saleCount = (active_itemsales_by_id($pdo,$item_id) + 1 ) ;
    $token  = $_POST['tokenStripe'] ; 
	$itemPrice = $_POST['itemAmount'] ;
    $checkPrice = find_activeitem_price($pdo,$item_id) ;
	$currency = $_POST['currency_code'] ;
	$uid = $_POST['userId'] ;
	$name = user_fullname($pdo) ;
	$email = useremail_by_id($pdo,$uid) ;
    $userPurchaseCount = (count_user_all_purchases($pdo,$uid) + 1) ;
    $authorEarning = ($itemPrice - ($itemPrice * $adminCommissionRate));
    $adminEarning = ($itemPrice - ($itemPrice * $forAdminRate));
    $authorSoldAmount = (count_author_sold_amount($pdo,$authorId) + $itemPrice) ;
    $nLink = BASE_URL.'payouts' ;
    // Include Stripe PHP library 
    require_once 'stripe-php/init.php'; 
     
    // Set API key 
    \Stripe\Stripe::setApiKey(STRIPE_API_KEY); 
	
	 $curl = new \Stripe\HttpClient\CurlClient();
	$curl->setEnablePersistentConnections(false);
	\Stripe\ApiRequestor::setHttpClient($curl);
     
    // Add customer to stripe 
    try {  
        $customer = \Stripe\Customer::create(array( 
            'email' => $email, 
			'name' => $name,
            'source'  => $token 
        )); 
    }catch(Exception $e) {  
        $api_error = $e->getMessage();  
    } 
     
    // Double Check Of Item Price to Prevent Fraud or Manipulation
    if($checkPrice == $itemPrice){
    
        if(empty($api_error) && $customer){  

            // Convert price to cents 
            $itemPriceCents = ($itemPrice*100); 

            // Charge a credit or a debit card 
            try {  
                $charge = \Stripe\Charge::create(array( 
                    'customer' => $customer->id, 
                    'amount'   => $itemPriceCents, 
                    'currency' => $currency, 
                    'description' => $itemName 
                )); 
            }catch(Exception $e) {  
                $api_error = $e->getMessage();  
            } 

            if(empty($api_error) && $charge){ 

                // Retrieve charge details 
                $chargeJsonData = $charge->jsonSerialize(); 

                // Check whether the charge is successful 
                if($chargeJsonData['amount_refunded'] == 0 && empty($chargeJsonData['failure_code']) && $chargeJsonData['paid'] == 1 && $chargeJsonData['captured'] == 1){ 
                    // Transaction details  
                    $txn_id = $chargeJsonData['balance_transaction']; 
                    $total_amt = $chargeJsonData['amount']; 
                    $total_amt = ($total_amt/100); 
                    $paidCurrency = $chargeJsonData['currency']; 
                    $payment_status = "Completed"; 
                    $complete_status = "1";

                   $statement = $pdo->prepare("insert into ot_payments (p_user_id, p_author_id, p_item_id, p_total_amt, p_commission, p_admin_earning, p_author_earning, txn_id, payment_status, complete_status, payment_method) values ('".$uid."', '".$authorId."', '".$item_id."', '".$total_amt."', '".$adminCommission."', '".$adminEarning."', '".$authorEarning."', '".$txn_id."', '".$payment_status."', '".$complete_status."','Stripe')");
                    $statement->execute();
                    
                    $updateSale = $pdo->prepare("update ot_users_video set item_sale = '".$saleCount."' where item_id = '".$item_id."'");
                    $updateSale->execute() ;
                    
                     $updateUser = $pdo->prepare("update ot_users set user_purchased_items = '".$userPurchaseCount."' where id='".$uid."'");
                    $updateUser->execute();
                    
                    $updateAuthor = $pdo->prepare("update ot_users set user_sold_items = '".$authorSaleCount."' , user_sold_price = '".$authorSoldAmount."' where id='".$authorId."'");
                    $updateAuthor->execute();
                    
                    $updatePurchase = $pdo->prepare("insert into ot_user_purchases (purchase_item_id, purchase_user_id) values ('".$item_id."','".$uid."')");
                    $updatePurchase->execute();
                    
                    $updateAuthorStatement = $pdo->prepare("insert into ot_author_statement (s_txn_id, author_id, s_item_id, s_author_earning) values ('".$txn_id."', '".$authorId."' , '".$item_id."' , '".$authorEarning."') ") ;
                    $updateAuthorStatement->execute();
                    
                    $insNotification = $pdo->prepare("insert into ot_notifications (n_type, n_user_id, n_link ) values ('1', '".$authorId."', '".$nLink."' ) ");
                    $insNotification->execute();
                    
                    //*******************************SEND EMAIL TO Author***********************************
                    $itemUrlTitle = item_urltitle_by_id($pdo,$item_id) ;
                    $imageName = find_live_image($pdo,$item_id) ;
                    $adminName = admin_name($pdo) ;
                    $adminCopyrightName = admin_copyright_name($pdo);
                    if($authorWantEmail == '1'){
                        $authoremail = useremail_by_id($pdo,$authorId) ;
                        $userfullname = user_fullname_by_id($pdo,$authorId) ;
                        $to = $authoremail ;
                        $subject = "Congrats! You have 1 New Sale.";
                        $headers  = 'MIME-Version: 1.0' . "\r\n";
                        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                        $headers .= 'From: '.$adminName.'' . "\r\n" . 'Reply-To: '.$authoremail.'' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
                        include("emailTemplates/send_itemsale_email_to_author.php");
                        mail($to, $subject, $body, $headers);
                    }
                    
                    //*******************************SEND EMAIL TO User***********************************
                    
                    $useremail = useremail_by_id($pdo,$uid) ;
                    $userfullname = user_fullname_by_id($pdo,$uid) ;
                    $to = $useremail ;
                    $subject = "Congrats! You Purchase is Successful.";
                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                    $headers .= 'From: '.$adminName.'' . "\r\n" . 'Reply-To: '.$useremail.'' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
                    include("emailTemplates/send_item_purchase_email.php");
                    mail($to, $subject, $body, $headers);
                    
                    // If the order is successful 
                    if($payment_status == 'Completed'){ 
                        $ordStatus = 'Success'; 
                        $statusMsg = "Your Transaction is Successful";
                    }else{ 
                        $statusMsg = "Your Payment has Failed!"; 
                    } 
                }else{ 
                    $statusMsg = "Transaction has been failed!"; 
                } 
            }else{ 
                $statusMsg = "Charge creation failed! $api_error";  
            } 
        }else{  
           $statusMsg = "Invalid card details! $api_error";  
        } 
    } else {
        $statusMsg = "Sorry, Item Price has been Changed or Manipulated. No Amount has been Debited From Your Account.";  
    }
}else{ 
    $statusMsg = "We found some error. Try Again."; 
} 
?>

<?php $webtitle = "Stripe Payments" ; ?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>

<?php include("sidebar_index.php"); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1 class="text-muted"><i class="fas fa-credit-card fa-lg"></i> Payment Info & Message</h1>
      </div>
    </section>
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header">
                <?php if($payment_status === "Completed") { ?>
                    <h4 class="text-muted"><i class="fa fa-check-circle text-success"></i>&ensp;<?php echo $statusMsg ; ?></h4>
                <?php } else { ?>
                    <h4 class="text-danger"><i class="fa fa-times text-danger"></i>&ensp;<?php echo $statusMsg ; ?></h4>
                <?php } ?>
            </div>
            <?php if(!empty($txn_id)){ ?>  
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h6 class="text-muted">Thank You for Purchase. You can Now Download Your Item.</h6>
                    </div>
                    <div class="col-lg-12">
                        <b>Transaction ID:</b> <?php echo $txn_id; ?>
                    </div>
                    <div class="col-lg-12">
                        <b>Paid Amount:</b> $<?php echo $total_amt ; ?>
                    </div>
                    <div class="col-lg-12">
                        <b>Payment Status:</b> <?php echo $payment_status; ?>
                    </div>
                    <div class="col-lg-12">
                        <b>Item Name:</b> <?php echo $itemName; ?>
                    </div>
                    <div class="col-lg-12 text-center mt-3">
                        <a href="<?php echo BASE_URL."downloads" ; ?>" class="btn btn-md btn-primary"><i class="fa fa-download"></i> Go To Downloads </a>
                    </div>
                    </div>
                </div>
                
            </div>
            <?php } ?>
          </div>
        </div>
        <div class="col-lg-3"></div>
    </div>            
</div>


<?php include("footer_main.php") ; ?>


