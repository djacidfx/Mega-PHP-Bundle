<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo get_item_title($pdo,$itemId) ; ?></title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<meta property="og:site_name" content="<?php echo BASE_URL ; ?>" />
	<meta property="og:title" content="<?php echo get_item_title($pdo,$itemId) ; ?>" />
	<meta property="og:description" content="<?php echo get_item_title($pdo,$itemId) ; ?>" />
	<meta property="og:url" content="<?php echo BASE_URL."item/".$itemId ; ?>" />
	<meta property="og:type" content="article" />
	<meta property="article:publisher" content="<?php echo BASE_URL ; ?>" />
	<meta property="article:section" content="Music" />
	<meta property="article:tag" content="<?php echo get_item_tags($pdo,$itemId) ; ?>" />
	<meta property="og:image" content="<?php echo get_item_previewImage_formetatags($pdo,$itemId) ; ?>" />
	<meta property="og:image:secure_url" content="<?php echo get_item_previewImage_formetatags($pdo,$itemId) ; ?>" />
	<meta property="og:image:width" content="1280" />
	<meta property="og:image:height" content="640" />
	<meta property="twitter:card" content="summary_large_image" />
	<meta property="twitter:image" content="<?php echo get_item_previewImage_formetatags($pdo,$itemId) ; ?>" />
	
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
	
</head>
<body> 
<?php include("header_common.php") ; ?>