<?php 
ob_start();
session_start();
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ;
check_user_logged_in($pdo) ;
$statusMsg = "Sorry, Item Price has been Changed or Manipulated. No Amount has been Debited From Your Account.";  
$nt = '1' ;
?>

<?php $webtitle = "Paypal Error" ; ?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>

<?php include("sidebar_index.php"); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1 class="text-muted"><i class="fas fa-exclamation-circle fa-lg"></i> Error</h1>
      </div>
    </section>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">
          <div class="card">
            <div class="card-header">
                <h4 class="text-danger"><i class="fa fa-times text-danger"></i>&ensp;<?php echo $statusMsg ; ?></h4>
            </div>
          </div>
        </div>
        <div class="col-lg-2"></div>
    </div>            
</div>


<?php include("footer_main.php") ; ?>


