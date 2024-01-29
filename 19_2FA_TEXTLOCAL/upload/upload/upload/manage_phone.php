<?php 
include_once('header.php');
?>
<div class="app-title">
        <div>
          <h1><i class="fa fa-phone"></i> Manage Mobile</h1>
		  <p><?php echo $customer_mobile ; ?></p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
        </ul>
 </div>
   <div class="container mar-top">
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="row">
				<div class="col-lg-3 col-md-3"></div>
				<div class="col-lg-6 col-md-6">
					<div class="card">
                		<div class="card-header bg-secondary text-white text-center"><h4> Change Phone</h4></div>
                		<div class="card-body">
						<div class="remove-messages"></div>
						<form  class="changePhone" method="post" >
					  		<div class="form-group">
								<label>Mobile*</label>
								<input type="text" class="form-control"   placeholder="Mobile" name="mobile"  maxlength="25" required>
								<input type="hidden" name="country_code" value="<?php echo $customer_countrycode ; ?>">
					  		</div>
					  		<div class="form-group" align="center">
								<input type="hidden" name="uid" value="<?php echo $id ; ?>">
					  			<input type="submit" class="btn btn-primary" name="submit" value="Continue">
					  		</div>
						</form>
						</div>
           			 </div>
				</div>
				<div class="col-lg-3 col-md-3"></div>
			</div>
		</div>
	</div>
</div>
<div id="changePhoneModal" class="modal fade " data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    		<form method="post" class="changePhone_otpform">
    			<div class="modal-content">
    				<div class="modal-header">
						<h4 class="modal-title"><i class='fa fa-eye'></i> Verify Change Phone OTP</h4>
    				</div>
    				<div class="modal-body">
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="form-group">
									<label>Mobile*</label>
									<input type="text" name="newmobile" id="changeMob" class="form-control" readonly="readonly" required />
								</div>
								<div class="form-group">
									<label>OTP*</label>
									<input type="password" name="otp" id="otp" class="form-control" required />
								</div>
							</div>
						</div>						
					</div>
					
					
    				<div class="modal-footer">
					<input type="hidden" name="id" value="<?php echo $id ; ?>">
    					<input type="submit" name="action_changephone" id="action_changephone" class="btn btn-info" value="Verify OTP"  />
    					
    				</div>
    			</div>
    		</form>
    	</div>
    </div>

<?php require_once('footer.php'); ?>