<?php include("header_session.php") ; ?>
<?php $webtitle = "User Forums" ; ?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>
<?php include("sidebar_index.php"); ?>
<?php
$nt = '1' ;
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1 class="text-muted"><i class="fas fa-users fa-lg"></i> Forums</h1>&ensp;
         <?php if(empty($_SESSION['unprofessional'])) { ?> 
            <a href="<?php echo BASE_URL ; ?>login" class="btn btn-success btn-sm rounded offset-md-9">+ Create Topic</a>
         <?php } else { ?>
            <a href="<?php echo BASE_URL ; ?>createtopic" class="btn btn-success btn-sm rounded offset-md-9">+ Create Topic</a>
         <?php } ?>
      </div>
        
        <div class="text-center my-3">

        <div class="row mx-auto my-auto">
            <div id="recipeCarousel" class="carousel slide w-100" data-ride="carousel">
                <div class="carousel-inner w-100" role="listbox">
                    <?php echo show_forumactive_category_first_slider($pdo) ; ?>
                    <?php echo show_forumactive_category_slider($pdo) ; ?>
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
        <div class="section-header">
            <div class="row w-100">
                <div class="col-lg-1"></div>
                <div class="col-lg-10 justify-content-center">
                    <form class="form-inline justify-content-center" method="post" action="<?php echo BASE_URL.'searched_topic' ; ?>">
                        <div class="form-group w-75">
                            <input type="search" maxlength="100" name="search_topickeyword" class="form-control w-100" placeholder="Search Forum Topic...." required>
                        </div>
                        &ensp;<button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                <div class="col-lg-1"> </div>
            </div>
        </div>
      <!-- Controls -->
      <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
        <span class="icon-prev"></span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
        <span class="icon-next"></span>
      </a>
    <?php echo grab_forum_topics_for_user($pdo); ?>
    </section>
</div>
<?php include("footer_main.php") ; ?>