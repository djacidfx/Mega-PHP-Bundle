<?php
ob_start();
session_start();
include("_adminarea_/db/config.php");
include("_adminarea_/db/post_functions.php");
$pageSlug = filter_var($_GET['page_slug'], FILTER_SANITIZE_STRING);
$checkPageStatus = check_activepage_for_user($pdo,$pageSlug) ; 
if($checkPageStatus == 0) {
	header("location: ".BASE_URL."") ;
	exit ;
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

    <title><?php echo get_page_title($pdo,$pageSlug); ?></title>
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

<body class="bg-dark"> 
<header class="header fixed-top">
        <nav class="navbar navbar-expand-lg " style="background:#343a40 !important">
            <div class="search-box">
                <button class="dismiss"><i class="icon-close"></i></button>
                <form id="searchForm" action="<?php echo BASE_URL.'usersearch.php' ; ?>" method="post" role="search" class="bg-dark">
                    <input type="search" placeholder="Search Blog..." class="form-control bg-dark text-white" name="search_keyword">
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
                    <nav id="sidebar-wrapper" class="bg-dark post-shadow">
                      <div class="sidebar-nav bg-dark"> 
                        <div class="tab" role="tabpanel"> 
                            <ul class="nav nav-tabs bg-dark" role="tablist">
                              <li class="nav-item w-100 bg-dark">
                                <a class="nav-link bg-dark   text-white text-left ml-3 mr-3" href="<?php echo BASE_URL ; ?>trending" ><i class="fa fa-signal"></i> Trending</a>
                              </li>
                                <li class="nav-item w-100 bg-dark">
                                <a class="nav-link bg-dark   text-white text-left ml-3 mr-3" href="<?php echo BASE_URL ; ?>featured" ><i class="fa fa-diamond"></i> Featured</a>
                              </li>
                              <li class="nav-item w-100 bg-dark">
                                <a class="nav-link active bg-dark border border-top-0 border-left-0 border-right-0 text-white text-left ml-3 mr-3" href="#live" role="tab" data-toggle="tab"><i class="fa fa-bookmark"></i> &ensp;Category</a>
                              </li>
                            </ul> 
                            <div class="tab-content tabs">
                              <div role="tabpanel" class="tab-pane fade show active" id="live">
                                <div class="content newsf-list">
                                    <ul class="list-unstyled">
                                        <?php echo get_sidebar_category($pdo) ; ?>
										
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

