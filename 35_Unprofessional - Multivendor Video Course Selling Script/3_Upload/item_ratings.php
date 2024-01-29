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
$nLink = BASE_URL."ratings/".$itemId."/".$shortUrlTitle ;
$authorNewRating = want_email_on_item_rating($pdo,$authorId) ;
$adminName = admin_name($pdo) ;
$adminCopyrightName = admin_copyright_name($pdo);
if(isset($_POST['submitRating']))
{
    if(!empty($_POST['ratingcomment']) &&  !empty($_POST['itemId']) && !empty($_POST['userId']) && !empty($_POST['rating'])) {
        
       $ratingComment = filter_var($_POST['ratingcomment'], FILTER_SANITIZE_STRING) ;
       $userId = filter_var($_POST['userId'], FILTER_SANITIZE_NUMBER_INT) ;
       $itemId = filter_var($_POST['itemId'], FILTER_SANITIZE_NUMBER_INT) ;
       $rating = filter_var($_POST['rating'], FILTER_SANITIZE_NUMBER_INT) ;
        if(check_rated_before($pdo,$userId,$itemId) > 0 ) {
            
            $ratedBy = grab_rated_by($pdo,$itemId) ;
            $oldRating = grab_rating_ofitem($pdo,$itemId) ; 
            $oldRating = ($oldRating * $ratedBy) ;
            $oldRating = $oldRating - grab_user_item_rating($pdo,$userId,$itemId) ;
            $newRating = $oldRating + $rating ;
            $newRating = ( $newRating / $ratedBy ) ;
            $upd = $pdo->prepare("update ot_ratings set rating_star = '".$rating."', rating_comment = '".$ratingComment."' where rating_item_id = '".$itemId."' and rating_user_id = '".$userId."'") ;
            $upd->execute();
            $updateItemRating = $pdo->prepare("update ot_users_video set item_rating='".$newRating."' where item_id = '".$itemId."' ") ;
            $updateItemRating->execute() ;
        } else {
            $ins = $pdo->prepare("insert into ot_ratings (rating_item_id, rating_user_id, rating_star, rating_comment) values ('".$itemId."', '".$userId."', '".$rating."', '".$ratingComment."') ") ;
            $ins->execute() ;
            $newRatedBy = grab_rated_by($pdo,$itemId) + 1 ;
            $oldRating = grab_rating_ofitem($pdo,$itemId) ; 
            $newRating = $oldRating + $rating ;
            $newRating = ($newRating / $newRatedBy) ;
            $updateItem = $pdo->prepare("update ot_users_video set item_rated_by = '".$newRatedBy."' , item_rating='".$newRating."' where item_id = '".$itemId."' ") ;
            $updateItem->execute() ;
        }
        $insNotification = $pdo->prepare("insert into ot_notifications (n_type, n_user_id, n_link ) values ('9', '".$authorId."', '".$nLink."' ) ");
        $insNotification->execute();
        
        // ********************** Send Email to Author for Item Rating. **********************
        if($authorNewRating == '1'){
            $userName = get_username_by_itemid($pdo,$_POST['userId']) ;
            $itemUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
            $imageName = find_live_image($pdo,$itemId) ;
            $userfullname = user_fullname_by_id($pdo,$_POST['userId']) ;
            $authoremail = useremail_by_id($pdo,$authorId) ;
            $to = $authoremail ;
            $subject = "User Rated Your Item.";
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
            $headers .= 'From: '.$adminName.'' . "\r\n" . 'Reply-To: '.$authoremail.'' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
            include("emailTemplates/send_item_rating_email.php");
            mail($to, $subject, $body, $headers);
        }
        
    } 
}
$onestar = "" ;
$twostar = "" ;
$threestar = "" ;
$fourstar = "" ;
$fivestar = "" ;
$userReviewComment = "";
if(!empty($_SESSION['unprofessional'])){
    if(check_rated_before($pdo,$_SESSION['unprofessional']['id'],$itemId) > 0 ) {
        if(grab_user_item_rating($pdo,$_SESSION['unprofessional']['id'],$itemId) == 1){
            $onestar = "checked" ;
        }
        if(grab_user_item_rating($pdo,$_SESSION['unprofessional']['id'],$itemId) == 2){
            $twostar = "checked" ;
        }
        if(grab_user_item_rating($pdo,$_SESSION['unprofessional']['id'],$itemId) == 3){
            $threestar = "checked" ;
        }
        if(grab_user_item_rating($pdo,$_SESSION['unprofessional']['id'],$itemId) == 4){
            $fourstar = "checked" ;
        }
        if(grab_user_item_rating($pdo,$_SESSION['unprofessional']['id'],$itemId) == 5){
            $fivestar = "checked" ;
        }
       $userReviewComment = grab_user_item_rating_comment($pdo,$_SESSION['unprofessional']['id'],$itemId) ;
    }
}
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
                <div class="card-header justify-content-center">
                  <h4>Post Ratings ( <i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i><i class="fas fa-star text-warning"></i> )</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="<?php echo BASE_URL ; ?>ratings/<?php echo $itemId ; ?>/<?php echo $shortUrlTitle ; ?>" enctype="multipart/form-data" class="submitRating">
                        <div class="row">
                            <div class="col-lg-12 mt-1 text-center">
                                <div class="form-group">
                                <span class="star-rating star-5">      
                                    <input type="radio" name="rating" value="1" data-toggle="tooltip" data-placement="top" title="Very Poor" required <?php echo $onestar ; ?> ><i></i>
                                    <input type="radio" name="rating" value="2" data-toggle="tooltip" data-placement="top" title="Poor"  required <?php echo $twostar ; ?> ><i></i>
                                    <input type="radio" name="rating" value="3" data-toggle="tooltip" data-placement="top" title="Good"  required <?php echo $threestar ; ?> ><i></i>
                                    <input type="radio" name="rating" value="4" data-toggle="tooltip" data-placement="top" title="Very Good"  required <?php echo $fourstar ; ?> ><i></i>
                                    <input type="radio" name="rating" value="5" data-toggle="tooltip" data-placement="top" title="Excellent"  required <?php echo $fivestar ; ?> ><i></i>
                                </span>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <textarea name="ratingcomment" id="ratingcomment" class="form-control textareaLarge" maxlength="300" placeholder="Post Your Review within 300 Characters." autofocus required  ><?php echo $userReviewComment ; ?></textarea>
                            </div>
                            <div class="col-lg-12 mt-4 text-center">
                                <?php if(!empty($_SESSION['unprofessional'])){ ?>
                                    <?php if($authorId != $_SESSION['unprofessional']['id']){ ?> 
                                        <?php if(checking_user_purchased_item($pdo,$_SESSION['unprofessional']['id'],$itemId) > 0){ ?>
                                        <input type="hidden" name="itemId" value="<?php echo $itemId ; ?>" > 
                                        <input type="hidden" name="userId" value="<?php echo $_SESSION['unprofessional']['id'] ; ?>" >
                                        <?php if(check_rating_report($pdo,$_SESSION['unprofessional']['id'],$itemId) > 0 ) { ?>
                                        <button class="btn btn-danger btn-md" disabled>Your Rating is Under Review</button>
                                        <?php } else { ?>
                                        <input type="submit" name="submitRating" value="Post Rating" class="btn btn-primary btn-md mt-1" >
                                        <?php } ?>
                                        <?php } else { ?> <button class="btn btn-danger btn-md" disabled>Purchase Before Post Ratings on Video</button> <?php } ?>
                                    <?php } else { ?>
                                        <button class="btn btn-danger btn-md" disabled>You cannot Post Ratings on your Own Video</button>
                                    <?php } ?>
                                <?php } else { ?>
                                <a href="<?php echo BASE_URL ; ?>login" class="btn btn-danger btn-md">Please Login to Post Ratings</a>
                                <?php } ?>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
           </div>
          <div class="col-lg-12"><?php echo  grab_item_reviews_default($pdo,$itemId) ; ?></div>
          <div class="col-lg-12"><div class="jQueryMoreItemRatings"></div></div>
          
        </div>
    </section>
</div>
    <?php include("common_footer.php") ; ?>
    </div>
</div>

  <?php include("item_js.php") ; ?>
</body>
</html>