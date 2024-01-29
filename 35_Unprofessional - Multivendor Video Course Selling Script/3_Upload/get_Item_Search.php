<?php include("header_session.php") ; ?>
<?php 
$nt = '2' ;
$search = filter_var($_GET['search_keyword'], FILTER_SANITIZE_STRING) ;
$webtitle = "Search - ".$search ;
?>
<?php include("header_main.php") ; ?>

<?php include("navbar_index.php"); ?>

<?php include("sidebar_index.php"); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1 class="text-muted"><i class="fas fa-search fa-lg"></i> Search</h1>
      </div>
      <?php if(empty($search)){ ?>
        <h3 class="text-danger text-center"><i class="fa fa-exclamation-circle text-danger"></i> Sorry, Nothing Found. Try with other Search Term.</h3>
      <?php } else { ?>
      <?php echo fetch_searchallusers_byusername($pdo,$search) ; ?>
      <?php echo fetch_searchallproduct_foruser($pdo,$search) ; ?>
      <div class="jQueryLoadSearchItem"></div>
      <?php } ?>
    </section>
</div>
<?php include("footer_main.php") ; ?>
