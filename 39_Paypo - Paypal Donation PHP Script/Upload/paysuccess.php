<?php
ob_start();
session_start();
include("setup.php") ;

if (!empty($_REQUEST)) {
    $product_status = filter_var($_REQUEST['st'], FILTER_SANITIZE_STRING) ; // Paypal product status
    $transactionID = filter_var($_REQUEST['txn_id'], FILTER_SANITIZE_STRING) ;
}

$email = $_SESSION['uEmail'] ;
$name = $_SESSION['uName'] ;
$amount = $_SESSION['uAmt'] ; 

if($product_status === "Completed") { 
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
    
    unset($_SESSION['uEmail']);
    unset($_SESSION['uName']);
    unset($_SESSION['uAmt']);
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
                            <?php if($product_status === "Completed") { ?>
                            <i class="bi bi-bookmark-star-fill text-warning"></i> <?php echo SUCCESSFUL_HEADING ; ?>
                            <?php } else { ?> 
                            <i class="bi bi-bookmark-x-fill text-danger"></i> <?php echo UNSUCCESSFUL_HEADING ; ?>
                            <?php } ?>
                        </h4>
                    </div>
                    <div class="card-body text-center text-white p-3">
                        <?php if($product_status === "Completed") { ?><?php echo THANK_YOU_MESSAGE ; ?><?php } else { ?> <?php echo RETRY_DONATION_MESSAGE ; ?> <?php } ?>
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