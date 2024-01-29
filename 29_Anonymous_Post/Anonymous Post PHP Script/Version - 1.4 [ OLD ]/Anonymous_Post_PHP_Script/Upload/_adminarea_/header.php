<?php
ob_start();
session_start();
include("db/config.php");
include("db/post_functions.php");
// Checking Admin is logged in or not
if(!isset($_SESSION['admin'])) {
	header("location: ".ADMIN_URL."login.php");
	exit;
} 
$admin = $pdo->prepare("SELECT * FROM ot_admin WHERE id=?");
$admin->execute(array(filter_var("1", FILTER_SANITIZE_NUMBER_INT)));   
$admin_result = $admin->fetchAll(PDO::FETCH_ASSOC);
foreach($admin_result as $adm) {
//escape all admin data
	$id = _e($adm['id']);
	$adminName = _e($adm['adm_name']) ;
	$email_old   = _e($adm['adm_email']);
	$old_password = _e($adm['adm_password']);
	$linkName = _e($adm['link_name']) ;
	$aboutUsName = _e($adm['about_us_name']) ;
	$aboutUsInfo = strip_tags($adm['about_us_info']) ;
	$copyrightName = _e($adm['copyright_name']) ;
	$fbUrl = _e($adm['fb_url']) ;
	$instaUrl = _e($adm['insta_url']) ;
	$twitterUrl = _e($adm['twitter_url']) ;
	$dribbleUrl = _e($adm['dribble_url']) ;
	$vkUrl = _e($adm['vk_url']) ;
	$linkedinUrl = _e($adm['linkedin_url']) ;
	$behanceUrl = _e($adm['behance_url']) ;
	$gCode = base64_decode($adm['g_code']) ;
	$adminOn = _e($adm['admin_on']) ;
	$userOn = _e($adm['user_on']) ;
	$defaultLoad = _e($adm['default_load']);
	$onLoad = _e($adm['on_load']);
	$adCode = base64_decode($adm['ad_code']) ;
	$adOn = _e($adm['ad_on']) ;
	$alreadyLike = strip_tags($adm['already_liked']) ;
	$alreadyLoved = strip_tags($adm['already_loved']) ;
	$pendingApproval = strip_tags($adm['approve_message']) ;
	$anony = _e($adm['auto_approve']) ;
	$titleLimit = _e($adm['title_limit']) ;
	$descriptionLimit = _e($adm['description_limit']) ;
}
?>
 <!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Home</title>

	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/all.min.css">
	<link rel="stylesheet" href="css/Latofont.css">
	<link rel="stylesheet" href="css/Niconnefont.css">
	<link rel="shortcut icon" href="<?php echo BASE_URL ; ?>img/favicon.png">	
</head>
<body class="app sidebar-mini">
    <!-- Navbar-->
    <header class="app-header"><a class="app-header__logo text-left" href="<?php echo ADMIN_URL ; ?>dashboard.php"><img src="<?php echo BASE_URL ; ?>img/logo.png" class="img-fluid" alt="Logo"></a>
      <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"><i class="fa fa-bars fa-2x"></i></a>
      <!-- Navbar Right Menu-->
      <ul class="app-nav">
        <!-- User Menu-->
        <li class="dropdown"><a class="app-nav__item" href="#" data-toggle="dropdown" aria-label="Open Profile Menu"><i class="fa fa-user fa-lg"></i></a>
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
		  	<li>
			<a class="dropdown-item" href="<?php echo ADMIN_URL ; ?>index.php"><i class="fa fa-envelope"></i> Email</a> 
			</li>
            <li><a class="dropdown-item"  href="<?php echo ADMIN_URL ; ?>change_password.php"><i class="fa fa-key"></i> Password</a></li>
            <li><a class="dropdown-item" href="<?php echo ADMIN_URL ; ?>logout.php"><i class="fa fa-sign-out-alt fa-lg"></i> Logout</a></li>
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
        <li><a class="app-menu__item" href="<?php echo ADMIN_URL ; ?>dashboard.php"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Dashboard</span></a></li>
          <li><a class="app-menu__item" href="<?php echo BASE_URL ; ?>sitemap.xml" target="_blank"><i class="app-menu__icon fa fa-sitemap"></i><span class="app-menu__label"> Sitemap </span></a></li>
		<li><a class="app-menu__item" href="<?php echo BASE_URL ; ?>" target="_blank"><i class="app-menu__icon fa fa-globe"></i><span class="app-menu__label"> Website View </span></a></li>
		<li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-cog"></i><span class="app-menu__label"> Settings &ensp;<span class="badge badge-warning badge-pill">Imp</span></span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
		  	<li><a class="app-menu__item" href="<?php echo ADMIN_URL ; ?>adminSetting.php"><i class="app-menu__icon fa fa-envelope"></i><span class="app-menu__label">Main Settings </span></a></li>
			<li><a class="app-menu__item" href="<?php echo ADMIN_URL ; ?>socialSetting.php"><i class="app-menu__icon fa fa-share-alt"></i><span class="app-menu__label">Social Settings </span></a></li>
			<li><a class="app-menu__item" href="<?php echo ADMIN_URL ; ?>gAnalytics.php"><i class="app-menu__icon fab fa-google"></i><span class="app-menu__label">Google Analytics </span></a></li>
			<li><a class="app-menu__item" href="<?php echo ADMIN_URL ; ?>gAds.php"><i class="app-menu__icon fab fa-buysellads"></i><span class="app-menu__label">Adsense </span></a></li>
			<li><a class="app-menu__item" href="<?php echo ADMIN_URL ; ?>post.php"><i class="app-menu__icon fa fa-pencil-alt"></i><span class="app-menu__label">Post Setting </span></a></li>
			<li><a class="app-menu__item" href="<?php echo ADMIN_URL ; ?>msg.php"><i class="app-menu__icon fa fa-comment"></i><span class="app-menu__label">Message Template </span></a></li>
		  </ul>
		</li>
		 <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-pencil-alt"></i><span class="app-menu__label">Post</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
		 	<li><a class="treeview-item"  href="<?php echo ADMIN_URL; ?>items.php"><i class="fa fa-check"></i> &ensp;Active Posts</a></li>
			<li><a class="treeview-item"  href="<?php echo ADMIN_URL; ?>drafts.php"><i class="fa fa-times"></i> &ensp;&ensp;Deactive Posts</a></li>
		  </ul>
		 </li>
		
		
		<li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-file-alt"></i><span class="app-menu__label">Pages</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
		  	<li><a href="<?php echo ADMIN_URL ; ?>pages.php" class="app-menu__item"><i class="app-menu__icon fa fa-file-alt"></i><span class="app-menu__label">Create Page </span></a></li>
		<li><a href="<?php echo ADMIN_URL ; ?>managepages.php" class="app-menu__item"><i class="app-menu__icon fa fa-pencil-alt"></i><span class="app-menu__label">Manage Pages </span></a></li>
		  </ul>
		 </li>
		
	  </ul>
    </aside>
    <main class="app-content">
 

