<?php include("header_session.php") ; ?>
<?php $webtitle = "Trending Items" ; ?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>
<?php
$nt = '1' ;
$trending = "active" ;
?>
<?php include("sidebar_index.php"); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">        
      <?php echo fetch_all_trending_item_default($pdo) ; ?>
      <div class="jQueryTrendingItem"></div>
    </section>
</div>
<?php include("footer_main.php") ; ?>
