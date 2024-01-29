<?php 
require_once('header.php');
?>
<div class="app-title">
        <div>
          <h1><i class="fa fa-users"></i> Send SMS to Non User</h1>
		  <p class="text-success">Send SMS to Any Number in the World. (Note : If your SMS Gateway Provider provides this service)</p>
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
								<button class="btn btn-info  m-1 bg-success border-success" id="add_nonuser_sms"><i class="fa fa-user"></i> Send SMS to Any Mobile</button>
								</div>
							</div> <!-- /panel-heading -->
							<div class="panel-body">
								<div class="remove-messages"></div>
								<div class="row">
									<div class="col-md-12">
									  <div class="tile">
										<div class="tile-body">
											<div class="table-responsive">
												<table class="table table-bordered table-striped" id="manageNonCustomerTable">
													<thead>
														<tr>
															<th>S.No.</th>
															<th>Date</th>
															<th>Country Code</th>							
															<th>Mobile</th>
															<th>SMS Text</th>
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
<!-- Add User Modal -->
	<div id="nonuserModal" class="modal fade">
    	<div class="modal-dialog">
    		<form method="post" id="nonuser_form">
    			<div class="modal-content">
    				<div class="modal-header">
						<h4 class="modal-title"><i class="fa fa-plus"></i> Add User & Send SMS</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
    				</div>
    				<div class="modal-body">
						<div class="form-group">
							<label>User Country</label>
							<?php
								$country = $pdo->prepare("SELECT * FROM country WHERE 1");
								$country->execute();
								$totalCountry = $country->rowCount();
								$result = $country->fetchAll(PDO::FETCH_ASSOC);
								if($totalCountry > 0){
							?>
							<select class="form-control form-control-sm selectpicker" name="countryCode" data-live-search="true" required>
								<option value="">Select User Country</option>
								<?php
									foreach($result as $row)
										{
											$countryName = _e($row['country_name'])." (+"._e($row['phonecode']).")" ;
											echo "<option value="._e($row["phonecode"]).">"._e($countryName)."</option>";
										}
								?>
							</select>
							<?php
								}
							?>
						</div>
						<div class="form-group">
							<label>User Mobile*</label>
							<input type="text" class="form-control" id="mobile" name="mobile" placeholder="User Mobile*" autocomplete="off" required maxlength="20">
						</div>
						<div class="form-group">
							<label>SMS Text* <small>(Maximum 320 Characters)</small></label>
							<textarea name="smstext" class="form-control" rows="4" maxlength="320"></textarea>
						</div>
						<div class="col-lg-12 border bg-secondary p-1 text-warning"><small>Please Make Sure you've configured SMS Setting. Otherwise SMS will not send.</small></div>
    				</div> 
    				<div class="modal-footer"> 
						
						<input type="hidden" name="btn_action_nonuser" id="btn_action_nonuser" />
    					<input type="submit" name="action_nonuser" id="action_user" class="btn btn-info" value="Send SMS" />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>

<?php require_once('footer.php'); ?>

