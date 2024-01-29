<div id="subscribeModal" class="modal fade subscribeModal " data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<form method="post" class="subscribe_form" id="uploadImage" action="<?php echo BASE_URL ; ?>action_upload.php">
			<div class="modal-content  bg-dark text-white">
				<div class="modal-header text-white">
					<h4 class="modal-title text-white"><i class="fa fa-user-secret"></i> Post Anything !</h4>
					<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group mb-3">
						<input type="text" name="caption" id="postTitle" class="form-control  bg-dark text-white border border-secondary rounded" placeholder="Post Title* [50 Character Maximum]" maxlength="50" required autocomplete="off"  autofocus>
						
					</div> 
					<div class="form-group mb-3">
					<label  class="text-white">Category*</label>
									<select class="form-control bg-dark text-white border border-secondary rounded" name="catId" id="catId" required>
                                        <?php echo active_category_select($pdo) ; ?>
                                    </select>
					</div>
                    <div class="form-group mb-3">
                        <label  class="text-white">Image* <small>(Only .jpeg, .jpg, & .png, 5 MB Allowed)</small></label>
                        <input type="file" class="form-control  bg-dark text-white border border-secondary rounded" id="uploadFile" name="uploadFile" accept="image/x-png,image/jpeg" required>
                    </div>
					<div class="form-group text-left">
						<label for="message" class="text-white"> Prove, You are Human*</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend  ">
								<div class="g-recaptcha" data-sitekey="<?php echo SITE_KEY ; ?>"></div>
							</div>
						</div>
					</div>
                    <div class="col-lg-12 col-md-12">
                        <div class="progress">
                            <div class="progress-bar"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div id="targetLayer"></div>
				    </div>
					<br>
					<div class="remove-messages"></div>
				</div> 
				<div class="modal-footer"> 
					<input type="hidden" name="btn_action_sb" id="btn_action_sb" value="Post" />
					<input type="submit" name="action_pic" id="action_pic" class="btn btn-warning" value="Post Now" />
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>
		</form>
	</div>
</div>
<div id="errorLike" class="modal fade errorLike">
	<div class="modal-dialog">
			<div class="modal-content  bg-dark text-white">
				<div class="modal-header text-white text-center">
					<h4 class="modal-title text-danger"><i class="fa fa-exclamation-circle text-danger"></i> Error</h4>
					<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-center">
				<h4 class="text-danger"><?php echo already_liked_message($pdo) ; ?></h4>
				</div>
				<div class="modal-footer text-center"> 
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
				</div>
			</div>
	</div>
</div>
<div id="errorLove" class="modal fade errorLove">
	<div class="modal-dialog">
			<div class="modal-content  bg-dark text-white">
				<div class="modal-header text-white">
					<h4 class="modal-title text-danger"><i class="fa fa-exclamation-circle text-danger"></i> Error</h4>
					<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-center">
				<h4 class="text-danger"><?php echo already_loved_message($pdo) ; ?></h4>
				</div>
				<div class="modal-footer"> 
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
				</div>
			</div>
	</div>
</div>
<div id="errorApprove" class="modal fade errorApprove">
	<div class="modal-dialog">
			<div class="modal-content  bg-dark text-white">
				<div class="modal-header text-white">
					<h4 class="modal-title text-danger"><i class="fa fa-exclamation-circle text-danger"></i> Message</h4>
					<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-center">
				<h4 class="text-danger"><?php echo approve_message($pdo) ; ?></h4>
				</div>
				<div class="modal-footer"> 
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
				</div>
			</div>
	</div>
</div>