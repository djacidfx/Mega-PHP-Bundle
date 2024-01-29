<?php include("header_session.php") ; ?>
<?php $webtitle = "High to Low Price Items" ; ?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>
<?php
$nt = '1' ;
$sortby = "active" ;
$hightolow = "active" ;
?>
<?php include("sidebar_index.php"); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">        
      <?php echo fetch_all_hightolow_price_item_default($pdo) ; ?>
      <div class="jQueryHightoLowPriceItem"></div>
    </section>
</div>
<?php include("footer_main.php") ; ?>
