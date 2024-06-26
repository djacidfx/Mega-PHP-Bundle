<?php include("header.php") ; ?>
<div class="app-title">
        <div>
          <h1><i class="fa fa-pencil-alt"></i> Anonymous Posts Category</h1>
		  <p class="text-success">Admin must have to choose category before Publishing a Blog.(Deactivating Category means All Blogs inside that category will be disabled & Hidden.)</p>
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
                                <button id="createCategory" class="btn btn-sm btn-success">+ Add Category</button>
							</div> <!-- /panel-heading -->
							<div class="panel-body mt-2">
								<div class="remove-messages"></div>
								<div class="row">
									<div class="col-md-12">
									  <div class="tile">
										<div class="tile-body">
											<div class="table-responsive">
												<table class="table table-bordered table-hover" id="manageCategoryTable">
													<thead>
														<tr>
															<th>S.No.</th>
															<th>Category ID</th>
															<th>Category Name</th>
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
	<!-- Category Modal -->
	<div id="catModal" class="modal fade" data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    		<form method="post" id="cat_form" class="cat_form">
    			<div class="modal-content">
    				<div class="modal-header">
						<h4 class="modal-title"><i class="fa fa-plus"></i> Add Category</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
    				</div>
    				<div class="modal-body">
						
						<div class="form-group">
							<label>Category Name* (Max 30 Characters)</label>
							<input type="text" class="form-control catName" id="catName" name="catName" autocomplete="off" required maxlength="30">
						</div>
    				</div> 
    				<div class="modal-footer"> 
						<input type="hidden" name="catId" class="catId" >
						<input type="hidden" name="btn_action" id="btn_action" />
    					<input type="submit" name="action_cat" id="action_cat" class="btn btn-info" value="Add Category" />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
<?php include("footer.php") ; ?>