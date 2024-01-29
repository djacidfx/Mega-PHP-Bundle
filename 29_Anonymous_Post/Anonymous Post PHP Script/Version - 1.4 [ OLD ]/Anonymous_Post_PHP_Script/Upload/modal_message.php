<div id="subscribeModal" class="modal fade subscribeModal " data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<form method="post" class="subscribe_form">
			<div class="modal-content  bg-dark text-white">
				<div class="modal-header text-white">
					<h4 class="modal-title text-white"><i class="fa fa-user-secret"></i> Post Anything !</h4>
					<button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="form-group mb-3">
						<input type="text" name="postTitle" id="postTitle" class="form-control  bg-dark text-white border border-secondary rounded postTitle" placeholder="Post Title* [<?php echo title_limit($pdo) ; ?> Character Maximum]" maxlength="<?php echo title_limit($pdo) ; ?>" required autocomplete="off"  autofocus>
						
					</div> 
					<div class="form-group mb-3">
					<textarea name="postDescription" class="form-control bg-dark text-white border-secondary rounded postDescription" rows="6" placeholder="Post Description* [<?php echo description_limit($pdo) ; ?> Character Maximum]" maxlength="<?php echo description_limit($pdo) ; ?>"></textarea>
					</div>
					<div class="form-group text-left">
						<label for="message" class="text-white"> Prove, You are Human*</label>
						<div class="input-group mb-3">
                            <div class="g-recaptcha" data-sitekey="<?php echo SITE_KEY ; ?>"></div>
						</div>
					</div>
					<br>
					<div class="remove-messages"></div>
				</div> 
				<div class="modal-footer"> 
					<input type="hidden" name="btn_action_sb" id="btn_action_sb" value="Post" />
					<input type="submit" name="action_sb" id="action_sb" class="btn btn-warning" value="Post Now" />
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