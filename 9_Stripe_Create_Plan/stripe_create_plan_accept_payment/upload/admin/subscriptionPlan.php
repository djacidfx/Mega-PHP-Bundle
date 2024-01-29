<?php include("header.php") ; ?>
<div class="app-title">
        <div>
          <h1><i class="fa fa-arrows-alt"></i> Plans</h1>
          <p>Add / Edit / Activate / Deactivate Unlimited Numbers of Plans.</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
        </ul>
 </div>
 <div class="container-fluid mar-top">
      	<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="row">
		   			<div class="col-md-12 col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<div class="page-heading"> <h6>Manage Plans</h6></div>
								<button class="btn btn-success btn-sm  m-1" id="add_subscription"><i class="fa fa-plus-square"></i> Add Plan</button>
							</div> <!-- /panel-heading -->
							<div class="panel-body">
								<div class="remove-messages"></div>
								<div class="row">
									<div class="col-md-12">
									  <div class="tile">
										<div class="tile-body">
										  <div class="table-responsive">
											<div class="table-responsive">
												<table class="table table-bordered table-hover" id="manageSubscriptionTable">
													<thead>
														<tr>
															<th>S.No.</th>
															<th>ID</th>
															<th>Date</th>
															<th>Plan Name</th>
															<th>Price</th>	
															<th>Status</th>
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
	</div><!-- page-content" -->
	<!-- Subscription Modal -->
	<div id="subscriptionModal" class="modal fade " data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    		<form method="post" id="subscription_form">
    			<div class="modal-content">
    				<div class="modal-header">
						<h4 class="modal-title"><i class='fa fa-plus'></i> Add Plan</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
    				</div>
    				<div class="modal-body">
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="form-group">
									<label>Subscription Name*</label>
									<input type="text" name="sname" id="sname" class="form-control" maxlength="200" required  placeholder="Subscription Name" />
								</div>
							</div>
								<div class="col-lg-5 col-md-5">
									<div class="form-group">
										<label>Date*</label>
										<input type="text" name="sdate" id="sdate" class="form-control order_date" autocomplete="off" required  placeholder="Date" />
									</div>
								</div>
								<div class="col-lg-7 col-md-7">
									<label>Price*</label>
									<div class="input-group mb-3">
									  <div class="input-group-prepend">
										<span class="input-group-text">$</span>
									  </div>
									  <input type="text" class="form-control" placeholder="Price" name="price" id="price" autocomplete="off" required maxlength="10"  >
									</div>
								</div>
							</div>						
					</div>
					
					
    				<div class="modal-footer">
						<input type="hidden" name="sid" id="sid" >
						<input type="hidden" name="btn_action_subscribe" id="btn_action_subscribe" />
    					<input type="submit" name="action_subscribe" id="action_subscribe" class="action_subscribe btn btn-success" value="Add Subscription Plan"  />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
<?php include("footer.php") ; ?>