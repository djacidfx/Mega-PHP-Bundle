<?php include("header.php") ; ?>
<div class="container mar-top">
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="row">
				<div class="col-lg-3 col-md-3"></div>
				<div class="col-lg-6 col-md-6">
					<div class="card">
                		<div class="card-header bg-secondary text-white text-center"><h4> Social Network Settings</h4></div>
                		<div class="card-body">
							<form method="post" id="social_settings" class="social_settings">
								<div class="form-group">
									<label><i class="fab fa-instagram"></i>&ensp; Instagram Profile URL </label>
									<input type="url" class="form-control" name="instaUrl" maxlength="300"  value="<?php echo $instaUrl ; ?>">
								</div>
								<div class="form-group">
									<label><i class="fab fa-facebook-square"></i>&ensp; Facebook Public Profile URL </label>
									<input type="url" class="form-control" name="fbUrl" maxlength="300"  value="<?php echo $fbUrl ; ?>">
								</div>
								<div class="form-group">
									<label><i class="fab fa-twitter-square"></i>&ensp; Twitter Public Profile URL </label>
									<input type="url" class="form-control" name="twitterUrl" maxlength="300"  value="<?php echo $twitterUrl ; ?>">
								</div>
								<div class="form-group">
									<label><i class="fab fa-linkedin-in"></i>&ensp; Linkedin Public Profile URL </label>
									<input type="url" class="form-control" name="linkedinUrl" maxlength="300"  value="<?php echo $linkedinUrl ; ?>">
								</div>
								<div class="form-group">
									<label><i class="fab fa-behance"></i>&ensp; Behance Public Profile URL </label>
									<input type="url" class="form-control" name="behanceUrl" maxlength="300"  value="<?php echo $behanceUrl ; ?>">
								</div>
								<div class="form-group">
									<label><i class="fab fa-dribbble"></i>&ensp; Dribbble Public Profile URL </label>
									<input type="url" class="form-control" name="dribbleUrl" maxlength="300"  value="<?php echo $dribbleUrl ; ?>">
								</div>
								<div class="form-group">
									<label><i class="fab fa-vk"></i>&ensp; VK Public Profile URL </label>
									<input type="url" class="form-control" name="vkUrl" maxlength="300"  value="<?php echo $vkUrl ; ?>">
								</div>
								<div class="col-md-12 text-center">
									<div class="remove-messages"></div>
								<input type="hidden" name="social_submit_pr" value="Submit" />
								<input type="submit" id="social_submit" name="social_submit" class="btn btn-primary text-center form_submit" value="Update Social Network" />
								</div>
							</form>
						</div>
						</div>
				</div>
				<div class="col-lg-3 col-md-3"></div>
			</div>
		</div>
	</div>
</div>
<?php include("footer.php") ; ?>