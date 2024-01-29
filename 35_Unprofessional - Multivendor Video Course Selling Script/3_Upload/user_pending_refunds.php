<?php include("header_session.php") ; ?>
<?php $webtitle = "Refund Requests" ; ?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>
<?php 
$refundRequest = "active" ; 
$dashboard = "active" ;
$nt = '1' ;
?>
<?php include("sidebar_index.php"); ?>
<?php echo check_user_logged_in($pdo) ; ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1 class="text-muted"><i class="fas fa-retweet fa-lg"></i> Pending Refund Request</h1>
      </div>
      <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>Here You find Refund Requests from your Buyer. If You don't take Decision within <?php echo find_max_refund_day($pdo) ; ?> Days then Refund will be in Favor of Buyer.</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table  class="table table-bordered table-hover managePendingRefundTable" >
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Refund Date</th>
                                        <th>Item</th>
                                        <th>Purchase Date</th>
                                        <th>Amount</th>
                                        <th>Item Downloaded</th>
                                        <th>Status</th>
                                        <th>Dispute</th>
                                        <th>Your Decision</th>
                                        <th>Action</th>
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

<div id="authorModal" class="modal fade " data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    		<form method="post" id="author_form" class="author_form">
    			<div class="modal-content">
    				<div class="modal-header">
						<h4 class="modal-title"><i class='fa fa-retweet'></i> Refund Decision Form</h4>
    				</div>
    				<div class="modal-body">
						<div class="row">
                            <div class="col-lg-3"></div><div class="col-lg-6"><div class="remove-messages"></div></div><div class="col-lg-3"></div>
							<div class="col-lg-12 col-md-12">
								<div class="form-group border bg-warning p-2 rounded">
									<small>Note : If You Decline the Request then Buyer has 1 more chance to Raise Dispute. Dispute will be reviewed on Your & Buyer Explanation. So, Explain Everything from your Side.</small>
								</div>
								<div class="form-group">
									<label>User Reason</label>
									<textarea name="userReason" id="userReason" class="userReason form-control textareaVeryLarge" rows="8" readonly></textarea>
								</div>
                                <div class="form-group">
                                    <label>Please Explain Everything about Your Decision.</label>
                                    <textarea name="authorReason" id="authorReason" class="form-control textareaVeryLarge" rows="8" required></textarea>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="decision" required>
                                        <option value="">Choose Your Decision*</option>
                                        <option value="1">Accept Refund</option>
                                        <option value="2">Decline Refund</option>
                                    </select>
                                </div>
							</div>
						</div>						
					</div>
					
					
    				<div class="modal-footer">
                        <input type="hidden" name="tsnId" class="tsnId" >
                        <input type="hidden" name="btn_action" value="submitAuthorRefundForm" />
    					<input type="submit" name="action_fp" id="action_fp" class="btn btn-primary" value="Submit Decision"  />
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    					
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
<?php include("footer_main.php") ; ?>