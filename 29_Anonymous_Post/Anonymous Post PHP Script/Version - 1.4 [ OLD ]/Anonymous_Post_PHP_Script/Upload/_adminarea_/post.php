<?php include("header.php") ; ?>
<div class="container mar-top">
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="row">
				<div class="col-lg-3 col-md-3"></div>
				<div class="col-lg-6 col-md-6">
					<div class="card">
                		<div class="card-header bg-secondary text-white text-center"><h4> Post Settings</h4></div>
                		<div class="card-body">
							<form method="post" id="post_settings" class="post_settings">
								<div class="form-group">
											<label>Auto Approve User Anonymous Post* </label>
											<select name="anony" class="form-control" required>
												<option value="1" <?php if($anony == '1'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>Yes</option>
												<option value="0"<?php if($anony == '0'){ echo $sub = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>No</option>
											</select>
								</div>
								<div class="form-group">
									<label>Post Title Character Limit* <small>(From 1-80 due to Twitter wordlimit)</small></label>
									<input type="number" min="1" max="80" required name="titleLimit" value="<?php echo $titleLimit ; ?>"  class="form-control" >
								</div>
								<div class="form-group">
									<label>Post Description Character Limit* </label>
									<input type="number" min="1" required name="descriptionLimit" value="<?php echo $descriptionLimit ; ?>" class="form-control" >
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