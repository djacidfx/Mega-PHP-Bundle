<?php include("header.php") ; ?>
<?php 
$reports = "active" ; 
$ratingReport = "active" ;
?>
<?php include("sidebar.php") ; ?>
<!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1 class="text-muted"><i class="fa fa-flag"></i> Rating Reports </h1>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>Author reported to a User Rating on their Item, Review & Either Delete User Rating or Deny Report. Note : Due to Rating Report, Ratings shows here means Old Rating which doesn't include this Rating.</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6"><div class="remove-messages"></div></div>
                        <div class="col-lg-3"></div>
                        <div class="table-responsive">
                            <table  class="table table-bordered table-hover manageRatingReportTable" >
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Item Title</th>
                                        <th>Price</th>
                                        <th>Sales</th>
                                        <th>Current Rating</th>
                                        <th>Rated By</th>
                                        <th>View Item</th>
                                        <th>Buyer Rating</th>
                                        <th>Buyer Comment</th>
                                        <th>Delete Rating</th>
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