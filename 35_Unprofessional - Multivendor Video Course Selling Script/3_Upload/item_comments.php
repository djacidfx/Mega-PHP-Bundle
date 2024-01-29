<?php 
ob_start();
session_start();
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ;
include("active_sidebar.php") ;
$itemId = filter_var($_GET['item_id'], FILTER_SANITIZE_NUMBER_INT) ;
checking_active_item($pdo,$itemId) ;
$username = get_username_by_itemid($pdo,$itemId) ;
$shortUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
$itemTitle = long_title_by_id($pdo,$itemId) ;
$authorId = find_user_id_by_itemid($pdo,$itemId) ;
?>
<!DOCTYPE html>
<html lang="en">
<?php include("item_head.php") ; ?>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
        <?php include("navbar_index.php"); ?>
        <?php include("sidebar_index.php"); ?>
     <div class="main-content">
    <section class="section">
      <div class="section-header">
          <div class="row w-100">
              <div class="col-lg-9 p-2">
                <a href="<?php echo BASE_URL ; ?>video/<?php echo $itemId ; ?>/<?php echo $shortUrlTitle ;  ?>" class="text-primary"><h1 class="text-primary"><i class="fas fa-bookmark fa-lg"></i> <?php echo long_title_by_id($pdo,$itemId) ; ?></h1></a>
              </div>
              <div class="col-lg-3 text-lg-right p-2">
                <button class="btn btn-primary align-right" disabled><i class="fas fa-comment"></i> <?php echo count_comment_by_itemid($pdo,$itemId) ; ?> </button>
              </div>
          </div>
      </div>
      <div class="row">
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header">
                  <h4><i class="fas fa-video"></i> Demo Video</h4>
                </div>
                <div class="card-body">
                    <?php echo active_itemdemovideo_by_id($pdo,$itemId); ?>
                </div>
              </div>
                
            </div>
           <div class="col-lg-6">
               <div class="card">
                <div class="card-header">
                  <h4><i class="fas fa-comment"></i> Post Your Comment</h4>
                </div>
                <div class="card-body">
                    <form method="post" class="postComment" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12 mt-1">
                                <textarea name="comment" id="comment" class="form-control commentTextarea" maxlength="1000" placeholder="Post Your Comment within 1000 Characters." autofocus required  ></textarea>
                            </div>
                            <div class="col-lg-12 mt-3 text-center">
                                <?php if(!empty($_SESSION['unprofessional'])){ ?>
                                    <?php if($authorId != $_SESSION['unprofessional']['id']){ ?> 
                                        <input type="hidden" name="itemId" value="<?php echo $itemId ; ?>" >                                     <input type="hidden" name="userId" value="<?php echo $_SESSION['unprofessional']['id'] ; ?>" >
                                        <input type="hidden" name="btn_action" value="postMyComment" >
                                        <button type="submit" class="btn btn-primary btn-md">Post Comment</button>
                                    <?php } else { ?>
                                        <button class="btn btn-danger btn-md" disabled>You cannot Post Comment on your Own Video</button>
                                    <?php } ?>
                                <?php } else { ?>
                                <a href="<?php echo BASE_URL ; ?>login" class="btn btn-danger btn-md">Please Login to Post Comment</a>
                                <?php } ?>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
           </div>
          <div class="col-lg-12"><div class="jQueryGrabAllComments"></div></div>
          <div class="col-lg-12"><?php echo  grab_all_comments_default($pdo,$itemId) ; ?></div>
          <div class="col-lg-12"><div class="jQueryMoreItemComments"></div></div>
          
        </div>
    </section>
</div>
    <?php include("common_footer.php") ; ?>
    </div>
</div>

  <?php include("item_js.php") ; ?>
</body>
</html>