<?php
ob_start();
session_start();
include("_adminarea_/db/config.php");
include("_adminarea_/db/post_functions.php");

$postId = filter_var($_GET['pid'], FILTER_SANITIZE_NUMBER_INT) ;
$postTitle = get_post_title($pdo,$postId) ;
if(empty($postId)){
	header("location:".BASE_URL."") ;
}
$checking = check_post_foruser($pdo,$postId) ;
if($checking == '0'){
	header("location:".BASE_URL."") ;
}
	$oldPostView = get_post_view($pdo,$postId) ;
	$newView = $oldPostView + 1 ;
	$upd = $pdo->prepare("update anony_post set post_view = '".$newView."' where id = '".$postId."'");
	$upd->execute();

include("post_header.php") ;
?>
<div class="container-fluid  mt-5 p-5 bg-dark ">
 	<div class="row text-center">
		<div class="col-lg-1"></div>
		<div class="col-lg-10">
			<div class="row text-white justify-content-left border border-top-0 border-left-0 border-right-0 border-light mb-3">
				<h2 class="mt-1"><i class="fa fa-file-text-o"></i>&ensp;<?php echo $postTitle ; ?></h2>
			
			</div>
		</div>  
		<div class="col-lg-1"></div>
    </div>
</div>
<div class="page-content d-flex align-items-stretch minH mt-n5">
	<div class="content-inner w-100 bg-dark">
		<!--***** Page Content *****-->  
		<div class="row">
		<div class="col-lg-1"></div>
		<div class="col-lg-10 text-white myPost">
            <?php include("footer_ad.php"); ?>
        <?php echo base64_decode(get_post_description($pdo,$postId)) ; ?>
		<?php echo get_single_post($pdo,$postId) ; ?>
        <?php echo get_comments_default($pdo,$postId) ; ?>
            <div class="jQueryNewComment"></div>
		</div>
		<div class="col-lg-1"></div>
		</div>
	</div>
</div> 
<!-- Unpaid Payout Breakups Modal -->
<div id="cModal" class="modal fade cModal" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <form class="c_form" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="modal-title"><i class='fa fa-plus'></i> Add Comment </h4>
                        </div>
                    </div>                       
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <label>Full Name*</label>
                            <input type="text" class="form-control" required name="fullname" maxlength="50">
                        </div>
                        <div class="col-lg-6">
                            <label>Email*</label>
                            <input type="email" class="form-control" required name="email" maxlength="50">
                        </div>
                        <div class="col-lg-12 mt-2">
                            <textarea name="comment" id="item_message" class="form-control" autofocus required></textarea>
                        </div>
                    </div>						
                </div>
                <div class="modal-footer">
                    <div class="row w-100">
                        <div class="col-lg-3"></div><div class="col-lg-6 remove-messages"></div><div class="col-lg-3"></div>
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6">
                            <div class="g-recaptcha" data-sitekey="<?php echo SITE_KEY ; ?>"></div>
                        </div>
                        <div class="col-lg-3"></div>
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6 text-center mt-2">
                            <input type="hidden" name="pId" value="<?php echo $postId ; ?>" >
                            <input type="hidden" name="btn_action_sb" value="postComment">
                            <button type="submit" name="submit" class="btn-primary btn btn-md">Post Comment</button>
                            <button type="button" class="btn btn-light btn-md ml-3" data-dismiss="modal">Close</button>
                        </div>
                        <div class="col-lg-3"></div>
                    </div>
                    
                </div>
            </form>
            </div>
    </div>
</div>
<?php include("footer.php") ; ?> 