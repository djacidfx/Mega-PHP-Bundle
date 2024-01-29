<?php 
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ;
if(show_userpanel($pdo) == 0){
    header("location: ".BASE_URL."undermaintenance");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>User SignUp</title>
  <meta property="og:title" content="User SignUp" />
  <meta property="og:description" content="<?php echo get_aboutus_info($pdo) ; ?>" />
  <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/style.css">
  <link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/components.css">
    <link rel="shortcut icon" href="<?php echo BASE_URL ; ?>img/siteLogoBig.png">
</head>
<body>
     <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
                <a href="<?php echo BASE_URL ; ?>"><img src="<?php echo BASE_URL ; ?>img/siteLogoS.png" alt="logo"  class=" img-fluid"></a>
            </div>

            <div class="card card-primary">
              <div class="card-header justify-content-center"><h4>User SignUp</h4></div>

              <div class="card-body">
                <form method="POST" action="#" class="needs-validation" novalidate="" id="usersignup_form">
                
                    <div class="form-group">
                        <label>Username* <small>(Only Small Alphabets & Number allowed)</small></label>
                        <input id="username" type="text" class="form-control text-lowercase" name="username" tabindex="1" required autofocus maxlength="30">
                        <div class="username-messagess"></div>
                      </div>
                    <div class="form-group">
                    <label for="email">Full Name*</label>
                    <input  type="text" class="form-control" name="userfullname" tabindex="1" required autofocus maxlength="30">
                  </div>
                  <div class="form-group">
                    <label for="email">Email*</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password*</label>
                      <div class="float-right">
                        <a href="<?php echo BASE_URL ; ?>login" class="text-small">
                          Do you already have an account?
                        </a>
                      </div>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                  </div>
                <div class="form-group">
                    <div class="g-recaptcha" data-sitekey="<?php echo SITE_KEY ; ?>"></div>
						
                </div>
                  <div class="form-group">
                    <div class="remove-messages"></div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block usernamebtn" tabindex="4" id="usernamebtn" disabled>
                      <i class="fas fa-user-plus"></i> SignUp
                    </button>
                  </div>
                </form>
              </div>
            </div>
              
          </div>
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
  <script src='https://www.google.com/recaptcha/api.js' async defer></script>
    <?php if(ga_on_user($pdo) == 1){ echo ga_code($pdo) ; } ?>
</body>
</html>