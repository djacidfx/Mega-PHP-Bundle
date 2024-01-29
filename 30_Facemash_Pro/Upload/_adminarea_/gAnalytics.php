<?php include("header.php") ; ?>
<div class="container mar-top">
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="row">
				<div class="col-lg-3 col-md-3"></div>
				<div class="col-lg-6 col-md-6">
					<div class="card">
                		<div class="card-header bg-secondary text-white text-center"><h4> Google Analytics Settings</h4></div>
                		<div class="card-body">
							<form method="post" id="google_settings" class="google_settings">
								<div class="form-group">
									<label><i class="fab fa-google"></i>&ensp; Google Analytics Javascript Code </label>
									<textarea name="gCode" class="form-control" maxlength="1000" rows="10" required><?php echo ($gCode); ?></textarea>
									
								</div>
								<div class="form-group">
											<label>Turn On Analytics for User Pages* </label>
											<select name="userOn" class="form-control" required>
												<option value="1" <?php if($userOn == '1'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>Yes</option>
												<option value="0"<?php if($userOn == '0'){ echo $sub = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>No</option>
											</select>
								</div>
								<div class="form-group">
											<label>Turn On Analytics for Admin Pages* </label>
											<select name="adminOn" class="form-control" required>
												<option value="1" <?php if($adminOn == '1'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>Yes</option>
												<option value="0"<?php if($adminOn == '0'){ echo $sub = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>No</option>
											</select>
								</div>
								<div class="col-md-12 text-center">
									<div class="remove-messages"></div>
								<input type="hidden" name="google_submit_pr" value="Submit" />
								<input type="submit" id="google_submit" name="google_submit" class="btn btn-primary text-center form_submit" value="Update Analytics Settings" />
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