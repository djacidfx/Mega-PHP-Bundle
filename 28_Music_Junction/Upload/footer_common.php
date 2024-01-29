<div class="container-fluid p-5" style="background:<?php echo $footerColor ; ?> ; color: <?php echo get_footerText_color($pdo)  ; ?> ;">
 	<div class="row">
		<div class="col-lg-4">
			<div class="col-lg-12">
				<h2><?php echo get_aboutus_name($pdo) ; ?></h2>
				<hr style="border: 1px solid <?php echo get_footerText_color($pdo)  ; ?> ; background:<?php echo $footerColor ; ?> ; color: <?php echo get_footerText_color($pdo)  ; ?> ;">
			</div>			
			<div class="col-lg-12">
			<p><?php echo nl2br(get_aboutus_info($pdo)) ; ?></p>
			</div>
		</div>
		<div class="col-lg-4">
				<div class="col-lg-12">
					<h2><?php echo get_linkname($pdo) ; ?></h2>
					<hr  style="border: 1px solid <?php echo get_footerText_color($pdo)  ; ?> ; background:<?php echo $footerColor ; ?> ; color: <?php echo get_footerText_color($pdo)  ; ?> ;">
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
					<h2>Follow Us</h2>
					<hr  style="border: 1px solid <?php echo get_footerText_color($pdo)  ; ?> ; background:<?php echo $footerColor ; ?> ; color: <?php echo get_footerText_color($pdo)  ; ?> ;">
			</div>
			<div class="col-lg-12">
				<?php echo get_insta_url($pdo).get_fb_url($pdo).get_twitter_url($pdo).get_linkedin_url($pdo).get_behance_url($pdo).get_dribble_url($pdo).get_vk_url($pdo) ; ?>
			</div>
		</div>
		<div class="col-lg-12 mt-5 p-2 text-center">
		<p>Copyright &copy; <?php echo date("Y"); ?>&ensp;<?php echo get_copyright_name($pdo) ; ?>. All Rights Reserved.</p>
		</div>
    </div>
</div>