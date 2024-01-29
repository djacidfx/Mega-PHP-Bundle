<?php
include("pageheader.php") ; 

?>
<div class="container-fluid  mt-5 p-5 bg-dark ">
 	<div class="row text-center">
		<div class="col-lg-1"></div>
		<div class="col-lg-10">
			<div class="row text-white justify-content-left">
				<h2 class="mt-4"><i class="fa fa-file-text-o"></i>&ensp;<?php echo get_page_title($pdo,$pageSlug); ?></h2>
			
			</div>
		</div>  
		<div class="col-lg-1"></div>
    </div>
</div>
<div class="page-content d-flex align-items-stretch minH">
	<div class="content-inner w-100 bg-dark">
		<!--***** Page Content *****-->  
		<div class="row">
		<div class="col-lg-1"></div>
		<div class="col-lg-10 text-white">
		<?php echo get_page_content($pdo,$pageSlug) ; ?>
		</div>
		<div class="col-lg-1"></div>
		</div>
	</div>
</div> 
<?php include("footer.php") ; ?>
