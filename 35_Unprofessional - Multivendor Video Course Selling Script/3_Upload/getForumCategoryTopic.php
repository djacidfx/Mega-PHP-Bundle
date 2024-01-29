<?php include("header_session.php") ; ?>
<?php 
$nt = '2' ;
$catId = $_GET['forum_cat_id'] ;
checking_active_forumcategory($pdo,$catId) ;

$webtitle = "Forum Category - ".forum_category_name($pdo,$catId) ;
?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>

<?php include("sidebar_index.php"); ?>

<!-- Main Content -->
<div class="main-content">
    <section class="section"> 
      <div class="section-header">
        <div class="row w-100">
            <div class="col-lg-9 p-2"><h1 class="text-muted"><i class="fas fa-bookmark fa-lg"></i> <?php echo forum_category_name($pdo,$catId); ?></h1></div> 
            <div class="col-lg-3 text-lg-right p-2">
                <?php if(empty($_SESSION['unprofessional'])) { ?> 
                    <a href="<?php echo BASE_URL ; ?>login" class="btn btn-success btn-sm rounded ">+ Create Topic</a>
                 <?php } else { ?>
                    <a href="<?php echo BASE_URL ; ?>createtopic" class="btn btn-success btn-sm rounded ">+ Create Topic</a>
                 <?php } ?>
            </div> 
        </div>
         
      </div>
            <?php echo grab_forum_topics_for_category($pdo,$catId) ; ?>
            <div class="jQueryMoreForumCategoryTopic"></div>
        
      
    </section>
</div>
<?php include("footer_main.php") ; ?>
