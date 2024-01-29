<?php
ob_start();
session_start();
include("db/config.php");
include("db/CSRF_Protect.php");
include("db/function_xss.php");
$csrf = new CSRF_Protect();
// Checking Admin is logged in or not
if(!isset($_SESSION['admin'])) {
	header("location: ".ADMIN_URL."/login.php");
	exit;
} 
$admin = $pdo->prepare("SELECT * FROM ot_admin WHERE admin_status=?");
$admin->execute(array(filter_var("1", FILTER_SANITIZE_NUMBER_INT)));   
$admin_result = $admin->fetchAll(PDO::FETCH_ASSOC);
foreach($admin_result as $adm) {
//escape all admin data
	$id = _e($adm['id']);
	$email_old   = _e($adm['email']);
	$old_password = _e($adm['password']);
	$show_announcement = _e($adm['show_announcement']) ;
	$sms_apikey = _e($adm['sms_apikey']) ;
	$sms_senderid = _e($adm['sms_senderid']) ;
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Dashboard</title>

	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	
	<link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/main.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/bootstrap-select.min.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/all.min.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/datepicker.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/Latofont.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/Niconnefont.css">
</head>
<body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo text-left" href="dashboard.php"><img src="<?php echo BASE_URL ; ?>images/siteLogo.png" class="img-fluid" alt="Logo"></a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"><i class="fa fa-bars fa-2x"></i></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
		  <li>
			<a class="dropdown-item" href="index.php"><i class="fa fa-envelope"></i> Email</a> 
			</li>
            <li><a class="dropdown-item"  href="change_password.php"><i class="fa fa-key"></i> Password</a></li>
            <li><a class="dropdown-item" href="logout.php"><i class="fa fa-sign-out-alt fa-lg"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </header>
    <!-- Sidebar menu-->
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user"><i class="fa fa-user-secret fa-2x text-warning"></i>
        <div>
          <p class="app-sidebar__user-name">Admin</p>
          <p class="app-sidebar__user-designation"><?php echo $email_old ; ?></p>
        </div>
      </div>
      <ul class="app-menu">
        <li><a class="app-menu__item" href="dashboard.php"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label"> Dashboard</span></a></li>
		<li><a href="smsSetting.php" class="app-menu__item"><i class="app-menu__icon fa fa-comment"></i><span class="app-menu__label"> SMS Setting </span></a></li>
		<li><a href="announcementSetting.php" class="app-menu__item"><i class="app-menu__icon fa fa-cog"></i><span class="app-menu__label">Announcement Setting </span></a></li>
		<li><a href="addAnnouncement.php" class="app-menu__item"><i class="app-menu__icon fa fa-bullhorn"></i><span class="app-menu__label"> Announcements </span></a></li>
		<li><a href="edit_user.php" class="app-menu__item"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label"> Manage Users</span></a></li>
		<li><a href="selected_country.php" class="app-menu__item"><i class="app-menu__icon fa fa-globe"></i><span class="app-menu__label"> Manage Country</span></a></li>
		<li><a href="sentSms.php" class="app-menu__item"><i class="app-menu__icon fa fa-comments"></i><span class="app-menu__label"> Sent SMS</span></a></li>
		<li><a href="sentNonUserSms.php" class="app-menu__item"><i class="app-menu__icon fa fa-cubes"></i><span class="app-menu__label"> Non User SMS</span></a></li>
	  </ul>
    </aside>
    <main class="app-content">
