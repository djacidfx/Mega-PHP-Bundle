<?php 
ob_start();
session_start();
include("setup.php") ; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?php echo META_SITE_TITLE ; ?></title>
    <meta property="og:title" content="<?php echo META_SITE_TITLE ; ?>" />
    <meta property="og:description" content="<?php echo META_SITE_DESCRIPTION ; ?>" />
    <link href="<?php echo BASE_URL ; ?>css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="<?php echo BASE_URL ; ?>css/custom.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo BASE_URL ; ?>favicon.png">
</head>
<body class="bg-light">
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col-lg-1">
            </div>
            <div class="col-lg-7">
                <div class="col-lg-12 p-0">
                    <div class="d-none d-sm-none d-md-block d-lg-block">
                        
                        
                        <!-- Desktop 728 x 90 Pixel Google Ad Javascript Code Paste Below -->
                        
                        
                        
                    </div>
                    <div class="d-md-none justify-content-center text-center">
                        
                        
                         <!-- Mobile 300 x 50  Pixel Google Ad Javascript Code Paste Below -->
                        
                        
                        
                    </div>
                    
                </div>
                <div class="col-lg-12 ps-0 pe-sm-5 mt-4">
                    <h1 class="text-muted"><i class="bi bi-pencil-square text-primary"></i> <?php echo INDEX_HEADING ; ?></h1>
                </div>
                <div class="col-lg-12 ps-0 pe-sm-5 mt-2">
                    <textarea name="usertext" id="usertext" class="form-control" rows="10" placeholder="<?php echo BOX_PLACEHOLDER ; ?>"></textarea>
                </div>
                <div class="col-lg-12 ps-0 pe-sm-5 mt-2 showtext"></div>
                <div class="col-lg-12 ps-0 pe-sm-5 mt-4 text-center text-muted">
                    <small>Copyright &copy; <?php echo date("Y"); ?> <b><?php echo COPYRIGHT_NAME ; ?></b>. All Rights Reserved.</small>
                </div>
                
                
            </div>
            <div class="col-lg-3">
                <div class="d-none d-sm-none d-md-block d-lg-block">
                    
                    <!-- Desktop 300 x 600 Pixel Google Ad Javascript Code Paste Below -->
                    
                    
                    
                </div>
            </div>
            <div class="col-lg-1">
            </div>
        </div>
    </div>
    <script src="<?php echo BASE_URL ; ?>js/jquery.min.js" ></script>
    <script src="<?php echo BASE_URL ; ?>js/popper.min.js" ></script>
    <script src="<?php echo BASE_URL ; ?>js/bootstrap.min.js"></script>	 
    <script type="text/javascript" src="<?php echo BASE_URL ; ?>js/custom.js" ></script>
</body>
</html>