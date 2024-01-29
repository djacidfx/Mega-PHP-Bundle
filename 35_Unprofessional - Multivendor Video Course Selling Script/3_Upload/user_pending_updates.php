<?php include("header_session.php") ; ?>
<?php $webtitle = "Active Items" ; ?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>
<?php 
$updateStatus = "active" ; 
$dashboard = "active" ;
$nt = '1' ;
?>
<?php include("sidebar_index.php"); ?>
<?php echo check_user_logged_in($pdo) ; ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1 class="text-muted"><i class="fas fa-clock fa-lg"></i>Items Update</h1>
      </div>
      <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>All Items which you've Uploaded for Update. You can cancel update anytime.</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover manageUpdateItemsTable" >
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Preview</th>
                                        <th>Item ID</th>
                                        <th>Title</th>
                                        <th>Upload Date</th>
                                        <th>Status</th>
                                        <th>Reviewer Comment</th>
                                        <th>Cancel Update</th>
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