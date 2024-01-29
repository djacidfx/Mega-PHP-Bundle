<!-- 2 Desktop Ad after Featured Section - 300 x 50 Pixel -->
<?php if(desktopfeatured300_status($pdo) == '1') { ?> 
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
            <?php echo ad_featuredone300_js_code($pdo) ; ?>
        </div>
        <div class="col-lg-6 mt-1 d-none d-sm-none d-md-block d-lg-block">
            <?php echo ad_featuredtwo300_js_code($pdo) ; ?>
        </div>
    <?php  } ?>
<?php } ?>

<!-- Mobile Ad after Featured Section - 300 x 50 Pixel -->
<?php if(mobilefeatured300_status($pdo) == '1') { ?> 
    <?php if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){ ?>
        <!-- If Localhost -->
        <div class="mt-1 d-md-none">
            <img src="<?php echo BASE_URL ; ?>img/300_50_ad.jpg" class="pointer">
        </div>
    <?php  } else { ?>
        <!-- If Server -->
        <div class="mt-1 d-md-none">
            <?php echo ad_featuredmobileone300_js_code($pdo) ; ?>
        </div>
    <?php  } ?>
<?php } ?>