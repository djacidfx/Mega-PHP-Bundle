<?php
ob_start();
session_start();
include("db/config.php");
include("db/CSRF_Protect.php");
include("db/function_xss.php");
$csrf = new CSRF_Protect();
// Checking Admin is logged in or not
if( empty($_SESSION['admin']['id'])  ){
	header('location: '.ADMIN_URL.'/index.php');
	exit;
}
$id = _e($_SESSION['admin']['id']) ; 
$admin = $pdo->prepare("SELECT * FROM subscription_admin WHERE  id = ?");
$admin->execute(array($id));   
$admin_result = $admin->fetchAll(PDO::FETCH_ASSOC);
$total = $admin->rowCount();
//if admin detail is empty
if($total == '0'){
	header('location: '.ADMIN_URL.'/logout.php');
	exit;
}
foreach($admin_result as $adm) {
//escape all  data
	$id = _e($adm['id']);
	$email_old   = _e($adm['adm_email']);
	$old_password = _e($adm['adm_password']);
	$success_message = _e($adm['success_message']) ;
	$paypalEmail = _e($adm['paypal_business_email']) ;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Dashboard</title>

	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="<?php echo ADMIN_URL; ?>/css/main.css">
	<link rel="stylesheet" href="<?php echo ADMIN_URL; ?>/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="<?php echo ADMIN_URL; ?>/css/all.min.css">
	<link rel="stylesheet" href="<?php echo ADMIN_URL; ?>/css/datepicker.css">
	<link rel="stylesheet" href="<?php echo ADMIN_URL; ?>/css/Latofont.css">
	<link rel="stylesheet" href="<?php echo ADMIN_URL; ?>/css/Niconnefont.css">
	
</head>
<body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo" href="<?php echo ADMIN_URL; ?>/dashboard.php"><img src="images/siteLogo.png" class="img-fluid" alt="Logo"></a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"><i class="fa fa-bars fa-2x"></i></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li>
			<a class="dropdown-item" href="<?php echo ADMIN_URL; ?>/change_email.php"><i class="fa fa-envelope"></i> Email</a> 
			</li>
            <li><a class="dropdown-item"  href="<?php echo ADMIN_URL; ?>/change_password.php"><i class="fa fa-key"></i> Password</a></li>
            <li><a class="dropdown-item" href="<?php echo ADMIN_URL; ?>/logout.php"><i class="fa fa-sign-out-alt fa-lg"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><i class="fa fa-user-secret fa-2x text-warning"></i>
        <div>
          <p class="app-sidebar__user-name"><?php echo $email_old ;?></p>
          <p class="app-sidebar__user-designation"><?php echo "Admin" ; ?></p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item" href="<?php echo ADMIN_URL; ?>/dashboard.php"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Dashboard</span></a></li>
		<li><a href="<?php echo ADMIN_URL; ?>/paymentView.php" class="app-menu__item"><i class="app-menu__icon fa fa-usd"></i><span class="app-menu__label"> Payments</span></a></li>
		<li><a href="<?php echo ADMIN_URL; ?>/subscriptionPlan.php" class="header_order app-menu__item"><i class="app-menu__icon  fa fa-arrows-alt"></i><span class="app-menu__label"> Subscription Plans</span></a></li>
		<li><a href="<?php echo ADMIN_URL; ?>/activesubscriptionPlan.php" class="header_order app-menu__item"><i class="app-menu__icon  fa fa-check"></i><span class="app-menu__label"> Active Plans</span></a></li>
		<li><a href="<?php echo ADMIN_URL; ?>/deactivesubscriptionPlan.php" class="header_order app-menu__item"><i class="app-menu__icon  fa fa-times"></i><span class="app-menu__label"> Deactive Plans</span></a></li>
		<li><a href="<?php echo ADMIN_URL; ?>/paypalIpn.php" class="header_order app-menu__item"><i class="app-menu__icon  fa fa-globe"></i><span class="app-menu__label"> Paypal IPN</span></a></li>
		<li><a href="<?php echo ADMIN_URL; ?>/payPalsuccess.php" class="app-menu__item"><i class="app-menu__icon fa fa-plus"></i><span class="app-menu__label"> Success Message</span></a></li>
		<li><a href="<?php echo ADMIN_URL; ?>/change_paypalEmail.php" class="app-menu__item"><i class="app-menu__icon fa fa-envelope"></i><span class="app-menu__label"> Paypal Business Email</span></a></li>
		
        
        
      </ul>
    </aside>
    <main class="app-content">
  <!-- sidebar-wrapper  -->
	
