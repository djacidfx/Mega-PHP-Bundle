<?php
require_once('db/config.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Admin Login</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/main.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/all.min.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/all.min.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/custom.css" />
	<link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/Latofont.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/Niconnefont.css">
</head>
<body>
<div id="logreg-forms" class="shadow-lg">
	<div class="modal-header justify-content-center bg-secondary">
		<img src="<?php echo BASE_URL ; ?>images/siteLogo.png" class="img-fluid"  alt="Logo">
	</div>
	<div class="remove-messages"></div>
	<form  id="adminlogin_form" class="form-signin" method="post">
		<h4 class="d-flex justify-content-center"> Admin Login</h4>
		<input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email Address" maxlength="50" required autofocus>
		<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
		<button class="btn btn-success btn-block" type="submit" name="action_log" id="action_log"><i class="fas fa-sign-in"></i> Sign in</button>
	</form>
</div>

<script type="text/javascript" src="<?php echo BASE_URL ; ?>js/jquery-3.5.1.min.js"></script>
<script type="text/javascript" src="<?php echo ADMIN_URL ; ?>/js/custom.js"></script>
</body>
</html>
