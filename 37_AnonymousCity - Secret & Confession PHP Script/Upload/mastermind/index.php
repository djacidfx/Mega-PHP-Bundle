<?php 
include("database.php") ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Admin Panel Login</title>
    <meta property="og:title" content="Admin Panel Login" />
    <meta property="og:description" content="Create, Upload & Share Zip Files" />
    <link href="<?php echo BASE_URL ; ?>css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.23/r-2.2.7/datatables.min.css"/>
    <link href="<?php echo BASE_URL ; ?>css/custom.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo BASE_URL ; ?>img/favicon.png">
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
</head>
<body class="bg-dark" > 
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4"></div>        
            <div class="col-lg-4 mt-5">
                <form method="post" id="adminlogin_form">
                <div class="card bg-dark shadow-lg text-center">
                    <div class="card-header ">
                        <h1 class="text-muted"><i class="bi bi-bug-fill"></i> Mastermind Login</h1>
                    </div>
                    <div class="card-body text-start">
                        <div class="form-group">
                            <label class="text-muted"><i class="bi bi-envelope-fill"></i> Email*</label>
                            <input type="email" name="email" class="form-control bg-dark text-white customBorder mt-1" autocomplete="off" required maxlength="50">
                        </div>
                        <div class="form-group mt-2">
                            <label class="text-muted"><i class="bi bi-key"></i> Password*</label>
                            <input type="password" name="password" class="form-control bg-dark text-white customBorder mt-1" autocomplete="off" required maxlength="50">
                        </div>
                        <div class="form-group mt-2">
                            <label class="text-muted"><i class="bi bi-person-check-fill"></i> Prove, You are Human*</label>
                            <div class="g-recaptcha" data-sitekey="<?php echo SITE_KEY ; ?>" data-theme="dark"></div>
                        </div>
                        
                    </div>
                    <div class="card-footer text-center">
                        <div class="form-group mt-2 text-center">                            
                            <div class="remove-messages"></div>
                            <button type="submit" class="btn btn-grey" id="action_log">
                              <i class="bi bi-shield-lock"></i> Login To Mastermind City
                            </button>
                        </div>
                    </div>
                </div>
                </form>
            </div>        
            <div class="col-lg-4"></div>        
        </div>
    </div>
    
    <script src="<?php echo BASE_URL ; ?>js/jquery.min.js" ></script>
    <script src="<?php echo BASE_URL ; ?>js/popper.min.js" ></script>
    <script src="<?php echo BASE_URL ; ?>js/bootstrap.min.js"></script>	 
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/r-2.2.9/datatables.min.js"></script>
    <script type="text/javascript" src="<?php echo ADMIN_URL ; ?>js/admin.js" ></script>
</body>
</html>
