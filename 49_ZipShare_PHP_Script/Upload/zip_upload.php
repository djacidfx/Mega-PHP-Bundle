<?php
include("db.php") ;
include("head.php") ;
include("header.php") ;
?>
<div class="row p-0">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <div class="row p-0">
            <div class="col-lg-7 mt-3">
                <div class="card newShadow <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> mb-3">
                    <div class="card-header"><h3 class="text-muted"><i class="bi bi-cloud-upload me-2"></i><?php echo userlang('upload_zip_file') ; ?></h3></div>
                    <div class="card-body">
                        <form action="<?php echo BASE_URL ; ?>make_zip" method="post" id="uploadImage">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label><i class="bi bi-pencil me-2"></i><?php echo userlang('zip_title') ; ?> <small>( <?php echo userlang('zip_title_unique') ; ?> )</small></label>
                                    <input type="text" name="ziptitle" class="mt-2 mb-2 form-control <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> <?php echo colormode('border') ; ?>" required autocomplete="off" autofocus>
                                </div>
                                <div class="col-lg-6 mt-2">
                                    <label><i class="bi bi-file-earmark-zip me-2"></i><?php echo userlang('zip') ; ?> <small>( <?php echo  userlang('max_limit') ; ?> )</small></label>
                                    <input class="mt-2 mb-2 form-control uploadFile <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> <?php echo colormode('border') ; ?>" type="file" name="uploadFile" id="uploadFile" required>
                                </div>
                                <div class="col-lg-6 mt-2">
                                    <label><i class="bi bi-diagram-3 me-2"></i><?php echo userlang('category') ; ?></label>
                                    <select name="category" class="mt-2 mb-2 form-select <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> <?php echo colormode('border') ; ?>" required>
                                        <?php echo show_category_options($pdo) ; ?>
                                    </select>
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <label><i class="bi bi-card-text me-2"></i><?php echo userlang('zipdescription') ; ?></label>
                                    <textarea name="description" class="mt-2 mb-2 form-control <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> <?php echo colormode('border') ; ?>" rows="8" ></textarea>
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <div class="g-recaptcha" data-sitekey="<?php echo SITE_KEY ; ?>" data-theme="<?php echo colormode('google_captcha_theme') ; ?> " ></div>
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <div class="progress">
                                        <div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div id="targetLayer"></div>
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <div class="remove-messages"></div>
                                </div>
                                <div class="col-lg-12 mt-2 text-center">
                                    <button type="submit" name="action_pic" id="action_pic" class="action_pic btn btn-primary btn-md"><i class="bi bi-cloud-upload me-1"></i> <?php echo userlang('upload_zip') ; ?></button>
                                </div>
                            </div>
                        </form>
                        
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-4">
                <?php include("sidebar.php") ; ?>
            </div>
        </div>
    </div>
    <div class="col-lg-1"></div>
</div>
<?php
include("js.php") ;
?>
