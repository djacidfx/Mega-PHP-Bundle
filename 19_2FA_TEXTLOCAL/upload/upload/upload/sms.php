<?php 
require_once('header.php');
?>
<div class="app-title">
        <div>
          <h1><i class="fa fa-comment"></i> SMS from Admin</h1>
		  <p class="text-success">All SMS from Admin to your Mobile.</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
        </ul>
 </div>
<main class="page-content">
	<div class="container-fluid">
      	<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="row">
		   			<div class="col-md-12 col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<div class="page-heading"> 
								</div>
							</div> <!-- /panel-heading -->
							<div class="panel-body">
								<div class="remove-messages"></div>
								<div class="row">
									<div class="col-md-12">
									  <div class="tile">
										<div class="tile-body">
											<div class="table-responsive">
												<table class="table table-bordered table-striped" id="manageSMSTable">
													<thead>
														<tr>
															<th>S.No.</th>
															<th>Date</th>
															<th>Country Code</th>							
															<th>Mobile</th>
															<th>Admin SMS</th>
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
</main>	<!-- page-content" -->

<?php require_once('footer.php'); ?>

