<?php
ob_start();
session_start();
include("setup.php") ;

if(!empty($_POST['tokenStripe'])){ 
     
    $token  = $_POST['tokenStripe'] ; 
    $name = $_POST['uname']; 
    $email = $_POST['uemail'] ; 
	$amount = $_POST['amount'] ;
	$currency = $_POST['currency_code'] ;
    $desname = "Item" ;
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
        $itemPriceCents = ($amount*100); 
         
        // Charge a credit or a debit card 
        try {  
            $charge = \Stripe\Charge::create(array( 
                'customer' => $customer->id, 
                'amount'   => $itemPriceCents, 
                'currency' => $currency, 
                'description' => $desname 
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
                $transactionID = $chargeJsonData['balance_transaction']; 
                $paidAmount = $chargeJsonData['amount']; 
                $paidAmount = ($paidAmount/100); 
                $paidCurrency = $chargeJsonData['currency']; 
                $payment_status = $chargeJsonData['status']; 
				
				
                // If the Donation is successful 
                if($payment_status == 'succeeded'){ 
                    $ordStatus = 'Success'; 
					$statusMsg = "Donation Successful." ;
                    
                    $to = ADMIN_EMAIL ;
                    $subject = "New Support";
                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
                    $headers .= 'From: '.ADMIN_NAME.'' . "\r\n" . 'Reply-To: '.ADMIN_EMAIL.'' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
                    include("email_to_admin.php");
                    mail($to, $subject, $body, $headers);
                    
                    $uto = $email ;
                    $usubject = "Thank You for Support";
                    $uheaders  = 'MIME-Version: 1.0' . "\r\n";
                    $uheaders .= "Content-type: text/html; charset=iso-8859-1\r\n";
                    $uheaders .= 'From: '.$name.'' . "\r\n" . 'Reply-To: '.$email.'' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
                    include("email_to_user.php");
                    mail($uto, $usubject, $ubody, $uheaders);
                    
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?php echo META_SITE_TITLE ; ?></title>
    <meta property="og:title" content="<?php echo META_SITE_TITLE ; ?>" />
    <meta property="og:description" content="<?php echo META_SITE_DESCRIPTION ; ?>" />
    <link href="<?php echo BASE_URL ; ?>css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="<?php echo BASE_URL ; ?>css/custom.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo BASE_URL ; ?>img/favicon.png">
</head>
<body class="bg-dark" > 
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3"></div>        
            <div class="col-lg-6 mt-5">
                <div class="card bg-dark shadow-lg text-center">
                    <div class="card-header ">
                        <h4 class="text-muted">
                            <?php if($payment_status === "succeeded") { ?>
                            <i class="bi bi-bookmark-star-fill text-warning"></i> <?php echo SUCCESSFUL_HEADING ; ?>
                            <?php } else { ?> 
                            <i class="bi bi-bookmark-x-fill text-danger"></i> <?php echo UNSUCCESSFUL_HEADING ; ?>
                            <?php } ?>
                        </h4>
                    </div>
                    <div class="card-body text-center text-white p-3">
                        <?php if($payment_status === "succeeded") { ?><?php echo THANK_YOU_MESSAGE ; ?><?php } else { ?> <?php echo RETRY_DONATION_MESSAGE ; ?> <?php } ?>
                    </div>
                    <div class="card-footer text-center">
                        <a href="<?php echo BASE_URL ; ?>" class="btn btn-grey btn-sm"> <i class="bi bi-house-fill"></i> </a>
                    </div>
                </div>                            
            </div>
            <div class="col-lg-3"></div> 
        </div>
    </div>
    
    <script src="<?php echo BASE_URL ; ?>js/jquery.min.js" ></script>
    <script src="<?php echo BASE_URL ; ?>js/popper.min.js" ></script>
    <script src="<?php echo BASE_URL ; ?>js/bootstrap.min.js"></script>	
</body>