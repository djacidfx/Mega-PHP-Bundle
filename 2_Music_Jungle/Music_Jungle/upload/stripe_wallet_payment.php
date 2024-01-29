<?php
ob_start();
session_start();
include("_adminarea_/db/config.php");
include("_adminarea_/db/item_functions.php");
if(!isset($_SESSION['user']['user_id'])){
	header("location: ".BASE_URL.""); 
}

$admin = $pdo->prepare("SELECT * FROM ot_admin WHERE id = '1'");
$admin->execute();   
$admin_result = $admin->fetchAll(PDO::FETCH_ASSOC);
$total = $admin->rowCount();
foreach($admin_result as $adm) {
//escape all  data
	$pay_email = _e($adm['pay_email']);
	$rec_email = _e($adm['rec_email']);
	$STRIPE_API_KEY = $adm['STRIPE_SECRET_KEY'] ;
	define("STRIPE_API_KEY", $STRIPE_API_KEY);
}
$headers = "";

$payment_id = $statusMsg = $payment_status = ''; 
$ordStatus = 'error'; 

// Check whether stripe token is not empty 
if(!empty($_POST['tokenStripe'])){ 
     
	$planAmount = $_POST['planAmount'] ; 
	$planId = $_POST['planId'] ; 
	$planName = get_wallet_plan_name($pdo,$planId) ;
    $token  = $_POST['tokenStripe'] ; 
	$bonusAmount = $_POST['bonusAmount'] ;
	$itemPrice = $planAmount + $bonusAmount ;
	$currency = $_POST['currency_code'] ;
	$uid = $_POST['userId'] ;
	$name = get_userfullname_byid($pdo,$uid) ;
	$email = get_useremail_byid($pdo,$uid) ;
	$userWallet = user_wallet_amount($pdo) ;
	$newWallet = $userWallet + $itemPrice ;
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
                $payDate = date('Y-m-d') ;
				$complete_status = "1";
				
				$statement = $pdo->prepare("insert into ot_user_wallet (wallet_user_id, planId, planAmt, bonusAmt, wallet_amt, wallet_txn_id, wallet_method, wallet_complete_status, wallet_date) values (?,?,?,?,?,?,?,?,?)");
				$statement->execute(array($uid, $planId, $planAmount, $bonusAmount, $total_amt, $txn_id, 'Stripe', '1', $payDate));
				$updWallet = $pdo->prepare("update ot_user set user_wallet = '".$newWallet."' where user_id = '".$uid."'");
				$updWallet->execute();
				if($pay_email == '1') {
					$userName = get_userfullname_byid($pdo,$uid) ;
					$userEmail = get_useremail_byid($pdo,$uid) ;
					$adminName = get_admin_name($pdo) ;
					$payMe = 'Stripe' ;
					$to = $rec_email ;
					$subject = "Congratulation! New Wallet Payment via Stripe";
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
					$headers .= 'From: '.$adminName.'' . "\r\n" . 'Reply-To: '.$rec_email.'' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
					include("email_for_wallet.php");
					mail($to, $subject, $body, $headers);
				}
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
}else{ 
    $statusMsg = "We found some error."; 
} 
?>
<!--
Only For Some Designing Part
author: Boostraptheme
author URL: https://boostraptheme.com
License: Creative Commons Attribution 4.0 Unported
License URL: https://creativecommons.org/licenses/by/4.0/
-->

<!DOCTYPE html>
<html>

<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

    <title>Stripe Payment</title>
    <link rel="shortcut icon" href="<?php echo BASE_URL ; ?>img/favicon.ico">
	<link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/RobotCondesedFont.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ; ?>font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/font-icon-style.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/style.default.css" id="theme-stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/pages/login.css">
</head>

<body> 
<section class="hero-area">
        <div class="overlay"></div>
        <div class="container">
          <div class="row">
            <div class="col-lg-3"></div>
			<div class="col-lg-6">
                <div class="contact-h-cont">
                  <h3 class="text-center"><img src="<?php echo BASE_URL ; ?>img/logo.png" class="img-fluid" alt=""></h3><br>
                    <div class="form-group text-center">
						<?php if($payment_status === "Completed") { ?>
                      	<h6 class="text-muted"><i class="fa fa-check-circle text-success"></i>&ensp;<?php echo $statusMsg ; ?></h6>
						<?php } else { ?>
						<h6 class="text-danger"><i class="fa fa-times text-danger"></i>&ensp;<?php echo $statusMsg ; ?></h6>
						<?php } ?>	
						<hr />					
                    </div>
					<?php if(!empty($txn_id)){ ?>  
                    <div class="form-group text-center" >
                       <h4>Payment Information</h4>
					   <p><b>Transaction ID:</b> <?php echo $txn_id; ?></p>
					   <p><b>Paid Amount:</b> $<?php echo $planAmount ; ?></p>
					   <p><b>Payment Status:</b> <?php echo $payment_status; ?></p>
					   <hr />
					   <h4>Wallet Information</h4>
					   <p><b>Plan Name :</b><?php echo $planName ; ?></p>
					   <p><b>Plan Amount :</b> $<?php echo $planAmount ; ?></p>
					   <p><b>Bonus Amount :</b> $<?php echo $bonusAmount ; ?></p>
					   <p><b>Total Credit Amount :</b> $<?php echo $itemPrice ; ?></p>
					   <p><b>New Wallet Balance :</b> $<?php echo $newWallet ; ?></p>
                    </div> 
					  
                    <div class="row text-center">
						<div class="col-lg-12 mt-2">
						<a href="<?php echo BASE_URL  ; ?>" class="btn btn-general btn-blue" role="button"><i class="fa fa-cart-arrow-down"></i> Continue Shopping</a>
						</div>
					</div>
					<?php } else { ?>
					<div class="row text-center">
						<div class="col-lg-12 mt-2">
						<a href="<?php echo BASE_URL  ; ?>" class="btn btn-general btn-blue" role="button"><i class="fa fa-home"></i> Go Back To Home </a>
						</div>
					</div>
					<?php } ?>
                </div>
            </div>
			<div class="col-lg-3"></div>
          </div>  
        </div>
      </section>
</body>
</html>

<?php include("footer.php") ; ?>


