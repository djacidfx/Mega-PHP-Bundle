<?php include("header.php") ; ?>
<?php 
$statusUpdate = "active" ; 
$dashboard = "active" ;
?>
<?php include("sidebar.php") ; ?>
<!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1 class="text-muted"><i class="fa fa-clock"></i> Pending Item Updates </h1>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>User Uploaded Item Update. Review & Approve or Reject the Updates.</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table  class="table table-bordered table-hover manageItemUpdateReviewTable" >
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>User ID</th>
                                        <th>Username</th>
                                        <th>User Email</th>
                                        <th>Date</th>
                                        <th>Item ID</th>
                                        <th>Item Title</th>
                                        <th>Category Update</th>
                                        <th>Preview Update</th>
                                        <th>Demo Update</th>
                                        <th>Main File Update</th>
                                        <th>User Comment</th>
                                        <th>Action</th>
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
<?php include("footer.php") ; ?>