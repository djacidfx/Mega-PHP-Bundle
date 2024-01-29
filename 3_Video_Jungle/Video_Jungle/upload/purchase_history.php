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
				<h2 class="mt-1"><i class="fa fa-credit-card"></i>&ensp;Purchases (<span class="oldCount"><?php echo count_purchased_items($pdo); ?></span><span class="newCount"></span>)</h2>
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
		<?php echo fetch_purchased_items($pdo) ; ?>
		<div class="jQueryPurchasedItem"></div>
		</div>
		<div class="col-lg-2"></div>
		</div>
	</div>
</div> 
<?php include("footer_js.php") ; ?>
