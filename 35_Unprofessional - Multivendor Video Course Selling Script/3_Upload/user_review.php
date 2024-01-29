<?php include("header_session.php") ; ?>
<?php $webtitle = "In Review Items" ; ?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>
<?php 
$review = "active" ; 
$dashboard = "active" ;
$nt = '1' ;
?>
<?php include("sidebar_index.php"); ?>
<?php echo check_user_logged_in($pdo) ; ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1 class="text-muted"><i class="fas fa-clock fa-lg"></i> Items in Review</h1>
      </div>
      <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>All Items which you've Uploaded to Review.</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table  class="table table-bordered table-hover managePendingReviewTable" >
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Date</th>
                                        <th>Preview Image</th>
                                        <th>Video Title</th>
                                        <th>Comment</th>
                                        <th>Status</th>
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