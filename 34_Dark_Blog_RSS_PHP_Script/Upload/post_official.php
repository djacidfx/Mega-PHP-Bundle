<?php include("header.php") ; ?>
<div class="page-content d-flex align-items-stretch minH mt-5 bg-dark">
	<div class="content-inner w-100 mt-4 bg-dark">  
		<div class="row">
            <?php echo get_official_post_default($pdo) ; ?>
            <div class="row jQueryOfficialPost w-100 noMargin"></div>
		</div>
	</div>
</div> 
<?php include("footer_index.php") ; ?> 

