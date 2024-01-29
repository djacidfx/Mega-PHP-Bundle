<?php include("header.php") ; ?>
<?php 
$solvedDisputes = "active" ; 
$dashboard = "active" ;
?>
<?php include("sidebar.php") ; ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1 class="text-muted"><i class="fa fa-retweet fa-lg"></i> Solved Disputes</h1>
      </div>
      <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>This Shows only Solved Dispute List which is solved by Admin.</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3"></div><div class="col-lg-6"><div class="remove-messages"></div></div><div class="col-lg-3"></div>
                        <div class="table-responsive">
                            <table  class="table table-bordered table-hover manageSolvedDisputeTable" >
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Buyer Email</th>
                                        <th>Author Email</th>
                                        <th>Refund Date</th>
                                        <th>Item</th>
                                        <th>Purchase Date</th>
                                        <th>Transaction ID</th>
                                        <th>Amount</th>
                                        <th>Item Downloaded</th>
                                        <th>Status</th>
                                        <th>Author Decision</th>
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