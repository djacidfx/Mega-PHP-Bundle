<?php 
include("database.php") ;
$webTitle = "Create Your Anonymous Secret & Confessions" ;
$metaDescription = "Hey ! Just Share Your Secret & Confessions to Our Anonymous World." ; 
include("head_common.php") ;
include("body_start.php") ;
?>


<div class="col-lg-9 offset-md-3 justify-content-center text-center p-2">
    <div class="row">
        
        <!-- Desktop Header Ad -->
        <?php include("header_ad.php") ; ?>
        
        <div class="col-lg-8 mt-3 p-md-3 pt-md-0">
            <div class="col-lg-12 p-1 pt-0 ms-md-2">
                <div class="card bg-dark newShadow">
                    <div class="card-header">
                        <span class="float-start p-1 ps-0 text-muted bigFont"><i class="bi bi-signpost-2-fill text-danger"></i> Create Your Anonymous Secret / Confession</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 p-1 pt-0 ms-md-2">
                <div class="card bg-dark newShadow">
                    <div class="card-header">
                        <form method="post" class="submitSecret">
                            <div class="form-group">
                                <input type="text" name="title" maxlength="100" class="form-control bg-dark text-white" placeholder="Unique Title & Max 100 Character" autocomplete="off" required >
                            </div>
                            <div class="form-group mt-1">
                                <textarea name="description" id="item_message" class="form-control" autofocus required></textarea>
                            </div>
                            <div class="form-group mt-1 justify-content-center text-center">
                                <div class="g-recaptcha" data-sitekey="<?php echo SITE_KEY ; ?>" data-theme="dark" ></div>
                            </div>
                            <div class="form-group mt-1 justify-content-center text-center">
                                <div class="remove-messages"></div>
                                <input type="hidden" name="btn_action" value="postSecret" >
                                <button type="submit" id="action_sb" class="action_sb btn btn-grey btn-md"><i class="bi bi-share-fill text-danger"></i> Share</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php include("sidebar_right.php") ; ?>
        
    </div>
</div>
            
<?php include("body_end.php") ; ?>
