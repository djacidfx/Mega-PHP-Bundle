<?php
include("db.php") ;
$urlTitle = filter_var($_GET['slug'], FILTER_SANITIZE_STRING) ;
$zipId = getzipid_by_slug($pdo,$urlTitle) ;
$zipTitle = getziptitle_by_id($pdo,$zipId) ;
$zipFile = getzipfile_by_id($pdo,$zipId) ;
if(check_zip_id($pdo,$zipId) == 0) {
    header("location: ".BASE_URL."");
}
increaseviews_by_zipid($pdo,$zipId) ;
include("head_file.php") ;
include("header.php") ;
?>
<div class="row p-0">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <div class="row p-0">
            <div class="col-lg-7 mt-3">
                <div class="card newShadow <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?>">
                    <div class="card-header">
                        <form action="<?php echo BASE_URL ; ?>download" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="zipfile" value="<?php echo $zipFile ; ?>">
                            <button type="submit" name="submit" class="btn btn-md btn-success float-end"><i class="bi bi-download me-1"></i> <?php echo userlang('download') ; ?></button>
                        </form>
                    </div>
                    <div class="card-body">
                        <h4 ><?php echo $zipTitle ; ?></h4>
                        <p class="mb-0 pb-0"><small class="text-muted"><i class="bi bi-diagram-3-fill me-1"></i><a href="<?php echo BASE_URL ; ?>category/<?php echo getcategoryshortname_by_zipid($pdo,$zipId) ; ?>"><?php echo getcategoryname_by_id($pdo,$zipId) ; ?></a></small>
                        
                        </p>
                    </div>
                    <div class="card-footer">
                        <small class="text-muted float-end mt-2"><?php echo getzipdate_by_id($pdo,$zipId) ; ?></small>
                        <small class="<?php echo colormode('default_text') ; ?>"><i class="bi bi-eye me-1"></i><?php echo getviews_by_zipid($pdo,$zipId) ; ?></small>
                        <small class="<?php echo colormode('default_text') ; ?>"><i class="bi bi-download ms-2 me-1"></i><span class="mt-2"><?php echo count_downloads($pdo,$zipId) ; ?></span></small>
                        <span class="p-1 ms-3"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo BASE_URL."zip/".$urlTitle ; ?>" target="_blank"><i class="bi bi-facebook pointer shareIcon fbColor mt-1" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo userlang('share_fb') ; ?>"></i></a></span>
                        <span class="p-1"><a href="https://twitter.com/share?url=<?php echo BASE_URL."zip/".$urlTitle ; ?>&text=<?php echo $zipTitle ; ?>" target="_blank"><i class="bi bi-twitter twitterColor pointer shareIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo userlang('share_tw') ; ?>"></i></a></span>
                        <span class="p-1"><a href="https://wa.me/?text=<?php echo BASE_URL."zip/".$urlTitle ; ?>" target="_blank"><i class="bi bi-whatsapp wpColor pointer shareIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo userlang('share_wp') ; ?>"></i></a></span>
                        <span class="p-1"><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo BASE_URL."zip/".$urlTitle ; ?>&title=<?php echo $zipTitle ; ?>&summary=&source=" target="_blank" ><i class="bi bi-linkedin ldColor pointer shareIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo userlang('share_ld') ; ?>"></i></a></span>
                    </div>
                    <?php if(check_zip_featured($pdo,$zipId) > 0){ ?> 
                        <div class="card-badge rounded bg-danger text-white"><i class="bi bi-bookmark-star-fill text-warning me-1"></i><?php echo userlang('featured') ; ?></div>
                    <?php } ?>
                    
                    <?php if(check_zip_popular($pdo,$zipId) > 0){ ?>
                        <div class="card-badge rounded bg-info text-dark"><i class="bi bi-bar-chart text-dark me-1"></i><?php echo userlang('popular') ; ?></div>
                    <?php } ?>
                    
                </div>
                <?php if(check_zip_description($pdo,$zipId) > 0) { ?>
                <div class="card newShadow <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> mt-3 mb-3">
                    <div class="card-header">
                        <h4><i class="bi bi-card-heading me-2"></i><?php echo userlang('description'); ?></h4>
                    </div>
                    <div class="card-body">
                        <h5><?php echo getzipdescription_by_id($pdo,$zipId) ; ?></h5>
                    </div>
                </div>
                <?php } ?>
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
