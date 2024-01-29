<?php 
include("header.php") ; 
$search = filter_var($_GET['search_keyword'], FILTER_SANITIZE_STRING) ;
?>
<div class="page-content d-flex align-items-stretch minH mt-5">
	<div class="content-inner w-100 mt-5">
		<!--***** Music *****-->  
		<div class="row mt-5">
			<div class="col-lg-3"></div>
			<div class="col-lg-6 p-0">
				<div class="row mt-5" >
					<ul class="pointerCursor w-100 mt-4"><?php include("footer_ad.php") ; ?>
					</ul>
					<ul class="list-group pointerCursor w-100 mt-4 jQueryNewMusic playlist" id="playlist">
						<?php echo fetch_searchallmusic_foruser($pdo,$search) ; ?>
					</ul>
				</div>
			</div>
			<div class="col-lg-3"></div>
		</div>
	</div>
</div> 

<?php include("footer.php") ; ?>
<script type="text/javascript" src="<?php echo BASE_URL ; ?>js/audio-player-new.js"></script>