<?php 
include("setup.php") ;
$userIp = $_SERVER['REMOTE_ADDR'];
if(find_blocked_ip($pdo , $userIp) == "0"){
    header("location: ".BASE_URL."");
}
?>
<!DOCTYPE html>
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1"> 
    <title>LinkDirectory</title>
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
            <div class="card mt-5 bg-dark newShadow">
                <div class="card-header text-center">
                     <img src="<?php echo BASE_URL ; ?>img/logo.png" class="img-fluid logo" >
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <h3 class="text-danger"><?php echo BLOCKED_MESSAGE ; ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4"></div>
    </div>
  </div>
</body>
</html>
