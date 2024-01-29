<?php
ob_start();
session_start();
include("_adminarea_/db/config.php");
include("_adminarea_/db/item_functions.php");
if(isset($_SESSION['user']['user_id'])){
	header("location: ".BASE_URL.""); 
}

?>
<!--
Only For Some Designing Part
author: Boostraptheme
author URL: https://boostraptheme.com
License: Creative Commons Attribution 4.0 Unported
License URL: https://creativecommons.org/licenses/by/4.0/
-->

<!DOCTYPE html>
<html>

<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

    <title>User Login</title>
    <link rel="shortcut icon" href="<?php echo BASE_URL ; ?>img/favicon.png">
	<link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/RobotCondesedFont.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ; ?>font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/font-icon-style.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/style.default.css" id="theme-stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/pages/login.css">
</head>

<body> 
<?php include("header_common.php") ; ?>
<!--====================================================
                        PAGE CONTENT
======================================================--> 
      <section class="hero-area">
        <div class="overlay"></div>
        <div class="container">
          <div class="row">
            <div class="col-lg-3"></div>
			<div class="col-lg-6">
                <div class="contact-h-cont">
                  <h3 class="text-center"><img src="<?php echo BASE_URL ; ?>img/logo.png" class="img-fluid" alt=""></h3><br>
                  <form id="forgot_form" class="forgot_form" method="post">
                    <div class="form-group">
                      <label for="username">Email</label>
                      <input type="email" class="form-control" name="email" placeholder="Email address" maxlength="50" autocomplete="off" required autofocus>
                    </div>    
                    <div class="row text-center">
					<div class="col-lg-12 p-2">
						<div class="remove-messages"></div>
					</div>
					<div class="col-lg-12 mt-2">
					<button class="btn btn-general btn-blue" role="button" id="action_log"><i class="fa fa-key"></i> Recover Password</button>
					</div>
					</div>
                  </form>
                </div>
            </div>
			<div class="col-lg-3"></div>
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
    					<input type="submit" name="action_cp" id="action_cp" class="btn btn-info" value="Change Password"  />
    					
    				</div>
    			</div>
    		</form>
    	</div>
    </div>  
    <script src="<?php echo BASE_URL ; ?>js/jquery.min.js"></script>
    <script src="<?php echo BASE_URL ; ?>js/popper/popper.min.js"></script>
    <script src="<?php echo BASE_URL ; ?>js/tether.min.js"></script>
    <script src="<?php echo BASE_URL ; ?>js/bootstrap.min.js"></script>
    <script src="<?php echo BASE_URL ; ?>js/jquery.cookie.js"></script>
    <script src="<?php echo BASE_URL ; ?>js/jquery.validate.min.js"></script> 
    <script src="<?php echo BASE_URL ; ?>js/chart.min.js"></script> 
    <script src="<?php echo BASE_URL ; ?>js/front.js"></script> 
    <script src="<?php echo BASE_URL ; ?>user.js"></script>
	<script type="text/javascript" src="<?php echo ADMIN_URL ; ?>js/errorMsg.js"></script>
	<?php include("footer_ga.php") ; ?>
</body>

</html>