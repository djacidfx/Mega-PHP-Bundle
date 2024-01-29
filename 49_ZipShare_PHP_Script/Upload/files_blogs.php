<?php
include("db.php") ;
include("head_popular.php") ;
include("header.php") ;
?>
<div class="row p-0">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <div class="row p-0">
            <div class="col-lg-7 mt-3">
                <div class="card newShadow <?php echo colormode('bg_color') ; ?> text-muted">
                    <div class="card-header">
                        <h2><i class="bi bi-rss text-success me-2"></i> <?php echo userlang('latest_blog') ; ?></h2>
                    </div>
                </div>
                <?php echo show_blog_default($pdo); ?>
                <div class="jQueryLoadMoreBlogFiles"></div>
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
