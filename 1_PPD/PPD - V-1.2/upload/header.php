<?php
ob_start();
session_start();
include("_adminarea_/db/config.php");
include("_adminarea_/db/item_functions.php");
if(isset($_SESSION['user']['user_id'])){
	 $checkStatus =  check_user_status($pdo) ;
	 //if user deactivate by admin then it's automatically logout
	 if($checkStatus == 0) {
		unset($_SESSION['user']);
		header("location: ".BASE_URL.""); 
	}
	
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

    <title>PPD - Pay Per Download</title>
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
