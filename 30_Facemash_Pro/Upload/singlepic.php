<?php
ob_start();
session_start();
include("_adminarea_/db/config.php");
include("_adminarea_/db/img_functions.php");

$picId = filter_var($_GET['pid'], FILTER_SANITIZE_NUMBER_INT) ;
if(empty($picId)){
	header("location:".BASE_URL."") ;
}
$checking = check_pic_foruser($pdo,$picId) ;
if($checking == '0'){
	header("location:".BASE_URL."") ;
}
include("post_header.php") ;
?>
<div class="page-content d-flex align-items-stretch minH mt-5 bg-dark">
	<div class="content-inner w-100 mt-1 bg-dark">
		<!--***** Post *****-->  
		<div class="row">
			<div class="col-lg-3">
				<div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px; " class="toastHidden">
				  <!-- Position it -->
				  <div style="position: absolute; ">
					<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="1000" style="min-width:200px;">
					  <div class="toast-header">
						<strong class="mr-auto">Last Winner</strong>
						
					  </div>
					  <div class="toast-body">
						<b class="winnerName"></b>
					  </div>
					</div>
				  </div>
				</div>
			</div>
			<div class="col-lg-6">
			  
				<div class="text-center" >
					<?php include("footer_ad.php"); ?>
					<div class="row text-white justify-content-center"><h2>Play Against <?php echo get_winner_name($pdo, $picId) ; ?></h2></div>
					<div class="row pic2"><?php echo random_one_image($pdo, $picId) ; ?></div>
					<!--Social Share-->
					<div class="col-lg-12 text-center">
					<a href="http://www.facebook.com/share.php?u=<?php echo BASE_URL."playagainst/".$picId ; ?>" target="_blank" class="text-white"><i class="fa fa-facebook-square myFa"></i></a> &ensp; <a href="https://twitter.com/share?url=<?php echo BASE_URL."playagainst/".$picId ; ?>&text=Play Against <?php echo get_winner_name($pdo, $picId) ; ?>" target="_blank" class="text-white"><i class="fa fa-twitter-square myFa"></i></a> &ensp; <a href="https://wa.me/?text=<?php echo BASE_URL."playagainst/".$picId ; ?>" class="text-white"><i class="fa fa-whatsapp myFa"></i></a>
					</div>
					<div class="col-lg-12 text-muted mt-2"><small>Click on Image to Vote</small></div>
				</div>
			</div>
			<div class="col-lg-3">
				
			</div>
		</div>
	</div>
</div> 
<?php include("footer.php") ; ?> 