<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo get_post_title($pdo,$postId) ; ?></title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<meta property="og:site_name" content="<?php echo BASE_URL ; ?>" />
	<meta property="og:title" content="<?php echo get_post_title($pdo,$postId) ; ?>" />
	<meta property="og:description" content="<?php echo get_post_description($pdo,$postId) ; ?>" />
	<meta property="og:url" content="<?php echo BASE_URL."post/".$postId ; ?>" />
	<meta property="og:type" content="article" />
	<meta property="article:publisher" content="<?php echo BASE_URL ; ?>" />
	<meta property="article:section" content="Articles" />
	<meta property="article:tag" content="Anonymous Post" />
	<meta property="og:image" content="" />
	<meta property="og:image:secure_url" content="" />
	<meta property="og:image:width" content="" />
	<meta property="og:image:height" content="" />
	<meta property="twitter:card" content="" />
	<meta property="twitter:image" content="" />
	
	<meta name="robots" content="all,follow">
    <link rel="shortcut icon" href="<?php echo BASE_URL ; ?>img/favicon.png">
	<link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/RobotCondesedFont.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ; ?>font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/font-icon-style.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/style.default.css" id="theme-stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/ui-elements/card.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/style.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/custom.css">
	<script src='https://www.google.com/recaptcha/api.js' async defer></script>
</head>
<body> 
<?php include("header_common.php") ; ?>