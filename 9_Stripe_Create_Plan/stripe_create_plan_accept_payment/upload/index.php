<?php
require_once("admin/db/config.php");
require_once("admin/db/function_xss.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Stripe Pay</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<meta name="description" content="Stripe Pay">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>css/all.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>css/custom.css">
</head>

<body>
<div id="logreg-forms" class="shadow-lg">
	<div class="modal-header justify-content-center bg-white">
		<img src="<?php echo BASE_URL; ?>images/siteLogo.png" class="img-fluid"  alt="Logo">
	</div>
		
        	<form action="<?php echo BASE_URL; ?>payments.php" class="form-signin"  id="payment_form" method="post">
				<select name="item_number" class="selectPlan form-control" required >
				<option value="">Select Plan</option>
				<?php
				$plan = $pdo->prepare("select * from subscription_plan where sub_status = '1' order by id asc") ;
				$plan->execute();
				$planData = $plan->fetchAll(PDO::FETCH_ASSOC);
				foreach($planData as $data){
				?>
				<option value="<?php echo _e($data['id']); ?>"><?php echo _e($data['sub_name']); ?></option>
				<?php
				}
				?>
				</select>
				<div class="form-group mt-2">
				<label class="text-muted">Amount</label>
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text">(USD)&ensp;<b> $</b></span>
					</div>
					<input type="text" name="item_amount" id="price" class="form-control" placeholder="Amount" required autofocus readonly="readonly"> 
				</div>
				</div>
				<div class="resl">
				<div class="form-group">
					<div class="row">
					<div class="col-lg-12">
                        <label class="text-muted">Cardholder Name</label>
						<div class="input-group">
							<input type="text" class="form-control input-sm" name="name" id="name" placeholder="Cardholder Name" required autofocus maxlength="50" />
						</div>
					</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
					<div class="col-lg-12">
                        <label class="text-muted">Email</label>
						<div class="input-group">
							<input type="email" class="form-control input-sm" name="email" id="email" placeholder="Email" required autofocus maxlength="50" />							
						</div>
					</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
					<div class="col-lg-12">
                        <label class="text-muted">Card Number</label>
						<div class="input-group">
							<div id="card_number" class="field form-control"></div>
						</div>
					</div>
					</div>
				</div>
				<div class="form-group">
					<div class="row">
						<div class="col-lg-4">
							<label class="text-muted">Expiry MM/YY</label>
							<div class="input-group">
								<div id="card_expiry" class="field"></div>
							</div>
						</div>
						<div class="col-lg-3">
							<label  class="text-muted">CVC</label>
							<div id="card_cvc" class="field"></div>
						</div> 
						<div class="col-lg-5 text-center mt-3">
							<input type='hidden' name='currency_code' value='USD'> 
							<button type="submit" class="btn btn-sm btn-warning" id="submitBtn"><img src="<?php echo BASE_URL; ?>images/Checkout.png" class="img-fluid w-75"  alt="PayPal Checkout"></button>
						</div> 
					</div>                     
                </div>
				</div>
			 </form>
			 <div class="col-lg-12 p-2"><div id="paymentResponse"></div> </div>
</div>
<!-- Stripe JS library -->
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>js/errorMsg.js"></script>

</body>
</html>
