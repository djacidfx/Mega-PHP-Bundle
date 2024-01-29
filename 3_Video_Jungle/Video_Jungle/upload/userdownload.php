<?php
include("header.php") ;
if(!isset($_SESSION['user']['user_id'])){
	header("location: ".BASE_URL.""); 
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
				<h1 class="mt-1"><i class="fa fa-download"></i>&ensp;Downloads</h1>
			</div>
		</div>  
		<div class="col-lg-3"></div>
    </div>
</div>
<div class="page-content d-flex align-items-stretch minH">
	<div class="content-inner w-100">
		<!--***** Downloads *****-->  
		<div class="row">
		<div class="col-lg-1"></div>
		<div class="col-lg-10">
		<?php echo fetch_user_downloads($pdo) ; ?>
		<div class="jQueryDownloadedItem"></div>
		</div>
		<div class="col-lg-1"></div>
		</div>
	</div>
</div> 
<?php include("footer_js.php") ; ?>
