<?php
if (!empty($_REQUEST)) {
require_once("header.php");
$payment_status = filter_var($_REQUEST['st'], FILTER_SANITIZE_STRING) ; // Paypal product status
$payment_id = parse_str($_GET['cm'],$_MYVAR) ;
$userWallet = user_wallet_amount($pdo) ;
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

    <title>Paypal Payment</title>
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
                      	<h6 class="text-muted"><i class="fa fa-check-circle text-success"></i>&ensp;Your Paypal Transaction is Successful.</h6>
						<?php } else { ?>
						<h6 class="text-danger"><i class="fa fa-times text-danger"></i>&ensp;Your Paypal Transaction is not Successful. Try Again.</h6>
						<?php } ?>	
						<hr />					
                    </div>
					<?php if($payment_status === "Completed"){ ?>  
                    <div class="row text-center">
						<div class="col-lg-12 mt-2">
						<?php if(empty($_MYVAR['wpus'])) { ?>
						<a href="<?php echo BASE_URL."downloads/" ; ?>" class="btn btn-general btn-blue" role="button"><i class="fa fa-download"></i> Go To Download </a>
						<?php } else {  ?>
						<h4>Wallet Information</h4>
					   <p><b>Plan Name :</b>&ensp;<?php echo $_GET['item_name'] ; ?></p>
					   <p><b>Plan Amount :</b> $<?php echo $_MYVAR['planAmount'] ; ?></p>
					   <p><b>Bonus Amount :</b> $<?php echo $_MYVAR['Bonus_Amount'] ; ?></p>
					   <p><b>Total Credit Amount :</b> $<?php echo ($_MYVAR['planAmount'] + $_MYVAR['Bonus_Amount']) ; ?></p>
					   <hr>
					   <a href="<?php echo BASE_URL  ; ?>" class="btn btn-general btn-blue" role="button"><i class="fa fa-cart-arrow-down"></i> Continue Shopping</a>
						<?php } ?>
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
<?php  
} else {
	header("location : ".BASE_URL."");
}
?>
