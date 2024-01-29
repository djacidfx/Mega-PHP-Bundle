<?php include("header.php") ; ?>
<div class="app-title">
        <div>
          <h1><i class="fa fa-usd"></i> Payments</h1>
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
								<div class="page-heading"> <h6>View Payments</h6></div>
							</div> <!-- /panel-heading -->
							<div class="panel-body">
								<div class="remove-messages"></div>
								<div class="row">
									<div class="col-md-12">
									  <div class="tile">
										<div class="tile-body">
										  <div class="table-responsive">
											<div class="table-responsive">
												<table class="table table-bordered table-hover" id="managePaymentTable">
													<thead>
														<tr>
															<th>S.No.</th>
															<th>Plan ID</th>
															<th>Plan Name</th>
															<th>Date</th>
															<th>Transaction ID</th>	
															<th>User Name</th>
															<th>User Email</th>
															<th>Price</th>
															<th>Status</th>
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
	
<?php include("footer.php") ; ?>