<?php include("header_session.php") ; ?>
<?php $webtitle = "Above 2 Star Rating Items" ; ?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>
<?php
$nt = '1' ;
$ratingby = "active" ;
$abovetwostar = "active" ;
?>
<?php include("sidebar_index.php"); ?>

<!-- Main Content -->
<div class="main-content ">
    <section class="section">        
      <?php echo fetch_all_two_star_item_default($pdo) ; ?>
      <div class="jQueryTwoStarItem"></div>
    </section>
</div>
<?php include("footer_main.php") ; ?>
