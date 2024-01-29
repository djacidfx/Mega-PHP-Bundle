<?php include("header.php") ; ?>
<div class="page-content d-flex align-items-stretch minH mt-5 bg-dark">
	<div class="content-inner w-100 mt-4 bg-dark">
		<!--***** Official Posts *****-->  
		<div class="row">
            <?php echo get_featured_post_default($pdo) ; ?>
            <div class="row jQueryFeaturedPost w-100" style="margin-left:0px !important"></div>
		</div>
	</div>
</div> 
<?php include("footer_index.php") ; ?> 

