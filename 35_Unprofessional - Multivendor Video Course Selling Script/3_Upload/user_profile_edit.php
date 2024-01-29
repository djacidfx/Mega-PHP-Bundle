<?php include("header_session.php") ; ?>
<?php $webtitle = "Edit Profile" ; ?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>
<?php  
$username = username_by_id($pdo,$_SESSION['unprofessional']['id']) ;
$nt = '1' ;
?>
<?php include("sidebar_index.php"); ?>
<?php echo check_user_logged_in($pdo) ; ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1 class="text-muted"><i class="fas fa-pencil fa-lg"></i> Edit Profile</h1>
      </div>
      <div class="row">
            <div class="col-lg-4">
              <div class="card">
                <div class="card-header">
                  <h4>Profile Picture [ 500px * 500px ]</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <?php echo get_user_profilepic($pdo); ?>
                        </div>
                        <div class="col-lg-12 mt-5">
                            <div class="prvw">
                                <label>Only (.jpg / .jpeg /.png) Allowed</label>
                                <div class="custom-file">
                                  <input type="file" class="custom-file-input" id="uploadProfileImage" name="uploadProfileImage" accept="image/x-png,image/jpeg" required>
                                  <label class="custom-file-label" for="customFile">Choose Profile Image</label>
                                </div>
                            </div>
                            <div class="remove-messagesprofile"></div>
                            <div class="col-lg-12 col-md-12 thumbprogress">
                                <div class="progress">
                                    <div class="progress-bar preview-bar bg-success"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                </div>
              </div>
            </div>
          
            <div class="col-lg-4">
              <div class="card">
                <div class="card-header">
                  <h4>About Yourself</h4>
                </div>
                <div class="card-body">
                    <form method="post" class="saveUserInfo" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12 mt-3">
                                <label>Max 500 Characters</label>
                                <textarea name="aboutinfo" id="aboutinfo" class="form-control textareaVeryLarge" rows="8" maxlength="500" required ><?php echo get_user_aboutus_by_username($pdo,$username) ; ?></textarea>
                            </div>
                            <div class="col-lg-12 mt-4">
                                <div class="remove-messagesUserInfo"></div>
                                <input type="hidden" name="btn_action" value="SaveUserAboutUs" />
                                <button type="submit" name="submit_info" class="btn btn-block btn-primary">Save Info</button>
                            </div>
                         </div>
                    </form>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card">
                <div class="card-header">
                  <h4>Social Network Profiles</h4>
                </div>
                <div class="card-body">
                    <form method="post" class="saveSocialNetwork" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12 mt-n3">
                                <input type="url" name="youtubeProfile" class="form-control" placeholder="Youtube Profile Link" value="<?php echo get_youtube_network_url($pdo,$username) ; ?>">
                                <input type="url" name="instaProfile" class="form-control mt-1" placeholder="Instagram Profile Link" value="<?php echo get_insta_network_url($pdo,$username) ; ?>">
                                <input type="url" name="fbProfile" class="form-control mt-1" placeholder="Facebook Profile Link" value="<?php echo get_fb_network_url($pdo,$username) ; ?>">
                                <input type="url" name="twitterProfile" class="form-control mt-1" placeholder="Twitter Profile Link" value="<?php echo get_twitter_network_url($pdo,$username) ; ?>">
                                <input type="url" name="linkedinProfile" class="form-control mt-1" placeholder="LinkedIn Profile Link" value="<?php echo get_linkedin_network_url($pdo,$username) ; ?>">
                                <input type="url" name="behanceProfile" class="form-control mt-1" placeholder="Behance Profile Link" value="<?php echo get_behance_network_url($pdo,$username) ; ?>">
                                <input type="url" name="dribbbleProfile" class="form-control mt-1" placeholder="Dribbble Profile Link" value="<?php echo get_dribbble_network_url($pdo,$username) ; ?>">
                                <input type="url" name="vkProfile" class="form-control mt-1" placeholder="VK Profile Link" value="<?php echo get_vk_network_url($pdo,$username) ; ?>">
                            </div>
                            <div class="col-lg-12 mt-2">
                                <div class="remove-messagesSocialNetwork"></div>
                                <input type="hidden" name="btn_action" value="SaveUserNetwork" />
                                <button type="submit" name="submit_info" class="btn btn-block btn-primary mt-1">Save Social Network</button>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card">
                <div class="card-header">
                  <h4>Username</h4>
                </div>
                <div class="card-body">
                    <form method="post" class="saveUsername" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12">
                                <label>Only Small Alphabets & Number allowed.</label>
                                <input type="text" name="username" class="form-control text-lowercase" id="username" value="<?php echo $username ; ?>" maxlength="30" placeholder="Unique Username at least 4 chars" required>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <div class="username-messagess"></div>
                                <input type="hidden" name="btn_action" value="Save_Username" />
                                <button type="submit" name="submit_info" class="usernamebtn btn btn-block btn-primary mt-1" disabled>Change Username</button>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          
          <div class="col-lg-4">
              <div class="card">
                <div class="card-header">
                  <h4>Fullname</h4>
                </div>
                <div class="card-body">
                    <form method="post" class="saveUserFullname" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12">
                                <label>Max 25 Characters</label>
                                <input type="text" name="userfullname" class="form-control"  value="<?php echo user_fullname($pdo) ; ?>" maxlength="25" placeholder="Fullname" required>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <div class="userfullname-messagess"></div>
                                <input type="hidden" name="btn_action" value="Save_Userfullname" />
                                <button type="submit" name="submit_info" class="btn btn-block btn-primary mt-1">Change Name</button>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          
          <div class="col-lg-4">
              <div class="card">
                <div class="card-header">
                  <h4>Email</h4>
                </div>
                <div class="card-body">
                    <form method="post" class="changeUserEmail" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-12">
                                <label>Email</label>
                                <input type="email" name="useremail" class="form-control"  value="<?php echo  useremail_by_id($pdo,$_SESSION['unprofessional']['id']) ; ?>" maxlength="50" placeholder="Email" required>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <div class="useremail-messagess"></div>
                                <input type="hidden" name="btn_action" value="Save_UserEmail" />
                                <button type="submit" name="submit_info" class="btn btn-block btn-primary mt-1">Change Email</button>
                            </div>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          
          
          
          </div>
    </section>
</div>
<div id="newEmailModal" class="modal fade " data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    		<form method="post" id="newemail_otpform" class="newemail_otpform">
    			<div class="modal-content">
    				<div class="modal-header">
						<h4 class="modal-title"><i class='fa fa-eye'></i> Verify New Email OTP</h4>
    				</div>
    				<div class="modal-body">
						<div class="row">
							<div class="col-lg-12 col-md-12">
								<div class="form-group">
									<label>New Email*</label>
									<input type="email" name="newemail" id="newemail" class="form-control" readonly="readonly" required />
								</div>
								<div class="form-group">
									<label>OTP*</label>
									<input type="password" name="otp" id="otp" class="form-control" required maxlength="4" />
								</div>
							</div>
						</div>						
					</div>
					
					
    				<div class="modal-footer">
                        <input type="hidden" name="btn_action" value="Change_UserNewEmail" />
    					<input type="submit" name="action_fp" id="action_fp" class="btn btn-primary" value="Verify OTP"  />
    					
    				</div>
    			</div>
    		</form>
    	</div>
    </div>
<?php include("footer_main.php") ; ?>