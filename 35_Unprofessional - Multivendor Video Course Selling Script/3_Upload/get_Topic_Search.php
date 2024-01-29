<?php include("header_session.php") ; ?>
<?php 
$nt = '2' ;
$topicsearch = filter_var($_GET['search_topickeyword'], FILTER_SANITIZE_STRING) ;
$webtitle = "Topic Search - ".$topicsearch ;
?>
<?php include("header_main.php") ; ?>

<?php include("navbar_index.php"); ?>

<?php include("sidebar_index.php"); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        
          <div class="row w-100">
                <div class="col-lg-1"></div>
                <div class="col-lg-10 justify-content-center">
                    <form class="form-inline justify-content-center" method="post" action="<?php echo BASE_URL.'searched_topic' ; ?>">
                        <div class="form-group w-75">
                            <input type="search" maxlength="100" name="search_topickeyword" class="form-control w-100" placeholder="Search Forum Topic...."  value="<?php echo $topicsearch ; ?>" required>
                        </div>
                        &ensp;<button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                    </form>
                </div>
                <div class="col-lg-1"> </div>
            </div>
      </div>
      <?php if(empty($topicsearch)){ ?>
        <h3 class="text-danger text-center"><i class="fa fa-exclamation-circle text-danger"></i> Sorry, Nothing Found. Try with other Search Term.</h3>
      <?php } else { ?>
      <?php echo fetch_searchalltopic_foruser($pdo,$topicsearch) ; ?>
      <div class="jQueryLoadTopicSearchItem"></div>
      <?php } ?>
    </section>
</div>
<?php include("footer_main.php") ; ?>
