<?php include("header.php") ; ?>
<div class="container mar-top">
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="row">
				<div class="col-lg-3 col-md-3"></div>
				<div class="col-lg-6 col-md-6">
					<div class="card">
                		<div class="card-header bg-secondary text-white text-center"><h4> User Panel Settings</h4></div>
                		<div class="card-body">
							<form method="post" id="color_settings" class="color_settings">
								<div class="form-group">
									<label>Header Background Hex Color* <small>(Example - #1DA1F2)</small></label>
									<input type="text" class="form-control" name="headerColor" maxlength="7"  value="<?php echo $headerColor ; ?>" required>
								</div>
								<div class="form-group">
									<label>Footer Background Hex Color* <small>(Example - #000000)</small></label>
									<input type="text" class="form-control" name="footerColor" maxlength="7"  value="<?php echo $footerColor ; ?>" required>
								</div>
								<div class="form-group">
									<label>Footer Text Hex Color* <small>(Example - #FFFFFF)</small></label>
									<input type="text" class="form-control" name="footerText" maxlength="7"  value="<?php echo $footerTextColor ; ?>" required>
								</div>
								
								<div class="col-md-12 text-center">
									<div class="remove-messages"></div>
								<input type="hidden" name="color_submit_pr" value="Submit" />
								<input type="submit" id="color_submit" name="color_submit" class="btn btn-primary text-center form_submit" value="Update Color Setting" />
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