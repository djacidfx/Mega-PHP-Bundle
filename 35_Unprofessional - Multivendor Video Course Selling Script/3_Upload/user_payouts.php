<?php include("header_session.php") ; ?>
<?php  
$username = username_by_id($pdo,$_SESSION['unprofessional']['id']) ; 
$nt = '1' ;
?>
<?php echo check_user_logged_in($pdo) ; ?>
<?php $webtitle = "Author Payouts" ; ?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>

<?php include("sidebar_index.php"); ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1 class="text-muted"><i class="fas fa-credit-card fa-lg"></i> Monthly Payout (Paid) </h1>
      </div>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
            <div class="card-icon shadow-primary bg-primary">
              <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Current Earning (Unpaid)</h4>
              </div>
              <div class="card-body smFont">
                <?php echo  grab_author_unpaid_earning($pdo,$_SESSION['unprofessional']['id']) ; ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
            <div class="card-icon shadow-primary bg-primary">
              <i class="fas fa-align-center"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Payouts</h4>
              </div>
              <div class="card-body smFont">
                <?php echo  count_author_total_payouts($pdo,$_SESSION['unprofessional']['id']) ; ?>
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
                <h4>Total Earning (Paid)</h4>
              </div>
              <div class="card-body smFont">
                <?php if(count_author_total_paid_payouts($pdo,$_SESSION['unprofessional']['id']) > 0) {
                    echo  count_author_total_paid_payouts($pdo,$_SESSION['unprofessional']['id']) ; 
                } else {
                    echo "0" ;
                }
                ?>
              </div>
            </div>
          </div>
        </div>
        
        
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table  class="table table-bordered table-hover" >
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Date</th>
                                        <th>Txn ID</th>
                                        <th>Payout Month</th>
                                        <th>Method</th>
                                        <th>Paypal Email / Account</th>
                                        <th>Payout ($)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php echo grab_payout_list($pdo,$_SESSION['unprofessional']['id']); ?>
                                    </tr>
                                </tbody>
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