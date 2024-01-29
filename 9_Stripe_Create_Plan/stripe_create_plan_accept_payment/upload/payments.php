<?php
require_once("admin/db/config.php");
require_once("admin/db/function_xss.php");

$payment_id = $statusMsg = $payment_status = ''; 
$ordStatus = 'error'; 

// Check whether stripe token is not empty 
if(!empty($_POST['tokenStripe'])){ 
     
	$item_id = $_POST['item_number'] ; 
	$itemName = item_name($pdo,$item_id) ;
    $token  = $_POST['tokenStripe'] ; 
    $name = $_POST['name']; 
    $email = $_POST['email'] ; 
	$itemPrice = $_POST['item_amount'] ;
	$currency = $_POST['currency_code'] ;
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
                $date = date('Y-m-d') ;
				$ins = $pdo->prepare("insert into payments (name, email, item_name, item_number, item_price, item_price_currency, amount, txn_id, payment_status, created_date, modified_date) values('".$name."','".$email."','".$itemName."','".$item_id."','".$itemPrice."','".$currency."','".$paidAmount."','".$transactionID."','".$payment_status."','".$date."',NOW())");
				$ins->execute();
				$statement = $pdo->query("SELECT LAST_INSERT_ID()");
				$payment_id = $statement->fetchColumn();
                // If the order is successful 
                if($payment_status == 'succeeded'){ 
                    $ordStatus = 'Success'; 
					$plan = $pdo->prepare("select success_message from subscription_admin where id='1'") ;
					$plan->execute();
					$planData = $plan->fetchAll(PDO::FETCH_ASSOC);
					foreach($planData as $data){
						$statusMsg = _e($data['success_message']) ;
					}
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
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>css/all.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>css/custom.css">
</head>
<body>
<div id="logreg-forms" class="shadow-lg">
	<div class="modal-header justify-content-center bg-white">
		<img src="<?php echo BASE_URL; ?>images/siteLogo.png" class="img-fluid"  alt="Logo">
	</div>
        	
				<?php
				
				?>
				<div class="col-lg-12 text-center p-3">
					<h5 class="text-muted">
						<?php 
						if($payment_status === "succeeded") {
						?>
						<i class="fa fa-check text-success"></i>
						<?php
						} else {
						?>
						<i class="fa fa-times text-danger"></i>
						<?php 
						}
							echo $statusMsg ; 
						?>
					</h5>
				</div>
				<?php if(!empty($payment_id)){ ?>
				<div class="col-lg-12 text-left p-3">
					<h4>Payment Information</h4>
					<p><b>Transaction ID:</b> <?php echo $transactionID; ?></p>
					<p><b>Paid Amount:</b> <?php echo $paidAmount.' '.$paidCurrency; ?></p>
					<p><b>Payment Status:</b> <?php echo $payment_status; ?></p>
					<h4>Product Information</h4>
					<p><b>Name:</b> <?php echo $itemName; ?></p>
					<p><b>Price:</b> <?php echo $itemPrice.' '.$currency; ?></p>
				</div>
				<?php } ?>
				<div class="col-lg-12 text-center p-3"> 
				<a href="<?php echo BASE_URL ; ?>" class="btn btn-info btn-md text-white"> Back to Home</a>
				</div>
				
</div>
</body>
</html>

