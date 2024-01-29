<?php 
include("database.php") ;
check_admin_logged_in($pdo) ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Admin Panel Login</title>
    <meta property="og:title" content="Admin Panel Login" />
    <meta property="og:description" content="Share Your Secret & Confessions" />
    <link href="<?php echo BASE_URL ; ?>css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/r-2.2.9/datatables.min.css"/>
    <link href="<?php echo BASE_URL ; ?>css/custom.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo BASE_URL ; ?>img/favicon.png">
</head>
<body class="bg-dark" > 
    <div class="container-fluid">
        <div class="row">
            <?php include("left_sidebar.php") ; ?>
            <div class="col-lg-9 offset-md-3 justify-content-center text-center p-2">
                <div class="row">