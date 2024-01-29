<?php include("header_session.php") ; ?>
<?php $webtitle = "Soft Reject Items" ; ?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>
<?php 
$softReject = "active" ; 
$dashboard = "active" ;
$nt = '1' ;
?>
<?php include("sidebar_index.php"); ?>
<?php echo check_user_logged_in($pdo) ; ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1 class="text-muted"><i class="fas fa-exclamation-circle fa-lg"></i> Soft Rejects</h1>
      </div>
      <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>All Items which you've Uploaded & Soft Rejects by Reviewer. You can Re-Submit anytime.</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table  class="table table-bordered table-hover manageSoftRejectTable" >
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Created Date</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Your Comment</th>
                                        <th>Reviewer Comment</th>
                                        <th>Title Issue</th>
                                        <th>Price Issue</th>
                                        <th>Description Issue</th>
                                        <th>Tags Issue</th>
                                        <th>Category Issue</th>
                                        <th>Image Issue</th>
                                        <th>Video Issue</th>
                                        <th>Mainfile Issue</th>
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
<?php include("footer_main.php") ; ?>