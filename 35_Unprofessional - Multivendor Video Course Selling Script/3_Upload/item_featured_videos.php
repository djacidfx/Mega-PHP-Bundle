<?php include("header_session.php") ; ?>
<?php $webtitle = "Featured Items" ; ?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>
<?php
$nt = '1' ;
$featured = "active" ;
?>
<?php include("sidebar_index.php"); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">        
      <?php echo fetch_all_featured_item_default($pdo) ; ?>
      <div class="jQueryFeaturedItem"></div>
    </section>
</div>
<?php include("footer_main.php") ; ?>
