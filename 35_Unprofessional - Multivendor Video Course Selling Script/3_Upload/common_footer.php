<?php
if(show_userpanel($pdo) == 0){
    header("location: ".BASE_URL."undermaintenance");
}
?>
<?php if(!empty($_SESSION['unprofessional'])){ ?>
    <?php if(check_user_registration_status($pdo) == 0) {  ?> 
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
						<small>You've <?php echo check_user_chance($pdo) ; ?> Chance to verify your account. After that You'll be Permanently Blocked.</small>
						</div>
						</div>
    				</div>
    				<div class="modal-body">
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="form-group">
									<label>Email*</label>
									<input type="text" name="email" id="email" class="form-control" readonly="readonly" required value="<?php echo useremail_by_id($pdo,$_SESSION['unprofessional']['id']) ; ?>" />
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
    					<input type="submit" name="action_sign" id="action_sign" class="btn btn-primary btn-sm" value="Verify OTP"  />
    				</form>
					<form method="post" class="resend_otpform">
						<input type="hidden" name="resend_email" value="Submit" />
						<input type="hidden" name="resendEmail" id="resendemail" value="<?php echo useremail_by_id($pdo,$_SESSION['unprofessional']['id']) ; ?>" >
						<input type="submit" name="action_resend" id="action_resend" class="btn btn-warning btn-sm" value="Resend OTP"  />
					</form>
    				</div>
    			</div>
    		
    	</div>
    </div>
    <?php } ?>
    <?php 
    $settingUrl = BASE_URL."settings" ;
    $settingUrl = remove_http($settingUrl) ;
    $hostSet = $_SERVER['SERVER_NAME']  . $_SERVER['REQUEST_URI'];
    if($hostSet != $settingUrl){
    ?>
        <?php if($soldCount != '0'){ ?>
            <?php if(empty(user_payout_email_for_admin($pdo,$_SESSION['unprofessional']['id']))){ ?>
                    <!-- Payout Email Reminder Modal -->
                <div id="reminderModal" class="modal fade reminderModal" data-backdrop="static" data-keyboard="false">
                    <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header border border-top-0 border-left-0 border-right-0">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h4 class="modal-title"><i class='fa fa-exclamation'></i> Payout Email Reminder </h4>
                                        </div>
                                    </div>                       
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <h5 class="text-danger"><i class='fa fa-exclamation'></i> Your Payout will not be processed until you've set your Payout Email.</h5>
                                        </div>
                                    </div>						
                                </div>


                                <div class="modal-footer">
                                    <a href="<?php echo BASE_URL ; ?>settings" class="btn btn-primary btn-sm">Go To Payout Email</a>
                                </div>
                            </div>
                    </div>
                </div>
            <?php } ?>
        <?php } ?>
    <?php } ?>
<?php } ?>
<footer class="main-footer  bg-white">
    <div class="row">
    <div class="col-lg-4 ">
      <h2><?php echo aboutus_name($pdo) ; ?></h2>
      <hr>
      <p><?php echo nl2br(get_aboutus_info($pdo)) ; ?></p> 
    </div>
    <div class="col-lg-4 ">
      <h2><?php echo quicklink_name($pdo) ; ?></h2>
      <hr>
     <?php 
		$checkSlug = check_slug_for_user($pdo) ;
        if($checkSlug > '0') {
    ?>
        <p><?php echo fetch_active_pages_foruser($pdo) ; ?></p>
	<?php
		}
	?>
    </div>
    <div class="col-lg-4 ">
        <h2>Follow Us</h2>
            <hr>
        <div class="row">
            
            <?php if(check_show_community_earning($pdo) > 0){ ?> 
            <div class="col-lg-6">
                <label>Sold Items</label>
                <h5><b class="text-dark"><?php echo count_communityitem_sold($pdo) ; ?></b></h5>
            </div>
            <div class="col-lg-6">
                <label>Community Earnings</label>
                <h5><b class="text-dark">$<?php echo grab_community_earning($pdo); ?></b></h5>
            </div>
            <?php } ?>
            <div class="col-lg-12 mt-3">
                <?php echo get_insta_url($pdo).get_fb_url($pdo).get_twitter_url($pdo).get_linkedin_url($pdo).get_behance_url($pdo).get_dribble_url($pdo).get_vk_url($pdo) ; ?>
            </div>
        </div>
        
    </div>
    <div class="col-lg-12 text-center">
        <p>Copyright &copy; <?php echo date("Y"); ?>&ensp;<?php echo admin_copyright_name($pdo) ; ?>. All Rights Reserved.</p>    
    </div>
    </div>
</footer>