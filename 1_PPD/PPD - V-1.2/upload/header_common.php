<header class="header fixed-top">
        <nav class="navbar navbar-expand-lg ">
            <div class="search-box">
                <button class="dismiss"><i class="icon-close"></i></button>
                <form id="searchForm" action="<?php echo BASE_URL.'usersearch.php' ; ?>" method="post" role="search">
                    <input type="search" placeholder="e.g. Wordpress Theme, PHP Script, Logos ..." class="form-control" name="search_keyword">
                </form>
            </div>
            <div class="container-fluid ">
                <div class="navbar-holder d-flex align-items-center justify-content-between">
                    <div class="navbar-header">
                        <a href="<?php echo BASE_URL ; ?>" class="navbar-brand">
                            <div class="brand-text brand-big hidden-lg-down"><img src="<?php echo BASE_URL ; ?>img/logo.png" alt="Logo" class="img-fluid"></div>
                            <div class="brand-text brand-small ml-1"><img src="<?php echo BASE_URL ; ?>img/logo.png" alt="Logo" class="img-fluid"></div>
                        </a>
                    </div>
                </div>
                <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                    <!-- Expand-->
                    <li class="nav-item d-flex align-items-center full_scr_exp"><a class="nav-link" href="#"><img src="<?php echo BASE_URL ; ?>img/expand.png" onClick="toggleFullScreen(document.body)" class="img-fluid" alt=""></a></li>
                    <!-- Search-->
                    <li class="nav-item d-flex align-items-center"><a id="search" class="nav-link" href="#"><i class="icon-search"></i></a></li>
                    <!-- Notifications-->
                    <li class="nav-item dropdown">
					<?php if(isset($_SESSION['user']['user_id'])){ ?>
					
                        <a id="notifications" class="nav-link getLovedItem"  href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo BASE_URL ; ?>img/userlove.png" alt="Profile" class="img-fluid rounded-circle" style="height: 30px; width: 30px;"><span class="noti-numb-bg"></span><span class="badge"><p class="oldCount"><?php echo count_loved_items($pdo); ?></p><p class="newCount"></p></span></a>
						<ul aria-labelledby="notifications" class="dropdown-menu showLovedItems">
							
                        </ul>
					
					<?php } else { ?>
					
						 <a id="notifications" class="nav-link" rel="nofollow" href="<?php echo BASE_URL."login/" ; ?>"><img src="<?php echo BASE_URL ; ?>img/userlove.png" alt="Profile" class="img-fluid rounded-circle" style="height: 30px; width: 30px;"></a>
					
					<?php } ?>
                    </li> 
                    
                    <li class="nav-item dropdown"><a id="profile" class="nav-link logout" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo BASE_URL ; ?>img/userprofile.png" alt="Profile" class="img-fluid rounded-circle" style="height: 30px; width: 30px;"></a>
                        <ul aria-labelledby="profile" class="dropdown-menu">
						<?php
							if(isset($_SESSION['user']['user_id'])){
							?>
                            <li>
                                <a rel="nofollow" href="<?php echo BASE_URL."profile/" ; ?>" class="dropdown-item d-flex">
                                    <div class="msg-profile"> <img src="<?php echo BASE_URL ; ?>img/userprofile.png" alt="User" class="img-fluid rounded-circle"></div>
                                    <div class="msg-body">
                                        <h3 class="h5"><?php echo get_userfullname($pdo) ;  ?></h3><span><?php echo get_useremail($pdo) ; ?></span>
                                    </div>
                                </a>
                                <hr>
                            </li>
							<li>
                                
                                    <div class="col-lg-12"> <a href="<?php echo BASE_URL."addcredit/" ; ?>" class="btn btn-block btn-success bg-success text-white">Add Credit</a></div>
                                    
                                <hr>
                            </li>
							<li>
                                <a rel="nofollow" href="<?php echo BASE_URL."walletHistory/" ; ?>" class="dropdown-item">
                                    <div class="notification">
                                        <div class="notification-content"><i class="fa fa-credit-card-alt"></i> Credit Balance : $<?php echo user_wallet_amount($pdo) ; ?></div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a rel="nofollow" href="<?php echo BASE_URL."profile/" ; ?>" class="dropdown-item">
                                    <div class="notification">
                                        <div class="notification-content"><i class="fa fa-user "></i> Profile</div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a rel="nofollow" href="<?php echo BASE_URL."downloads/" ; ?>" class="dropdown-item">
                                    <div class="notification">
                                        <div class="notification-content"><i class="fa fa-download"></i> Downloads</div> 
                                    </div>
                                </a>
                            </li>
							<li>
                                <a rel="nofollow" href="<?php echo BASE_URL."purchases/" ; ?>" class="dropdown-item">
                                    <div class="notification">
                                        <div class="notification-content"><i class="fa fa-history"></i> Payment History</div> 
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a rel="nofollow" href="<?php echo BASE_URL."loved/" ; ?>" class="dropdown-item">
                                    <div class="notification">
                                        <div class="notification-content"><i class="fa fa-heart-o"></i> Loved Items</div>
                                    </div>
                                </a>
                                <hr>
                            </li>
							
                            <li>
                                <a rel="nofollow" href="<?php echo BASE_URL."logout.php" ; ?>" class="dropdown-item">
                                    <div class="notification">
                                        <div class="notification-content"><i class="fa fa-power-off"></i>Logout</div>
                                    </div>
                                </a> 
                            </li>
							<?php
							} else {
							?>
							<li>
                                <a rel="nofollow" href="<?php echo BASE_URL."login/" ; ?>" class="dropdown-item">
                                    <div class="notification">
                                        <div class="notification-content"><i class="fa fa-sign-in"></i> Login</div>
                                    </div>
                                </a> 
                            </li>
							<li>
                                <a rel="nofollow" href="<?php echo BASE_URL."signup/" ; ?>" class="dropdown-item">
                                    <div class="notification">
                                        <div class="notification-content"><i class="fa fa-user-plus"></i> SignUp</div>
                                    </div>
                                </a> 
                            </li>
							<li>
                                <a rel="nofollow" href="<?php echo BASE_URL."recover/" ; ?>" class="dropdown-item">
                                    <div class="notification">
                                        <div class="notification-content"><i class="fa fa-unlock-alt"></i> Recover Password</div>
                                    </div>
                                </a> 
                            </li>
							<?php
							}
							?>
                        </ul>
                    </li>
                    <li class="nav-item d-flex align-items-center"><a id="menu-toggle-right" class="nav-link" href="#"><i class="fa fa-bars"></i></a></li>
                    <nav id="sidebar-wrapper">
                      <div class="sidebar-nav"> 
                        <div class="tab" role="tabpanel"> 
                            <ul class="nav nav-tabs" role="tablist">
                              <li class="nav-item w-100">
                                <a class="nav-link active" href="#live" role="tab" data-toggle="tab"><i class="fa fa-bookmark-o"></i> Category</a>
                              </li>
                            </ul> 
                            <div class="tab-content tabs">
                              <div role="tabpanel" class="tab-pane fade show active" id="live">
                                <div class="content newsf-list">
                                    <ul class="list-unstyled">
                                        <?php echo get_category_name_and_link($pdo) ; ?>
                                    </ul>
                                </div>
                              </div>
                              
                           </div>
                      </div>
                    </nav>
                </ul> 
            </div>
        </nav>
    </header>
<?php
	if(isset($_SESSION['user']['user_id'])){
	$u_chance = check_user_chance($pdo);
	$registrationStatus = check_user_registration_status($pdo) ;
	if($registrationStatus == 0) {
	?>
	<div id="signupModal" class="modal fade " data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    		<form method="post" class="signup_otpform">
    			<div class="modal-content">
    				<div class="modal-header">
						<div class="row">
						<div class="col-lg-12">
						<h4 class="modal-title"><i class='fa fa-eye'></i> Verify Sign Up OTP</h4>
						</div>
						<div class="col-lg-12">
						<small>You've <?php echo $u_chance ; ?> Chance to verify your account. After that You'll be Permanently Blocked.</small>
						</div>
						</div>
    				</div>
    				<div class="modal-body">
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="form-group">
									<label>Email*</label>
									<input type="text" name="email" id="email" class="form-control" readonly="readonly" required value="<?php echo get_useremail($pdo) ; ?>" />
								</div>
								<div class="form-group">
									<label>OTP*</label>
									<input type="password" name="otp" id="otp" class="form-control" required />
								</div>
							</div>
							<div class="col-lg-12 text-center">
							<div class="remove-messages"></div>
							</div>
						</div>						
					</div>
					
					
    				<div class="modal-footer">
						<input type="hidden" name="verify_otp" value="Submit" />
    					<input type="submit" name="action_sign" id="action_sign" class="btn btn-info" value="Verify OTP"  />
    				</form>
					<form method="post" class="resend_otpform">
						<input type="hidden" name="resend_email" value="Submit" />
						<input type="hidden" name="resendEmail" id="resendemail" value="<?php echo get_useremail($pdo) ; ?>" >
						<input type="submit" name="action_resend" id="action_resend" class="btn btn-success" value="Resend OTP"  />
					</form>
    				</div>
    			</div>
    		
    	</div>
    </div>
	<?php
	}
	?>
	<!-- Preview & Wallet Checkout Modal -->
	<div id="previewWalletModal" class="modal fade previewWalletModal"  data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    			<div class="modal-content">
    				<div class="modal-header bg-primary">
						<h4 class="modal-title text-white"><i class="fa fa-keyboard-o"></i> Preview & Checkout</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true" class="text-white">&times;</span>
						</button>
    				</div>
					<form method="post" class="selectPayWallet" enctype="multipart/form-data">
    				<div class="modal-body">
					
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
								<label>Name</label>
								<input type="text" name="userName" value="<?php echo get_userfullname($pdo) ;  ?>" class="form-control" readonly="readonly"  />
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
								<label>Email</label>
								<input type="text" name="userEmail" value="<?php echo get_useremail($pdo) ; ?>" class="form-control" readonly="readonly"  />
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
								<label>Purpose</label>
								<input type="text" name="itemName" value="Add Credit Balance to Wallet" class="form-control" readonly="readonly" />
								</div>
							</div>
							<div class="col-lg-8">
								<div class="form-group">
								<label>Payment Method*</label>
								<select name="paymentMethod" class="form-control" required>
									<option value="">Choose Payment Method</option>
									<?php echo payment_method($pdo) ; ?>
								</select>
								</div>
							</div>
							<div class="col-lg-4">
								<div class="form-group">
								<label>Amount(USD $)</label>
								<input type="number" name="itemAmount" min="10" max="100" value="10" class="form-control" required="required" />
								</div>
							</div>
						</div>
					
    				</div> 
    				<div class="modal-footer">
						<input type="hidden" name="userId" value="<?php echo $_SESSION['user']['user_id'] ; ?>"  />
						<input type="hidden" name="btn_action" value="selectWalletPayment"  />
						<input type="submit" value="Proceed To Checkout" name="actionBtnWallet" class="actionBtnWallet btn btn-md btn-primary"  />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
					</form>
    			</div>
    		
    	</div>
    </div>
	
	<?php
	}
	?>