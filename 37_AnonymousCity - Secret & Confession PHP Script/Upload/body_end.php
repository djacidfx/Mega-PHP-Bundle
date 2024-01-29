<div class="col-lg-9 offset-md-3 justify-content-center text-center p-2 customTopBorder mt-1">
    <div class="row">
        <div class="col-lg-12 mt-3 p-md-3 pt-md-0">
            <h4 class="text-muted"><?php echo nl2br(about_us($pdo)) ; ?></h4>
        </div>
        <div class="col-lg-12 p-md-3 pt-md-0">
            <small class="text-white">Copyright &copy; <?php echo date("Y"); ?>&ensp;<?php echo copyright_name($pdo) ; ?>. All Rights Reserved.</small>
        </div>
    </div>
</div>

</div>
</div>
    <!-- Modal -->
<div id="errorLove" class="modal fade errorLove">
	<div class="modal-dialog">
			<div class="modal-content  bg-dark">
				<div class="modal-header customBottomBorder">
					<h4 class="modal-title text-danger"><i class="bi bi-exclamation-circle text-danger"></i> Error</h4>
					<button type="button" class="close btn btn-grey btn-sm " data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-center">
				<h4 class="text-danger"><?php echo already_loved_message($pdo) ; ?></h4>
				</div>
			</div>
	</div>
</div>
<div id="shareSecret" class="modal fade shareSecret">
	<div class="modal-dialog">
			<div class="modal-content  bg-dark secBody newShadow"></div>
	</div>
</div>

<div id="errorLove" class="modal fade errorPostLove">
	<div class="modal-dialog">
			<div class="modal-content  bg-dark">
				<div class="modal-header customBottomBorder">
					<h4 class="modal-title text-danger"><i class="bi bi-exclamation-circle text-danger"></i> Error</h4>
					<button type="button" class="close btn btn-grey btn-sm " data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body text-center">
				<h4 class="text-danger"><?php echo already_loved_message($pdo) ; ?></h4>
				</div>
			</div>
	</div>
</div>
<div id="sharePostSecret" class="modal fade sharePostSecret">
	<div class="modal-dialog">
			<div class="modal-content  bg-dark secPostBody newShadow"></div>
	</div>
</div>

<div id="manualSearch" class="modal fade manualSearch">
	<div class="modal-dialog">
			<div class="modal-content  bg-dark">
                <form method="post" class="searchPost">
                    <div class="modal-header customBottomBorder">
                        <h4 class="modal-title text-danger"><i class="bi bi-search text-warning"></i> Search Anonymous Secret / Confession</h4>
                        <button type="button" class="close btn btn-grey btn-sm " data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-start">
                        <div class="form-group">
                            <input required type="text" name="search_keyword" class="customBorder form-control bg-dark text-white" maxlength="100" placeholder="Search Anonymous Things ..." <?php if(isset($search)) { ?> value="<?php echo $search ; ?>" <?php } ?> >
                        </div>
                        <div class="form-group">
                            <div class="search-messages"></div>
                        </div>
                    </div>
                    <div class="modal-body text-end">
                        <input type="hidden" name="btn_action" value="manualUserSearch">
                        <button type="submit" class="btn btn-grey btn-md" id="action_log">Search</button>
                    </div>
                </form>
			</div>
	</div>
</div>
    <?php if(analytics_user_status($pdo) == '1') { echo analytics_code($pdo) ; } ?>
    <script src="<?php echo BASE_URL ; ?>js/jquery.min.js" ></script>
    <script src="<?php echo BASE_URL ; ?>js/popper.min.js" ></script>
    <script src="<?php echo BASE_URL ; ?>js/bootstrap.min.js"></script>	 
    <script type="text/javascript" src="<?php echo BASE_URL ; ?>js/custom.js" ></script>
    <script src="<?php echo BASE_URL ; ?>tinymce/tinymce.min.js"></script>
    <script src="<?php echo BASE_URL ; ?>js/tinymce_editor.js"></script>
</body>
</html>