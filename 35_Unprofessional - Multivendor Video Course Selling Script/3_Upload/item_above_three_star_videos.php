<?php include("header_session.php") ; ?>
<?php $webtitle = "Above 3 Star Rating Items" ; ?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>
<?php
$nt = '1' ;
$ratingby = "active" ;
$abovethreestar = "active" ;
?>
<?php include("sidebar_index.php"); ?>

<!-- Main Content -->
<div class="main-content ">
    <section class="section">        
      <?php echo fetch_all_three_star_item_default($pdo) ; ?>
      <div class="jQueryThreeStarItem"></div>
    </section>
</div>
<?php include("footer_main.php") ; ?>
