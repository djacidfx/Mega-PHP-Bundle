<?php 
include("database.php") ;
$webTitle = "Anonymous Secret & Confessions" ;
$metaDescription = "Hey ! Just Share Your Secret & Confessions to Our Anonymous World." ; 
include("head_common.php") ;
include("body_start.php") ;
?>


<div class="col-lg-9 offset-md-3 justify-content-center text-center p-2">
    <div class="row">
        
        <?php include("header_ad.php") ; ?>
        
        <div class="col-lg-8 mt-3 p-md-3 pt-md-0">
            <div class="col-lg-12 p-1 pt-0 ms-md-2">
                <div class="card bg-dark newShadow">
                    <div class="card-header">
                        <span class="float-start p-1 ps-0 text-muted bigFont"><i class="bi bi-bookmark-star text-warning"></i> Featured</span>
                        <span class="float-end mt-2"><a href="<?php echo BASE_URL ; ?>featured" class="btn btn-sm btn-grey" data-bs-toggle="tooltip" data-bs-placement="top" title="View All Featured Secret / Confession"><i class="bi bi-link-45deg text-primary"></i> View All</a></span>
                    </div>
                </div>
            </div>
            <div class="row p-1 pt-0 ms-md-1">
                <?php echo grab_featured_post_for_index($pdo, featuredload_index($pdo)) ; ?>
            </div>
            <div class="row p-1 pt-0 ms-md-1">
                <?php include("ad_after_featured.php") ; ?>                  
            </div>
            
            <div class="col-lg-12 p-1 pt-0 ms-md-2 mt-2">
                <div class="card bg-dark newShadow">
                    <div class="card-header">
                        <span class="float-start p-1 ps-0 text-muted bigFont"><i class="bi bi-graph-up text-success"></i> Trending</span>
                        <span class="float-end mt-2"><a href="<?php echo BASE_URL ; ?>trending" class="btn btn-sm btn-grey" data-bs-toggle="tooltip" data-bs-placement="top" title="View All Trending Secret / Confession"><i class="bi bi-link-45deg text-primary"></i> View All</a></span>
                    </div>
                </div>
            </div>
            <div class="row p-1 pt-0 ms-md-1">
                <?php echo grab_trending_post_for_index($pdo,trendingload_index($pdo)) ; ?>
            </div>
            <div class="row p-1 pt-0 ms-md-1">
                <?php include("ad_after_trending.php") ; ?>
            </div>
            
            <div class="col-lg-12 p-1 pt-0 ms-md-2 mt-2">
                <div class="card bg-dark newShadow">
                    <div class="card-header">
                        <span class="float-start p-1 ps-0 text-muted bigFont"><i class="bi bi-broadcast text-info"></i> New</span>
                        <span class="float-end mt-2"><a href="<?php echo BASE_URL ; ?>new" class="btn btn-sm btn-grey" data-bs-toggle="tooltip" data-bs-placement="top" title="View All New Secret / Confession"><i class="bi bi-link-45deg text-primary"></i> View All</a></span>
                    </div>
                </div>
            </div>
            <div class="row p-1 pt-0 ms-md-1">
                <?php echo grab_new_post_for_index($pdo,newload_index($pdo)) ; ?>
            </div>
        </div>
        <?php include("sidebar_right.php") ; ?>
        
    </div>
</div>
            
<?php include("body_end.php") ; ?>
