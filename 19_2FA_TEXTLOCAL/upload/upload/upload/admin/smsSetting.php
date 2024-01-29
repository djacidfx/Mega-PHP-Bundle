<?php 
require_once('header.php');
?>
<div class="app-title">
        <div>
          <h1><i class="fa fa-key"></i> SMS Gateway Setup</h1>
		  <p class="text-success">This form required TextLocal Api Key & TextLocal SenderID, After saving It enables SMS OTP for Users.</p>
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
                		<div class="card-header bg-secondary text-white text-center"><h4> TextLocal Setup</h4></div>
                		<div class="card-body">
							<div class="remove-smsmessages"></div>
							<form class="verifyClickatell" method="post" >
					  		<div class="form-group">
								<label>TextLocal API Key*</label>
								<input type="text" class="form-control"  value="<?php echo $sms_apikey ; ?>" name="Api" id="Api" maxlength="200" required  >
					  		</div>
							<div class="form-group">
								<label>TextLocal Sender ID* (e.g. TXTLCL or YOUR_SENDER_ID)</label>
								<input type="text" class="form-control"  value="<?php echo $sms_senderid ; ?>" name="senderid" id="senderid" maxlength="100" required >
					  		</div>
							
					  		<div class="form-group text-center">
					  			<input type="submit" class="btn btn-primary" name="submit" value="Save Settings">
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
<?php require_once('footer.php'); ?>