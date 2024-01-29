<?php if(ad_header468_status($pdo) == '1') { ?> 
    <?php if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){ ?>
        <div class="d-none d-sm-none d-md-block d-lg-block justify-content-center text-center">
            <img src="<?php echo BASE_URL ; ?>img/468_60_ad.jpg" >
        </div>
    <?php } else { ?>
        <div class="d-none d-sm-none d-md-block d-lg-block justify-content-center text-center">
             <?php echo ad_header468_js_code($pdo) ; ?>
        </div>
    <?php } ?>
<?php } ?>

<?php if(ad_header320_status($pdo) == '1') { ?> 
    <?php if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){ ?>
        <div class="d-md-none justify-content-center text-center">
            <img src="<?php echo BASE_URL ; ?>img/320_100_ad.jpg" >
        </div>
    <?php } else { ?>
        <div class="d-md-none justify-content-center text-center">
             <?php echo ad_header320_js_code($pdo) ; ?>
        </div>
    <?php } ?>
<?php } ?>
    