<?php include("header.php") ; ?>
<?php 
$hardreject  = "active" ; 
$hardrejectsubject = "active" ;
?>
<?php include("sidebar.php") ; ?>
<!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1 class="text-muted"><i class="fa fa-window-close"></i> Hard Reject Reasons </h1>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>Hard Rejected Reason can be used for Email Body to User.</h4>
                  <button class="btn btn-success btn-sm" id="hr_sub_title"><i class="fa fa-plus"></i> Add New Reason</button>
              
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3"></div><div class="col-lg-6"><div class="remove-messages"></div></div><div class="col-lg-3"></div>
                        <div class="table-responsive">
                            <table  class="table table-bordered table-hover manageHrReasonTable" >
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>ID</th>
                                        <th>Reason</th>
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
<!-- Add Hard Reject Reason Modal -->
	<div id="hrSubModal" class="modal fade" data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    		<form method="post" id="hr_sub_form" class="hr_sub_form">
    			<div class="modal-content">
    				<div class="modal-header">
						<h4 class="modal-title"><i class="fa fa-plus"></i> Add Hard Reject Reason</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
    				</div>
    				<div class="modal-body">
						
						<div class="form-group">
							<label>Reason* (Max 300 Characters)</label>
                            <textarea name="hr_reason" id="hr_reason" class="form-control textareaLarge"rows="4" maxlength="300" ></textarea>
						</div>
    				</div> 
    				<div class="modal-footer"> 
						<input type="hidden" name="hrSubId" class="hrSubId" >
						<input type="hidden" name="btn_action" id="btn_action" />
    					<input type="submit" name="action_hr_sub" id="action_hr_sub" class="btn btn-info" value="Save Reason" />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
<?php include("footer.php") ; ?>