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
	
}
$headers = "";
$userWallet = user_wallet_amount($pdo) ;
$itemPrice = filter_var($_POST['item_amount'], FILTER_SANITIZE_NUMBER_INT) ;
$payment_id = $statusMsg = $payment_status = ''; 
$ordStatus = 'error'; 

// Check whether stripe token is not empty 
if(!empty($_POST['Wallet_Purchase']) && ($userWallet >= $itemPrice)){ 
     
	$item_id = filter_var($_POST['item_number'], FILTER_SANITIZE_NUMBER_INT)  ; 
	$itemName = get_item_title($pdo,$item_id) ;
	
	$uid = filter_var($_POST['uid'], FILTER_SANITIZE_NUMBER_INT)  ;
	$name = get_userfullname_byid($pdo,$uid) ;
	$email = get_useremail_byid($pdo,$uid) ;
	$wallet = "Wallet" ;
	
	$newuserWallet = $userWallet - $itemPrice ;
    
                // Transaction details  
                $txn_id = "Wallet";  
                $total_amt = $itemPrice ;  
                $payment_status = "Completed"; 
                $payDate = date('Y-m-d') ;
				$complete_status = "1";
				
				$item_sale = get_item_sale($pdo,$item_id) + 1 ;
				$statement = $pdo->prepare("insert into ot_payments (p_user_id, p_item_id, p_total_amt, txn_id, payment_status, payment_date, complete_status, payment_method) values (?,?,?,?,?,?,?,?)");
				$statement->execute(array($uid, $item_id, $total_amt, $txn_id, $payment_status, $payDate, $complete_status,'Wallet'));
				$item_sale_upd = $pdo->prepare("update item_db set item_sale = '".$item_sale."' where item_Id = '".$item_id."'");
				$item_sale_upd->execute();
				$updWallet = $pdo->prepare("update ot_user set user_wallet = '".$newuserWallet."' where user_id = '".$uid."'");
				$updWallet->execute();
				
				if($pay_email == '1') {
					$userName = get_userfullname_byid($pdo,$uid) ;
					$userEmail = get_useremail_byid($pdo,$uid) ;
					$itemName = get_item_title($pdo,$item_id) ;
					$webUrl = BASE_URL.'item/'.$item_id ;
					$adminName = get_admin_name($pdo) ;
					$to = $rec_email ;
					$subject = "Congratulation! New Sale of an Item via Wallet";
					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
					$headers .= 'From: '.$adminName.'' . "\r\n" . 'Reply-To: '.$rec_email.'' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
					include("email_for_sale.php");
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
					   <p><b>Transaction via:</b> Wallet </p>
					   <p><b>Paid Amount:</b> $<?php echo $total_amt ; ?></p>
					   <p><b>Payment Status:</b> <?php echo $payment_status; ?></p>
					   <hr />
					   <h4>Product Information</h4>
					   <p><b>Name:</b> <?php echo $itemName; ?></p>
					   <p><b>Price:</b> $<?php echo $itemPrice ; ?></p>
					   <p><b>New Wallet Balance :</b> $<?php echo $newuserWallet ; ?></p>
                    </div> 
					  
                    <div class="row text-center">
						<div class="col-lg-12 mt-2">
						<a href="<?php echo BASE_URL."downloads/" ; ?>" class="btn btn-general btn-blue" role="button"><i class="fa fa-download"></i> Go To Download </a>
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


