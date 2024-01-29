<?php include("header.php") ; ?>
<?php 
$payments = "active" ; 
$walletPay = "active" ;
?>
<?php include("sidebar.php") ; ?>
<!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1 class="text-muted"><i class="fa fa-dollar-sign"></i> Wallet Recharges </h1>
          </div>
          <div class="row">
            
            
            <div class="col-lg-12 mt-2">
              <div class="card">
                <div class="card-header">
                  <h4 >You can find here which User has Add Credit into their wallet.</h4>              
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6"><div class="remove-messages"></div></div>
                        <div class="col-lg-3"></div>
                        <div class="table-responsive">
                            <table  class="table table-bordered table-hover WalletPaymentTable" id="WalletPaymentTable" >
                                <thead>
                                    <tr>
                                        <th>S.No.</th>	
                                        <th>User ID</th>	
                                        <th>Username</th>
                                        <th>User Email</th>
                                        <th>Current Balance</th>
                                        <th>Date</th>
                                        <th>Credit Amount</th>
                                        <th>Transaction ID</th>
                                        <th>Method</th>
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
<?php include("footer.php") ; ?>