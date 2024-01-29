<?php
include("header.php") ;
if(!isset($_SESSION['user']['user_id'])){
	header("location: ".BASE_URL.""); 
}
if(check_user_verify_status($pdo) == 0) {
		header("location: ".BASE_URL."");
	}
?>
<link rel="stylesheet" href="<?php echo BASE_URL ; ?>css/profile.css">
<div class="page-content d-flex align-items-stretch minH mt-5">
	<div class="content-inner w-100">
		<div class="row mt-2" id="card-prof">
                <div class="col-md-3">
                    <div class="card hovercard">
                        <div class="cardheader"></div>
                        <div class="avatar">
                            <img alt="Profile" src="<?php echo BASE_URL ; ?>img/userprofile.png" class="img-fluid">
                        </div>
                        <div class="info">
                            <div class="title ">
                                <a href="#"><span class="nameChange"><?php echo get_userfullname($pdo) ;  ?></span></a>
                            </div>
                            <div class="desc"><span class="emailChange"><?php echo get_useremail($pdo) ; ?></span></div> 
							<div class="col-lg-12"> <a href="<?php echo BASE_URL."addcredit/" ; ?>" class="profileBtn btn btn-md btn-success bg-success text-white">Add Credit</a></div>
                            <hr>
                        </div>
                        <nav class="nav text-center prof-nav">
                            <ul  class="list-unstyled text-left">
								<li><a href="<?php echo BASE_URL."walletHistory/" ; ?>"<i class="fa fa-credit-card"></i> Credit Balance : $<?php echo user_wallet_amount($pdo) ; ?></a></li> 
                                <li><a href="<?php echo BASE_URL."downloads/" ; ?>"><i class="fa fa-download"></i> Downloads</a></li> 
                                <li><a href="<?php echo BASE_URL."purchases/" ; ?>"><i class="fa fa-history"></i> Payment History</a></li> 
                                <li><a href="<?php echo BASE_URL."loved/" ; ?>"><i class="fa fa-heart-o"></i> Loved Items</a></li> 
                                <li><a href="<?php echo BASE_URL."logout.php" ; ?>"><i class="fa fa-power-off"></i> Logout</a></li> 
                            </ul>
                        </nav>
                        <div class="bottom">
                            
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card hovercard">
                        <div class="tab" role="tabpanel"> 
                            <ul class="nav nav-tabs" role="tablist">
                              <li class="nav-item">
                                <a class="nav-link" href="#name" role="tab" data-toggle="tab"><span><i class="fa fa-pencil-square-o"></i></span> Name</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link active" href="#email" role="tab" data-toggle="tab"><span><i class="fa fa-envelope"></i></span> Email</a>
                              </li>
                              <li class="nav-item">
                                <a class="nav-link" href="#password" role="tab" data-toggle="tab"><span><i class="fa fa-lock"></i></span> Password</a>
                              </li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content tabs">
                              <div role="tabpanel" class="tab-pane fade" id="name">
							  <form method="post" class="name_validation" enctype="multipart/form-data">
                                    <div class="row mx-2">
                                        <div class="col-md-12 panel-heading">
                                            <h3 class="panel-title"><i class="fa fa-pencil-square"></i> Edit Name</h3><br>
                                        </div>
                                        <div class="col-md-6 ">
                                            <div class="form-group row">
                                                <label for="example-text-input" class="ml-3 col-form-label">Name</label>
                                                <div class="col-12">
                                                    <input class="form-control" type="text" value="<?php echo get_userfullname($pdo) ;  ?>" id="example-text-input" name="userName" maxlength="25" required>
                                                </div>
                                            </div> 
                                             
                                        </div>
										<div class="col-md-6 ">
                                            <div class="form-group row">
                                                <label for="example-text-input" class="ml-3 col-form-label">Password</label>
                                                <div class="col-12">
                                                    <input class="form-control userPassword" type="password"  id="example-text-input" name="userPassword" required>
                                                </div>
                                            </div> 
                                             
                                        </div>
										<div class="col-md-12 mt-2">
                                            <div class=" row justify-content-center">
											<div class="col-lg-12"><div class="remove-messages"></div></div>
											<div class="col-lg-5"></div>
											<div class="col-lg-2">
											<input type="hidden" name="name_submit_pr" value="SubmitName" />
												<input type="submit" value="Change Name" class="profileBtn btn btn-primary btn-sm text-white" >
											</div>
											<div class="col-lg-5"></div>
											</div>
											
										</div>
                                        
                                    </div>
							  </form> 
                              </div>
                              <div role="tabpanel" class="tab-pane fade  show active" id="email">
                                    <form method="post" class="email_validation" enctype="multipart/form-data">
                                    <div class="row mx-2">
                                        <div class="col-md-12 panel-heading">
                                            <h3 class="panel-title"><i class="fa fa-pencil-square"></i> Edit Email</h3><br>
                                        </div>
                                        <div class="col-md-6 ">
                                            <div class="form-group row">
                                                <label for="example-text-input" class="ml-3 col-form-label">Email</label>
                                                <div class="col-12">
                                                    <input class="form-control" type="email" value="<?php echo get_useremail($pdo) ;  ?>" id="example-text-input" name="newemail" maxlength="50" required>
                                                </div>
                                            </div> 
                                             
                                        </div>
										<div class="col-md-6 ">
                                            <div class="form-group row">
                                                <label for="example-text-input" class="ml-3 col-form-label">Password</label>
                                                <div class="col-12">
                                                    <input class="form-control passw" type="password"  id="example-text-input" name="passw" required>
                                                </div>
                                            </div> 
                                             
                                        </div>
										<div class="col-md-12 mt-2">
                                            <div class=" row justify-content-center">
											<div class="col-lg-12"><div class="remove-messages"></div></div>
											<div class="col-lg-5"></div>
											<div class="col-lg-2">
											<input type="hidden" name="email_submit_pr" value="Submit" />
												<input type="submit" value="Change Email" class="profileBtn btn btn-primary btn-sm text-white" >
											</div>
											<div class="col-lg-5"></div>
											</div>
											
										</div>
                                        
                                    </div>
							  </form>
                              </div>
                              <div role="tabpanel" class="tab-pane fade" id="password">
                                    <form method="post" class="password_validation" enctype="multipart/form-data">
                                    <div class="row mx-2">
                                        <div class="col-md-12 panel-heading">
                                            <h3 class="panel-title"><i class="fa fa-pencil-square"></i> Edit Password</h3><br>
                                        </div>
										<div class="col-md-4 ">
                                            <div class="form-group row">
                                                <label for="example-text-input" class="ml-3 col-form-label">Old Password*</label>
                                                <div class="col-12">
                                                    <input class="form-control" type="password"  id="example-text-input" name="oldpass" maxlength="50" required>
                                                </div>
                                            </div> 
                                             
                                        </div>
                                        <div class="col-md-4 ">
                                            <div class="form-group row">
                                                <label for="example-text-input" class="ml-3 col-form-label">New Password*</label>
                                                <div class="col-12">
                                                    <input class="form-control" type="password"  id="example-text-input" name="newpass" maxlength="50" required>
                                                </div>
                                            </div> 
                                             
                                        </div>
										<div class="col-md-4 ">
                                            <div class="form-group row">
                                                <label for="example-text-input" class="ml-3 col-form-label">Confirm New Password*</label>
                                                <div class="col-12">
                                                    <input class="form-control passw" type="text"  id="example-text-input" name="repass" maxlength="50" required autocomplete="off">
                                                </div>
                                            </div> 
                                             
                                        </div>
										<div class="col-md-12 mt-2">
                                            <div class=" row justify-content-center">
											<div class="col-lg-12 text-center">New Password must contain minimum 8 characters, 1 Uppercase character, 1 Lowercase character & 1 number.</div>
											<div class="col-lg-12"><div class="remove-messages"></div></div>
											<div class="col-lg-5"></div>
											<div class="col-lg-2 mt-2">
											<input type="hidden" name="pass_submit_pr" value="Submit" />
												<input type="submit" value="Change Password" class="profileBtn btn btn-primary btn-sm text-white" >
											</div>
											<div class="col-lg-5"></div>
											</div>
										</div>
                                        
                                    </div>
							  </form>
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
	</div>
</div> 
<?php 
include("footer_js.php") ; 
include("footer_stripe.php");
?>

 