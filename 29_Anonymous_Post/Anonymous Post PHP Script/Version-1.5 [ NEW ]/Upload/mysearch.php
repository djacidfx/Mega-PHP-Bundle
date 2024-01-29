<?php 
include("header.php") ; 
$search = filter_var($_GET['search_keyword'], FILTER_SANITIZE_STRING) ;
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
					<div class="postDesign w-100"></div>
					<?php echo get_searched_post($pdo,$search) ; ?>
					<div class="jQueryNewPost w-100"></div>
				</div>
			</div>
			<div class="col-lg-3"></div>
		</div>
	</div>
</div> 
<?php include("footer.php") ; ?>