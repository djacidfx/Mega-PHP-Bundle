<?php
include("db.php") ;
include("head.php") ;
include("header.php") ;
check_admin_logged_in($pdo);
?>
<div class="row mt-2">
    <div class="col-lg-12 <?php echo colormode('default_text') ; ?> ">
        <div class="row p-0">
            <div class="col-lg-12 mb-3 ">
                <h1 class="text-muted"> <i class="bi bi-check2-circle text-success"></i> <?php echo userlang('total_active_category') ; ?>  <button class="btn btn-success btn-md addCategory"><i class="bi bi-plus me-2"></i><?php echo userlang('category_add') ; ?></button></h1>
            </div>
            <div class="table-responsive p-3 <?php echo colormode('bg_color') ; ?> rounded newShadow">
                <div class="remove-messages <?php echo colormode('default_text') ; ?>"></div>
                <table class="table table-bordered <?php echo colormode('tbl_dark') ; ?> table-hover cell-border manageactive_CatTable" >
                    <thead>
                        <tr>
                            <th><?php echo userlang('serial_number') ; ?></th>
                            <th><?php echo userlang('date') ; ?></th>
                            <th><?php echo userlang('category_id') ; ?></th>
                            <th><?php echo userlang('category') ; ?> <?php echo userlang('name') ; ?></th>
                            <th><?php echo userlang('action') ; ?></th>
                        </tr>
                    </thead>
                </table><!-- /table -->
            </div>
        </div>
    </div>
</div>
<div class="modal fade openAddCategory" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="modal-dialog">
			<div class="modal-content <?php echo colormode('bg_color') ; ?>">
                    <div class="modal-header <?php echo colormode('border_bottom') ; ?>">
                        <h4 class="modal-title text-danger"><i class="bi bi-plus"></i> <?php echo userlang('category_add') ; ?></h4>
                        <button type="button" class="close btn btn-dark btn-sm " data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-start">
                        <form method="post" class="add_category">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label class="mb-2 <?php echo colormode('default_text') ; ?>"><?php echo userlang('category') ; ?> <?php echo userlang('name') ; ?></label>
                                    <input name="catName" type="text" maxlength="50" class="form-control <?php echo colormode('default_text') ; ?> <?php echo colormode('border') ; ?> <?php echo colormode('textarea-bgcolor') ; ?>" required autocomplete="off">
                                </div>
                                <div class="col-lg-12 mt-3 text-center">
                                    <div class="addc-messages"></div>
                                    <input type="hidden" name="btn_action" value="btnAddCategory">
                                    <button type="submit" name="submit" class="btn btn-md btn-success action_log"><i class="bi bi-plus me-1"></i> <?php echo userlang('category_create') ; ?></button>
                                </div>
                            </div>
                        </form>                        
                    </div>
			</div>
	</div>
</div>

<div class="modal fade openEditCategory" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="modal-dialog">
			<div class="modal-content <?php echo colormode('bg_color') ; ?>">
                    <div class="modal-header <?php echo colormode('border_bottom') ; ?>">
                        <h4 class="modal-title text-danger"><i class="bi bi-pencil"></i> <?php echo userlang('category_edit') ; ?></h4>
                        <button type="button" class="close btn btn-dark btn-sm " data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-start">
                        <form method="post" class="edit_category_form">
                            <div class="row">
                                <div class="col-lg-12">
                                    <label class="mb-2 <?php echo colormode('default_text') ; ?>"><?php echo userlang('category') ; ?> <?php echo userlang('name') ; ?></label>
                                    <input name="catName" type="text" maxlength="50" class="catName form-control <?php echo colormode('default_text') ; ?> <?php echo colormode('border') ; ?> <?php echo colormode('textarea-bgcolor') ; ?>" required autocomplete="off">
                                </div>
                                <div class="col-lg-12 mt-3 text-center">
                                    <div class="editc-messages"></div>
                                    <input type="hidden" name="cid" class="cid">
                                    <input type="hidden" name="btn_action" value="btnEditCategory">
                                    <button type="submit" name="submit" class="btn btn-md btn-success action_log"><i class="bi bi-pencil me-1"></i> <?php echo userlang('category_edit') ; ?></button>
                                </div>
                            </div>
                        </form>                        
                    </div>
			</div>
	</div>
</div>

<?php
include("js.php") ;
?>