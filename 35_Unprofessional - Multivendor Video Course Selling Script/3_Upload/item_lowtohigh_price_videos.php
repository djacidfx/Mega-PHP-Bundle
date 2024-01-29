<?php include("header_session.php") ; ?>
<?php $webtitle = "Low to High Price Items" ; ?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>
<?php
$nt = '1' ;
$sortby = "active" ;
$lowtohigh = "active" ;
?>
<?php include("sidebar_index.php"); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">        
      <?php echo fetch_all_lowtohigh_price_item_default($pdo) ; ?>
      <div class="jQueryLowtoHighPriceItem"></div>
    </section>
</div>
<?php include("footer_main.php") ; ?>
