<?php include("header.php") ; ?>
<?php 
$reports = "active" ; 
$commentReport = "active" ;
?>
<?php include("sidebar.php") ; ?>
<!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1 class="text-muted"><i class="fa fa-flag"></i> Comment Reports </h1>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>Author reported to a Comment, Review & Either Delete Comment or Deny Report.</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6"><div class="remove-messages"></div></div>
                        <div class="col-lg-3"></div>
                        <div class="table-responsive">
                            <table  class="table table-bordered table-hover manageCommentReportTable" >
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Comment</th>
                                        <th>Item Comments</th>
                                        <th>Delete</th>
                                        <th>Deny</th>
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