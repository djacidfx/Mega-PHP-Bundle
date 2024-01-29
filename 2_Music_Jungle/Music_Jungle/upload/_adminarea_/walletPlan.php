<?php include("header.php") ; ?>
<div class="app-title">
        <div>
          <h1><i class="fa fa-money-bill"></i> Wallet Plan</h1>
		  <p class="text-success">Customer can Add Credit to their Wallet according to Your Plan.</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?php echo ADMIN_URL ; ?>dashboard.php">Dashboard</a></li>
        </ul>
 </div>
 <div class="container-fluid">
      	<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="row">
		   			<div class="col-md-12 col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<div class="page-heading"> 
								<button class="btn btn-info  m-1 bg-success border-success add_wallet_plan" id="add_wallet_plan"><i class="fa fa-plus"></i> Add Wallet Plan</button>
								</div>
							</div> <!-- /panel-heading -->
							<div class="panel-body">
								<div class="remove-messages"></div>
								<div class="row">
									<div class="col-lg-12">
									  <div class="tile">
										<div class="tile-body">
											<div class="table-responsive">
												<table class="table table-bordered table-hover" id="manageWalletPlanTable">
													<thead>
														<tr>
															<th>S.No.</th>
															<th>Plan ID</th>
															<th>Date</th>
															<th>Status</th>
															<th>Plan Name</th>	
															<th>Plan Amt</th>
															<th>Bonus Amt</th>
															<th><i class="fa fa-pencil-alt"></i></th>
															<th><i class="fa fa-ban"></i></th>
														</tr>
													</thead>
												</table><!-- /table -->
											</div>
										</div>
									  </div>
									</div>
								</div>
							</div> <!-- /panel-body -->
					</div> <!-- /panel -->	
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Add Wallet Plan Modal -->
	<div id="planModal" class="modal fade" data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    		<form method="post" id="plan_form" class="plan_form">
    			<div class="modal-content">
    				<div class="modal-header">
						<h4 class="modal-title"><i class="fa fa-plus"></i> Add Wallet Plan</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
    				</div>
    				<div class="modal-body">
						<div class="row">
							<div class="col-lg-12">
								<div class="form-group">
									<label>Plan Name* (Max 50 Characters)</label>
									<input type="text" class="form-control" id="planName" name="planName" placeholder="e.g. Starter Wallet Plan" autocomplete="off" required maxlength="50">
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label>Plan Amount* (USD $)</label>
									<input type="number" class="form-control" id="planAmt" name="planAmt" min="1" autocomplete="off" required>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
									<label>Bonus Amount* (USD $)</label>
									<input type="number" class="form-control" id="bonusAmt" name="bonusAmt" min="0" autocomplete="off" >
								</div>
							</div>
						</div>
    				</div> 
    				<div class="modal-footer"> 
						<input type="hidden" name="planId" class="planId" >
						<input type="hidden" name="btn_action_plan" id="btn_action_plan" />
    					<input type="submit" name="action_plan" id="action_plan" class="btn btn-info" value="Save Plan" />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
<?php include("footer.php") ; ?>