<?php include("header.php") ; ?>
<?php 
$forumCategory = "active" ; 
$forum = "active" ;
?>
<?php include("sidebar.php") ; ?>
<!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1 class="text-muted"><i class="fa fa-clone"></i> Forum Category </h1>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>Create, Edit, Activate / Deactivate Forum Category</h4>&ensp;<button class="btn btn-success btn-sm rounded openForumCategory">+ Add Forum Category</button>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 remove-messages"></div>
                        <div class="table-responsive">
                            <table  class="table table-bordered table-hover manageForumCategoryTable" >
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Category ID</th>
                                        <th>Category Name</th>
                                        <th>Status</th>
                                        <th><i class="fa fa-pencil-alt"></i></th>
                                        <th><i class="fa fa-ban"></i></th>
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
<!-- Add Category Modal -->
	<div id="catModal" class="modal fade" data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    		<form method="post" id="cat_form" class="cat_form">
    			<div class="modal-content">
    				<div class="modal-header">
						<h4 class="modal-title"><i class="fa fa-plus"></i> Add Forum Category</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
    				</div>
    				<div class="modal-body">
						
						<div class="form-group">
							<label>Category Name* (Max 50 Characters)</label>
							<input type="text" class="form-control" id="cat" name="cat" placeholder="e.g. General Discussion" autocomplete="off" required maxlength="50">
						</div>
    				</div> 
    				<div class="modal-footer"> 
						<input type="hidden" name="catId" class="catId" >
						<input type="hidden" name="btn_action" id="btn_action" />
    					<input type="submit" name="action_cat" id="action_cat" class="btn btn-info" value="Save Category" />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
<?php include("footer.php") ; ?>