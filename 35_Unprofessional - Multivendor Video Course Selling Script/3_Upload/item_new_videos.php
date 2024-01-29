<?php include("header_session.php") ; ?>
<?php $webtitle = "New Items" ; ?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>
<?php
$nt = '1' ;
$new = "active" ;
?>
<?php include("sidebar_index.php"); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">        
      <?php echo fetch_all_new_item_default($pdo) ; ?>
      <div class="jQueryNewItem"></div>
    </section>
</div>
<?php include("footer_main.php") ; ?>
