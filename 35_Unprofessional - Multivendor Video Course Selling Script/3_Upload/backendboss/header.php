<?php
ob_start();
session_start();
include("config/db.php") ; 
include("controller/functions.php") ; 
check_admin_logged_in($pdo) ;
include("active_sidebar.php") ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Unprofessional Admin Panel</title>
  
  <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/r-2.2.7/datatables.min.css"/>
  <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/style.css">
  <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/components.css">
  <link rel="stylesheet" href="<?php echo ADMIN_URL ; ?>css/custom.css">
    <link rel="shortcut icon" href="<?php echo BASE_URL ; ?>img/siteLogoBig.png">
</head>
<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
        <?php include("navbar.php") ; ?>
        