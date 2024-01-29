<?php
include("pageheader.php") ; 
$pageSlug = filter_var($_GET['page_slug'], FILTER_SANITIZE_STRING);
$checkPageStatus = check_activepage_for_user($pdo,$pageSlug) ; 
if($checkPageStatus == 0) {
	header("location: ".BASE_URL."") ;
	exit ;
}
?>
<div class="container-fluid  mt-5 p-5 search-image-bg">
 	<div class="row text-center">
		<div class="col-lg-3"></div>
		<div class="col-lg-6 mt-5">
			<div class="row text-white justify-content-center">
				<h4 class="mt-4"><i class="fa fa-file-text-o"></i>&ensp;<?php echo get_page_title($pdo,$pageSlug); ?></h4>
			
			</div>
		</div>  
		<div class="col-lg-3"></div>
    </div>
</div>
<div class="page-content d-flex align-items-stretch minH">
	<div class="content-inner w-100">
		<!--***** Page Content *****-->  
		<div class="row">
		<div class="col-lg-1"></div>
		<div class="col-lg-10">
		<?php echo get_page_content($pdo,$pageSlug) ; ?>
		</div>
		<div class="col-lg-1"></div>
		</div>
	</div>
</div> 
<?php include("footer.php") ; ?>
