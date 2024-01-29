<?php
include("db.php") ;
include("head.php") ;
include("header.php") ;
include("body.php") ;
check_admin_logged_in($pdo);
?>
<div class="row mt-2">
    <div class="col-lg-1"></div> 
    <div class="col-lg-10 <?php echo colormode('default_text') ; ?> ">
        <div class="row p-0">
            <div class="col-lg-12 mb-3 ">
                <h1 class="text-muted text-center"> <i class="bi bi-eye-slash text-danger"></i> <?php echo userlang('total_unreadprivate_note') ; ?></h1>
            </div>
            <div class="table-responsive p-3 <?php echo colormode('bg_color') ; ?> rounded newShadow">
                <div class="remove-messages <?php echo colormode('default_text') ; ?>"></div>
                <table class="table table-bordered <?php echo colormode('tbl_dark') ; ?> table-hover cell-border manage_unreadNotesTable" >
                    <thead>
                        <tr>
                            <th><?php echo userlang('serial_number') ; ?></th>
                            <th><?php echo userlang('date') ; ?></th>
                            <th><?php echo userlang('note_id') ; ?></th>
                            <th><?php echo userlang('note_unique_id') ; ?></th>
                            <th><?php echo userlang('user_ip') ; ?></th>
                            <th><?php echo userlang('note') ; ?></th>
                            <th><?php echo userlang('password_protected') ; ?> </th>
                            <th><?php echo userlang('status') ; ?></th>
                            <th><?php echo userlang('action') ; ?></th>
                        </tr>
                    </thead>
                </table><!-- /table -->
            </div>
        </div>
    </div>
    <div class="col-lg-1"></div> 
</div>
<div class="modal fade openNote" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="modal-dialog">
			<div class="modal-content <?php echo colormode('bg_color') ; ?>">
                    <div class="modal-header <?php echo colormode('border_bottom') ; ?>">
                        <h4 class="modal-title text-danger"><i class="bi bi-file-earmark-person"></i> <?php echo userlang('note_heading') ; ?></h4>
                        <button type="button" class="close btn btn-dark btn-sm " data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-start">
                        <div class="showDescription <?php echo colormode('default_text') ; ?>"></div>
                    </div>
			</div>
	</div>
</div>
<?php
include("js.php") ;
include("body_end.php") ;
?>