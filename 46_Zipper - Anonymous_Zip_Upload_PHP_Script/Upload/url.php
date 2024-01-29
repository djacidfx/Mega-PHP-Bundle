<?php
ob_start();
session_start();
include("config/database.php") ;
include("functions.php") ;
include("mode/mode.php") ;
include("language/lang.php") ;
$userIp = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP) ;
if(find_blocked_ip($pdo , $userIp) > "0"){
    header("location: ".BASE_URL."notforyou");
}
$noteUniqueId = filter_var($_GET['uniqueid'], FILTER_SANITIZE_STRING) ; 
include("head.php") ;
include("header.php") ;
include("body.php") ;

if(check_noteunique_id($pdo , $noteUniqueId) == 0) {
    header("location: ".BASE_URL."");
}
$readStatus = "2" ;
$actualStatus = get_noteunique_id_readstatus($pdo , $noteUniqueId) ;
if(!empty(check_note_pass($pdo , $noteUniqueId))){
    
} else {
    if($readStatus > $actualStatus){
      update_noteunique_id_readstatus($pdo , $noteUniqueId , $actualStatus) ;  
    }
}


?>
<div class="row mt-2">
<!-- Mobile AD 300 x 50 Pixel Start-->
<div class="col-lg-12 d-md-none me-5 mt-2">
      <?php include("ad_mobile.php") ; ?>
</div>
<!-- Mobile AD 300 x 50 Pixel Start-->
   
<!-- Desktop AD 300 x 600 Pixel ==> Left Side AD Start-->
<div class="col-lg-3 d-none d-sm-none d-md-block d-lg-block text-center justify-content-center">
    <?php include("ad_desktop_leftside.php") ; ?>
</div>
<!-- Desktop AD 300 x 600 Pixel ==> Left Side AD End-->
    
<div class="col-lg-6 <?php echo colormode('default_text') ; ?> pb-3">
    <?php if(!empty(check_note_pass($pdo , $noteUniqueId))){ ?>
    <?php if(check_unique_note_id_status($pdo, $noteUniqueId) === 0) { ?>
        <div class="card <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> <?php echo colormode('border') ; ?> shadow-lg mt-5">
            <div class="sh">
                <div class="card-header <?php echo colormode('border_bottom') ; ?>">
                    <div class="col-lg-12">
                        <h3 class="<?php echo colormode('default_text') ; ?> mt-4"><i class="bi bi-shield-lock me-2"></i><?php echo userlang('password_msg_heading') ; ?></h3>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" class="pass">
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <label class="<?php echo colormode('default_text') ; ?> mt-2 mb-2"><h5><i class="bi bi-lock me-1"></i><?php echo userlang('password_heading') ; ?></h5></label>
                                <input type="password" name="password" class="form-control <?php echo colormode('default_text') ; ?> <?php echo colormode('border') ; ?> <?php echo colormode('textarea-bgcolor') ; ?>" required >
                            </div>
                            <div class="col-lg-3"></div>
                            <div class="col-lg-12 mt-4 text-center">
                                <div class="g-recaptcha" data-sitekey="<?php echo SITE_KEY ; ?>" data-theme="<?php echo colormode('google_captcha_theme') ; ?> " ></div>
                            </div>
                            <div class="col-lg-12 mt-4 text-center pb-2">
                                <div class="p-messages"></div>
                                <input type="hidden" name="privatenote" value="<?php echo $noteUniqueId ; ?>">
                                <input type="hidden" name="btn_action" value="btnPassword">
                                <button type="submit" name="submit" class="btn btn-md btn-primary action_logpass"><i class="bi bi-key me-1"></i> <?php echo userlang('enter_password') ; ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="showNote"></div>
        </div>
    <?php } else { ?>
        <div class="card <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> <?php echo colormode('border') ; ?> shadow-lg mt-5">
            <div class="card-header">
                <div class="col-lg-12">
                    <h1 class="text-center"><i class="bi bi-exclamation-triangle-fill text-warning veryBigFont"></i></h1>
                    <h3 class="text-danger text-center mt-4"><?php echo userlang('read_msg') ; ?></h3>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php } else { ?> 
    <?php if(check_unique_note_id_status($pdo, $noteUniqueId) > 0) { ?>
        <div class="card <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> <?php echo colormode('border') ; ?> shadow-lg mt-5">
            <div class="card-header">
                <div class="col-lg-12">
                    <h1 class="text-center"><i class="bi bi-exclamation-triangle-fill text-warning veryBigFont"></i></h1>
                    <h3 class="text-danger text-center mt-4"><?php echo userlang('read_msg') ; ?></h3>
                </div>
            </div>
        </div>
    <?php } else { ?>
    <div class="card <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> <?php echo colormode('border') ; ?> shadow-lg">
        <div class="card-header">
            <div class="row p-0">
                <div class="col-lg-8">
                    <h4 class="<?php echo colormode('default_text') ; ?> mt-2"><i class="bi bi-pencil text-primary me-2"></i> <?php echo userlang('note_heading') ; ?></h4>
                </div>
                <div class="col-lg-4">
                    <a href="<?php echo BASE_URL ; ?>" class="text-muted btn btn-md btn-warning float-md-end "><i class="bi bi-file-earmark-person"></i> <?php echo userlang('create_pvt_note') ; ?></a>
                </div>
                <div class="col-lg-12 mt-3">
                    <p class="text-danger"><small><i class="bi bi-exclamation-triangle-fill text-danger me-2"></i><?php echo userlang('note_destroy_msg') ; ?></small></p>
                </div>
            </div>
            
            
        </div>
        <div class="card-body errorMessage ">
            <div class="col-lg-12">
                <form action="<?php echo BASE_URL ; ?>download" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="zipfile" value="<?php echo get_zipfile($pdo, $noteUniqueId) ; ?>">
                    <button type="submit" name="submit" class="btn btn-md btn-success hide"><i class="bi bi-download me-1"></i> <?php echo userlang('download') ; ?></button>
                </form>
            </div>
        </div>
        <div class="card-footer" id="txt">
            <div class="col-lg-12 mt-3">
                <?php echo get_unique_note($pdo, $noteUniqueId) ; ?>
            </div>
            <div class="col-lg-12 mt-2 text-center">
                <button class="btn btn-primary tk" id="tk" type="button" data-clipboard-target="#txt"><i class="bi bi-clipboard"></i></button>
            </div>
        </div>    
    </div>
    <?php } }?>
</div>
    
<!-- Desktop AD 300 x 600 Pixel ==> Right Side AD Start-->
<div class="col-lg-3 d-none d-sm-none d-md-block d-lg-block text-center justify-content-center">
   <?php include("ad_desktop_rightside.php") ; ?> 
</div>
<!-- Desktop AD 300 x 600 Pixel ==> Right Side AD End-->
</div>
<?php
include("footer.php") ;
include("js.php") ;
?>
<script>
  var clipboard = new ClipboardJS('.btn');

  clipboard.on('success', function (e) {
    console.log(e);
  });

  clipboard.on('error', function (e) {
    console.log(e);
  });
</script>
<?php
include("body_end.php") ;
?>