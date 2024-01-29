<?php
include("db.php") ;
include("head.php") ;
include("header.php") ;
include("body.php") ;
if(isset($_SESSION['owner'])) 
{
    header("location: ".ADMIN_URL."dashboard");
    exit;
} 
?>
<div class="row mt-2">
    <div class="col-lg-3"></div> 
    <div class="col-lg-6 <?php echo colormode('default_text') ; ?> <?php echo colormode('border') ; ?> p-3 shadow-lg">
        <form method="post" class="adminLogin">
        <div class="row">
            <div class="col-lg-12 text-center <?php echo colormode('border_bottom') ; ?> p-3">
                <h3  class="<?php echo colormode('default_text') ; ?> mt-2 mb-2"><i class="bi bi-shield-lock me-2"></i><?php echo userlang('admin_login_heading') ; ?></h3>
            </div>
            <div class="col-lg-6 mt-3">
                <label class="<?php echo colormode('default_text') ; ?> mt-2 mb-2"><?php echo userlang('username') ; ?></label>
                <input type="text" name="username" class="form-control <?php echo colormode('default_text') ; ?> <?php echo colormode('border') ; ?> <?php echo colormode('textarea-bgcolor') ; ?>" required autocomplete="off" >
                
            </div>
            <div class="col-lg-6 mt-3">
                <label class="<?php echo colormode('default_text') ; ?> mt-2 mb-2"><?php echo userlang('password_heading') ; ?></label>
                <input type="password" name="password" class="form-control <?php echo colormode('default_text') ; ?> <?php echo colormode('border') ; ?> <?php echo colormode('textarea-bgcolor') ; ?>" required autocomplete="off">
            </div>
            <div class="col-lg-12 mt-4 text-center">
                <div class="g-recaptcha" data-sitekey="<?php echo SITE_KEY ; ?>" data-theme="<?php echo colormode('google_captcha_theme') ; ?> " ></div>
            </div>
            <div class="col-lg-12 mt-4 text-center">
                <div class="c-messages"></div>
                <input type="hidden" name="btn_action" value="btnCreateNote">
                <button type="submit" name="submit" class="btn btn-md btn-success action_log"><i class="bi bi-box-arrow-in-right me-1"></i> <?php echo userlang('login') ; ?></button>
            </div>
        </div>
        
    </form>
    </div> 
    <div class="col-lg-3"></div> 
</div>
<script type="text/javascript" src="<?php echo BASE_URL ; ?>js/jquery-3.6.0.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL ; ?>js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL ; ?>js/login.js"></script>

<?php
include("body_end.php") ;
?>