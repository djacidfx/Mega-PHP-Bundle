<?php include("header.php") ; ?>
<div class="app-title">
        <div>
          <h1><i class="fa fa-times"></i> Deactive Images</h1>
		  <p class="text-danger">It will show Only Deactive Image. (Note: If you want to Activate any Image just click Green Button, Image will be Active & saved into Activae Image & Live for Users.)</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?php echo ADMIN_URL ; ?>dashboard.php">Dashboard</a></li>
        </ul>
 </div>
 <div class="container-fluid">
      	<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="row">
		   			<div class="col-md-12 col-lg-12">
						<div class="panel panel-default">
							<div class="panel-heading">
							<small>Click on the Image to View, Click on Up/Down Arrow to arrange Most / Least Win or Most / Least Point on the Won & Points column.</small>
							</div> <!-- /panel-heading -->
							<div class="panel-body">
								<div class="remove-messages"></div>
								<div class="row">
									<div class="col-md-12">
									  <div class="tile">
										<div class="tile-body">
											<div class="table-responsive">
												<table class="table table-bordered table-hover" id="manageDraftItemsTable">
													<thead>
														<tr>
															<th>S.No.</th>
															<th>Image ID</th>
															<th>Thumbnail</th>
															<th>Caption</th>
															<th>Points</th>		
															<th>Won</th>
															<th>Date</th>
															<th>Status</th>
															<th><i class="fa fa-pencil-alt"></i></th>
															<th><i class="fa fa-ban"></i></th>
														</tr>
													</thead>
												</table><!-- /table -->
								</div>
										</div>
									  </div>
									</div>
								</div>
							</div> <!-- /panel-body -->
					</div> <!-- /panel -->	
					</div>
				</div>
			</div>
		</div>
	</div>
<?php include("footer.php") ; ?>