<?php 
require_once('header.php');
?>
<div class="app-title">
        <div>
          <h1><i class="fa fa-users"></i> Manage Users</h1>
		  <p class="text-success">Add / Activate / Deactivate User.</p>
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
								<button class="btn btn-info  m-1 bg-success border-success" id="add_user"><i class="fa fa-user"></i> Add User & Send SMS</button>
								</div>
							</div> <!-- /panel-heading -->
							<div class="panel-body">
								<div class="remove-messages"></div>
								<div class="row">
									<div class="col-md-12">
									  <div class="tile">
										<div class="tile-body">
											<div class="table-responsive">
												<table class="table table-bordered table-striped" id="manageCustomerTable">
													<thead>
														<tr>
															<th>ID</th>						
															<th>User Fullname</th>
															<th>Country Code</th>							
															<th>Mobile</th>
															<th>Address</th>
															<th>State</th>
															<th>City</th>
															<th>Zipcode</th>
															<th>Status</th>
															<th>Activate / Deactivate</th>
															<th>SendSMS</th>
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
	<div id="userModal" class="modal fade">
    	<div class="modal-dialog">
    		<form method="post" id="user_form">
    			<div class="modal-content">
    				<div class="modal-header">
						<h4 class="modal-title"><i class="fa fa-plus"></i> Add User & Send SMS</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
    				</div>
    				<div class="modal-body">
						<div class="form-group">
							<label>User Fullname*</label>
							<input type="text" class="form-control" id="username" name="username" placeholder="User Fullname*" autocomplete="off" required maxlength="25">
						</div>
						<div class="form-group">
							<label>User Country</label>
							<?php
								$country = $pdo->prepare("SELECT * FROM country WHERE active_country = ?");
								$country->execute(array(filter_var("1", FILTER_SANITIZE_NUMBER_INT)));
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
							<label>User Password* <br><small>Password must contain minimum 8 characters, 1 Uppercase character, 1 Lowercase character & 1 number.</small></label>
							<input type="text" class="form-control" id="password" name="password" placeholder="User Password*" autocomplete="off" required maxlength="50">
						</div>
						
						<div class="col-lg-12 border bg-secondary p-1 text-warning"><small>Please Make Sure you've configured SMS Setting. Otherwise SMS will not send.</small></div>
						<div class="removeuser-messages"></div>
    				</div> 
    				<div class="modal-footer"> 
						
						<input type="hidden" name="btn_action" id="btn_action" />
    					<input type="submit" name="action" id="action" class="btn btn-info" value="Add User & Send Credential SMS" />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
<!-- Send User SMS Modal -->
	<div id="smsModal" class="modal fade">
    	<div class="modal-dialog">
    		<form method="post" id="sms_form">
    			<div class="modal-content">
    				<div class="modal-header">
						<h4 class="modal-title"><i class="fa fa-comments"></i> Send SMS</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
    				</div>
    				<div class="modal-body">
						<div class="form-group">
							<input type="text" class="form-control" id="smsusername" name="username" autocomplete="off" required readonly="readonly">
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><span class="ccode"></span>&ensp;</span>
							</div>
							<input type="text" name="mobile" id="smsmobile" class="form-control" required autofocus readonly="readonly"> 
						</div>
						<div class="form-group">
							<label>SMS Text* <small>(Maximum 320 Characters)</small></label>
							<textarea name="smstext" class="form-control" rows="4" maxlength="320"></textarea>
						</div>
						
						<div class="col-lg-12 border bg-secondary p-1 text-warning"><small>Please Make Sure you've configured SMS Setting. Otherwise SMS will not send.</small></div>
    				</div> 
    				<div class="modal-footer"> 
						<input type="hidden" name="countryCode" id="smscountryCode"> 
						<input type="hidden" name="userId" id="userId">
						<input type="hidden" name="btn_action_sms" id="btn_action_sms" />
    					<input type="submit" name="action_sms" id="action_sms" class="btn btn-info" value="Send SMS" />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
<?php require_once('footer.php'); ?>

