<?php include("header.php") ; ?>
<div class="app-title">
        <div>
          <h1><i class="fa fa-pencil-alt"></i> Featured Anonymous Posts</h1>
		  <p class="text-success">It will show Only Featured Post.</p>
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
							</div> <!-- /panel-heading -->
							<div class="panel-body">
								<div class="remove-messages"></div>
								<div class="row">
									<div class="col-md-12">
									  <div class="tile">
										<div class="tile-body">
											<div class="table-responsive">
												<table class="table table-bordered table-hover" id="manageFeaturedTable">
													<thead>
														<tr>
															<th>S.No.</th>
															<th>Post ID</th>
															<th>Post Title</th>
															<th>Post Description</th>		
															<th>Date</th>
															<th>Loved</th>
															<th>Liked</th>
															<th>View</th>
															<th>Status</th>
															<th><i class="fa fa-star"></i></th>
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
	<!-- Edit Post Modal -->
	<div id="postModal" class="modal fade" data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    		<form method="post" id="post_form" class="post_form">
    			<div class="modal-content">
    				<div class="modal-header">
						<h4 class="modal-title"><i class="fa fa-pencil-alt"></i> Edit Post</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
    				</div>
    				<div class="modal-body">
						
						<div class="form-group">
							<label>Post Title* (Max 50 Characters)</label>
							<input type="text" class="form-control postTitle" id="postTitle" name="postTitle" autocomplete="off" required maxlength="50">
						</div>
						<div class="form-group">
							<label>Post Description* (Max 300 Characters)</label>
							<textarea rows="6" class="form-control postDescription" name="postDescription" maxlength="300" required></textarea>
						</div>
    				</div> 
    				<div class="modal-footer"> 
						<input type="hidden" name="postId" class="postId" >
						<input type="hidden" name="btn_action" id="btn_action" />
    					<input type="submit" name="action_post" id="action_post" class="btn btn-info" value="Edit Post" />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
<?php include("footer.php") ; ?>