<?php include("header.php") ; ?>
<?php 
$title_hard_reject = "active" ; 
$hardreject = "active" ;
?>
<?php include("sidebar.php") ; ?>
<!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1 class="text-muted"><i class="fa fa-window-close"></i> Hard Reject Titles </h1>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>Hard Rejected Title can be used for Email Subject to User.</h4>
                  <button class="btn btn-success btn-sm" id="hr_title"><i class="fa fa-plus"></i> Add New Title</button>
              
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3"></div><div class="col-lg-6"><div class="remove-messages"></div></div><div class="col-lg-3"></div>
                        <div class="table-responsive">
                            <table  class="table table-bordered table-hover manageHrTitleTable" >
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                            </table><!-- /table -->
                        </div>
                        
                        
                    </div>
                </div>
              </div>
            </div>
          </div>
        </section>
    </div>
<!-- Add Hard Reject Title Modal -->
	<div id="hrModal" class="modal fade" data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    		<form method="post" id="hr_form" class="hr_form">
    			<div class="modal-content">
    				<div class="modal-header">
						<h4 class="modal-title"><i class="fa fa-plus"></i> Add Hard Reject Title</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
    				</div>
    				<div class="modal-body">
						
						<div class="form-group">
							<label>Title Name* (Max 50 Characters)</label>
							<input type="text" class="form-control" id="hr" name="hr" placeholder="e.g. Your Item was Hard Rejected" autocomplete="off" required autofocus  maxlength="50">
						</div>
    				</div> 
    				<div class="modal-footer"> 
						<input type="hidden" name="hrId" class="hrId" >
						<input type="hidden" name="btn_action" id="btn_action" />
    					<input type="submit" name="action_hr" id="action_hr" class="btn btn-info" value="Save Title" />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
<?php include("footer.php") ; ?>