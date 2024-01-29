<!-- 2 Desktop Ad after Featured Section - 300 x 50 Pixel -->
<?php if(desktoptrending300_status($pdo) == '1') { ?> 
    <?php if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){ ?>
        <!-- If Localhost -->
        <div class="col-lg-6 mt-1 d-none d-sm-none d-md-block d-lg-block">
            <img src="<?php echo BASE_URL ; ?>img/300_50_ad.jpg" class="pointer">
        </div>
        <div class="col-lg-6 mt-1 d-none d-sm-none d-md-block d-lg-block">
            <img src="<?php echo BASE_URL ; ?>img/300_50_ad.jpg" class="pointer">
        </div>
    <?php  } else { ?>
        <!-- If Server -->
        <div class="col-lg-6 mt-1 d-none d-sm-none d-md-block d-lg-block">
            <?php echo ad_trendingone300_js_code($pdo) ; ?>
        </div>
        <div class="col-lg-6 mt-1 d-none d-sm-none d-md-block d-lg-block">
            <?php echo ad_trendingtwo300_js_code($pdo) ; ?>
        </div>
    <?php  } ?>
<?php } ?>

<!-- Mobile Ad after Trending Section - 300 x 50 Pixel -->
<?php if(mobiletrending300_status($pdo) == '1') { ?> 
    <?php if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){ ?>
        <!-- If Localhost -->
        <div class="mt-1 d-md-none">
            <img src="<?php echo BASE_URL ; ?>img/300_50_ad.jpg" class="pointer">
        </div>
    <?php  } else { ?>
        <!-- If Server -->
        <div class="mt-1 d-md-none">
            <?php echo ad_trendingmobileone300_js_code($pdo) ; ?>
        </div>
    <?php  } ?>
<?php } ?>