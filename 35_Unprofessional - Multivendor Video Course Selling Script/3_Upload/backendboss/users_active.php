<?php include("header.php") ; ?>
<?php 
$users = "active" ; 
$activeUsers = "active" ;
?>
<?php include("sidebar.php") ; ?>
<!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1 class="text-muted"><i class="fa fa-users"></i> Active Users </h1>
          </div>
          <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4"><div class="remove-messages"></div></div>
            <div class="col-lg-4"></div>
            <div class="col-lg-12 mt-2">
              <div class="card">
                <div class="card-header">
                  <h4>Here's the list of Only Active User whose status is active and not blocked. Note : You can Add Credit manually in any Active Users Wallet which reflects in User Wallet Statement. You can Block or Unblock User anytime.</h4>              
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table  class="table table-bordered table-hover activeUsersTable" id="activeUsersTable" >
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>User ID</th>
                                        <th>Profile Pic</th>
                                        <th>Fullname</th>
                                        <th>Username</th>
                                        <th>Email</th>	
                                        <th>SignUp Date</th>
                                        <th>Sold Items</th>
                                        <th>Sold Amount</th>
                                        <th>Purchases</th>
                                        <th>Forum Solutions</th>
                                        <th>Followers</th>
                                        <th>Following</th>
                                        <th>Wallet Balance</th>
                                        <th>Add Credit</th>
                                        <th>Profile</th>
                                        <th>Block</th>
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

<!-- Add Credit Modal -->
<div id="addcreditModal" class="modal fade addcreditModal" data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    			<div class="modal-content">
                    <form method="post" enctype="multipart/form-data" class="addcredit_form">
    				<div class="modal-header border border-top-0 border-left-0 border-right-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4 class="modal-title"><i class='fa fa-plus'></i> Add Credit to Wallet </h4>
                            </div>
                            <div class="col-lg-12">
                                <small>Note : Once You Credited the Amount into User's Wallet it cannot be Reverse Back.</small>
                            </div>
                        </div>                       
    				</div>
    				<div class="modal-body">
						<div class="row">
							<div class="col-lg-6">
								<label class="text-muted">User Fullname*</label>
                                <input type="text" name="fullname" class="form-control fullname" readonly required>
							</div>
                            <div class="col-lg-6">
								<label class="text-muted">Username*</label>
                                <input type="text" name="username" class="form-control username" readonly required>
							</div>
                            <div class="col-lg-6 mt-3">
								<label class="text-muted">Current Wallet(USD $)*</label>
                                <input type="text" name="walletbalance" class="form-control walletbalance" readonly required>
							</div>
                            <div class="col-lg-6 mt-3">
								<label class="text-muted">Added Amount(USD $)*</label>
                                <input type="number" name="addedamt" class="form-control addedamt" min="1" required autocomplete="off" autofocus>
							</div>
						</div>						
					</div>
					
					
    				<div class="modal-footer">
                        <input type="hidden" name="userId" class="userId" >
                        <input type="hidden" name="btn_action" value="sendCreditToUser">
                        <button type="submit" name="submit" class="btn-primary btn btn-sm">Add Credit</button>
    					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
    				</div>
                    </form>
    			</div>
               
    	</div>
    </div>

<?php include("footer.php") ; ?>