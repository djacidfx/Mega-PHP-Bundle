<?php 
require_once('header.php');
?>
<div class="app-title">
        <div>
          <span>Deactivate All Country</span>&ensp;<a href="deactive_all.php" class="btn btn-danger btn-sm">Deactivate All</a>
		  <p><small class="form-text text-muted">After Deactivating All Country, You have to activate at least 1 Country otherwise OTP verification shows error.</small></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><span>Activate All Country</span>&ensp;<a href="active_all.php" class="btn btn-success btn-sm"> Activate All</a></li>
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
								<div class="page-heading"> Manage Country</div>
							</div> <!-- /panel-heading -->
							<div class="panel-body">
								<div class="remove-messages"></div>
								<div class="row">
									<div class="col-md-12">
									  <div class="tile">
										<div class="tile-body">
											<div class="table-responsive">	
									<table class="table table-bordered table-hover" id="manageCountryTable" >
										<thead>
											<tr>
												<th>Country Name</th>						
												<th>Country Code</th>
												<th>Status</th>
												<th>Options</th>
											</tr>
										</thead>
									</table> <!-- /table -->
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
</main> <!-- page-content" -->
<?php require_once('footer.php'); ?>
