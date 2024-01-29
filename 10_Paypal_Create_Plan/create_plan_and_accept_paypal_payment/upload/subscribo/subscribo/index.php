<?php
require_once("admin/db/config.php");
require_once("admin/db/function_xss.php");
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Subscription Pay</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<meta name="description" content="Subscription Pay">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>css/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>css/all.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>css/custom.css">
</head>

<body>
<div id="logreg-forms" class="shadow-lg">
	<div class="modal-header justify-content-center bg-white">
		<img src="<?php echo BASE_URL; ?>images/siteLogo.png" class="img-fluid"  alt="Logo">
	</div>
        	<form action="<?php echo BASE_URL; ?>payment.php" class="form-signin" method="post">
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
				<div class="input-group mb-3">
					<div class="input-group-prepend">
						<span class="input-group-text">(USD)&ensp;<b> $</b></span>
					</div>
					<input type="text" name="item_amount" id="price" class="form-control" placeholder="Price" required autofocus readonly="readonly"> 
				</div>
				<input type="hidden" name="cmd" value="_xclick" />
				<input type="hidden" name="item_name" value="plan"  >
				<input type="hidden" name="no_note" value="1" /> 
				<input type="hidden" name="lc" value="UK" /> 
				<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" /> 
				<div class="col-lg-12 text-center">  
				<button type="submit" class="btn btn-sm btn-warning"><img src="<?php echo BASE_URL; ?>images/Checkout.png" class="img-fluid w-75"  alt="PayPal Checkout"></button>
				</div>
				
            </form>
</div>
<script type="text/javascript" src="<?php echo BASE_URL; ?>js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>js/errorMsg.js"></script>
</body>
</html>
