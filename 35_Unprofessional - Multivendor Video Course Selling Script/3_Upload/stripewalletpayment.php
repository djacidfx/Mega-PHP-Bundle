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
    $minAmt = _e($adm['min_wallet']) ;
    $maxAmt = _e($adm['max_wallet']) ;
}
$headers = "";

$payment_id = $statusMsg = $payment_status = ''; 
$ordStatus = 'error'; 

// Check whether stripe token is not empty 
if(!empty($_POST['tokenStripe'])){ 
    $rechargeAmt = $_POST['rechargeAmt'] ;
	$currency = $_POST['currency_code'] ;
	$uid = $_SESSION['unprofessional']['id'] ;
	$name = user_fullname($pdo) ;
	$email = useremail_by_id($pdo,$uid) ;
    $userWalletAmt = find_userwallet_amt($pdo,$uid) ;
    $newWalletAmt = ($userWalletAmt + $rechargeAmt) ;
    $adminName = admin_name($pdo) ;
    $adminCopyrightName = admin_copyright_name($pdo);
    $itemName = "Active Item" ;
    $token  = $_POST['tokenStripe'] ; 
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
    if(($rechargeAmt >= $minAmt) && ($rechargeAmt <= $maxAmt) ){
    
        if(empty($api_error) && $customer){  

            // Convert price to cents 
            $itemPriceCents = ($rechargeAmt*100); 

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

                   $statement = $pdo->prepare("insert into ot_wallet(w_user_id, w_amt, w_txn_id, w_payment_status, w_complete_status, w_payment_method) values ('".$uid."', '".$total_amt."', '".$txn_id."', '".$payment_status."', '".$complete_status."','Stripe')");
                    $statement->execute();
                    
                    
                    $updateUser = $pdo->prepare("update ot_users set user_wallet = '".$newWalletAmt."' where id='".$uid."'");
                    $updateUser->execute();
                    
                    
                    
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
        $statusMsg = "Sorry, You cannot Manipulate Credit Minimum or Maximum Amount. No Amount has been Debited From Your Account.";  
    }
}else{ 
    $statusMsg = "We found some error. Try Again."; 
} 
?>

<?php $webtitle = "Stripe Wallet Recharge" ; ?>
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
                        <h6 class="text-muted">Thank You for Adding Credit in Wallet.</h6>
                    </div>
                    <div class="col-lg-12">
                        <b>Transaction ID:</b> <?php echo $txn_id; ?>
                    </div>
                    <div class="col-lg-12">
                        <b>Paid Amount:</b> $<?php echo $total_amt ; ?>
                    </div>
                    <div class="col-lg-12">
                        <b>Credited Amount:</b> $<?php echo $total_amt ; ?>
                    </div>
                    <div class="col-lg-12">
                        <b>New Wallet Balance:</b> $<?php echo $newWalletAmt; ?>
                    </div>
                    <div class="col-lg-12 text-center mt-3">
                        <a href="<?php echo BASE_URL."wallet" ; ?>" class="btn btn-md btn-primary"><i class="fa fa-credit-card"></i> Check Wallet Balance & Transaction </a>
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


