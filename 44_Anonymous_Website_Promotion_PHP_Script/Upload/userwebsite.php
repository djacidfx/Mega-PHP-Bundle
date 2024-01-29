<?php 
include("setup.php") ;
$siteId = filter_var($_GET['id'] , FILTER_SANITIZE_NUMBER_INT) ;
if(check_site_id($pdo , $siteId) == 0) {
    header("location: ".BASE_URL."");
}
$userIp = $_SERVER['REMOTE_ADDR'];
update_block($pdo , $userIp) ;
if(find_blocked_ip($pdo , $userIp) > "0"){
    header("location: ".BASE_URL."notforyou");
}
$siteTitle = site_title_by_id($pdo,$siteId) ;
$UrlTitle = urltitle_by_id($pdo,$siteId) ;
$siteOriginalUrl = original_url($pdo,$siteId) ;
increase_views($pdo, $siteId) ;
update_password($pdo) ;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1"> 
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?php echo $siteTitle ; ?></title>
    <meta property="og:title" content="<?php echo $siteTitle ; ?>" />
    <meta property="og:description" content="<?php echo META_DESCRIPTION ; ?>" />
    <meta property="og:site_name" content="<?php echo BASE_URL ; ?>" />
	<meta property="og:url" content="<?php echo BASE_URL."site/".$siteId."/".$UrlTitle ; ?>" />
	<meta property="og:type" content="article" />
	<meta property="article:publisher" content="<?php echo BASE_URL ; ?>" />
	<meta property="article:section" content="Articles" />
	<meta property="article:tag" content="Anonymous Website, Anonymous Promotion , Anonymous Group, Anonymous Post" />
	<meta property="og:image" content="" />
	<meta property="og:image:secure_url" content="" />
	<meta property="og:image:width" content="" />
	<meta property="og:image:height" content="" />
	<meta property="twitter:card" content="" />
	<meta property="twitter:image" content="" />
	
	<meta name="robots" content="all,follow">
    
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
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-12 mt-2 text-center">
                        <a href="<?php echo BASE_URL ; ?>"><img src="<?php echo BASE_URL ; ?>img/logo.png" class="img-fluid" ></a>
                    </div>
                    <!-- Mobile AD 300 x 50 Pixel Start-->
                    <div class="col-lg-12 d-md-none me-5 mt-2">
                          <?php include("ad_mobile.php") ; ?>
                    </div>
                    <!-- Mobile AD 300 x 50 Pixel Start-->
                    <div class="col-lg-12 mt-5">
                        <div class="card bg-dark text-white newShadow">
                            <div class="card-header">
                                <h3><i class="bi bi-display me-2"></i> <?php echo $siteTitle ; ?></h3>
                            </div>
                            <div class="card-body fw-bold mediumFont">
                                
                                <a href="<?php echo original_url($pdo,$siteId) ; ?>" target="_blank" class="me-3 btn btn-primary btn-sm mt-n2"><i class="bi bi-globe2"></i> <?php echo WEBSITE_LINK_NAME ; ?></a>
                                <span class="p-1"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo BASE_URL."secret/".$siteId."/".$UrlTitle ; ?>" target="_blank"><i class="bi bi-facebook pointer shareIcon fbColor mt-1" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo FB_NAME ; ?>"></i></a></span>
                                <span class="p-1"><a href="https://twitter.com/share?url=<?php echo BASE_URL."secret/".$siteId."/".$UrlTitle ; ?>&text=<?php echo $siteTitle ; ?>" target="_blank"><i class="bi bi-twitter twitterColor pointer shareIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo TWITTER_NAME ; ?>"></i></a></span>
                                <span class="p-1"><a href="https://wa.me/?text=<?php echo BASE_URL."secret/".$siteId."/".$UrlTitle ; ?>" target="_blank"><i class="bi bi-whatsapp wpColor pointer shareIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo WP_NAME ; ?>"></i></a></span>
                                <span class="p-1"><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo BASE_URL."secret/".$siteId."/".$UrlTitle ; ?>&title=<?php echo $siteTitle ; ?>&summary=&source=" target="_blank" ><i class="bi bi-linkedin ldColor pointer shareIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo LD_NAME ; ?>"></i></a></span>
                                
                            </div>
                            <div class="card-footer">
                                <small class="text-white"><i class="bi bi-eye"></i> <?php echo site_views_by_id($pdo,$siteId) ; ?>&ensp;&ensp;</small><i class="bi bi-trash text-danger mouseClick smallfont float-end mt-n-half align-bottom delWeb" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo DELETE_BTN_POP_UP ; ?>"></i><small class="text-muted float-end ms-2 me-2"><?php echo site_date($pdo,$siteId) ; ?></small>
                                
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-3 mt-5 d-none d-sm-none d-md-block d-lg-block">
                <?php include("ad_desktop_rightside.php") ; ?>
            </div>
            <div class="bg-dark customTopBorder text-muted text-center fixed-bottom p-2"><span>Copyright &copy; <?php echo date("Y"); ?> <b class="text-white"><?php echo COPYRIGHT_NAME ; ?></b> . All Rights Reserved.</span></div>
        </div>
    </div>
    <div id="delWebModal" class="modal fade delWebModal" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
                <div class="modal-content bg-dark shadow-lg">
                    <form method="post" class="deleteWebsiteForm">
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
                            <div class="c-messages"></div>
                            <input type="hidden" name="sid" value="<?php echo $siteId ; ?>" >
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