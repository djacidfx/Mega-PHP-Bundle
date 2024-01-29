<div class="container-fluid p-5 bg-dark text-white">
 	<div class="row">
		<div class="col-lg-4">
			<div class="col-lg-12">
				<h2><?php echo get_aboutus_name($pdo) ; ?></h2>
				<hr class="border border-muted border-top-0 border-right-0 border-left-0">
			</div>			
			<div class="col-lg-12">
			<p><?php echo nl2br(get_aboutus_info($pdo)) ; ?></p>
			</div>
		</div>
		<div class="col-lg-4">
				<div class="col-lg-12">
					<h2><?php echo get_linkname($pdo) ; ?></h2>
					<hr class="border border-muted border-top-0 border-right-0 border-left-0">
				</div>
				<?php 
					$checkSlug = check_slug_for_user($pdo) ;
					if($checkSlug > '0') {
				?>
					<div class="col-lg-12">
						<?php echo fetch_active_pages_foruser($pdo) ; ?>
					</div>
				<?php
					}
				?>
		</div>  
		<div class="col-lg-4">
			<div class="col-lg-12">
					<h2><i class="fa fa-lock text-warning"></i>&ensp;Secured Checkout</h2>
					<hr class="border border-muted border-top-0 border-right-0 border-left-0">
			</div>
			<div class="col-lg-12">
				<img src="<?php echo BASE_URL."img/card_image.png" ; ?>" class="img-fluid" >
			</div>
		</div>
		<div class="col-lg-12 mt-5 p-2 text-center">
		<p>
		<?php echo get_fb_url($pdo).get_twitter_url($pdo).get_linkedin_url($pdo).get_behance_url($pdo).get_dribble_url($pdo).get_vk_url($pdo) ; ?>
		</p>
		<p>Copyright &copy; <?php echo date("Y"); ?>&ensp;<?php echo get_copyright_name($pdo) ; ?>. All Rights Reserved.</p>
		</div>
    </div>
</div>