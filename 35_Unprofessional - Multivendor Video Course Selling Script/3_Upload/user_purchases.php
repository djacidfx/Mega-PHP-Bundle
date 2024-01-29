<?php include("header_session.php") ; ?>
<?php $webtitle = "Purchases" ; ?>
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
        <h1 class="text-muted"><i class="fas fa-cart-arrow-down fa-lg"></i> Your Purchases</h1>
      </div>
    <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>You can raise Refund of an Item within <?php echo find_max_refund_day($pdo) ; ?> Days. After that Refund Period is Over.</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3"></div><div class="col-lg-6"><div class="remove-messages"></div></div><div class="col-lg-3"></div>
                        <div class="table-responsive">
                            <table  class="table table-bordered table-hover managePurchasesTable" >
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Purchase Date</th>
                                        <th>Item</th>
                                        <th>Price</th>
                                        <th>Transaction ID</th>
                                        <th>Method</th>
                                        <th>Payment Status</th>
                                        <th>Refund Status</th>
                                        <th>Author Decision</th>
                                        <th>Dispute</th>
                                        <th>Refund</th>
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
<div id="refundModal" class="modal fade " data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    		<form method="post" id="refund_form" class="refund_form">
    			<div class="modal-content">
    				<div class="modal-header">
						<h4 class="modal-title"><i class='fa fa-refresh'></i> Refund Item</h4>
    				</div>
    				<div class="modal-body">
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="form-group border bg-warning p-2 rounded">
									<small>Note : If Author doesn't respond in <?php echo find_max_refund_day($pdo) ; ?> Days. Then Refund will be credited by Reviewer into your Wallet. Till then, You have to wait for Author Decision.</small>
								</div>
								<div class="form-group">
									<label>Item Name</label>
									<input type="text" id="itemName" class="form-control" readonly />
								</div>
                                <div class="form-group">
                                    <label>Please Explain Everything.</label>
                                    <textarea name="userReason" id="userReason" class="form-control textareaVeryLarge" rows="8" required></textarea>
                                </div>
							</div>
						</div>						
					</div>
					
					
    				<div class="modal-footer">
                        <input type="hidden" name="tsnId" class="tsnId" >
                        <input type="hidden" name="btn_action" value="submitRefundForm" />
    					<input type="submit" name="action_fp" id="action_fp" class="btn btn-primary" value="Submit Refund"  />
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    					
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
<?php include("footer_main.php") ; ?>