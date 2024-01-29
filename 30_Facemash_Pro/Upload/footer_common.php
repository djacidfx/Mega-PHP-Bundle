<div class="container-fluid footer-shadow p-3 bg-dark "  >

 	<div class="row">
		<div class="col-lg-4">
			<div class="col-lg-12">
				<h2><?php echo get_aboutus_name($pdo) ; ?></h2>
				<hr class="border border-secondary border-right-0 border-bottom-0 border-left-0 text-white">
			</div>			
			<div class="col-lg-12">
			<p><?php echo nl2br(get_aboutus_info($pdo)) ; ?></p>
			</div>
		</div>
		<div class="col-lg-4">
				<div class="col-lg-12">
					<h2><?php echo get_linkname($pdo) ; ?></h2>
					<hr class="border border-secondary border-right-0 border-bottom-0 border-left-0 text-white">
				</div>
				<?php 
					$checkSlug = check_slug_for_user($pdo) ;
					if($checkSlug > '0') {
				?>
					<div class="col-lg-12">
						<p><?php echo fetch_active_pages_foruser($pdo) ; ?></p>
					</div>
				<?php
					}
				?>
		</div>  
		<div class="col-lg-4">
			<div class="col-lg-12">
					<h2>Follow Us</h2>
					<hr class="border border-secondary border-right-0 border-bottom-0 border-left-0 text-white">
			</div>
			<div class="col-lg-12">
				<?php echo get_insta_url($pdo).get_fb_url($pdo).get_twitter_url($pdo).get_linkedin_url($pdo).get_behance_url($pdo).get_dribble_url($pdo).get_vk_url($pdo) ; ?>
			</div>
		</div>
		<div class="col-lg-12 mt-2 p-3 text-center">
		<p>Copyright &copy; <?php echo date("Y"); ?>&ensp;<?php echo get_copyright_name($pdo) ; ?>. All Rights Reserved.</p>
		</div>
    </div>
</div>