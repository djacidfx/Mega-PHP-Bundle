<?php include("header_session.php") ; ?>
<?php $webtitle = "Wallet" ; ?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>
<?php
$nt = '1' ;
?>
<?php include("sidebar_index.php"); ?>
<?php echo check_user_logged_in($pdo) ; ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1 class="text-muted"><i class="fas fa-credit-card fa-lg"></i> Wallet</h1>
      </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                  <h4>Add Credit cannot be Refunded. It can be used only for Purchases.</h4>
                </div>
                <div class="card-body">
                    <form class="selectWalletPay" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-12">
                            <h5>Wallet Balance : $<?php echo  find_userwallet_amt($pdo,$_SESSION['unprofessional']['id'])  ; ?></h5>
                        </div>
                        <div class="col-lg-12 mt-2">
                            <label class="text-muted">Select USD($)*</label>
                            <input type="number" name="rechargeAmt" min="<?php echo find_min_wallet($pdo) ; ?>" max="<?php echo find_max_wallet($pdo) ; ?>" class="form-control" required autofocus >
                        </div>
                        <div class="col-lg-12 mt-2">
                            <label class="text-muted">Payment Method*</label>
                            <select name="walletpaymentMethod" class="form-control walletpaymentMethod" required>
                                <option value="">Choose Payment Method</option>
                                <?php echo wallet_payment_method($pdo) ; ?>
                            </select>
                        </div>
                        <div class="col-lg-12 mt-2">
                            <div class="remove_message"></div>
                            <input type="hidden" name="btn_action" value="selectWalletPayment"  />
                            <input type="submit" value="Proceed To Checkout" name="actionBtn" class="actionBtn btn btn-md btn-primary btn-block mt-2"  />
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
          <div class="card">
            <div class="card-header">
              <h4>Here's the Summary of Wallet Add Credits.</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3"></div><div class="col-lg-6"><div class="remove-messages"></div></div><div class="col-lg-3"></div>
                        <div class="table-responsive">
                            <table  class="table table-bordered table-hover manageWalletTable" >
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Date</th>
                                        <th>Amount Added</th>
                                        <th>Transaction ID</th>
                                        <th>Method</th>
                                        <th>Payment Status</th>
                                    </tr>
                                </thead>
                            </table><!-- /table -->
                        </div>
                        
                        
                    </div>
            </div>
          </div>
        </div>
    </div>
</section>
</div>
<?php include("common_footer.php") ; ?>
    </div>
</div>
<!-- Stripe Wallet Checkout Modal -->
	<div id="stripeWalletPayModal" class="modal fade stripeWalletPayModal"  data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    			<div class="modal-content">
    				<div class="modal-header bg-primary">
						<h4 class="modal-title text-white"><i class="fa fa-credit-card"></i> Add Credit via Stripe</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true" class="text-white">&times;</span>
						</button>
    				</div>
					<form action="<?php echo BASE_URL."stripewalletmessage" ; ?>" method="post" class="stripeWalletPay" enctype="multipart/form-data" id="payment_form">
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
						<input type="hidden" name="rechargeAmt" class="rechargeAmt" />
						<input type="hidden" name="btn_action" value="selectPaymentStripe"  />
						<input type='hidden' name='currency_code' value='USD'> 
						<input type="submit" name="stripepayactionBtn" class="stripepayactionBtn btn btn-md btn-primary"  />
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
						<h4 class="modal-title text-white"><i class="fa fa-credit-card"></i> Add Credit via Paypal</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true" class="text-white">&times;</span>
						</button>
    				</div>
					<form action="<?php echo BASE_URL."paypalpay" ; ?>" method="post" enctype="multipart/form-data" >
    				<div class="modal-body">
					
						<h4 class="text-muted text-center">Reconfirm & Go to Paypal</h4>
					
    				</div> 
    				<div class="modal-footer">
						<input type="hidden" name="only_Wallet" value="only_Wallet"  />
						<input type="hidden" name="rechargeAmt" class="rechargeAmt" />
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
<?php include("wallet_js.php") ; ?>
<?php include("footer_stripewallet.php") ; ?>
</body>
</html>