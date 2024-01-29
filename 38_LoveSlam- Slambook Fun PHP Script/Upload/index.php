<?php 
include("database.php") ; 
$webTitle = "Create Your Slambook !" ;
$metaDescription = "Hey ! Just Share Your Slambook to your Friends & have some fun." ; 
?>
<?php include("header_common.php") ; ?>
    <div class="col-lg-3 d-none d-sm-none d-md-block d-lg-block justify-content-center text-center">
        <?php include("ad_left_desktop.php") ; ?>
    </div>
    <div class="col-lg-6">
        <?php include("ad_common.php") ; ?>
        <div class="card mt-3 shadow-lg">
            <div class="card-header">
                <div class="text-center mt-2"><img src="<?php echo BASE_URL ; ?>img/logo.png" class="logoDesktop img-fluid"></div>
                <h2 class="text-center text-muted mt-2">Create Your Slambook</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <form method="post" class="fillSlambook">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Your Name" maxlength="20" required autocomplete="off" autofocus>
                            </div>
                            <div class="form-group mt-1 justify-content-center text-center">
                                <div class="g-recaptcha" data-sitekey="<?php echo SITE_KEY ; ?>" ></div>
                            </div>
                            <div class="form-group mt-4 text-center">
                                <div class="remove-messages"></div>
                                <input type="hidden" name="btn_action" value="saveSlambook">
                                <button type="submit" id="action_sb" class="btn btn-md btn-danger"><i class="bi bi-suit-heart"></i> Create Slambook</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3"></div>
                </div>
            </div>
        </div>
        
        <?php include("copyright.php") ; ?>
        
    </div>


    <div class="col-lg-3 d-none d-sm-none d-md-block d-lg-block justify-content-center text-center">
        <?php include("ad_right_desktop.php") ; ?>
    </div>
<?php include("footer_common.php") ; ?>