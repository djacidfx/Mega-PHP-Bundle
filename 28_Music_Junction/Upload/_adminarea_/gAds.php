<?php include("header.php") ; ?>
<div class="container mar-top">
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="row">
				<div class="col-lg-3 col-md-3"></div>
				<div class="col-lg-6 col-md-6">
					<div class="card">
                		<div class="card-header bg-secondary text-white text-center"><h4> Adsense Settings</h4></div>
                		<div class="card-body">
							<form method="post" id="ad_settings" class="ad_settings">
								<div class="form-group">
									<label><i class="fab fa-buysellads"></i>&ensp; 728 x 90 Pixel Ad Javascript Code </label>
									<textarea name="adCode" class="form-control" maxlength="1000" rows="10" required><?php echo ($adCode); ?></textarea>
									
								</div>
								<div class="form-group">
											<label>Turn On Ad on User Pages* </label>
											<select name="adOn" class="form-control" required>
												<option value="1" <?php if($adOn == '1'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>Yes</option>
												<option value="0"<?php if($adOn == '0'){ echo $sub = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>No</option>
											</select>
								</div>
								<div class="col-md-12 text-center">
									<div class="remove-messages"></div>
								<input type="hidden" name="ad_submit_pr" value="Submit" />
								<input type="submit" id="ad_submit" name="ad_submit" class="btn btn-primary text-center form_submit" value="Update Ad Settings" />
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