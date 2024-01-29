<?php
include("db.php") ;
include("head.php") ;
include("header.php") ;
check_admin_logged_in($pdo);
?>
<div class="row p-0">
    <div class="col-lg-12 text-center">
        <h1 class="<?php echo colormode('default_text') ; ?>"> <i class="bi bi-rss text-primary"></i> <?php echo userlang('create_blog') ; ?></h1>
    </div>
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
        <div class="card <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> newShadow mb-2">
            <div class="card-body">
                <form method="post" class="blogCreate" action="<?php echo ADMIN_URL ; ?>upload" id="uploadImage" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-6 mt-2">
                            <label class="text-muted"><?php echo userlang('blog_name') ; ?> <small><?php echo userlang('blog_name_unique') ; ?></small></label>
                            <input type="text" name="blog_name" class="mt-3 mb-3 form-control <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> <?php echo colormode('border') ; ?>" maxlength="100" autofocus autocomplete="off" required>
                        </div>
                        <div class="col-lg-6 mt-2">
                            <label class="text-muted"><?php echo userlang('blog_image') ; ?> <small>( <?php echo  userlang('blog_max_limit') ; ?> )</small></label>
                            <input class="mt-3 mb-3 form-control uploadFile <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> <?php echo colormode('border') ; ?>" type="file" name="uploadFile" id="uploadFile" required>
                        </div>
                        <div class="col-lg-12">
                            <label class="text-muted mb-2"><?php echo userlang('blog_short_description') ; ?></label>
                            <textarea name="shortdescription" class="form-control <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> <?php echo colormode('border') ; ?>" rows="4" autofocus required></textarea>
                        </div>
                        <div class="col-lg-12 mt-2">
                            <label class="text-muted mb-2"><?php echo userlang('blog_description') ; ?></label>
                            <textarea name="description" class="form-control new_txtarea" autofocus required></textarea>
                        </div>
                        <div class="col-lg-12 mt-2">
                            <div class="progress">
                                <div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <div id="targetLayer"></div>
                        </div>
                        <div class="col-lg-12 mt-4 text-center">
                            <div class="remove-messages"></div>
                            <button type="submit" name="action_pic" id="action_pic" class="action_pic btn btn-primary btn-md "><i class="bi bi-box-arrow-in-right me-1"></i><?php echo userlang('create_blog') ; ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-2"></div>
</div>
<?php
include("js.php") ;
?>