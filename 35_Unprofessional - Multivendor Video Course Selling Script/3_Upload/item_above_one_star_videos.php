<?php include("header_session.php") ; ?>
<?php $webtitle = "Above 1 Star Rating Items" ; ?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>
<?php
$nt = '1' ;
$ratingby = "active" ;
$aboveonestar = "active" ;
?>
<?php include("sidebar_index.php"); ?>

<!-- Main Content -->
<div class="main-content ">
    <section class="section">        
      <?php echo fetch_all_one_star_item_default($pdo) ; ?>
      <div class="jQueryOneStarItem"></div>
    </section>
</div>
<?php include("footer_main.php") ; ?>
