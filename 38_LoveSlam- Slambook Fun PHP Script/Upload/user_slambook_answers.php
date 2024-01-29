<?php 
include("database.php") ; 
$answerId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT) ;
if(check_answer_id($pdo , $answerId) == 0){
     header("location: ".BASE_URL."");
}
$slambookId = slambookid_by_answerid($pdo,$answerId) ;
$urlTitle =  urlanswername_by_id($pdo,$answerId) ; 
$username = username_by_id($pdo,$slambookId) ;
$answerUsername = answerusername_by_id($pdo,$answerId) ;
$webTitle = "Slambook of ".$username." - Answer by ".$answerUsername ;
$metaDescription = "Hey ! Just Share Your Slambook to your Friends & have some fun." ; 
?>
<?php include("header_common.php") ; ?>
    <div class="col-lg-3 d-none d-sm-none d-md-block d-lg-block justify-content-center text-center">
        <?php include("ad_left_desktop.php") ; ?>
    </div>
    <div class="col-lg-6">
        <?php include("ad_common.php") ; ?>
        <div class="card mt-3 shadow-lg">
            <div class="card-header">
                <div class="text-center mt-2"><img src="<?php echo BASE_URL ; ?>img/logo.png" class="logoDesktop img-fluid"></div>
                <h5 class="text-center text-muted mt-2"><b class="text-danger"><i class="bi bi-suit-heart-fill"></i> <?php echo $answerUsername ; ?> <i class="bi bi-suit-heart-fill"></i> </b> gave answers for <b class="text-danger"><i class="bi bi-suit-heart-fill"></i> <?php echo $username ; ?> <i class="bi bi-suit-heart-fill"></i> </b></h5>
            </div>
            <div class="card-body">
                <div class="row">
                    
                    <div class="col-lg-12 text-center customBottomBorder">
                        <small class="text-muted text-center">Share with your friends</small>
                    <br>
                        <span class="p-1"><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo BASE_URL.'answer/'.$answerId.'/'.$urlTitle ; ?>" target="_blank"><i class="bi bi-facebook pointer shareIcon fbColor" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Facebook"></i></a></span>
                        <span class="p-1"><a href="https://twitter.com/share?url=<?php echo BASE_URL.'answer/'.$answerId.'/'.$urlTitle ; ?>&text=<?php echo $webTitle; ?>" target="_blank"><i class="bi bi-twitter twitterColor pointer shareIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Twitter"></i></a></span>
                        <span class="p-1"><a href="https://wa.me/?text=<?php echo BASE_URL.'answer/'.$answerId.'/'.$urlTitle ; ?>" target="_blank"><i class="bi bi-whatsapp wpColor pointer shareIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Whatsapp"></i></a></span>
                        <span class="p-1"><a href="https://www.pinterest.com/pin/create/button/?url=<?php echo BASE_URL.'answer/'.$answerId.'/'.$urlTitle ; ?>&media&description=<?php echo $webTitle; ?>" target="_blank" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Pinterest"><img src="<?php echo BASE_URL ; ?>img/pinterest.png" class="mt-n4"></a></span>
                        <span class="p-1"><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo BASE_URL.'answer/'.$answerId.'/'.$urlTitle ; ?>&title=<?php echo $webTitle; ?>&summary=&source=" target="_blank" ><i class="bi bi-linkedin ldColor pointer shareIcon" data-bs-toggle="tooltip" data-bs-placement="top" title="Share on Linkedin"></i></a></span>
                    </div>
                    <div class="col-lg-12 mt-2">
                        <?php echo answer_form($pdo,$slambookId,$answerId) ; ?>
                    </div>
                    <div class="col-lg-12 mt-2 text-center ">
                        <a href="<?php echo BASE_URL ; ?>" class="btn btn-danger btn-md">It's Your Turn, Create Your Slambook <i class="bi bi-suit-heart-fill"></i></a>
                    </div>
                </div>
            </div>
        </div>
        
        <?php include("copyright.php") ; ?>
    </div>


    <div class="col-lg-3 d-none d-sm-none d-md-block d-lg-block justify-content-center text-center">
        <?php include("ad_right_desktop.php") ; ?>
    </div>
<?php include("footer_common.php") ; ?>