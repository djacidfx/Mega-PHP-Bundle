<?php include("header_session.php") ; ?>
<?php $webtitle = "Unprofessional - Largest Video Selling Platform" ; ?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>
<?php 
$home = "active" ;
$dashboard = "active" ;
$nt = '1' ;
?>
<?php include("sidebar_index.php"); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <?php if(check_start_category($pdo) > 0) { ?>
      <div class="section-header">
        <h1 class="text-muted"><i class="fas fa-align-center fa-lg"></i> Categories</h1>
      </div>
     <div class="text-center my-3">

        <div class="row mx-auto my-auto">
            <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
                <div class="carousel-inner w-100" role="listbox">
                    <?php echo show_active_category_first_slider($pdo) ; ?>
                    <?php echo show_active_category_slider($pdo) ; ?>
                </div>
                <a class="carousel-control-prev w-auto" href="#recipeCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon bg-dark border border-dark rounded-circle" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next w-auto" href="#recipeCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon bg-dark border border-dark rounded-circle" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>

    </div>
      <!-- Controls -->
      <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
        <span class="icon-prev"></span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
        <span class="icon-next"></span>
      </a>
        <?php } ?>
    
        <?php echo new_item_on_indexpage($pdo) ; ?>
        <?php echo featured_item_on_indexpage($pdo) ; ?>
        <?php echo trending_item_on_indexpage($pdo) ; ?>
        <?php echo bestsellers_item_on_indexpage($pdo) ; ?>
        

    </section>
</div>
<?php include("footer_main.php") ; ?>
