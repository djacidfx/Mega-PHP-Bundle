<?php include("header.php") ; ?>
<?php 
$payments = "active" ; 
$itemPay = "active" ;
?>
<?php include("sidebar.php") ; ?>
<!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1 class="text-muted"><i class="fa fa-dollar-sign"></i> Item Payments </h1>
          </div>
          <div class="row">
            
            
            <div class="col-lg-12 mt-2">
              <div class="card">
                <div class="card-header">
                  <h4 class="text-danger">Note : Sale Reversal Immediately Block the User Access and Block Downloads. Author Earning will also be affected.</h4>              
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6"><div class="remove-messages"></div></div>
                        <div class="col-lg-3"></div>
                        <div class="table-responsive">
                            <table  class="table table-bordered table-hover ItemPaymentTable" id="ItemPaymentTable" >
                                <thead>
                                    <tr>
                                        <th>S.No.</th>	
                                        <th>Buyer ID</th>	
                                        <th>Buyer Username</th>
                                        <th>Buyer Email</th>
                                        <th>Author ID</th>
                                        <th>Author Username</th>
                                        <th>Author Email</th>
                                        <th>Item ID</th>
                                        <th>Item Name</th>
                                        <th>Date</th>
                                        <th>Transaction ID</th>
                                        <th>Method</th>
                                        <th>Type</th>
                                        <th>Payout Paid</th>
                                        <th>Status</th>
                                        <th>Sale Amount</th>
                                        <th>Commission %</th>
                                        <th>Author Earning</th>
                                        <th>Admin Earning</th>
                                        <th>Sale Reversal</th>
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