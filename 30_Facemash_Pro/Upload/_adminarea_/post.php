<?php include("header.php") ; ?>
<div class="container mar-top">
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="row">
				<div class="col-lg-3 col-md-3"></div>
				<div class="col-lg-6 col-md-6">
					<div class="card">
                		<div class="card-header bg-secondary text-white text-center"><h4> Image Settings</h4></div>
                		<div class="card-body">
							<form method="post" id="post_settings" class="post_settings">
								<div class="form-group">
											<label>Points You Give to Image when User Clicks*<small>(Play with Points - Min = 1 & Max = 100)</small> </label>
											<input type="number" min="1" max="100" required name="point" value="<?php echo $points ; ?>"  class="form-control" >
								</div>
								<div class="form-group">
									<label>Index Page Tagline* <small>(Max - 50 Character)</small></label>
									<input type="text" maxlength="50" required name="titleName" value="<?php echo $titleName ; ?>"  class="form-control" >
								</div>
								
								<div class="col-md-12 text-center">
									<div class="remove-messages"></div>
								<input type="hidden" name="post_submit_pr" value="Submit" />
								<input type="submit" id="post_submit" name="post_submit" class="btn btn-primary text-center form_submit" value="Update Post Settings" />
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