
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