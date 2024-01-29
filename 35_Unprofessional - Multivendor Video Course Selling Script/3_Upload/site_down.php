<?php 
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ;
if(show_userpanel($pdo) > 0){
    header("location: ".BASE_URL."");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Wesbite Under Maintenance</title>
  <meta property="og:title" content="Wesbite Under Maintenance" />
  <meta property="og:description" content="<?php echo get_aboutus_info($pdo) ; ?>" />
  <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/style.css">
  <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/components.css">
</head>
<body>
     <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
              <div class="col-lg-3"></div>
              <div class="col-lg-6">
                    <div class="login-brand">
                        <img src="<?php echo BASE_URL ; ?>img/siteLogoS.png" alt="logo"  class=" img-fluid">
                    </div>

                    <div class="card card-primary">
                      <div class="card-header justify-content-center"><h4>Website Under Maintenance </h4></div>

                      <div class="card-body">
                        <div class="jumbotron text-center">
                          <p class="lead text-muted mt-3">
                            <?php echo nl2br(show_userpanel_msg($pdo)); ?>
                          </p>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="col-lg-3"></div>
        </div>
      </div>
    </section>
  </div>
  <script src="<?php echo BASE_URL ; ?>js/jquery-3.6.0.min.js"></script>
  <script src="<?php echo BASE_URL ; ?>js/popper.min.js" ></script>
  <script src="<?php echo BASE_URL ; ?>js/bootstrap.min.js"></script>
  <script src="<?php echo BASE_URL ; ?>js/jquery.nicescroll.min.js"></script>
  <script src="<?php echo BASE_URL ; ?>js/moment.min.js"></script>
  <script src="<?php echo BASE_URL ; ?>js/stisla.js"></script>
  <script src="<?php echo BASE_URL ; ?>js/scripts.js"></script>
  <script src="<?php echo BASE_URL ; ?>js/login.js"></script>
    <?php if(ga_on_user($pdo) == 1){ echo ga_code($pdo) ; } ?>
</body>
</html>