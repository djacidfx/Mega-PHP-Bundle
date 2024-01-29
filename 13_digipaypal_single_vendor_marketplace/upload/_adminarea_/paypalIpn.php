<?php include("header.php") ; ?>

<div class="app-title">
        <div>
          <h1><i class="fa fa-globe"></i> Paypal IPN (Instant Payment Notifications)</h1>
          <p>Important : Copy below URL and set IPN in Paypal Business Account. It receives data from Paypal after successfull transaction and saves into your Database. </p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
        </ul>
 </div>
 
 <div class="container mar-top">
	<div class="row">
		<div class="col-lg-12 col-md-12">
			<div class="row">
				<div class="col-lg-3 col-md-3"></div>
				<div class="col-lg-6 col-md-6">
					<div class="card">
                		<div class="card-header bg-secondary text-white text-center"><h4>Paypal IPN URL</h4></div>
                		<div class="card-body">
							<div class="form-group">
								<label for="useroldpass"><i class="fa fa-key"></i> Copy and Paste in Paypal IPN URL <a href="https://www.paypal.com/cgi-bin/customerprofileweb?cmd=_profile-ipn-notify" target="_blank"> Click Me for Paypal IPN URL</a></label>
								<input type="text" class="form-control" value="<?php echo BASE_URL."verify_process.php" ; ?>" readonly="readonly" >
							</div>
						</div>
           			 </div>
				</div>
				<div class="col-lg-3 col-md-3"></div>
			</div>
		</div>
	</div>
</div>
 
<?php include("footer.php") ; ?>