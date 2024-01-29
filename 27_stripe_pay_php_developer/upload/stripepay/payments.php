<?php
session_start();
ob_flush();
//Link your Database 
//include_once("folderpath/databasefilename.php") ;


$payment_id = $statusMsg = $payment_status = ''; 
$ordStatus = 'Error'; 


// Stripe API configuration (You will find it in https://dashboard.stripe.com/apikeys with Option after Developer View Test Data On means Testing Mode Otherwise Live Mode
//Stripe API KEY : Note - If you want to test in sandbox mode your api key should be starts with sk_test_ & In Live mode it starts with sk_live_   
define('STRIPE_API_KEY', 'YOUR_STRIPE_SECRET_KEY');  
// Check whether stripe token is not empty 

//Home Page URL User can go back to Your Website Home Page or Any other Page example https://www.yourwebsite.com/home.php
$homeUrl = "YOUR_WEBSITE_LANDING_URL" ;

if(!empty($_POST['tokenStripe'])){ 
     
	$itemId = $_POST['itemId'] ; 
	$itemName = $_POST['itemName'] ;
    $token  = $_POST['tokenStripe'] ; 
    $name = $_POST['name']; 
    $email = $_POST['email'] ; 
	$itemPrice = $_POST['item_amount'] ;
	$currency = $_POST['currency_code'] ;
	$date = date('Y-m-d') ;
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
                $transactionID = $chargeJsonData['balance_transaction']; 
                $paidAmount = $chargeJsonData['amount']; 
                $paidAmount = ($paidAmount/100); 
                $paidCurrency = $chargeJsonData['currency']; 
                $payment_status = $chargeJsonData['status']; 
				
                //This is for the demo where you insert into database when Transaction Complete
				
				//SQL QUERY = ("insert into payments (name, email, item_name, item_number, item_price, item_price_currency, txn_id, payment_status, created_date, modified_date) values('".$name."','".$email."','".$itemName."','".$itemId."','".$itemPrice."','".$currency."','".$transactionID."','".$payment_status."','".$date."',NOW())");
				
                // If the order is successful 
                if($payment_status == 'succeeded'){ 
                    $ordStatus = 'Success'; 
					$statusMsg = "Transaction Successful." ;
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
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Stripe Payment Page</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<meta name="description" content="Stripe Payment Page">
	<link rel="stylesheet" type="text/css" href="cssStripe/main.css">
	<link rel="stylesheet" type="text/css" href="cssStripe/all.min.css">
	<link rel="stylesheet" type="text/css" href="cssStripe/custom.css">
</head>
<body>
<div class="container mar-top">
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="row mt-n3">
				<div class="col-lg-3 col-md-3"></div>
				<div class="col-lg-6 col-md-6">
					<div class="card">
                		<div class="card-header bg-success text-white text-center">
							<h4 class="text-white"> 
								<?php 
								if($payment_status === "succeeded") {
								?>
									<i class="fa fa-check"></i>
								<?php
								} else {
								?>
									<i class="fa fa-times"></i>
								<?php 
								}
									echo $statusMsg ; 
								?>
							</h4>
						</div>
						<?php 
						if($payment_status === "succeeded") {
						?>
                		<div class="card-body">
							<h4>User Information</h4>
							<p><b>Email:</b> <?php echo $email; ?></p>
							<p><b>Name:</b> <?php echo $name ; ?></p>
							<hr>
							<h4>Payment Information</h4>
							<p><b>Transaction ID:</b> <?php echo $transactionID; ?></p>
							<p><b>Paid Amount:</b> <?php echo $paidAmount.' '.$paidCurrency; ?></p>
							<p><b>Payment Status:</b> <?php echo $payment_status; ?></p>
							<hr>
							<h4>Product Information</h4>
							<p><b>Name:</b> <?php echo $itemName; ?></p>
							<p><b>Price:</b> <?php echo $itemPrice.' '.$currency; ?></p>
						</div>
						<?php
						}
						?>
						<div class="card-footer">
							<div class="row justify-content-center p-1"> 
							<a href="<?php echo $homeUrl ; ?>" class="btn btn-info btn-md text-white w-25"> Back to Home</a>
							</div>
						</div>
           			 </div>
				</div>
				<div class="col-lg-3 col-md-3"></div>
			</div>
		</div>
	</div>
</div>

</body>
</html>

