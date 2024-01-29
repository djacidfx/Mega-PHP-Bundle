<?php if(ad_sidebar600_status($pdo) == '1') { ?> 
    <?php if(in_array($_SERVER['REMOTE_ADDR'], $whitelist)){ ?>
            <img src="<?php echo BASE_URL ; ?>img/300_600_ad.jpg" >
    <?php } else { ?>
             <?php echo ad_sidebar600_js_code($pdo) ; ?>
    <?php } ?>
<?php } ?>