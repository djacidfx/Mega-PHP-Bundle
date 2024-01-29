<?php include("header.php") ; ?>
<div class="container mar-top">
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="row">
				<div class="col-lg-3 col-md-3"></div>
				<div class="col-lg-6 col-md-6">
					<div class="card">
                		<div class="card-header bg-secondary text-white text-center"><h4> Settings</h4></div>
                		<div class="card-body">
							<form method="post" id="admin_settings" class="admin_settings">
								<div class="form-group">
									<label> Admin Name* <small>(Label of Email Inbox, Keep it shorter Just Like Facebook or CodeDaddy)</small></label>
									<input type="text" class="form-control" name="adminName" id="adminName" maxlength="25"  value="<?php echo $adminName ; ?>"required>
								</div>
								<div class="form-group">
									<label> Quick Link Name* <small>(Shows in Footer, Example- Quick Links, Pages, Important Link, etc.)</small></label>
									<input type="text" class="form-control" name="quickLinkName" id="quickLinkName" maxlength="20"  value="<?php echo $linkName ; ?>"required>
								</div>
								<div class="form-group">
									<label> About Us Name* <small>(Shows in Footer, Example- About Us, Who Are We ?, etc.)</small></label>
									<input type="text" class="form-control" name="aboutusName" id="aboutusName" maxlength="25"  value="<?php echo $aboutUsName ; ?>"required>
								</div>
								<div class="form-group">
									<label> About Us Info* <small>(Shows in Footer, Example- Company Short Description 200 Character.)</small></label>
									<textarea name="aboutUsInfo" class="form-control" maxlength="200" required><?php echo ($aboutUsInfo); ?></textarea>
								</div>
								<div class="form-group">
									<label> Copyright Name* <small>(Shows in Footer, Example- Company Name etc.)</small></label>
									<input type="text" class="form-control" name="copyrightName" id="copyrightName" maxlength="50"  value="<?php echo $copyrightName ; ?>"required>
								</div>
								
								
										<div class="form-group">
											<label>Default Load*<small>(Means No. of Blogs shows on Deafault)</small> </label>
											<select name="default_load" class="form-control" required>
												<option value="3" <?php if($defaultLoad == '3'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>3</option>
												<option value="6" <?php if($defaultLoad == '6'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>6</option>
												<option value="9" <?php if($defaultLoad == '9'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>9</option>
												<option value="12" <?php if($defaultLoad == '12'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>12</option>
												<option value="15" <?php if($defaultLoad == '15'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>15</option>
											</select>
										</div>
										<div class="form-group">
											<label>On Load*<small>(Means No. of Blogs shows on When Load More Button Press)</small> </label>
											<select name="on_load" class="form-control" required>
												<option value="3" <?php if($onLoad == '3'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>3</option>
												<option value="6" <?php if($onLoad == '6'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>6</option>
												<option value="9" <?php if($onLoad == '9'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>9</option>
												<option value="12" <?php if($onLoad == '12'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>12</option>
												<option value="15" <?php if($onLoad == '15'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>15</option>
											</select>
										</div>
								<div class="col-md-12 text-center">
									<div class="remove-messages"></div>
								<input type="hidden" name="uid" value="<?php echo $id ; ?>">
								<input type="hidden" name="sub_submit_pr" value="Submit" />
								<input type="submit" id="sub_submit" name="sub_submit" class="btn btn-primary text-center form_submit" value="Update Settings" />
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