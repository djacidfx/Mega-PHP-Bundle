<?php
ob_start();
session_start();
include("config/database.php") ;
include("functions.php") ;
if (!empty($_GET['mode'])) {
    $getMode = trim(filter_var(htmlentities($_GET['mode']),FILTER_SANITIZE_STRING));
    $_SESSION['mode'] = $getMode;
}
if (!empty($_GET['lang'])) {
    $getLang = trim(filter_var(htmlentities($_GET['lang']),FILTER_SANITIZE_STRING));
    $_SESSION['lang'] = $getLang;
}
include("mode/mode.php") ;
include("language/lang.php") ;
$userNewIp = $_SERVER['REMOTE_ADDR'];
if(find_blocked_ip($pdo , $userNewIp) == "0"){
    header("location: ".BASE_URL."");
}
?>
<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1"> 
    <title><?php echo META_SITE_TITLE ; ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/bootstrap.min.css" >
	<link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/custom.css">    
    <link rel="shortcut icon" href="<?php echo BASE_URL ; ?>img/favicon.png">
</head>
<body class="bg-dark">
  <div class="container">
    <div class="row mt-5">
        <div class="col-lg-4"></div>
        <div class="col-lg-4 mt-5">
            <div class="card shadow-lg mt-5 darkmode_border">
                <div class="card-header bg-dark text-center darkmode_border">
                     <img src="<?php echo BASE_URL ; ?>img/logo.png" class="img-fluid logo" >
                </div>
                <div class="card-body bg-dark">
                    <div class="row text-center">
                        <h3 class="text-danger"><?php echo userlang('blocked_msg'); ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4"></div>
    </div>
  </div>
</body>
</html>
