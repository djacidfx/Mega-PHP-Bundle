<?php
ob_start();
session_start();
include("_adminarea_/db/config.php");
include("_adminarea_/db/item_functions.php");
$headerColor = get_header_color($pdo) ;
$footerColor = get_footer_color($pdo) ;
$footerTextColor = get_footerText_color($pdo) ;
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

    <title>MJ - Music Jungle Download</title>
    <link rel="shortcut icon" href="<?php echo BASE_URL ; ?>img/favicon.png">
	<link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/RobotCondesedFont.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ; ?>font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/font-icon-style.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/style.default.css" id="theme-stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/ui-elements/card.css">
    <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/style.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/custom.css">
	<link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/music.css">
</head>

<body style="background:#EEF5F9;"> 
<header class="header fixed-top">
        <nav class="navbar navbar-expand-lg " style="background:<?php echo $headerColor ; ?> ;">
            <div class="search-box">
                <button class="dismiss"><i class="icon-close"></i></button>
                <form id="searchForm" action="<?php echo BASE_URL.'usersearch.php' ; ?>" method="post" role="search">
                    <input type="search" placeholder="e.g. Pitbull, Hip Hop Music ..." class="form-control" name="search_keyword">
                </form>
            </div>
            <div class="container-fluid ">
                <div class="navbar-holder d-flex align-items-center justify-content-between">
                    <div class="navbar-header">
                        <a href="<?php echo BASE_URL ; ?>" class="navbar-brand">
                            <div class="brand-text brand-big hidden-lg-down"><img src="<?php echo BASE_URL ; ?>img/logo.png" alt="Logo" class="img-fluid"></div>
                            <div class="brand-text brand-small ml-1"><img src="<?php echo BASE_URL ; ?>img/logo.png" alt="Logo" class="img-fluid"></div>
                        </a>
                    </div>
                </div>
                <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                    <!-- Search-->
                    <li class="nav-item d-flex align-items-center"><a id="search" class="nav-link" href="#"><i class="icon-search"></i></a></li>
                    
                    <li class="nav-item d-flex align-items-center"><a id="menu-toggle-right" class="nav-link" href="#"><i class="fa fa-bars"></i></a></li>
                    <nav id="sidebar-wrapper">
                      <div class="sidebar-nav"> 
                        <div class="tab" role="tabpanel"> 
                            <ul class="nav nav-tabs" role="tablist">
                              <li class="nav-item w-100">
                                <a class="nav-link active" href="#live" role="tab" data-toggle="tab"><i class="fa fa-music"></i> Artist / Category</a>
                              </li>
                            </ul> 
                            <div class="tab-content tabs">
                              <div role="tabpanel" class="tab-pane fade show active" id="live">
                                <div class="content newsf-list">
                                    <ul class="list-unstyled">
                                        <?php echo get_category_name_and_link($pdo) ; ?>
                                    </ul>
                                </div>
                              </div>
                              
                           </div>
                      </div>
                    </nav>
                </ul> 
            </div>
        </nav>
		
    </header>

