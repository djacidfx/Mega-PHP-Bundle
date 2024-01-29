<?php include("header.php") ; ?>

<div class="app-title">
        <div>
          <h1><i class="fa fa-globe"></i> Paypal Auto Return to your Website</h1>
          <p>Important : Copy below URL and set Auto Return On with below URL & Payment Data Transfer On in Paypal Business Account. <br>It receives data from Paypal after successfull transaction and display Successfull Transaction Message to Customer. </p>
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
                		<div class="card-header bg-secondary text-white text-center"><h4>Paypal Success URL</h4></div>
                		<div class="card-body">
							<div class="form-group">
								<label for="useroldpass"><i class="fa fa-key"></i> Copy and Paste in Paypal Auto Return URL <a href="https://www.paypal.com/businessmanage/preferences/website" target="_blank"> Click Me for Paypal Auto Return URL</a></label>
								<input type="text" class="form-control" value="<?php echo BASE_URL."paySuccess.php" ; ?>" readonly="readonly" >
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