<?php include("header.php") ; ?>
<?php 
$disputes = "active" ; 
$dashboard = "active" ;
?>
<?php include("sidebar.php") ; ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1 class="text-muted"><i class="fa fa-retweet fa-lg"></i> Pending Disputes</h1>
      </div>
      <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>Buyer Raised Dispute against Author Decision. Review Explanations of Both & Take Action on Refund Dispute.</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3"></div><div class="col-lg-6"><div class="remove-messages"></div></div><div class="col-lg-3"></div>
                        <div class="table-responsive">
                            <table  class="table table-bordered table-hover managePendingDisputeTable" >
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Buyer Email</th>
                                        <th>Author Email</th>
                                        <th>Refund Date</th>
                                        <th>Item</th>
                                        <th>Purchase Date</th>
                                        <th>Transaction ID</th>
                                        <th>Amount</th>
                                        <th>Item Downloaded</th>
                                        <th>Status</th>
                                        <th>Author Decision</th>
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

<div id="adminDisputeModal" class="modal fade " data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    		<form method="post" id="dispute_form" class="dispute_form">
    			<div class="modal-content">
    				<div class="modal-header">
						<h4 class="modal-title"><i class='fa fa-retweet'></i> Admin Decision on Dispute</h4>
    				</div>
    				<div class="modal-body">
						<div class="row">
                            <div class="col-lg-3"></div><div class="col-lg-6"><div class="remove-messages"></div></div><div class="col-lg-3"></div>
							<div class="col-lg-12 col-md-12">
								<div class="form-group">
									<label>User Reason</label>
									<textarea name="userReason" id="userReason" class="userReason form-control textareaVeryLarge" rows="8" readonly></textarea>
								</div>
                                <div class="form-group">
                                    <label>Author Explanation</label>
                                    <textarea name="authorReason" id="authorReason" class="authorReason form-control textareaVeryLarge" rows="8" readonly></textarea>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" name="decision" required>
                                        <option value="">Choose Your Decision*</option>
                                        <option value="1">In Favor of Buyer [Refund]</option>
                                        <option value="2">In Favor of Author [Not Refund]</option>
                                    </select>
                                </div>
							</div>
						</div>						
					</div>
					
					
    				<div class="modal-footer">
                        <input type="hidden" name="tsnId" class="tsnId" >
                        <input type="hidden" name="btn_action" value="submitAdminRefundForm" />
    					<input type="submit" name="action_fp" id="action_fp" class="btn btn-primary" value="Submit Decision"  />
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    					
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
<?php include("footer.php") ; ?>