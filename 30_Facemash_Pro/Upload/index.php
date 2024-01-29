<?php include("header.php") ; ?>
<div class="page-content d-flex align-items-stretch minH mt-5 bg-dark">
	<div class="content-inner w-100 mt-4 bg-dark">
		<!--***** Post *****-->  
		<div class="row">
			<div class="col-lg-3">
				<div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px; " class="toastHidden">
				  <!-- Position it -->
				  <div style="position: absolute; ">
					<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="1000" style="min-width:200px;">
					  <div class="toast-header">
						<strong class="mr-auto">Last Winner</strong>
						
					  </div>
					  <div class="toast-body">
						<b class="winnerName"></b>
					  </div>
					</div>
				  </div>
				</div>
			</div>
			<div class="col-lg-6">
			  
				<div class="text-center" >
					<?php include("footer_ad.php"); ?>
					<div class="row text-white justify-content-center"><h2><?php echo homepage_tagline($pdo) ; ?></h2></div>
					<div class="row pic1"><?php echo random_two_image($pdo) ; ?></div>
					
					<div class="col-lg-12 text-muted mt-2"><small>Click on Image to Vote</small></div>
				</div>
			</div>
			<div class="col-lg-3">
				
			</div>
		</div>
	</div>
</div> 
<?php include("footer_index.php") ; ?> 
