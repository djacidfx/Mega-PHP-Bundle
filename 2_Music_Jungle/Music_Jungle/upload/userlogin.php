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
                  <form id="login_form" method="post">
                    <div class="form-group">
                      <label for="username">Email</label>
                      <input type="email" name="email" class="form-control" id="username" placeholder="Enter Email"> 
                    </div>  
                    <div class="form-group">
                      <label>Password</label>
                      <input class="form-control" name="password" type="password" id="user-pass"> 
                    </div>   
                    <div class="row text-center">
					<div class="col-lg-12 p-2">
						<div class="remove-messages"></div>
					</div>
					<div class="col-lg-12 mt-2">
					<button class="btn btn-general btn-blue" role="button" id="action_log"><i class="fa fa-sign-in"></i> Login</button>
					</div>
					</div>
                  </form>
                </div>
            </div>
			<div class="col-lg-3"></div>
          </div>  
        </div>
      </section>
      
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