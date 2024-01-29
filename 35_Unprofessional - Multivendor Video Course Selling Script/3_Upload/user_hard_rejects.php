<?php include("header_session.php") ; ?>
<?php $webtitle = "Hard Reject Items" ; ?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>
<?php 
$hardReject = "active" ; 
$dashboard = "active" ;
$nt = '1' ;
?>
<?php include("sidebar_index.php"); ?>
<?php echo check_user_logged_in($pdo) ; ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1 class="text-muted"><i class="fas fa-times fa-lg"></i> Hard Rejects</h1>
      </div>
      <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>All Items which you've Uploaded & Hard Rejects by Reviewer.</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table  class="table table-bordered table-hover manageHardRejectTable" >
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Date</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Your Comment</th>
                                        <th>Reason</th>
                                        <th>Reviewer Comment</th>
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