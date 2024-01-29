<div class="col-lg-4 mt-2">
    <div class="col-lg-12 mt-2">
        <!-- Desktop Right SideBar Ad -->
        <div class="d-none d-sm-none d-md-block d-lg-block ">
            <?php if(ad_sidebar600_status($pdo) == '1') { ?> 
                <?php if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){ ?>
                    <!-- If Localhost -->
                    <img src="<?php echo BASE_URL ; ?>img/300_600_ad.jpg" class="pointer">
                <?php  } else { ?>
                    <!-- If Server -->
                    <?php echo ad_sidebar600_js_code($pdo) ; ?>
                <?php  } ?>
            <?php } ?>
        </div>
        <!-- Mobile Ad -->
        <div class="d-md-none ">
            <?php if(ad_sidebar300_status($pdo) == '1') { ?> 
                <?php if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){ ?>
                    <!-- If Localhost -->
                    <img src="<?php echo BASE_URL ; ?>img/320_100_ad.jpg" class="pointer">
                <?php  } else { ?>
                    <!-- If Server -->
                    <?php echo ad_sidebar300_js_code($pdo) ; ?>
                <?php  } ?>
            <?php } ?>
        </div>
    </div>
    <div class="col-lg-12 mt-2 p-1">
       <div class="card shadow-lg bg-dark text-white">
            <div class="card-header">
                <span class="float-start p-1 ps-0"><i class="bi bi-bookmark-star text-warning"></i> Featured</span>
                <span class="float-end"><a href="#" class="btn btn-sm btn-grey" data-bs-toggle="tooltip" data-bs-placement="top" title="View All Featured Secret / Confession"><i class="bi bi-link-45deg text-primary"></i> View All</a></span>
            </div>
            <?php echo grab_featured_post_for_sidebar($pdo,featuredload_index_side($pdo)) ; ?>
        </div> 
    </div>
    <!--Common Ad for Desktop & Mobile 300 x 50 Pixel -->
    <div class=" col-lg-12 mt-2">
        <?php if(ad_commonfeatured300_status($pdo) == '1') { ?> 
            <?php if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){ ?>
                <!-- If Localhost -->
                <img src="<?php echo BASE_URL ; ?>img/300_50_ad.jpg" class="pointer">
            <?php  } else { ?>
                <!-- If Server -->
                <?php echo ad_commonfeatured300_js_code($pdo) ; ?>
            <?php  } ?>
        <?php } ?>
    </div>
    
    <div class="col-lg-12 mt-2 p-1">
       <div class="card shadow-lg bg-dark text-white">
            <div class="card-header">
                <span class="float-start p-1 ps-0"><i class="bi bi-graph-up text-success"></i> Trending</span>
                <span class="float-end"><a href="#" class="btn btn-sm btn-grey" data-bs-toggle="tooltip" data-bs-placement="top" title="View All Trending Secret / Confession"><i class="bi bi-link-45deg text-primary"></i> View All</a></span>
            </div>
            <?php echo grab_trending_post_for_sidebar($pdo,trendingload_index_side($pdo)) ; ?>
        </div> 
    </div>
    <!--Common Ad for Desktop & Mobile -->
    <div class=" col-lg-12 mt-2">
        <?php if(ad_commontrending300_status($pdo) == '1') { ?> 
            <?php if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){ ?>
                <!-- If Localhost -->
                <img src="<?php echo BASE_URL ; ?>img/300_50_ad.jpg" class="pointer">
            <?php  } else { ?>
                <!-- If Server -->
                <?php echo ad_commontrending300_js_code($pdo) ; ?>
            <?php  } ?>
        <?php } ?>
    </div>
</div>