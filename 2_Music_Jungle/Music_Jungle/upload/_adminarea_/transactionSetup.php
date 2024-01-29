<?php include("header.php") ; ?>
<div class="container mar-top">
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="row">
				<div class="col-lg-3 col-md-3"></div>
				<div class="col-lg-6 col-md-6">
					<div class="card">
                		<div class="card-header bg-secondary text-white text-center"><h4> Transaction Fee Setup</h4></div>
                		<div class="card-body">
							<form method="post" id="transaction_fee_settings" class="transaction_fee_settings">
								<div class="form-group">
									<label><i class="fa fa-money-bill"></i> Transaction Fee* (USD $)</label>
									<input type="number" class="form-control" name="transactionFee" id="transactionFee" min="0"  value="<?php echo $transactionFee ; ?>"required>
								</div>
								<div class="col-md-12 text-center">
									<div class="remove-messages"></div>
								<input type="hidden" name="transaction_submit_pr" value="Submit" />
								<input type="submit" id="transaction_submit" name="transaction_submit" class="btn btn-primary text-center form_submit" value="Update Transaction Fee" />
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