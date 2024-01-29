<?php
ob_start();
session_start();
include("_adminarea_/db/config.php");
include("_adminarea_/db/post_functions.php");

$postId = filter_var($_GET['pid'], FILTER_SANITIZE_NUMBER_INT) ;
if(empty($postId)){
	header("location:".BASE_URL."") ;
}
$checking = check_post_foruser($pdo,$postId) ;
if($checking == '0'){
	header("location:".BASE_URL."") ;
}
if(!isset($_SESSION['admin'])){
	$oldPostView = get_post_view($pdo,$postId) ;
	$newView = $oldPostView + 1 ;
	$upd = $pdo->prepare("update anony_post set post_view = '".$newView."' where id = '".$postId."'");
	$upd->execute();
}
include("post_header.php") ;
?>
<div class="page-content d-flex align-items-stretch minH mt-5 bg-dark">
	<div class="content-inner w-100 mt-4 bg-dark">
		<!--***** Post *****-->  
		<div class="row">
            <div class="col-lg-12 text-center d-none d-sm-none d-md-block d-lg-block">
                <?php include("footer_ad.php"); ?>
            </div>
			<div class="col-lg-3"></div>
			<div class="col-lg-6 mt-3">
				<div class="row shadow" >
					<?php echo get_single_post($pdo,$postId) ; ?>
				</div>
			</div>
			<div class="col-lg-3"></div>
		</div>
	</div>
</div> 
<?php include("footer.php") ; ?> 