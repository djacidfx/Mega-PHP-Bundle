<?php include("header.php") ; ?>
<?php 
$payouts = "active" ; 
$sendPayout = "active" ;
$curMonth = date("m") ;
$curYear = date("Y") ;
$curMonthYear = date($curYear."-".$curMonth) ;
$previousMonthYear = date('Y-m', strtotime($curMonthYear." -1 month"));
$previousMonth = strtotime($previousMonthYear);
$previousMonth = date("m",$previousMonth) ;
$concatPreviousYear = date("Y",strtotime($previousMonthYear)) ;

$dateObj   = DateTime::createFromFormat('!m', $previousMonth);
$monthName = $dateObj->format('F');

$endDate = date($concatPreviousYear."-".$previousMonth."-31");
$endTimeStamp = " 23:59:59" ;
?>
<?php include("sidebar.php") ; ?>
<!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1 class="text-muted"><i class="fa fa-dollar-sign"></i> Send Payouts </h1>
          </div>
          <div class="row">
            
            
            <div class="col-lg-12 mt-2">
              <div class="card">
                <div class="card-header">
                  <h4>Note : Unpaid Author Earnings [ Last Day of <?php echo $monthName ; ?> <?php echo $concatPreviousYear; ?> till <?php echo $endTimeStamp ; ?> ] . This Month Payout will be seen on Next Month and Send Payout Button will automatically enabled in Action Tab. </h4>              
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-4"><div class="remove-messages"></div></div>
                        <div class="col-lg-4"></div>
                        <div class="table-responsive">
                            <table  class="table table-bordered table-hover SendPayoutTable" id="SendPayoutTable" >
                                <thead>
                                    <tr>
                                        <th>S.No.</th>	
                                        <th>User ID</th>	
                                        <th>Username</th>
                                        <th>Email</th>
                                        <th>Paypal Email</th>
                                        <th>Payout</th>
                                        <th>Status</th>
                                        <th>BreakUps</th>
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

<!-- Send Payout Modal -->
<div id="spayoutModal" class="modal fade spayoutModal" data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    			<div class="modal-content">
                    <form method="post" enctype="multipart/form-data" class="spayout_form">
    				<div class="modal-header border border-top-0 border-left-0 border-right-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4 class="modal-title"><i class='fa fa-dollar-sign'></i> Send Payout </h4>
                            </div>
                            <div class="col-lg-12">
                                <small>Note : Transaction ID should be Unique Every Time.</small>
                            </div>
                        </div>                       
    				</div>
    				<div class="modal-body">
						<div class="row">
							<div class="col-lg-6">
								<label class="text-muted">Payout Email*</label>
                                <input type="text" name="payoutEmail" class="form-control payoutEmail" readonly required>
							</div>
                            <div class="col-lg-6">
								<label class="text-muted">Payout Amount(USD $)*</label>
                                <input type="text" name="payoutAmt" class="form-control payoutAmt" readonly required>
							</div>
                            <div class="col-lg-12 mt-3">
								<label class="text-muted">Transaction ID*</label>
                                <input type="text" name="txnId" class="form-control txnId" required autocomplete="off" autofocus>
							</div>
						</div>						
					</div>
					
					
    				<div class="modal-footer">
                        <input type="hidden" name="authorId" class="authorId" >
                        <input type="hidden" name="monName" value="<?php echo $monthName ; ?>" >
                        <input type="hidden" name="year" value="<?php echo $concatPreviousYear ; ?>" >
                        <input type="hidden" name="btn_action" value="sendPayoutToAuthor">
                        <button type="submit" name="submit" class="btn-primary btn btn-sm">Send Payout & Email</button>
    					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Close</button>
    				</div>
                    </form>
    			</div>
               
    	</div>
    </div>
<!-- Unpaid Payout Breakups Modal -->
<div id="unpaidBreakupModal" class="modal fade unpaidBreakupModal" data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog modal-xl">
    			<div class="modal-content">
    				<div class="modal-header border border-top-0 border-left-0 border-right-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <h4 class="modal-title"><i class='fa fa-eye'></i> View Payout Breakups </h4>
                            </div>
                            <div class="col-lg-12">
                                <small>[ Note : Payment Breakups means their Lifetime Earning. It includes Sale, Reversal & Refunds ]</small>
                            </div>
                        </div>                       
    				</div>
    				<div class="modal-body">
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<span class="viewPayoutBreakups"></span>
							</div>
						</div>						
					</div>
					
					
    				<div class="modal-footer">
    					<button type="button" class="btn btn-primary btn-sm" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    	</div>
    </div>
<?php include("footer.php") ; ?>