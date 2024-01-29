<?php 
ob_start();
session_start();
include("config/db.php") ; 
include("controller/functions.php") ;
$userNewIp = $_SERVER['REMOTE_ADDR'];
if(find_blocked_ip($pdo , $userNewIp) == 0){
    header("location: ".BASE_URL."");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Not For You</title>
    <meta property="og:title" content="Not For You" />
    <meta property="og:description" content="Not For You" />
    <link href="<?php echo BASE_URL ; ?>css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="<?php echo BASE_URL ; ?>css/custom.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo BASE_URL ; ?>img/favicon.png">
</head>
<body > 
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-lg-4"></div>        
            <div class="col-lg-4 mt-5">
                <div class="card bg-light newShadow text-center mt-5">
                    <div class="card-header">
                        <h1 class="text-muted"><i class="bi bi-bug-fill text-danger"></i></h1>
                    </div>
                    <div class="card-body text-center text-danger">
                        <?php echo nl2br(block_message($pdo)) ; ?>
                    </div>
                </div>
            </div>        
            <div class="col-lg-4"></div>        
        </div>
    </div>
    
    <script src="<?php echo BASE_URL ; ?>js/jquery.min.js" ></script>
    <script src="<?php echo BASE_URL ; ?>js/popper.min.js" ></script>
    <script src="<?php echo BASE_URL ; ?>js/bootstrap.min.js"></script>	 
</body>
</html>
