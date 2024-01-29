<?php include("header.php") ; ?>
<div class="container mar-top">
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="row">
				<div class="col-lg-3 col-md-3"></div>
				<div class="col-lg-6 col-md-6">
					<div class="card">
                		<div class="card-header bg-secondary text-white text-center"><h4> Stripe Setup</h4></div>
                		<div class="card-body">
							<form method="post" id="stripe_settings" class="stripe_settings">
								<div class="form-group">
									<label><i class="fa fa-key"></i> Stripe Publishable Key* (Example - pk_live_ajsjd384jd0naj)</label>
									<input type="text" class="form-control" name="stripePubKey" id="stripePubKey" maxlength="500"  value="<?php echo $stripePubKey ; ?>"required>
								</div>
								<div class="form-group">
									<label><i class="fa fa-key"></i> Stripe Secret Key* (Example - sk_live_ajsjd384jd0naj)</label>
									<input type="text" class="form-control" name="stripeSecKey" id="stripeSecKey" maxlength="500"  value="<?php echo $stripeSecKey ; ?>"required>
								</div>
								
										
										<div class="form-group">
											<label>Accept Stripe Payment Turn On* </label>
											<select name="stripe_on" class="form-control" required>
												<option value="1" <?php if($stripeOn == '1'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>Yes</option>
												<option value="0"<?php if($stripeOn == '0'){ echo $sub = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>No</option>
											</select>
										</div>
								<div class="col-md-12 text-center">
									<div class="remove-messages"></div>
									<input type="hidden" name="stripe_submit_pr" value="Submit" />
									<input type="submit" id="stripe_submit" name="stripe_submit" class="btn btn-primary text-center form_submit" value="Update Stripe Settings" />
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