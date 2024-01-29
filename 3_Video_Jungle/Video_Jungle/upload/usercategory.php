<?php
include("header.php") ; 
$catId = filter_var($_GET['cid'], FILTER_SANITIZE_NUMBER_INT) ;
if(empty($catId)){
	header("location:".BASE_URL."") ;
}
$checking = check_category_foruser($pdo,$catId) ;
if($checking == '0'){
	header("location:".BASE_URL."") ;
}
if(check_user_verify_status($pdo) == 0) {
		header("location: ".BASE_URL."");
	}
?>
<div class="container-fluid  mt-5 p-5 search-image-bg">
 	<div class="row text-center">
		<div class="col-lg-3"></div>
		<div class="col-lg-6 mt-5">
			<div class="row text-white justify-content-center">
				<i class="fa fa-home mt-1"></i>&ensp;<a href="<?php echo BASE_URL ; ?>" class="text-white">Home</a>&ensp;/&ensp;<h4 class="mt-n2"><?php echo fetchcategory_name($pdo,$catId) ; ?></h4>
			
				<div class="col-lg-12 p-0 mt-2">
					Recommend: &ensp;<?php echo get_recommend_category_byid($pdo,$catId) ; ?>
				</div>
			</div>
		</div>  
		<div class="col-lg-3"></div>
    </div>
</div>
<div class="page-content d-flex align-items-stretch minH">
	<div class="content-inner w-100">
		<!--***** Items *****-->  
		<div class="row">
		<div class="col-lg-1"></div>
		<div class="col-lg-10">
		<?php echo fetch_product_by_category_foruser($pdo,$catId) ; ?>
		<div class="jQueryCategoryItem"></div>
		</div>
		<div class="col-lg-1"></div>
		</div>
	</div>
</div> 
<?php include("footer_js.php") ; ?>
