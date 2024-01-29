<?php 
ob_start();
session_start();
include("setup.php") ; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title><?php echo META_SITE_TITLE ; ?></title>
    <meta property="og:title" content="<?php echo META_SITE_TITLE ; ?>" />
    <meta property="og:description" content="<?php echo META_SITE_DESCRIPTION ; ?>" />
    <link href="<?php echo BASE_URL ; ?>css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="<?php echo BASE_URL ; ?>css/custom.css" rel="stylesheet">
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
</head>
<body class="bg-dark" > 
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3"></div>        
            <div class="col-lg-6 mt-5">
                <form method="post" class="donationForm">
                <div class="card bg-dark newShadow text-center">
                    <div class="card-header ">
                        <h1 class="text-muted"><i class="bi bi-cash-coin text-warning"></i> <?php echo DONATION_BOX_HEADER ; ?></h1>
                    </div>
                    <div class="card-body text-start">
                        <div class="row">
                            <div class="col-lg-4 mt-1">
                            <div class="form-group">
                                <label class="text-muted"><i class="bi bi-person-check-fill"></i> <?php echo NAME_HEADING ; ?>*</label>
                                <input type="text" name="name" class="form-control bg-dark text-white customBorder mt-1" autocomplete="off" required maxlength="50">
                            </div>
                            </div>
                            <div class="col-lg-4 mt-1">
                             <div class="form-group">
                                <label class="text-muted"><i class="bi bi-envelope-fill"></i> <?php echo EMAIL_HEADING ; ?>*</label>
                                <input type="email" name="email" class="form-control bg-dark text-white customBorder mt-1" autocomplete="off" required maxlength="50">
                            </div>
                            </div>
                            
                            <div class="col-lg-4 mt-1">
                                <div class="form-group">
                                <label class="text-muted"><i class="bi bi-currency-exchange"></i> <?php echo DONATION_AMT_HEADING ; ?>* </label>
                                    <div class="input-group mb-3 mt-1">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text bg-dark text-white customBorder" id="basic-addon1"><?php echo CURRENCY_TYPE ; ?></span>
                                      </div>
                                      <input type="number" name="amount" min="<?php echo MIN_DONATION_AMOUNT ; ?>" max="<?php echo MAX_DONATION_AMOUNT ; ?>" class="form-control bg-dark text-white customBorder" aria-label="Username" aria-describedby="basic-addon1" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <div class="form-group mt-2 text-center">
                                    <label class="text-muted"><i class="bi bi-patch-check-fill"></i> <?php echo PROVE_HUMAN_HEADING ; ?>*</label>
                                    <div class="g-recaptcha" data-sitekey="<?php echo SITE_KEY ; ?>" data-theme="dark" ></div>
                                </div>
                            </div>
                            
                            
                        </div>
                       
                        
                    </div>
                    <div class="card-footer text-center">
                        <div class="form-group mt-2 text-center">
                            <input type="hidden" name="btn_action" value="SubmitDonationForm" >
                            <div class="remove-messages"></div>
                            <button type="submit" class="btn btn-grey" id="action_sb">
                              <i class="bi bi-credit-card-2-back-fill"></i> &ensp;<?php echo BUTTON_HEADING ; ?>
                            </button>
                        </div>
                    </div>
                </div>
                </form>
            </div>        
            <div class="col-lg-3"></div>        
        </div>
    </div>
    
    
    <!-- Stripe Checkout Modal -->
	<div id="stripePayModal" class="modal fade stripePayModal"  data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    			<div class="modal-content bg-dark">
    				<div class="modal-header customBottomBorder">
						<h4 class="modal-title text-white"><i class="bi bi-credit-card-2-back-fill"></i> &ensp;<?php echo BUTTON_HEADING ; ?></h4>
						<button type="button" class="close btn btn-grey" data-bs-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true" class="text-white">&times;</span>
						</button>
    				</div>
					<form action="<?php echo BASE_URL."donation" ; ?>" method="post" class="stripePay" enctype="multipart/form-data" id="payment_form">
    				<div class="modal-body customBottomBorder">
					
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
									<label class="text-muted">Card Number</label>
										<div id="card_number" class="field form-control"></div>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label class="text-muted">Expiry MM/YY</label>
										<div id="card_expiry" class="field form-control"></div>
								</div>
							</div>
							<div class="col-lg-3">
								<div class="form-group">
									<label  class="text-muted">CVC</label>
									<div id="card_cvc" class="field form-control"></div>
								</div>
							</div>
							<div class="col-lg-12 p-2"><div id="paymentResponse"></div> </div>
						</div>
					
    				</div> 
    				<div class="modal-footer customBottomBorder">
						<input type="hidden" name="uname" class="uname" />
						<input type="hidden" name="uemail" class="uemail"  />
						<input type="hidden" name="amount" class="amount"  />
						<input type='hidden' name='currency_code' value='<?php echo CURRENCY_TYPE ; ?>'> 
						<input type="submit" value="<?php echo BUTTON_HEADING ; ?>" name="stripepayactionBtn" class="stripepayactionBtn btn btn-md btn-primary"  />
    				</div>
					</form>
    			</div>
    		
    	</div>
    </div>
    
    <script src="<?php echo BASE_URL ; ?>js/jquery.min.js" ></script>
    <script src="<?php echo BASE_URL ; ?>js/popper.min.js" ></script>
    <script src="<?php echo BASE_URL ; ?>js/bootstrap.min.js"></script>	 
    <script src="https://js.stripe.com/v3/"></script>
    <script src="<?php echo BASE_URL ; ?>js/stripe.js"></script>	 
    <script src="<?php echo BASE_URL ; ?>js/custom.js"></script>	 
</body>
</html>
