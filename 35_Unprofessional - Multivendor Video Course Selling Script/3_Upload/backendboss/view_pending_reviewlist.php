<?php include("header.php") ; ?>
<?php 
$pending = "active" ; 
$dashboard = "active" ;
?>
<?php include("sidebar.php") ; ?>
<!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1 class="text-muted"><i class="fa fa-exclamation-circle"></i> Pending Items </h1>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>Delete Pending Items because User not Uploaded Completely within 30 Minutes.</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table  class="table table-bordered table-hover managePendingReviewTable" >
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Temp ID</th>
                                        <th>User ID</th>
                                        <th>Username</th>
                                        <th>User Email</th>
                                        <th>Item Title</th>
                                        <th>Delete</th>
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