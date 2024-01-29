<?php 
include("header.php") ; 
$search = filter_var($_GET['search_keyword'], FILTER_SANITIZE_STRING) ;
?>
<div class="page-content d-flex align-items-stretch minH mt-5 bg-dark">
	<div class="content-inner w-100 mt-4 bg-dark">
        <div class="row">
            <?php //include("footer_ad.php"); ?>
            <?php echo get_searched_post($pdo,$search) ; ?>
            <div class="row jQueryNewPost w-100" style="margin-left:0px !important"></div>
		</div>
		
	</div>
</div> 
<?php include("footer.php") ; ?>