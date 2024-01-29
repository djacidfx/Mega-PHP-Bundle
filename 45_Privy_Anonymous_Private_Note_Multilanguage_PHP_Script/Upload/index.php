<?php
include("db.php") ;
include("head.php") ;
include("header.php") ;
include("body.php") ;
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
    
<div class="col-lg-6 <?php echo colormode('default_text') ; ?>">
    <form method="post" class="createNote">
        <div class="form-group">
            <label class="<?php echo colormode('default_text') ; ?> mt-2 mb-2"><h3><?php echo userlang('note_heading') ; ?></h3></label><a href="#!" class="text-muted btn btn-md btn-warning float-md-end mt-2 openPassNote"><i class="bi bi-shield-lock"></i> <?php echo userlang('create_note_with_password_btn') ; ?></a>
            <textarea name="privatenote" class="form-control <?php echo colormode('default_text') ; ?> <?php echo colormode('border') ; ?> <?php echo colormode('textarea-bgcolor') ; ?> mt-3" rows="12" placeholder="<?php echo userlang('textarea_placeholder') ; ?>" required></textarea>
        </div>
        <div class="form-group mt-4 text-center">
            <div class="g-recaptcha" data-sitekey="<?php echo SITE_KEY ; ?>" data-theme="<?php echo colormode('google_captcha_theme') ; ?> " ></div>
        </div>
        <div class="form-group mt-4 text-center">
            <div class="c-messages"></div>
            <input type="hidden" name="btn_action" value="btnCreateNote">
            <button type="submit" name="submit" class="btn btn-md btn-primary action_log"><i class="bi bi-send-check"></i> <?php echo userlang('create_note_btn') ; ?></button>
        </div>
    </form>
</div>
    
<!-- Desktop AD 300 x 600 Pixel ==> Right Side AD Start-->
<div class="col-lg-3 d-none d-sm-none d-md-block d-lg-block text-center justify-content-center">
   <?php include("ad_desktop_rightside.php") ; ?> 
</div>
<!-- Desktop AD 300 x 600 Pixel ==> Right Side AD End-->
    
</div>
<div  class="modal fade openCreateLinkPass"  data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="modal-dialog modal-lg">
			<div class="modal-content  <?php echo colormode('bg_color') ; ?> ">
                    <div class="modal-header customBottomBorder">
                        <h4 class="modal-title <?php echo colormode('default_text') ; ?>"><i class="bi bi-shield-lock text-primary me-2"></i> <?php echo userlang('note_heading_password') ; ?></h4>
                        <button type="button" class="close btn <?php echo colormode('dark_btn') ; ?> btn-sm " data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-start">
                        <form method="post" class="createNotewithPass">
                        <div class="row">
                            <div class="col-lg-12">
                                <textarea name="privatenote" class="form-control <?php echo colormode('default_text') ; ?> <?php echo colormode('border') ; ?> <?php echo colormode('textarea-bgcolor') ; ?>" rows="12" placeholder="<?php echo userlang('textarea_placeholder') ; ?>" required></textarea>
                            </div>
                            <div class="col-lg-6 mt-2">
                                <label class="<?php echo colormode('default_text') ; ?> mt-2 mb-2"><?php echo userlang('password_heading') ; ?></label>
                                <input type="password" class="form-control <?php echo colormode('default_text') ; ?> <?php echo colormode('border') ; ?> <?php echo colormode('textarea-bgcolor') ; ?>" name="password" maxlength="50" autocomplete="off" required>
                            </div>
                            <div class="col-lg-6 mt-2">
                                <label class="<?php echo colormode('default_text') ; ?> mt-2 mb-2"><?php echo userlang('repassword_heading') ; ?></label>
                                <input type="text" class="form-control <?php echo colormode('default_text') ; ?> <?php echo colormode('border') ; ?> <?php echo colormode('textarea-bgcolor') ; ?>" name="repassword" maxlength="50" autocomplete="off" required>
                            </div>
                            <div class="col-lg-12 mt-4 text-center">
                                <div class="g-recaptcha" data-sitekey="<?php echo SITE_KEY ; ?>" data-theme="<?php echo colormode('google_captcha_theme') ; ?> " ></div>
                            </div>
                            <div class="col-lg-12 mt-4 text-center pb-2">
                                <div class="cp-messages"></div>
                                <input type="hidden" name="btn_action" value="btnCreateNotewithPassword">
                                <button type="submit" name="submit" class="btn btn-md btn-primary action_logpass"><i class="bi bi-send-check"></i> <?php echo userlang('create_note_btn') ; ?></button>
                            </div>
                        </div>
                        </form>
                    </div>
			</div>
	</div>
</div>
<div  class="modal fade openNoteLink"  data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="modal-dialog">
			<div class="modal-content  <?php echo colormode('bg_color') ; ?>">
                    <div class="modal-header customBottomBorder">
                        <h4 class="modal-title <?php echo colormode('default_text') ; ?>"><i class="bi bi-link-45deg text-primary me-2"></i> <?php echo userlang('note_heading_link') ; ?></h4>
                        <button type="button" class="close btn <?php echo colormode('dark_btn') ; ?> btn-sm " data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-start">
                        <div class="form-group">
                            <div class="col-lg-12 userlink p-2"></div>
                        </div>
                    </div>
			</div>
	</div>
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