<?php include("header.php") ; ?>
<?php $catId = filter_var($_GET['cat_id'], FILTER_SANITIZE_NUMBER_INT) ; ?>
<div class="page-content d-flex align-items-stretch minH mt-5 bg-dark">
	<div class="content-inner w-100 mt-4 bg-dark">
		<!--***** Post *****-->  
		<div class="row">
            <?php echo get_category_post_default($pdo,$catId); ?>
            <div class="row jQueryCategoryPost w-100" style="margin-left:0px !important"></div>
		</div>
	</div>
</div> 
<?php include("footer_index.php") ; ?> 

