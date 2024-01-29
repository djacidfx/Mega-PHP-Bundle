<?php
ob_start();
session_start();
require_once('admin/db/config.php');
require_once("admin/db/function_xss.php");
require_once("admin/db/CSRF_Protect.php");
$csrf = new CSRF_Protect();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Customer Login</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<meta name="description" content="Customer Login">
	<link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/main.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/bootstrap-select.min.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/all.min.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/custom.css">
</head>
<body>
<div id="logreg-forms" class="shadow-lg">
	<div class="modal-header justify-content-center bg-secondary">
				<img src="images/siteLogo.png" class="img-fluid"  alt="Logo">
          	</div>
			
			<div class="remove-messages"></div>
        	<form id="login_form" class="form-signin login_form" method="post">
				<h4 class="d-flex justify-content-center"> Sign In</h4>
				<input type="text" class="form-control" name="mobile" placeholder="Mobile" maxlength="25" required >
				<input type="password" class="form-control" name="password" placeholder = "Password" required>
				<button class="btn btn-success btn-block loginbutton" type="submit"><i class="fas fa-sign-in"></i> Sign in</button>
				<a href="#" id="forgot_pswd">Forgot password?</a>
				<hr>
				<button class="btn btn-primary btn-block" type="button" id="btn-signup"><i class="fas fa-user-plus"></i> Sign up New Account</button>
            </form>
			<form class="form-reset forgot_form" method="post">
				<h4 class="d-flex justify-content-center"> Forgot Password ?</h4>
                <input type="text" class="form-control" name="mobile" maxlength="25" autocomplete="off" required>
                <button class="btn btn-primary btn-block" type="submit">Reset Password</button>
                <a href="#" id="cancel_reset"><i class="fas fa-angle-left"></i> Back</a>
            </form>
            <form  class="form-signup signup_form" method="post">
                <h4 class="d-flex justify-content-center"> Sign Up</h4>
                <input type="text" class="form-control" name="fullname" placeholder="Full Name" maxlength="25" required >
				<?php
					$country = $pdo->prepare("SELECT * FROM country WHERE active_country = ?");
					$country->execute(array(filter_var("1", FILTER_SANITIZE_NUMBER_INT)));
					$totalCountry = $country->rowCount();
					$result = $country->fetchAll(PDO::FETCH_ASSOC);
					if($totalCountry > 0){
				?>
                <select class="form-control form-control-sm selectpicker" name="country_code" data-live-search="true" required>
					<option value="">Select Your Country</option>
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
				<input type="text" class="form-control" name="mobile" maxlength="25" autocomplete="off" Placeholder="Mobile" required>
				<small>Password must contain minimum 8 characters, 1 Uppercase character, 1 Lowercase character & 1 number.</small>
                <input type="password" class="form-control" name="password" maxlength="40" placeholder="Password" required>
                <input type="text" class="form-control" name="repassword" maxlength="40"  placeholder="Confirm Password" autocomplete="off" required>
				
				<button class="btn btn-primary btn-block" type="submit"><i class="fas fa-user-plus"></i> Sign Up</button>
                <a href="#" id="cancel_signup"><i class="fas fa-angle-left"></i> Back</a>
            </form>
            <br>
            
    </div>
<div id="loginModal" class="modal fade " data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    		<form method="post" id="login_otpform">
    			<div class="modal-content">
    				<div class="modal-header">
						<h4 class="modal-title"><i class='fa fa-eye'></i> Verify Login OTP</h4>
    				</div>
    				<div class="modal-body">
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="form-group">
									<label>Mobile*</label>
									<input type="text" name="mobile" id="loginmobile" class="form-control" readonly="readonly" required />
								</div>
								<div class="form-group">
									<label>OTP*</label>
									<input type="password" name="otp" id="otp" class="form-control" required />
								</div>
							</div>
						</div>						
					</div>
					
					
    				<div class="modal-footer">
    					<input type="submit" name="action_log" id="action_log" class="btn btn-info" value="Verify OTP"  />
    					
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
<div id="signupModal" class="modal fade " data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    		<form method="post" id="signup_otpform">
    			<div class="modal-content">
    				<div class="modal-header">
						<h4 class="modal-title"><i class='fa fa-eye'></i> Verify Sign Up OTP</h4>
    				</div>
    				<div class="modal-body">
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="form-group">
									<label>Mobile*</label>
									<input type="text" name="mobile" id="signupmobile" class="form-control" readonly="readonly" required />
								</div>
								<div class="form-group">
									<label>OTP*</label>
									<input type="password" name="otp" id="otp" class="form-control" required />
								</div>
							</div>
						</div>						
					</div>
					
					
    				<div class="modal-footer">
						<input type="hidden" name="country_code" id="country_code"  />
						<input type="hidden" name="password"  id="password" />
						<input type="hidden" name="fullname"  id="fullname" />
    					<input type="submit" name="action_sign" id="action_sign" class="btn btn-info" value="Verify OTP"  />
    					
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
<div id="forgotModal" class="modal fade " data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    		<form method="post" id="forgot_otpform">
    			<div class="modal-content">
    				<div class="modal-header">
						<h4 class="modal-title"><i class='fa fa-eye'></i> Verify Forgot Password OTP</h4>
    				</div>
    				<div class="modal-body">
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="form-group">
									<label>Mobile*</label>
									<input type="text" name="mobile" id="forgotmobile" class="form-control" readonly="readonly" required />
								</div>
								<div class="form-group">
									<label>OTP*</label>
									<input type="password" name="otp" id="otp" class="form-control" required />
								</div>
							</div>
						</div>						
					</div>
					
					
    				<div class="modal-footer">
    					<input type="submit" name="action_fp" id="action_fp" class="btn btn-info" value="Verify OTP"  />
    					
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
<div id="forgotpasswordModal" class="modal fade " data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    		<form method="post" id="forgotpassword_otpform">
    			<div class="modal-content">
    				<div class="modal-header">
						<h4 class="modal-title"><i class='fa fa-key'></i> Change Password</h4>
    				</div>
    				<div class="modal-body">
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="form-group">
									<label>Mobile*</label>
									<input type="text" name="mobile" id="forgotpasswordmobile" class="form-control" readonly="readonly" required />
								</div>
								<div class="form-group">
								 <small>Password must contain minimum 8 characters, 1 Uppercase character, 1 Lowercase character & 1 number.</small>
								 <br>
									<label for="newpassword" class="control-label">New Password*</label>
									<input type="password" class="form-control" name="newpassword" maxlength="50" required>
								</div>
								<div class="form-group">
									<label for="confirmnewpassword" class="control-label">Confirm New Password*</label>
									<input type="text" class="form-control" name="confirmnewpassword" maxlength="50" autocomplete="off" required>
								</div>
							</div>
						</div>						
					</div>
					
					
    				<div class="modal-footer">
    					<input type="submit" name="action_cp" id="action_cp" class="btn btn-info" value="Change Password"  />
    					
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
<script type="text/javascript" src="<?php echo BASE_URL ; ?>js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL ; ?>js/popper.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL ; ?>js/bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL ; ?>js/bootstrap-select.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL ; ?>js/custom.js"></script>

</body>
</html>