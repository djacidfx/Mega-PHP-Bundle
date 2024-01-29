<?php
include("db.php") ;
$blogSlug = filter_var($_GET['slug'], FILTER_SANITIZE_STRING) ;
if(check_blog_slug($pdo,$blogSlug) == '0'){
    header("location: ".BASE_URL."");
}
$blogId = blogid_by_blog_slug($pdo,$blogSlug);
$blogTitle = blogtitle_by_blog_slug($pdo,$blogSlug) ;
$blogImage = blogimage_by_blog_slug($pdo,$blogSlug) ;
$blogShortDescription = blogshortdescription_by_blog_slug($pdo,$blogSlug);
$blogDescription = blogdescription_by_blog_slug($pdo,$blogSlug);
include("head_blogs.php") ;
include("header.php") ;
?>
<div class="row p-0">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <div class="row p-0">
            <div class="col-lg-7">
                <div class="card newShadow <?php echo colormode('bg_color') ; ?>  mb-3">
                    <div class="card-header p-0">
                        <img class="card-img-top" src="<?php echo BASE_URL.'blogimages/'.$blogImage ; ?>" alt="'.$blogTitle.'">
                        <h4 class="<?php echo colormode('default_text') ; ?> mt-2 p-2"><i class="bi bi-rss text-primary me-1"></i> <?php echo $blogTitle ; ?></h4>
                    </div>
                    <div class="card-body <?php echo colormode('border_top') ; ?>">
                       <p class="<?php echo colormode('default_text') ; ?>"><?php echo ($blogShortDescription) ; ?></p>
                       
                        <span class="p-1"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo BASE_URL."blog/".$blogSlug ; ?>" target="_blank"><i class="bi bi-facebook pointer shareIcon fbColor mt-1" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo userlang('share_fb') ; ?>"></i></a></span>
                        <span class="p-1"><a href="https://twitter.com/share?url=<?php echo BASE_URL."blog/".$blogSlug ; ?>&text=<?php echo $blogTitle ; ?>" target="_blank"><i class="bi bi-twitter twitterColor pointer shareIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo userlang('share_tw') ; ?>"></i></a></span>
                        <span class="p-1"><a href="https://wa.me/?text=<?php echo BASE_URL."blog/".$blogSlug ; ?>" target="_blank"><i class="bi bi-whatsapp wpColor pointer shareIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo userlang('share_wp') ; ?>"></i></a></span>
                        <span class="p-1"><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo BASE_URL."blog/".$blogSlug ; ?>&title=<?php echo $blogTitle ; ?>&summary=&source=" target="_blank" ><i class="bi bi-linkedin ldColor pointer shareIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo userlang('share_ld') ; ?>"></i></a></span>
                    </div>
                </div>
                <div class="card newShadow <?php echo colormode('bg_color') ; ?>  mb-3">
                    <div class="card-body <?php echo colormode('border_top') ; ?>">
                       <p class="<?php echo colormode('default_text') ; ?>"><?php echo ($blogDescription) ; ?></p>
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
