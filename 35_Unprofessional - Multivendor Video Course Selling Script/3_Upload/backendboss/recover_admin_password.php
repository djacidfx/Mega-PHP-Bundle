<?php 
include("config/db.php") ; 
include("controller/functions.php") ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Recover Admin Password</title>
  <meta property="og:title" content="Recover Admin Password" />
  <meta property="og:description" content="<?php echo get_aboutus_info($pdo) ; ?>" />
  <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/style.css">
  <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/components.css">
    <link rel="shortcut icon" href="<?php echo BASE_URL ; ?>img/siteLogoBig.png">
</head>
<body>
     <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
                <img src="<?php echo BASE_URL ; ?>img/siteLogoS.png" alt="logo"  class=" img-fluid">
            </div>

            <div class="card card-primary">
              <div class="card-header justify-content-center"><h4>Recover Admin Password</h4></div>

              <div class="card-body">
                <form method="POST" action="#" class="needs-validation forgot_form" novalidate="" id="forgot_form">
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                  </div>
                <div class="form-group">
                    <div class="g-recaptcha" data-sitekey="<?php echo SITE_KEY ; ?>"></div>
						
                </div>
                  <div class="form-group">
                    <div class="remove-messages"></div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4" id="action_log">
                      <i class="fas fa-key"></i> Reset Password
                    </button>
                    <a href="<?php echo ADMIN_URL ; ?>" class="btn btn-primary btn-lg btn-block mt-2" tabindex="4"><i class="fas fa-unlock"></i> Login</a>
                  </div>
                </form>
              </div>
            </div>
              
          </div>
        </div>
      </div>
    </section>
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
									<label>Email*</label>
									<input type="email" name="email" id="forgotemail" class="form-control" readonly="readonly" required />
								</div>
								<div class="form-group">
									<label>OTP*</label>
									<input type="password" name="otp" id="otp" class="form-control" required />
								</div>
							</div>
						</div>						
					</div>
					
					
    				<div class="modal-footer">
    					<input type="submit" name="action_fp" id="action_fp" class="btn btn-primary btn-sm" value="Verify OTP"  />
    					
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
									<label>Email*</label>
									<input type="email" name="email" id="forgotpasswordemail" class="form-control" readonly="readonly" required />
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
    					<input type="submit" name="action_cp" id="action_cp" class="btn btn-primary btn-sm" value="Change Password"  />
    					
    				</div>
    			</div>
    		</form>
    	</div>
    </div> 
  </div>
  <script src="<?php echo BASE_URL ; ?>js/jquery-3.6.0.min.js"></script>
  <script src="<?php echo BASE_URL ; ?>js/popper.min.js" ></script>
  <script src="<?php echo BASE_URL ; ?>js/bootstrap.min.js"></script>
  <script src="<?php echo BASE_URL ; ?>js/jquery.nicescroll.min.js"></script>
  <script src="<?php echo BASE_URL ; ?>js/moment.min.js"></script>
  <script src="<?php echo BASE_URL ; ?>js/stisla.js"></script>
  <script src="<?php echo BASE_URL ; ?>js/scripts.js"></script>
  <script src="<?php echo ADMIN_URL ; ?>js/login.js"></script>
  <script src='https://www.google.com/recaptcha/api.js' async defer></script>
    <?php if(ga_on_admin($pdo) == 1){ echo ga_code($pdo) ; } ?>
</body>
</html>