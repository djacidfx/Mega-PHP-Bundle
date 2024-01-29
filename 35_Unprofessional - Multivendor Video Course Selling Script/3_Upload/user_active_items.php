<?php include("header_session.php") ; ?>
<?php $webtitle = "Active Items" ; ?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>
<?php 
$activeItem = "active" ; 
$dashboard = "active" ;
$nt = '1' ;
?>
<?php include("sidebar_index.php"); ?>
<?php echo check_user_logged_in($pdo) ; ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1 class="text-muted"><i class="fas fa-check fa-lg"></i> Active Items</h1>
      </div>
      <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>All Items which you've Uploaded & Active for Sale.<small>&ensp;(Note : It also shows Items which is disabled by admin)</small></h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 remove_message_pause"></div>
                        <div class="table-responsive">
                            <table  class="table table-bordered table-hover manageActiveItemsTable" >
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Item ID</th>
                                        <th>Approved Date</th>
                                        <th>Preview Image</th>
                                        <th>Video Title</th>
                                        <th>Category</th>
                                        <th>Last Update</th>
                                        <th>Price</th>
                                        <th>Sales</th>
                                        <th>Rating</th>
                                        <th>Rated By</th>
                                        <th>Loved By</th>
                                        <th>Views</th>
                                        <th>Comments</th>
                                        <th>Status</th>
                                        <th>Link</th>
                                        <th>Action</th>
                                        <th>Edit</th>
                                        <th>Main File</th>
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
<?php include("footer_main.php") ; ?>