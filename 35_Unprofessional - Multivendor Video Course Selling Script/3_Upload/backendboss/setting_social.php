<?php include("header.php") ; ?>
<?php 
$settings = "active" ; 
$socialSettings = "active" ;
$com = "";
?>
<?php include("sidebar.php") ; ?>
<!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1 class="text-muted"><i class="fa fa-cog"></i> Social Settings </h1>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>This is Your Social Network Profile Link which will show in Footer which You've filled.</h4>              
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" class="social_settings">
                    <div class="row">
                        <div class="col-lg-4 mt-3">
                            <label><i class="fab fa-instagram"></i>&ensp; Instagram Profile URL </label>
				            <input type="url" class="form-control" name="instaUrl" maxlength="300"  value="<?php echo get_insta_url_link($pdo) ; ?>">
                        </div>
                        <div class="col-lg-4 mt-3">
                            <label><i class="fab fa-facebook-square"></i>&ensp; Facebook Public Profile URL </label>
				            <input type="url" class="form-control" name="fbUrl" maxlength="300"  value="<?php echo get_fb_url_link($pdo) ; ?>">
                        </div> 
                        <div class="col-lg-4 mt-3">
                            <label><i class="fab fa-twitter-square"></i>&ensp; Twitter Public Profile URL </label>
				            <input type="url" class="form-control" name="twitterUrl" maxlength="300"  value="<?php echo get_twitter_url_link($pdo) ; ?>">
                        </div>
                        <div class="col-lg-4 mt-3">
                           <label><i class="fab fa-linkedin-in"></i>&ensp; Linkedin Public Profile URL </label>
				           <input type="url" class="form-control" name="linkedinUrl" maxlength="300"  value="<?php echo get_linkedin_url_link($pdo) ; ?>">
                        </div>
                        <div class="col-lg-4 mt-3">
                            <label><i class="fab fa-behance"></i>&ensp; Behance Public Profile URL </label>
				            <input type="url" class="form-control" name="behanceUrl" maxlength="300"  value="<?php echo get_behance_url_link($pdo) ; ?>">
                        </div>
                        <div class="col-lg-4 mt-3">
                            <label><i class="fab fa-dribbble"></i>&ensp; Dribbble Public Profile URL </label>
				            <input type="url" class="form-control" name="dribbleUrl" maxlength="300"  value="<?php echo get_dribble_url_link($pdo) ; ?>">
                        </div>
                        <div class="col-lg-4 mt-3">
                            <label><i class="fab fa-vk"></i>&ensp; VK Public Profile URL </label>
				            <input type="url" class="form-control" name="vkUrl" maxlength="300"  value="<?php echo get_vk_url_link($pdo) ; ?>">
                        </div>
                        <div class="col-lg-4 mt-3"></div>
                        <div class="col-lg-4 mt-3"></div>
                        <div class="col-lg-4 mt-3"></div>
                        <div class="col-lg-4 mt-3">
                            <div class="remove-messages"></div>
                             <input type="hidden" name="btn_action" value="saveSocialSettings">
                            <button type="submit" class="btn btn-primary btn-md btn-block mt-3" tabindex="4">Save Social Settings</button>
                        </div>
                        <div class="col-lg-4 mt-3"></div>
                        
                    </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </section>
    </div>

<?php include("footer.php") ; ?>