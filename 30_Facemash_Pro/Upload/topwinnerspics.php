<?php include("header.php") ; ?>
<div class="page-content d-flex align-items-stretch minH mt-5 bg-dark">
	<div class="content-inner w-100 mt-4 bg-dark">
		<!--***** Post *****-->  
		<div class="row">
			<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<div class="row shadow" >
					<?php include("footer_ad.php"); ?>
					<div class="col-lg-12 text-white text-center"><h2>Top Winners</h2></div>
					<?php echo get_top_winners($pdo) ; ?>
					<div class="row jQueryNewImg"></div>
				</div>
			</div>
			<div class="col-lg-3"></div>
		</div>
	</div>
</div> 
<?php include("footer_index.php") ; ?> 