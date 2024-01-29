<?php
include("setup.php") ;
$search = filter_var($_GET['term'] , FILTER_SANITIZE_STRING) ;
if(!isset($_GET['term'])){
    header("location:".BASE_URL." ") ;
}
$userIp = $_SERVER['REMOTE_ADDR'];
update_block($pdo , $userIp) ;
if(find_blocked_ip($pdo , $userIp) > "0"){
    header("location: ".BASE_URL."notforyou");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1"> 
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?php echo $search ; ?></title>
    <meta property="og:title" content="<?php echo $search ; ?>" />
    <meta property="og:description" content="<?php echo META_DESCRIPTION ; ?>" />
    <meta property="og:site_name" content="<?php echo BASE_URL ; ?>" />
	
    
    <link href="<?php echo BASE_URL ; ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo BASE_URL ; ?>css/custom.css" rel="stylesheet">
    <link rel="shortcut icon" href="<?php echo BASE_URL ; ?>img/favicon.png">
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
</head>
<body class="bg-dark text-white">
    <div class="container">
        <div class="row mt-2">
            <div class="col-lg-3 mt-5 d-none d-sm-none d-md-block d-lg-block">
                <?php include("ad_desktop_leftside.php") ; ?>
            </div>
            <div class="col-lg-6 pb-5">
                <div class="row">
                    <div class="col-lg-12 mt-2 text-center">
                        <a href="<?php echo BASE_URL ; ?>"><img src="<?php echo BASE_URL ; ?>img/logo.png" class="img-fluid" ></a>
                    </div>
                    <!-- Mobile AD 300 x 50 Pixel Start-->
                    <div class="col-lg-12 d-md-none me-5 mt-2">
                          <?php include("ad_mobile.php") ; ?>
                    </div>
                    <!-- Mobile AD 300 x 50 Pixel Start-->
                    <div class="col-lg-12 mt-3">
                        <div class="card bg-dark newShadow">
                    <div class="card-header">
                        <form method="post" class="searchPost form-inline">
                           <div class="row">
                            <div class="col-lg-9">
                               <div class="form-group">
                                    <input required type="text" name="search_keyword" class="customBorder form-control bg-dark text-white" maxlength="100" placeholder="<?php echo SEARCH_PLACEHOLDER ; ?>" <?php if(isset($search)) { ?> value="<?php echo $search ; ?>" <?php } ?> >
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <input type="hidden" name="btn_action" value="manualUserSearch">
                                <button type="submit" class="btn btn-grey btn-md" id="action_log"><?php echo SEARCH_BTN ; ?></button>   
                            </div>
                            <div class="col-lg-12"><div class="search-messages"></div></div>
                           </div>
                        </form>
                    </div>
                </div>
                    </div>
                    <div class="col-lg-12">
                        <?php echo grab_search_default($pdo,$search) ; ?>
                    </div>
                    <div class="col-lg-12 jQueryLoadSearch"></div>
                    </div>

            </div>
            <div class="col-lg-3 mt-5 d-none d-sm-none d-md-block d-lg-block">
                <?php include("ad_desktop_rightside.php") ; ?>
            </div>
            <div class="bg-dark customTopBorder text-muted text-center fixed-bottom p-2"><span>Copyright &copy; <?php echo date("Y"); ?> <b class="text-white"><?php echo COPYRIGHT_NAME ; ?></b> . All Rights Reserved.</span></div>
        </div>
    </div>
    <div id="delWebModalIn" class="modal fade delWebModalIn" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
                <div class="modal-content bg-dark shadow-lg">
                    <form method="post" class="deleteWebsiteFormIn">
                        <div class="modal-header customBottomBorder">
                            <h4 class="modal-title text-danger"><i class="bi bi-trash text-danger"></i> <?php echo DELETEFORM_TITLE ; ?></h4>
                            <button type="button" class="close btn btn-grey btn-sm " data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body text-start">
                            <div class="form-group">
                                <label class="text-muted"><?php echo PASSWORD_NAME ; ?>*</label>
                                <input type="password" name="password"  maxlength="50" class="customBorder form-control bg-dark text-white"  autocomplete="off">
                            </div>
                            <div class="form-group mt-4 text-center">
                                <div class="g-recaptcha" data-sitekey="<?php echo SITE_KEY ; ?>" data-theme="dark" ></div>
                            </div>
                        </div>
                        <div class="modal-body text-center">
                            <div class="cr-messages"></div>
                            <input type="hidden" name="sid" class="sid" >
                            <input type="hidden" name="btn_action" value="btnDeleteSite">
                            <button type="submit" class="btn btn-danger btn-md" id="action_log"><?php echo DELETEFORM_BTN_NAME ; ?></button>
                        </div>
                    </form>
                </div>
        </div>
    </div>
        
<script type="text/javascript" src="<?php echo BASE_URL ; ?>js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL ; ?>js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL ; ?>js/custom.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL ; ?>js/bodytooltip.js"></script>
</body>
</html>