<?php include("header.php") ; ?>

<div class="col-lg-12 mt-2">
    <div class="card  newShadow">
        <div class="card-header text-start">
            <h1><i class="bi bi-slash-circle-fill text-danger"></i> Blocked User IP <button class="openManualBlock ml-2 btn btn-sm btn-danger">+ Manual Block IP</button></h1>
        </div>
    </div>
</div>
<div class="col-lg-12 mt-4">
    <div class="remove-messages"></div>
    <div class="table-responsive bg-light p-3 text-start">
        <table class="table table-bordered table-hover table-light" id="manageBlockedTable">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Blocked IP</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table><!-- /table -->
    </div>
</div>

<div id="manualBlock" class="modal fade manualBlock">
	<div class="modal-dialog">
			<div class="modal-content ">
                <form method="post" class="blockManualIp">
                    <div class="modal-header customBottomBorder">
                        <h4 class="modal-title text-danger"><i class="bi bi-slash-circle-fill text-danger"></i> Block IP</h4>
                        <button type="button" class="close btn btn-grey btn-sm " data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-start">
                        <div class="form-group">
                            <label class="text-muted">User IP</label>
                            <input type="text" name="userip" minlength="7" maxlength="15" size="15" pattern="^((\d{1,2}|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d{1,2}|1\d\d|2[0-4]\d|25[0-5])$" class="form-control ">
                        </div>
                        <div class="form-group">
                            <div class="block-messages"></div>
                        </div>
                    </div>
                    <div class="modal-body text-end">
                        <input type="hidden" name="btn_action" value="blockUserManualIPAddress">
                        <button type="submit" class="btn btn-danger btn-md" id="action_log">Block IP</button>
                    </div>
                </form>
			</div>
	</div>
</div>
<?php include("footer.php") ; ?>