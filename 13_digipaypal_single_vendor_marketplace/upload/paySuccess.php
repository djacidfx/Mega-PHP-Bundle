<?php
if (!empty($_REQUEST)) {
require_once("header.php");
$product_status = filter_var($_REQUEST['st'], FILTER_SANITIZE_STRING) ; // Paypal product status
?>
<div class="container mar-top">
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="row">
				<div class="col-lg-3 col-md-3"></div>
				<div class="col-lg-6 col-md-6">
					<div class="card">
                		<div class="card-header bg-secondary text-white text-center"><h4> Payment Information</h4></div>
                		<div class="card-body">
							<div class="col-lg-12 text-left p-3">
								<h6 class="text-muted">
									<?php 
									if($product_status == "Completed") {
									?>
									<i class="fa fa-check text-success"></i>
									<?php
									echo "Your Transaction is Successful." ; 
									} else {
									?>
									<i class="fa fa-times text-danger"></i>
									<?php 
									echo "Your Transaction is not Successful. Try Again." ; 
									}
										
									?>
								</h6>
							</div>
							<?php if($product_status == "Completed") { ?>
							<hr>
							<div class="col-lg-12 text-left p-3">
								<p><b>Go to Download Option to Download the Script</b></p>
								<p><b>Transaction History inside Purchases Option.</b></p>
							</div>
							<?php } ?>
							</div>
           			 </div>
				</div>
				<div class="col-lg-3 col-md-3"></div>
			</div>
		</div>
	</div>
</div>
<?php 
include("footer.php") ; 
} else {
	header("location : ".BASE_URL."");
}
?>
