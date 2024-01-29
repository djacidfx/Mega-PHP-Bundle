<?php include("header.php") ; ?>
<div class="container mar-top">
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="row">
				<div class="col-lg-3 col-md-3"></div>
				<div class="col-lg-6 col-md-6">
					<div class="card">
                		<div class="card-header bg-secondary text-white text-center"><h4> Message Template Settings</h4></div>
                		<div class="card-body">
							<form method="post" id="msg_settings" class="msg_settings">
								<div class="form-group">
									<label><i class="fa fa-comment"></i>&ensp; Already Liked Message </label>
									<input type="text" name="alreadyLiked" class="form-control" maxlength="200" required autocomplete="off" value="<?php echo $alreadyLike ; ?>">
									
								</div>
								<div class="form-group">
									<label><i class="fa fa-comment"></i>&ensp; Already Loved Message </label>
									<input type="text" name="alreadyLoved" class="form-control" maxlength="200" required autocomplete="off" value="<?php echo $alreadyLoved ; ?>">
									
								</div>
								<div class="col-md-12 text-center">
									<div class="remove-messages"></div>
								<input type="hidden" name="msg_submit_pr" value="Submit" />
								<input type="submit" id="msg_submit" name="msg_submit" class="btn btn-primary text-center form_submit" value="Update Message Settings" />
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