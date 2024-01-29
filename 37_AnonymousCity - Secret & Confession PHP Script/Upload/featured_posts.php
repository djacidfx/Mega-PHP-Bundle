<?php 
include("database.php") ;
$webTitle = "Featured Anonymous Secret & Confessions" ;
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
                        <span class="float-start p-1 ps-0 text-muted bigFont"><i class="bi bi-bookmark-star text-warning"></i> Featured</span>
                    </div>
                </div>
            </div>
            <div class="row p-1 pt-0 ms-md-1">
                <?php echo grab_featured_allpost_default($pdo, featuredload_featuredpage($pdo)) ; ?>
                
            </div>
            <div class="row p-1 pt-0 ms-md-1 jQueryLoadMoreFeatured mt-n4"></div>
        </div>
        <?php include("sidebar_right.php") ; ?>
        
    </div>
</div>
            
<?php include("body_end.php") ; ?>