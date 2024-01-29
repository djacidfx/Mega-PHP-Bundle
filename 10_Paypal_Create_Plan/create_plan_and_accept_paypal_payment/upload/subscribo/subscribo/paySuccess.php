<?php
require_once("admin/db/config.php");
require_once("admin/db/function_xss.php");
if (!empty($_REQUEST)) {

$product_status = filter_var($_REQUEST['st'], FILTER_SANITIZE_STRING) ; // Paypal product status
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Transaction Complete</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<meta name="description" content="Transaction Complete">
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
				$plan = $pdo->prepare("select success_message from subscription_admin where id='1'") ;
				$plan->execute();
				$planData = $plan->fetchAll(PDO::FETCH_ASSOC);
				foreach($planData as $data){
					$msg = _e($data['success_message']) ;
				}
				?>
				<div class="col-lg-12 text-center p-5">
					<h5 class="text-muted">
						<?php 
						if($product_status === "Completed") {
						?>
						<i class="fa fa-check text-success"></i>
						<?php
							echo $msg ; 
						} else {
						?>
						<i class="fa fa-times text-danger"></i>
						<?php
							echo "There was an Error with your Payment. We'll check and contact you shortly." ;
						}
						?>
					</h5>
				</div>
				<div class="col-lg-12 text-center"> 
				<a href="<?php echo BASE_URL ; ?>" class="btn btn-info btn-md text-white"> Back to Home</a>
				</div>
				
</div>
</body>
</html>
<?php
}
?>