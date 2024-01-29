<?php 
ob_start();
session_start();
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ;
check_user_logged_in($pdo) ;
$payment_status = filter_var($_REQUEST['st'], FILTER_SANITIZE_STRING) ; 
$payment_id = parse_str($_GET['cm'],$_MYVAR) ;
$nt = '1' ;
?>

<?php $webtitle = "Paypal Payment Message" ; ?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>

<?php include("sidebar_index.php"); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1 class="text-muted"><i class="fas fa-credit-card fa-lg"></i> Payment Message</h1>
      </div>
    </section>
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header">
                <?php if($payment_status === "Completed") { ?>
                    <h4 class="text-muted"><i class="fa fa-check-circle text-success"></i>&ensp;Your Transaction is Successful</h4>
                <?php } else { ?>
                    <h4 class="text-danger"><i class="fa fa-times text-danger"></i>&ensp;Your Transaction is Not Successful. Try Again.</h4>
                <?php } ?>
            </div>
            <?php if($payment_status === "Completed"){ ?>  
            <div class="card-body">
                <div class="row">
                        <?php if(empty($_MYVAR['wpus'])) { ?>
                        <div class="col-lg-12 text-center mt-3">
                        <a href="<?php echo BASE_URL."downloads" ; ?>" class="btn btn-md btn-primary"><i class="fa fa-download"></i> Go To Downloads </a>
                        </div>
                        <?php } else { ?>
                        <div class="col-lg-12 text-center mt-1">
                        <b>Credited Amount:</b> $<?php echo $_MYVAR['planAmount'] ; ?>
                        </div>
                        <div class="col-lg-12 text-center mt-2">
                        <a href="<?php echo BASE_URL."wallet" ; ?>" class="btn btn-md btn-primary mt-3"><i class="fa fa-credit-card"></i> Check Wallet Balance & Transaction </a>
                        </div>
                        <?php } ?>
                    
                </div>  
            </div>
            <?php } ?>
          </div>
        </div>
        <div class="col-lg-3"></div>
    </div>            
</div>


<?php include("footer_main.php") ; ?>


