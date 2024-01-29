<?php
session_start();
ob_flush();
//pass your item name with in double inverted comma i.e. " " example $_POST['item_id'] Note : It is hidden field which you can save into your database when payment is successfull.
$itemId = filter_var("1512" , FILTER_SANITIZE_NUMBER_INT);
//pass your item name with in double inverted comma i.e. " " example $_POST['item_name']
$itemName = filter_var("Premium Item" , FILTER_SANITIZE_STRING);
//pass your Item Price  with in double inverted comma i.e. " " example $_POST['item_price']
$itemPrice = filter_var("19" , FILTER_SANITIZE_NUMBER_INT);
//link to your Website Logo with in double inverted comma i.e. " " 
$logoLink = filter_var("imagesStripe/siteLogo.png" , FILTER_SANITIZE_STRING);
//pass your Customer Email with in double inverted comma i.e. " " example $_POST['user_email']
$customerEmail = filter_var("user@user.com" , FILTER_SANITIZE_EMAIL);
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Stripe Pay</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<meta name="description" content="Stripe Pay">
	<link rel="stylesheet" type="text/css" href="cssStripe/main.css">
	<link rel="stylesheet" type="text/css" href="cssStripe/all.min.css">
	<link rel="stylesheet" type="text/css" href="cssStripe/custom.css">
</head>

<body>
<div id="logreg-forms" class="shadow-lg">
	<div class="modal-header justify-content-center bg-white">
		<img src="<?php echo $logoLink ; ?>" class="img-fluid"  alt="Logo">
	</div>
		
        	<form action="payments.php" class="form-signin"  id="payment_form" method="post">
				<div class="form-group">
					<div class="row">
						<div class="col-lg-6">
							 <label class="text-muted">Item Name</label>
							<div class="input-group">
								<input type="text" class="form-control input-sm" name="itemName" id="itemName" placeholder="Item Name" required autofocus value="<?php echo $itemName ; ?>" readonly="readonly" />
							</div>
						</div>
						<div class="col-lg-6">
						<label class="text-muted">Amount</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">(USD)&ensp;<b> $</b></span>
							</div>
							<input type="text" name="item_amount" id="price" class="form-control" placeholder="Amount" required autofocus readonly="readonly" value="<?php echo $itemPrice ; ?>"> 
						</div>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
					<div class="col-lg-6">
                        <label class="text-muted">Cardholder Name</label>
						<div class="input-group">
							<input type="text" class="form-control input-sm" name="name" id="name" placeholder="Cardholder Name" required autofocus maxlength="50" />
						</div>
					</div>
					<div class="col-lg-6">
                        <label class="text-muted">Email</label>
						<div class="input-group">
							<input type="email" class="form-control input-sm" name="email" id="email" placeholder="Email" required autofocus maxlength="50" value="<?php echo $customerEmail ; ?>" readonly="readonly" />							
						</div>
					</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="row">
					<div class="col-lg-6">
                        <label class="text-muted">Card Number</label>
						<div class="input-group">
							<div id="card_number" class="field form-control"></div>
						</div>
					</div>
					<div class="col-lg-3">
							<label class="text-muted">Expiry MM/YY</label>
							<div class="input-group">
								<div id="card_expiry" class="field form-control"></div>
							</div>
						</div>
						<div class="col-lg-3">
							<label  class="text-muted">CVC</label>
							<div id="card_cvc" class="field form-control"></div>
						</div> 
					</div>
				</div>
				
					<div class="row justify-content-center">
						<input type="hidden" name="itemId" value="<?php echo $itemId ; ?>" >
						<input type='hidden' name='currency_code' value='USD'> 
							<button type="submit" class="btn btn-sm btn-warning" id="submitBtn"><img src="imagesStripe/Checkout.png" class="img-fluid w-75"  alt="Stripe Checkout"></button>
					</div>                     
               
			 </form>
			 <div class="col-lg-12 p-2"><div id="paymentResponse"></div> </div>
</div>
<!-- Stripe JS library -->
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript" src="jsStripe/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="jsStripe/errorMsg.js"></script>

</body>
</html>
