<?php include("header.php") ; ?>
<div class="app-title">
        <div>
          <h1><i class="fa fa-pencil-alt"></i> Anonymous Posts</h1>
		  <p class="text-success">It will show Only Active Post. (Note: If you want to deactive any Post just click Red Ban Button, Post will be inactive & saved into Deactive Post automatically.)</p>
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
                                <button id="add_pic" class="btn btn-sm btn-success">+ Add Official Image Post</button>
							</div> <!-- /panel-heading -->
							<div class="panel-body mt-2">
								<div class="remove-messages"></div>
								<div class="row">
									<div class="col-md-12">
									  <div class="tile">
										<div class="tile-body">
											<div class="table-responsive">
												<table class="table table-bordered table-hover" id="manageOfficialTable">
													<thead>
														<tr>
															<th>S.No.</th>
															<th>Post ID</th>
															<th>Post Title</th>
															<th>Image</th>
                                                            <th>Category</th>
															<th>Date</th>
															<th>Loved</th>
															<th>Liked</th>
															<th>View</th>
															<th>Status</th>
                                                            <th>Change Category</th>
                                                            <th>Edit Caption</th>
															<th>Replace Image</th>
															<th><i class="fa fa-ban"></i></th>
                                                            <th><i class="fa fa-trash"></i></th>
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
<!-- Picture Modal -->
	<div id="picModal" class="modal fade " data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    		<form action="<?php echo ADMIN_URL; ?>action_upload.php" method="post" id="uploadImage">
    			<div class="modal-content">
    				<div class="modal-header">
						<h4 class="modal-title"><i class='fa fa-image'></i> Add Photo</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
    				</div>
    				<div class="modal-body">
						<div class="row">
                            <div class="col-lg-12 col-md-12">
								<div class="form-group">
								<label>Caption* <small>(Max Length = 50)</small></label>
									<input type="text" name="caption" id="caption" class="form-control" maxlength="50" required/>
								</div>
							</div>
                            <div class="col-lg-12 col-md-12">
								<div class="form-group">
								<label>Select Category*</label>
									<select class="form-control" name="catId" id="catId" required>
                                        <?php echo active_category_select($pdo) ; ?>
                                    </select>
								</div>
							</div>
							<div class="col-lg-12 col-md-12">
								<div class="form-group">
                                    <label>Image* <small>(Only .jpeg, .jpg, & .png, 5 MB Allowed)</small></label>
                                    
                                      <input type="file" class="form-control" id="uploadFile" name="uploadFile" accept="image/x-png,image/jpeg" required>
                                      
								</div>
							</div>
							
                            
							<div class="col-lg-12 col-md-12">
								<div class="progress">
									<div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								<div id="targetLayer"></div>
							</div>
						</div>						
					</div>
					<div class="modal-footer">
    					<input type="submit" name="action_pic" id="action_pic" class="action_pic btn btn-success" value="Upload"  />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
	<!-- Replace Picture Modal -->
	<div id="replacepicModal" class="modal fade " data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    		<form action="<?php echo ADMIN_URL; ?>action_upload.php" method="post" id="uploadReplaceImage">
    			<div class="modal-content">
    				<div class="modal-header">
						<h4 class="modal-title"><i class='fa fa-pencil-alt'></i> Replace Photo </h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
    				</div>
    				<div class="modal-body">
						<div class="row">
                            
							<div class="col-lg-12 col-md-12">
								<div class="form-group">
									<label>Image* <small>(Only .jpeg, .jpg & .png , 5 MB Allowed)</small></label>
									<input type="file" name="uploadReplaceFile" id="uploadReplaceFile" class="form-control" required/>
								</div>
							</div>
							
							<div class="col-lg-12 col-md-12">
								<div class="progress">
									<div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
								</div>
								<div id="targetLayer"></div>
							</div>
						</div>						
					</div>
					<div class="modal-footer">
						<input type="hidden" name="postId" id="postId" >
    					<input type="submit" name="action_pic_replace" id="action_pic_replace" class="action_pic_replace btn btn-success" value="Replace"  />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
<!--Edit Caption Modal -->
	<div id="captionModal" class="modal fade " data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    		<form  method="post" id="captionForm">
    			<div class="modal-content">
    				<div class="modal-header">
						<h4 class="modal-title"><i class='fa fa-pencil-alt'></i> Edit Caption </h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
    				</div>
    				<div class="modal-body">
						<div class="row">
                            <div class="col-lg-12 col-md-12">
								<div class="form-group">
									<label>Caption* <small>(Max Length = 50)</small></label>
									<input type="text" name="caption" id="postTitle" class="form-control" required/>
								</div>
							</div>
						</div>						
					</div>
					<div class="modal-footer">
                        <input type="hidden" name="btn_action" value="EditCaption" >
						<input type="hidden" name="postId" id="postId" class="postId" >
    					<input type="submit" name="action_pic_replace" id="action_pic_replace" class="action_pic_replace btn btn-success" value="Replace"  />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
<!--Change Category Modal -->
	<div id="categoryModal" class="modal fade " data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    		<form  method="post" id="categoryForm">
    			<div class="modal-content">
    				<div class="modal-header">
						<h4 class="modal-title"><i class='fa fa-pencil-alt'></i> Change Category </h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
    				</div>
    				<div class="modal-body">
						<div class="row">
                            <div class="col-lg-12 col-md-12">
								<div class="form-group">
								<label>Change Category*</label>
									<select class="form-control" name="catId" id="catId" required>
                                        <option value="">Change to Desired Category</option>
                                        <?php echo active_category_select($pdo) ; ?>
                                    </select>
								</div>
							</div>
						</div>						
					</div>
					<div class="modal-footer">
                        <input type="hidden" name="btn_action" value="ChangeCategory" >
						<input type="hidden" name="postId" id="postId" class="postId" >
    					<input type="submit" name="action_pic_replace" id="action_pic_replace" class="action_pic_replace btn btn-success" value="Replace"  />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
<?php include("footer.php") ; ?>