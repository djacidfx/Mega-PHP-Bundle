<?php
include("header.php") ;
if(!isset($_SESSION['user']['user_id'])){
	header("location: ".BASE_URL.""); 
}
if(check_user_verify_status($pdo) == 0) {
		header("location: ".BASE_URL."");
	}
?>
<link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/profile.css">
<div class="page-content d-flex align-items-stretch minH mt-5">
	<div class="content-inner w-100">
		<div class="row mt-2" id="card-prof">
                <div class="col-md-3">
                    <div class="card hovercard">
                        <div class="cardheader"></div>
                        <div class="avatar">
                            <img alt="Profile" src="<?php echo BASE_URL ; ?>img/userprofile.png" class="img-fluid">
                        </div>
                        <div class="info">
                            <div class="title ">
                                <a href="#"><span class="nameChange"><?php echo get_userfullname($pdo) ;  ?></span></a>
                            </div>
                            <div class="desc"><span class="emailChange"><?php echo get_useremail($pdo) ; ?></span></div> 
							<div class="col-lg-12"> <a href="#" class="profileBtn btn btn-md btn-success bg-success text-white">Add Credit</a></div>
                            <hr>
                        </div>
                        <nav class="nav text-center prof-nav">
                            <ul  class="list-unstyled text-left">
								<li><a href="<?php echo BASE_URL."walletHistory/" ; ?>"<i class="fa fa-credit-card"></i> Credit Balance : $<?php echo user_wallet_amount($pdo) ; ?></a></li> 
                                <li><a href="<?php echo BASE_URL."downloads/" ; ?>"><i class="fa fa-download"></i> Downloads</a></li> 
                                <li><a href="<?php echo BASE_URL."purchases/" ; ?>"><i class="fa fa-history"></i> Payment History</a></li> 
                                <li><a href="<?php echo BASE_URL."loved/" ; ?>"><i class="fa fa-heart-o"></i> Loved Items</a></li> 
                                <li><a href="<?php echo BASE_URL."logout.php" ; ?>"><i class="fa fa-power-off"></i> Logout</a></li> 
                            </ul>
                        </nav>
                        <div class="bottom">
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card hovercard">
                        <div class="tab" role="tabpanel"> 
                            <ul class="nav nav-tabs justify-content-center" role="tablist">
                              <li class="nav-item">
                                <a class="nav-link active" href="#email" role="tab" data-toggle="tab"><span><i class="fa fa-credit-card-alt"></i></span> Wallet Plans</a>
                              </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content tabs">
                              
                              <div role="tabpanel" class="tab-pane fade  show active" id="email">
                                    <form method="post" class="wallet_validation" enctype="multipart/form-data">
                                    <div class="row mx-2">
                                        <div class="col-md-12 panel-heading">
                                            <h3 class="panel-title text-center"><i class="fa fa-tachometer"></i> Select the Plan & Add Credit Balance with No Transaction Fee.</h3><br>
                                        </div>
                                        <div class="col-md-3 ">
                                        </div>
										<div class="col-md-6 ">
                                            <div class="form-group row">
                                                <label for="example-text-input" class="ml-3 col-form-label">Choose Plan*</label>
                                                <div class="col-lg-12">
                                                    <select name="addWallet" class="addWallet form-control" required>
													<option value="">---Choose Plan---</option>
													<?php echo get_wallet_plan($pdo); ?>
													</select>
                                                </div>
												<div class="col-lg-6">
													<label for="example-text-input" class=" col-form-label">Amount($)*</label>
													<input type="text" name="planAmt" class="planAmt form-control" readonly="readonly" required  />
												</div>
												<div class="col-lg-6">
													<label for="example-text-input" class="col-form-label">Bonus Amount($)*</label>
													<input type="text" name="bonusAmt" class="bonusAmt form-control" readonly="readonly" required  />
												</div>
												<div class="col-lg-12">
												<label for="example-text-input" class="col-form-label">Payment Method*</label>
                                                    <select name="choosePayment" class="choosePayment form-control" required>
													<option value="">---Choose Payment Option---</option>
													<?php echo payment_method_for_wallet($pdo) ; ?>
													</select>
                                                </div>
                                            </div> 
                                             
                                        </div>
										<div class="col-md-3 ">
                                        </div>
										<div class="col-md-12 mt-2">
                                            <div class=" row justify-content-center">
											<div class="col-lg-12"><div class="remove-messages"></div></div>
											<div class="col-lg-4"></div>
											<div class="col-lg-4">
											<input type="hidden" name="uid" value="<?php echo $_SESSION['user']['user_id'] ; ?>"  />
											<input type="hidden" name="addwallet_submit_pr" value="Submit" />
												<input type="submit" value="Proceed To Checkout" class="btnCheck profileBtn btn btn-primary btn-sm text-white" >
											</div>
											<div class="col-lg-4"></div>
											</div>
											
										</div>
                                        
                                    </div>
							  </form>
                              </div>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
	</div>
</div> 
<?php 
include("footer_js.php") ; 
include("footer_stripe_wallet.php");
?>
<!-- Stripe Wallet Checkout Modal -->
	<div id="stripeWalletModal" class="modal fade stripeWalletModal"  data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    			<div class="modal-content">
    				<div class="modal-header bg-primary">
						<h4 class="modal-title text-white"><i class="fa fa-cc-stripe"></i> Add Credit via Stripe</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true" class="text-white">&times;</span>
						</button>
    				</div>
					<form action="<?php echo BASE_URL."stripewalletmsg/" ; ?>" method="post" class="stripePayViaWallet" enctype="multipart/form-data" id="wallet_payment_form">
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
						<input type="hidden" name="planAmount" class="planAmount" />
						<input type="hidden" name="bonusAmount" class="bonusAmount" />
						<input type="hidden" name="planId" class="planId" />
						<input type="hidden" name="userId" class="userId" value="<?php echo $_SESSION['user']['user_id'] ; ?>"  />
						<input type="hidden" name="btn_action" value="selectPaymentStripe"  />
						<input type='hidden' name='currency_code' value='USD'> 
						<input type="submit" value="Pay Now & Add Credit" name="stripepayactionBtnWallet" class="stripepayactionBtnWallet btn btn-md btn-primary"  />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
					</form>
    			</div>
    		
    	</div>
    </div>
<!--Paypal Wallet Checkout Modal-->
	<div id="paypalPayWalletModal" class="modal fade paypalPayWalletModal"  data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    			<div class="modal-content">
    				<div class="modal-header bg-primary">
						<h4 class="modal-title text-white"><i class="fa fa-paypal"></i> Add Credit via Paypal</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true" class="text-white">&times;</span>
						</button>
    				</div>
					<form action="<?php echo BASE_URL."paypalPayments.php" ; ?>" method="post" enctype="multipart/form-data" >
    				<div class="modal-body">
					
						<h4 class="text-muted text-center">Reconfirm & Go to Paypal</h4>
					
    				</div> 
    				<div class="modal-footer">
						<input type="hidden" name="only_Wallet" value="only_Wallet"  />
						<input type="hidden" name="planAmount" class="planAmount" />
						<input type="hidden" name="bonusAmount" class="bonusAmount" />
						<input type="hidden" name="planId" class="planId" />
						<input type="hidden" name="uid" value="<?php echo $_SESSION['user']['user_id'] ; ?>"  />
						<input type="hidden" name="cmd" value="_xclick" />
						<input type="hidden" name="no_note" value="1" /> 
						<input type="hidden" name="lc" value="UK" /> 
						<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" /> 
						<input type="submit" class="paypalpayactionBtnWallet btn btn-md btn-primary"  />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
					</form>
    			</div>
    		
    	</div>
    </div>
 