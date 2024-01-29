<?php
ob_start();
session_start();
include("_adminarea_/db/config.php");
include("_adminarea_/db/item_functions.php");
if(isset($_SESSION['user']['user_id'])){
	 $checkStatus =  check_user_status($pdo) ;
	 //if user deactivate by admin then it's automatically logout
	 if($checkStatus == 0) {
		unset($_SESSION['user']);
		header("location: ".BASE_URL.""); 
	}
} 
$itemId = filter_var($_GET['item_id'], FILTER_SANITIZE_NUMBER_INT) ;
$categoryId = get_category_id_foritem($pdo,$itemId) ;
if(empty($itemId)){
	header("location:".BASE_URL."") ;
}
$checking = check_item_foruser($pdo,$itemId) ;
if($checking == '0'){
	header("location:".BASE_URL."") ;
}
if(check_user_verify_status($pdo) == 0) {
		header("location: ".BASE_URL."");
}
if(!isset($_SESSION['admin'])){
	$oldItemView = count_item_view($pdo,$itemId) ;
	$newView = $oldItemView + 1 ;
	$upd = $pdo->prepare("update item_db set item_viewed = '".$newView."' where item_Id = '".$itemId."'");
	$upd->execute();
}
include("product_header.php") ;
?>
<div class="container-fluid  mt-5 p-5 search-image-bg">
 	<div class="row text-center">
		<div class="col-lg-1"></div>
		<div class="col-lg-10 mt-5">
			<div id="loader-icon"></div>
			<div class="row text-white justify-content-center mt-2">
				<h3><i class="fa fa-file-text"></i> <span class="mt-1"><?php echo get_item_title($pdo,$itemId) ; ?></span></h3>
				<div class="col-lg-12 p-0 mt-2 text-light">
					<small>Created:&ensp;<?php echo get_item_created_date($pdo,$itemId) ; ?>&ensp;/&ensp;Last Update:<?php echo get_item_updated_date($pdo,$itemId) ; ?></small>
				</div>
			</div>
		</div>  
		<div class="col-lg-1"></div>
    </div>
</div>
<div class="page-content d-flex align-items-stretch">
	<div class="content-inner w-100">
		<!--***** Items *****-->  
		<div class="row">
		<div class="col-lg-1"></div>
		<div class="col-lg-6">
		<?php echo preview_image_for_product_page($pdo,$itemId) ; ?>
		<?php echo item_description_for_product_page($pdo,$itemId) ; ?>
		</div>
		<div class="col-lg-4 shadow-lg">
			<!--Item Details-->
			<div class="row" id="report2">
			
			<div class="col-lg-12" id="card-1">
			
        	<div class="card card-inverse card-info p-3 rounded">
			<?php echo item_other_details($pdo,$itemId) ; ?>
			<div class="col-lg-12 p-1 mt-2 text-left ml-1">
				<div class="row">
					<?php echo get_item_youtube_video($pdo,$itemId) ; ?>
					<?php echo item_preview($pdo,$itemId) ; ?> 
						<?php
							if(check_screenshot_foruser($pdo,$itemId) > 0) {
								$targetDir = "_adminarea_/_item_secure_/".$itemId."/";
								$fname = "screenshots";
								$files = glob($targetDir.$fname.'/*.{jpg,png,jpeg}', GLOB_BRACE);
								$in = 1 ;
								?>
								<div class="col-lg-3">
								<small class="text-muted">Screenshot</small><br>
								<?php
								foreach($files as $file) {
									$file = BASE_URL.$file ;
									?>
										<a href="<?php echo $file ; ?>" class="spotlight">
										<?php if($in == '1') { $in = 0 ; ?> <span class="btn btn-sm buttonCircle btn-primary"><i class="fa fa-camera"></i></span> <?php } ?> 
										</a>
									<?php
								}
								?>
								</div>
								<?php
							}
						?>
					<?php 
					if(isset($_SESSION['user']['user_id'])){
					?>
					<div class="col-lg-3">
					<span class="loveOld">
					<?php
						echo check_item_love($pdo,$itemId) ; 
					?>
					</span>
					<span class="loveNew"></span>
					</div>
					<?php
					} else {
					?>
					<div class="col-lg-3"><small class="text-muted">Love</small><br><a href="<?php echo BASE_URL."login/" ; ?>" class=""><i class="fa fa-heart-o text-danger fa-2x"></i> </a></div>
					<?php
					} 
					?>
				</div>
			</div>
			<div class="border mt-3"></div>
			<!--Social Share-->
			<div class="row mt-2 text-center">
				<div class="col-lg-12 p-2 text-center"><h4 class="text-muted text-center"><i class="fa fa-share-alt"></i> Social Share</h4></div>
				<div class="col-lg-12">
					<a href="http://www.facebook.com/share.php?u=<?php echo BASE_URL."item/".$itemId ; ?>" target="_blank" class=" ml-2 mt-1">
					<i class="fa fa-facebook-square text-primary fa-2x"></i>
					</a>
					<a href="https://twitter.com/share?url=<?php echo BASE_URL."item/".$itemId ; ?>&text=<?php echo get_item_title($pdo,$itemId) ; ?>" target="_blank" class=" ml-2 mt-1">
					<i class="fa fa-twitter-square text-info fa-2x"></i>
					</a>
					<a href="https://wa.me/?text=<?php echo BASE_URL."item/".$itemId ; ?>" target="_blank" class="ml-2 mt-1">
					<i class="fa fa-whatsapp text-success fa-2x"></i>
					</a>
				</div>
			</div>
			<!--Item Purchase-->
			<div class="border mt-3"></div>
			<!--Social Share-->
			<div class="row mt-2 text-center">
				<div class="col-lg-12 p-1">
					<?php 
					if(isset($_SESSION['user']['user_id'])){
					?>
					<a href="#!" class="viewPreview btn btn-md btn-primary"><b>Buy Now &ensp;$<?php echo get_item_price($pdo,$itemId) ; ?></b></a>
					<?php } else { ?>
					<a href="<?php echo BASE_URL."login/" ; ?>" class="btn btn-md btn-primary"><b>Buy Now &ensp;$<?php echo get_item_price($pdo,$itemId) ; ?></b></a>
					<?php } ?>
				</div>
			</div>
			<!--Item Purchase-->
			</div>
			</div>
			</div>
			<!--Item Details-->
			<!--Item Tags-->
			<div class="row" id="report2">
				<div class="col-lg-12" id="card-1">
					<div class="card card-inverse card-info p-3 rounded">
						<h5 class="text-muted text-center"><i class="fa fa-tags"></i> Item Tags</h5>
						<div class="border mt-3"></div>
						<?php echo item_tag_link($pdo,$itemId) ; ?>
					</div>
				</div>
			</div>
			<!--Item Tags-->
			<?php 
			if(check_item_selling_or_not($pdo) > 0) {
			?>
			<!--Top Downloaded Items-->
			<div class="row" id="report2">
				<div class="col-lg-12" id="card-1">
					<div class="card card-inverse card-info p-3 rounded">
						<h5 class="text-muted text-center"><i class="fa fa-signal"></i> Top Downloaded Items</h5>
						<div class="border mt-3"></div>
						<?php echo fetch_maxsaleproduct_foruser($pdo) ; ?>
					</div>
				</div>
			</div>
			<!--Top Downloaded Items-->
			<?php
			}
			?>
		</div>
		<div class="col-lg-1"></div>
		</div>
	</div>
</div> 
<div class="page-content d-flex align-items-stretch">
	<div class="content-inner w-100">
		<!--***** Related Items *****-->
		
		<div class="row">
		
		<div class="col-lg-1"></div>
		<div class="col-lg-10">
		<div class="col-lg-12 bg-white rounded p-4">
			<h5 class="text-muted"><i class="fa fa-simplybuilt"></i> Related Products</h5>
		</div>
		<?php echo related_items($pdo,$categoryId,$itemId) ; ?>
		</div>
		<div class="col-lg-1"></div>
		</div>
	</div>
</div>
<!-- View Youtube Video Modal -->
	<div id="youtubeModal" class="modal fade youtubeModal">
    	<div class="modal-dialog modal-lg">
    			<div class="modal-content">
    				<div class="modal-header">
						<h4 class="modal-title text-danger"><i class="fa fa-video text-danger"></i> Youtube Demo Video</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
    				</div>
    				<div class="modal-body1 text-center">
    				</div> 
    				<div class="modal-footer"> 
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		
    	</div>
    </div>
<!-- Preview & Checkout Modal -->
	<div id="previewModal" class="modal fade previewModal"  data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    			<div class="modal-content">
    				<div class="modal-header bg-primary">
						<h4 class="modal-title text-white"><i class="fa fa-keyboard-o"></i> Preview & Checkout</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true" class="text-white">&times;</span>
						</button>
    				</div>
					<form method="post" class="selectPay" enctype="multipart/form-data">
    				<div class="modal-body">
					
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
								<label>Name</label>
								<input type="text" name="userName" value="<?php echo get_userfullname($pdo) ;  ?>" class="form-control" readonly="readonly"  />
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
								<label>Email</label>
								<input type="text" name="userEmail" value="<?php echo get_useremail($pdo) ; ?>" class="form-control" readonly="readonly"  />
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
								<label>Item Name</label>
								<input type="text" name="itemName" value="<?php echo get_item_title($pdo,$itemId) ; ?>" class="form-control" readonly="readonly" />
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
								<label>Payment Method*</label>
								<select name="paymentMethod" class="form-control paymentMethod" data-status="<?php echo $itemId ; ?>" required>
									<option value="">Choose Payment Method</option>
									<?php echo payment_method($pdo) ; ?>
								</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
								<label>Item Amount($)</label>
								<input type="text" value="<?php echo get_item_price($pdo,$itemId) ; ?>" class="form-control" readonly="readonly" />
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
								<label>Transaction Fee($)</label>
								<input type="text" value="<?php echo get_transaction_fee($pdo) ; ?>" class="form-control transactionFee" readonly="readonly" />
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
								<label>Total Amount($)</label>
								<input type="text" name="itemAmount" value="<?php echo (get_item_price($pdo,$itemId)+ get_transaction_fee($pdo)) ; ?>" class="form-control itemAmount" readonly="readonly" />
								</div>
							</div>
						</div>
					
    				</div> 
    				<div class="modal-footer">
						<input type="hidden" name="itemNumber" value="<?php echo $itemId ; ?>"  />
						<input type="hidden" name="userId" value="<?php echo $_SESSION['user']['user_id'] ; ?>"  />
						<input type="hidden" name="btn_action" value="selectPayment"  />
						<input type="submit" value="Proceed To Checkout" name="actionBtn" class="actionBtn btn btn-md btn-primary"  />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
					</form>
    			</div>
    		
    	</div>
    </div>
<!-- Stripe Checkout Modal -->
	<div id="stripePayModal" class="modal fade stripePayModal"  data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    			<div class="modal-content">
    				<div class="modal-header bg-primary">
						<h4 class="modal-title text-white"><i class="fa fa-cc-stripe"></i> Pay via Stripe</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true" class="text-white">&times;</span>
						</button>
    				</div>
					<form action="<?php echo BASE_URL."stripemsg/" ; ?>" method="post" class="stripePay" enctype="multipart/form-data" id="payment_form">
    				<div class="modal-body">
					
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label class="text-muted">Card Number</label>
										<div id="card_number" class="field form-control"></div>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label class="text-muted">Expiry MM/YY</label>
										<div id="card_expiry" class="field form-control"></div>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label  class="text-muted">CVC</label>
									<div id="card_cvc" class="field form-control"></div>
								</div>
							</div>
							<div class="col-lg-12 p-2"><div id="paymentResponse"></div> </div>
						</div>
					
    				</div> 
    				<div class="modal-footer">
						<input type="hidden" name="itemAmount" value="<?php echo (get_item_price($pdo,$itemId)+ get_transaction_fee($pdo))  ; ?>" />
						<input type="hidden" name="itemNumber" value="<?php echo $itemId ; ?>"  />
						<input type="hidden" name="userId" value="<?php echo $_SESSION['user']['user_id'] ; ?>"  />
						<input type="hidden" name="btn_action" value="selectPaymentStripe"  />
						<input type='hidden' name='currency_code' value='USD'> 
						<input type="submit" value="Pay $<?php echo (get_item_price($pdo,$itemId)+ get_transaction_fee($pdo)) ; ?>" name="stripepayactionBtn" class="stripepayactionBtn btn btn-md btn-primary"  />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
					</form>
    			</div>
    		
    	</div>
    </div>
<!--Paypal Checkout Modal-->
	<div id="paypalPayModal" class="modal fade paypalPayModal"  data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    			<div class="modal-content">
    				<div class="modal-header bg-primary">
						<h4 class="modal-title text-white"><i class="fa fa-paypal"></i> Pay via Paypal</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true" class="text-white">&times;</span>
						</button>
    				</div>
					<form action="<?php echo BASE_URL."paypalPayments.php" ; ?>" method="post" enctype="multipart/form-data" >
    				<div class="modal-body">
					
						<h4 class="text-muted text-center">Reconfirm & Go to Paypal</h4>
					
    				</div> 
    				<div class="modal-footer">
						<input type="hidden" name="item_amount" value="<?php echo (get_item_price($pdo,$itemId)+ get_transaction_fee($pdo)) ; ?>" />
						<input type="hidden" name="item_number" value="<?php echo $itemId ; ?>"  />
						<input type="hidden" name="uid" value="<?php echo $_SESSION['user']['user_id'] ; ?>"  />
						<input type="hidden" name="cmd" value="_xclick" />
						<input type="hidden" name="no_note" value="1" /> 
						<input type="hidden" name="lc" value="UK" /> 
						<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" /> 
						<input type="submit" value="Pay $<?php echo (get_item_price($pdo,$itemId)+ get_transaction_fee($pdo)) ; ?> via Paypal"  class="btn btn-md btn-primary"  />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
					</form>
    			</div>
    		
    	</div>
    </div>
	
<!--Wallet Checkout Modal-->
	<div id="walletPayModal" class="modal fade walletPayModal"  data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    			<div class="modal-content">
    				<div class="modal-header bg-primary">
						<h4 class="modal-title text-white"><i class="fa fa-credit-card-alt"></i> Pay via Wallet</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true" class="text-white">&times;</span>
						</button>
    				</div>
					<form action="<?php echo BASE_URL."walletPay/" ; ?>" method="post" enctype="multipart/form-data" >
    				<div class="modal-body text-center">
					
						<h4 class="text-muted text-center">No Transaction Fee, Hurry Up!</h4>
					
    				</div> 
    				<div class="modal-footer">
						<input type="hidden" name="item_amount" value="<?php echo get_item_price($pdo,$itemId) ; ?>" />
						<input type="hidden" name="item_number" value="<?php echo $itemId ; ?>"  />
						<input type="hidden" name="Wallet_Purchase" value="Wallet"  />
						<input type="hidden" name="uid" value="<?php echo $_SESSION['user']['user_id'] ; ?>"  />
						<input type="submit" value="Pay $<?php echo get_item_price($pdo,$itemId) ; ?> via Wallet"  class="btn btn-md btn-primary"  />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
					</form>
    			</div>
    		
    	</div>
    </div>
	
<!--Wallet Insufficient Balance Modal-->
	<div id="walletInsufficientModal" class="modal fade walletInsufficientModal"  data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    			<div class="modal-content">
    				<div class="modal-header bg-danger">
						<h4 class="modal-title text-white"><i class="fa fa-times"></i> Insufficient Credit Balance</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true" class="text-white">&times;</span>
						</button>
    				</div>
    				<div class="modal-body text-center">
					
						<h5 class="text-danger text-center">You have Insufficient Credit Balance to Purchase this Item</h5>
						<hr />
						<div class="col-lg-12"><a href="<?php echo BASE_URL."addcredit/" ; ?>" class="btn btn-md- btn-success">Add Credit</a></div>
					
    				</div> 
    				<div class="modal-footer">
						
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		
    	</div>
    </div>
<?php
include("footer_js.php");
include("footer_stripe.php");
?>