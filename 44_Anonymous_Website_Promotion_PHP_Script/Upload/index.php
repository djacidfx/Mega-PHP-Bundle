<?php
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0"); 
include("setup.php") ;
include("header.php") ;
$userIp = $_SERVER['REMOTE_ADDR'];
if(find_blocked_ip($pdo , $userIp) > "0"){
    header("location: ".BASE_URL."notforyou");
}
update_block($pdo , $userIp) ;
update_password($pdo) ;
?>
<div class="col-lg-3 mt-5 d-none d-sm-none d-md-block d-lg-block">
    <?php include("ad_desktop_leftside.php") ; ?>
</div>
<div class="col-lg-6 text-center pb-5">
    <div class="row">
        <div class="col-lg-12">
            <a href="<?php echo BASE_URL ; ?>"><img src="img/logo.png" class="img-fluid" ></a>
        </div>
        <?php include("add.php") ; ?>
        
        <!-- Mobile AD 300 x 50 Pixel Start-->
        <div class="col-lg-12 d-md-none me-5 mt-2">
              <?php include("ad_mobile.php") ; ?>
        </div>
        <!-- Mobile AD 300 x 50 Pixel Start-->
        
        <div class="col-lg-12"><?php echo load_default_site($pdo) ; ?></div>
        <div class="col-lg-12 jQueryLoadMoreSite"></div>
    </div>
    
</div>
<div class="col-lg-3 mt-5 d-none d-sm-none d-md-block d-lg-block">
    <?php include("ad_desktop_rightside.php") ; ?>
</div>
<div class="bg-dark customTopBorder text-muted text-center fixed-bottom p-2"><span>Copyright &copy; <?php echo date("Y"); ?> <b class="text-white"><?php echo COPYRIGHT_NAME ; ?></b> . All Rights Reserved.</span></div>
<?php
include("footer.php") ;
?>