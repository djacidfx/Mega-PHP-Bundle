<?php include("header.php") ; ?>

<div class="app-title">
        <div>
          <h1><i class="fa fa-check-square text-success"></i> Success Message</h1>
          <p>This is the success message which you want to show after Successfull Transaction.</p>
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
                		<div class="card-header bg-secondary text-white text-center"><h4>Success Message</h4></div>
                		<div class="card-body">
						<form method="post" class="msgForm">
							<div class="form-group">
								<label for="useroldpass"><i class="fa fa-comment"></i> Message which you want to show your Customer after Successfull Transaction.</label>
								<input type="text" name="successmsg" id="successmsg" class="form-control" value="<?php echo $success_message ; ?>"  maxlength="100" >
								<div class="col-lg-12 text-center mt-2">
								<div class="remove-messages"></div>
								<input type="hidden" name="btn-action" value="msg">
								<input type="submit" class="btn btn-sm btn-primary" value="Save Message">
								</div>
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