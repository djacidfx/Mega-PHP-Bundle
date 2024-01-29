<!-- Desktop Header Ad -->
<div class="d-none d-sm-none d-md-block d-lg-block">
    <?php if(ad_header970_status($pdo) == '1') { ?> 
        <?php if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){ ?>
            <!-- If Localhost -->
            <img src="<?php echo BASE_URL ; ?>img/970_ad.jpg" class="pointer">
        <?php  } else { ?>
            <!-- If Server -->
            <?php echo ad_header970_js_code($pdo) ; ?>
        <?php  } ?>
    <?php } ?>
</div> 
<!-- Mobile Header Ad -->
<div class="d-md-none">
    <?php if(ad_header320_status($pdo) == '1') { ?> 
        <?php if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){ ?>
            <!-- If Localhost -->
            <img src="<?php echo BASE_URL ; ?>img/320_100_ad.jpg" class="pointer">
        <?php  } else { ?>
            <!-- If Server -->
            <?php echo ad_header320_js_code($pdo) ; ?>
        <?php  } ?>
    <?php } ?>
</div>