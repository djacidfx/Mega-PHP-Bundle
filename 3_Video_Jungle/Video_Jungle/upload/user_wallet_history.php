<?php
include("header.php") ;
if(!isset($_SESSION['user']['user_id'])){
	header("location: ".BASE_URL.""); 
}
if(check_user_verify_status($pdo) == 0) {
		header("location: ".BASE_URL."");
	}
?>
<div class="container-fluid  mt-5 p-5 search-image-bg">
 	<div class="row text-center">
		<div class="col-lg-3"></div>
		<div class="col-lg-6 mt-5">
			<div class="row text-white justify-content-center">
				<div class="col-lg-12"><h2 class="mt-1"><i class="fa fa-clock-o"></i>&ensp;Wallet History</h2></div>
				<div class="col-lg-12"><h5>Credit Balance : $<?php echo (int)user_wallet_amount($pdo) ; ?></h5></div>
			</div>
		</div>  
		<div class="col-lg-3"></div>
    </div>
</div>
<div class="page-content d-flex align-items-stretch minH">
	<div class="content-inner w-100">
		<!--***** Purchased Items *****-->  
		<div class="row">
		<div class="col-lg-2"></div>
		<div class="col-lg-8">
		<?php echo fetch_wallet_history($pdo) ; ?>
		<div class="jQueryWalletItem"></div>
		</div>
		<div class="col-lg-2"></div>
		</div>
	</div>
</div> 
<?php include("footer_js.php") ; ?>
