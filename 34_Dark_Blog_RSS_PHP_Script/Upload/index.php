<?php include("header.php") ; ?>
<div class="page-content d-flex align-items-stretch minH mt-5 bg-dark">
	<div class="content-inner w-100 mt-4 bg-dark">
		<!--***** Post *****-->  
		<div class="row">
            <?php echo get_official_post($pdo) ; ?>
            <?php echo get_featured_post($pdo) ; ?>
            <?php echo get_user_post_default($pdo); ?>
            <div class="row jQueryNewPost w-100 noMargin"></div>
		</div>
	</div>
</div> 
<?php include("footer_index.php") ; ?> 

