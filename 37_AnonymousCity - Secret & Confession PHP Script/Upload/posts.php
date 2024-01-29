<?php
include("header_post.php") ;
?>
<div class="col-lg-9 offset-md-3 justify-content-center text-center p-2">
    <div class="row">
        
        <!-- Desktop Header Ad -->
        <div class="d-none d-sm-none d-md-block d-lg-block">
            <img src="<?php echo BASE_URL ; ?>img/970_ad.jpg">
        </div> 
        <!-- Mobile Header Ad -->
        <div class="d-md-none">
            <img src="<?php echo BASE_URL ; ?>img/320_100_ad.jpg">
        </div>
        <div class="col-lg-8 mt-3 p-md-3 pt-md-0">
            <div class="col-lg-12 p-1 pt-0 ms-md-2">
                <div class="card bg-dark newShadow">
                    <div class="card-header">
                        <span class="float-start p-1 ps-0 text-white bigFont"><i class="bi bi-signpost-2-fill text-danger"></i> <?php echo $postTitle ; ?></span>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 p-1 pt-0 ms-md-2">
                <div class="card bg-dark newShadow">
                    <div class="card-header mySecret text-start">
                        <?php echo $postDescription ; ?>
                    </div>
                    <div class="card-body mySecret text-start">
                        <?php echo grab_post_footer($pdo,$postId); ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 p-1 pt-0 ms-md-2 mt-2">
                <div class="card bg-dark newShadow">
                    <form class="postUserComment" method="post">
                        <div class="card-header mySecret text-start">
                            <div class="col-lg-12">
                                <textarea class="form-control customBorder bg-dark text-white" name="usercomment" rows="8" placeholder="Post Your Comment...." required></textarea>
                            </div>
                            <div class="col-lg-12 text-center">
                                <div class="g-recaptcha" data-sitekey="<?php echo SITE_KEY ; ?>" data-theme="dark" ></div>
                            </div>
                        </div>
                        <div class="card-body mySecret text-center">
                            <div class="commentmessage"></div>
                            <input type="hidden" name="pid" value="<?php echo $postId ; ?>">
                            <input type="hidden" name="btn_action" value="postComment">
                            <button class="btn btn-md btn-grey btnComment"><i class="bi bi-chat-left-text text-primary"></i> Post Comment</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-12 p-1 pt-0 ms-md-2 mt-2">
                <?php echo get_comments_default($pdo,$postId) ; ?>
                <div class="jQueryNewComment"></div>
            </div>
        </div>
        <?php include("sidebar_right.php") ; ?>
    </div>
</div>

<?php include("body_end.php") ; ?>