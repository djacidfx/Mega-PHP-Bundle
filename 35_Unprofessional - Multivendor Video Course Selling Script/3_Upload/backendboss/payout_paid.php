<?php include("header.php") ; ?>
<?php 
$payouts = "active" ; 
$paidPayout = "active" ;
?>
<?php include("sidebar.php") ; ?>
<!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1 class="text-muted"><i class="fa fa-dollar-sign"></i> Paid Payouts </h1>
          </div>
          <div class="row">
              <div class="col-lg-2 col-md-2 col-sm-12"></div>
              <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
            <div class="card-icon shadow-primary bg-primary">
              <i class="fas fa-align-center"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Paid Payouts</h4>
              </div>
              <div class="card-body smFont">
                <?php echo count_totalpayout_paid_for_admin($pdo) ; ?>
              </div>
            </div>
          </div>
        </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
            <div class="card-icon shadow-primary bg-primary">
              <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Paid Amount</h4>
              </div>
              <div class="card-body smFont">
                <?php echo grab_totalpayout_paid_for_admin($pdo) ; ?>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-lg-2 col-md-2 col-sm-12"></div>
            
            <div class="col-lg-12 mt-2">
              <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4"><div class="remove-messages"></div></div>
                        <div class="col-lg-4"></div>
                        <div class="table-responsive">
                            <table  class="table table-bordered table-hover PaidPayoutTable" id="PaidPayoutTable" >
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>User ID</th>	
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Paypal Email</th>
                                        <th>Transaction ID</th>
                                        <th>Paid Date</th>
                                        <th>Month</th>
                                        <th>Payout</th>
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