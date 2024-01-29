<?php include("header.php") ; ?>
<div class="container mar-top">
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="row">
				<div class="col-lg-3 col-md-3"></div>
				<div class="col-lg-6 col-md-6">
					<div class="card">
                		<div class="card-header bg-secondary text-white text-center"><h4> Paypal Setup</h4></div>
                		<div class="card-body">
							<form method="post" id="paypal_settings" class="paypal_settings">
								<div class="form-group">
									<label><i class="fa fa-globe"></i> Paypal IPN* <small>(Read IPN Setup in Documentation)</small></label>
									<br />
									<small>Important : Copy below URL and set IPN in Paypal Business Account. It receives data from Paypal after successfull transaction and saves into your Database.</small>
									<br />
									<input type="text" class="form-control" value="<?php echo BASE_URL."verify_process.php" ; ?>" readonly="readonly" >
								</div>
								<div class="form-group">
									<label><i class="fa fa-globe"></i> Paypal Success URL* <small>(Read Success URL Setup in Documentation)</small></label>
									<small>Important :  Copy below URL and set Auto Return On with below URL & Payment Data Transfer On in Paypal Business Account. It receives data from Paypal after successful transaction and display Successful Transaction Message to Customer. </small>
									<input type="text" class="form-control" value="<?php echo BASE_URL."paypalSuccess/" ; ?>" readonly="readonly" >
								</div>
								<div class="form-group">
									<label><i class="fa fa-envelope"></i> Paypal Business Email</label>
									<input type="text" class="form-control" name="paypalEmail" id="paypalBusinessEmail" maxlength="500"  value="<?php echo $paypalEmail ; ?>"required>
								</div>
								
										
										<div class="form-group">
											<label>Accept Paypal Payment Turn On* </label>
											<select name="paypal_on" class="form-control" required>
												<option value="1" <?php if($paypalOn == '1'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>Yes</option>
												<option value="0"<?php if($paypalOn == '0'){ echo $sub = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>No</option>
											</select>
										</div>
								<div class="col-md-12 text-center">
									<div class="remove-messages"></div>
									<input type="hidden" name="paypal_submit_pr" value="Submit" />
									<input type="submit" id="paypal_submit" name="paypal_submit" class="btn btn-primary text-center form_submit" value="Update Paypal Settings" />
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