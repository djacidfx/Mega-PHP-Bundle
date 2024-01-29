<?php include("header_session.php") ; ?>
<?php $webtitle = "Email & Settings" ; ?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>
<?php
$nt = '1' ;
$username = username_by_id($pdo,$_SESSION['unprofessional']['id']) ;
$authorWantEmail = want_email_on_item_sales($pdo,$_SESSION['unprofessional']['id']) ;
$emailComment = want_email_on_item_comment($pdo,$_SESSION['unprofessional']['id']) ; 
$itemUpdateApprove = want_email_on_item_update_approved($pdo,$_SESSION['unprofessional']['id']) ;
$itemUpdateReject = want_email_on_item_update_reject($pdo,$_SESSION['unprofessional']['id']) ;
$authorCommentReply = want_email_on_author_reply($pdo,$_SESSION['unprofessional']['id']) ;
$userCommentReply = want_email_on_commentuser_reply($pdo,$_SESSION['unprofessional']['id']) ;
$authorNewRating = want_email_on_item_rating($pdo,$_SESSION['unprofessional']['id']) ;
$authorItemLove = want_email_on_item_love($pdo,$_SESSION['unprofessional']['id']) ;
$authorPayoutRelease = want_email_on_payout_release($pdo,$_SESSION['unprofessional']['id']) ;
$authorForumTopic = want_email_on_forum_topic($pdo,$_SESSION['unprofessional']['id']) ;
?>
<?php include("sidebar_index.php"); ?>
<?php echo check_user_logged_in($pdo) ; ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1 class="text-muted"><i class="fas fa-envelope fa-lg"></i> Email & Settings</h1>
      </div>
    <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>These Emails Cannot Be Turned OFF.</h4>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" class="userEmailSetting">
                <div class="row">
                    <div class="col-lg-4 mt-3">
                        <label>When Item is Hard Reject</label>
                        <select class="form-control" disabled>
                            <option value="1">Turn On</option>
                        </select>
                    </div>
                    <div class="col-lg-4 mt-3">
                        <label>When Item is Soft Reject</label>
                        <select class="form-control" disabled>
                            <option value="1">Turn On</option>
                        </select>
                    </div>
                    <div class="col-lg-4 mt-3">
                        <label>When Item is Approved</label>
                        <select class="form-control" disabled>
                            <option value="1">Turn On</option>
                        </select>
                    </div>
                    <div class="col-lg-4 mt-3">
                        <label>When Purchase is Successful</label>
                        <select class="form-control" disabled>
                            <option value="1">Turn On</option>
                        </select>
                    </div>
                    <div class="col-lg-4 mt-3">
                        <label>When Refund Decision taken by Reviewer</label>
                        <select class="form-control" disabled>
                            <option value="1">Turn On</option>
                        </select>
                    </div>
                    <div class="col-lg-4 mt-3">
                        <label>When User wants Refund</label>
                        <select class="form-control" disabled>
                            <option value="1">Turn On</option>
                        </select>
                    </div>
                    <div class="col-lg-4 mt-3">
                        <label>When Use OTP for Forgot Password</label>
                        <select class="form-control" disabled>
                            <option value="1">Turn On</option>
                        </select>
                    </div>
                    <div class="col-lg-4 mt-3">
                        <label>When Use OTP for Change Email</label>
                        <select class="form-control" disabled>
                            <option value="1">Turn On</option>
                        </select>
                    </div>
                    <div class="col-lg-4 mt-3">
                        <label>When Use OTP for SignUP Verification</label>
                        <select class="form-control" disabled>
                            <option value="1">Turn On</option>
                        </select>
                    </div>
                </div>
                </form>
            </div>
          </div>
        
        <div class="card">
            <div class="card-header">
              <h4>You can Turn ON / OFF Receiving Email</h4>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" class="userEmailSetting">
                <div class="row">
                    <div class="col-lg-4 mt-3">
                        <label>When New Sale of Your Item</label>
                        <select class="form-control" name="emailSale">
                            <option value="1" <?php if($authorWantEmail == '1') { ?>selected="selected" <?php } ?> >Turn On</option>
                            <option value="0" <?php if($authorWantEmail == '0') { ?>selected="selected" <?php } ?>>Turn Off</option>
                        </select>
                    </div>
                    <div class="col-lg-4 mt-3">
                        <label>When Item Update is Approved</label>
                        <select class="form-control" name="emailUpdateApprove">
                            <option value="1" <?php if($itemUpdateApprove == '1') { ?>selected="selected" <?php } ?> >Turn On</option>
                            <option value="0" <?php if($itemUpdateApprove == '0') { ?>selected="selected" <?php } ?>>Turn Off</option>
                        </select>
                    </div>
                    <div class="col-lg-4 mt-3">
                        <label>When Item Update is Rejected</label>
                        <select class="form-control" name="emailUpdateReject">
                            <option value="1" <?php if($itemUpdateReject == '1') { ?>selected="selected" <?php } ?> >Turn On</option>
                            <option value="0" <?php if($itemUpdateReject == '0') { ?>selected="selected" <?php } ?>>Turn Off</option>
                        </select>
                    </div>
                    <div class="col-lg-4 mt-3">
                        <label>When Comment on Your Item</label>
                        <select class="form-control" name="emailComment">
                            <option value="1" <?php if($emailComment == '1') { ?>selected="selected" <?php } ?> >Turn On</option>
                            <option value="0" <?php if($emailComment == '0') { ?>selected="selected" <?php } ?>>Turn Off</option>
                        </select>
                    </div>
                    <div class="col-lg-4 mt-3">
                        <label>When Author Reply to Your Comment</label>
                        <select class="form-control" name="authorCommentReply">
                            <option value="1" <?php if($authorCommentReply == '1') { ?>selected="selected" <?php } ?> >Turn On</option>
                            <option value="0" <?php if($authorCommentReply == '0') { ?>selected="selected" <?php } ?>>Turn Off</option>
                        </select>
                    </div>
                    <div class="col-lg-4 mt-3">
                        <label>When User Reply to Your Comment</label>
                        <select class="form-control" name="userCommentReply">
                            <option value="1" <?php if($userCommentReply == '1') { ?>selected="selected" <?php } ?> >Turn On</option>
                            <option value="0" <?php if($userCommentReply == '0') { ?>selected="selected" <?php } ?>>Turn Off</option>
                        </select>
                    </div>
                    <div class="col-lg-4 mt-3">
                        <label>When New Rating on Your Item</label>
                        <select class="form-control" name="newRating">
                            <option value="1" <?php if($authorNewRating == '1') { ?>selected="selected" <?php } ?> >Turn On</option>
                            <option value="0" <?php if($authorNewRating == '0') { ?>selected="selected" <?php } ?>>Turn Off</option>
                        </select>
                    </div>
                    <div class="col-lg-4 mt-3">
                        <label>When User Loves Your Item</label>
                        <select class="form-control" name="newLove">
                            <option value="1" <?php if($authorItemLove == '1') { ?>selected="selected" <?php } ?> >Turn On</option>
                            <option value="0" <?php if($authorItemLove == '0') { ?>selected="selected" <?php } ?>>Turn Off</option>
                        </select>
                    </div>
                    <div class="col-lg-4 mt-3">
                        <label>When Your Payout Release</label>
                        <select class="form-control" name="payoutRelease">
                            <option value="1" <?php if($authorPayoutRelease == '1') { ?>selected="selected" <?php } ?> >Turn On</option>
                            <option value="0" <?php if($authorPayoutRelease == '0') { ?>selected="selected" <?php } ?>>Turn Off</option>
                        </select>
                    </div>
                    <div class="col-lg-4 mt-3">
                        <label>When User Reply on Your Forum Topic</label>
                        <select class="form-control" name="forumTopic">
                            <option value="1" <?php if($authorForumTopic == '1') { ?>selected="selected" <?php } ?> >Turn On</option>
                            <option value="0" <?php if($authorForumTopic == '0') { ?>selected="selected" <?php } ?>>Turn Off</option>
                        </select>
                    </div>
                    <div class="col-lg-4 mt-3">
                        <label>Click to Save Settings</label>
                        <input type="hidden" name="btn_action" value="saveMyEmailSetting">
                        <button type="submit" class="btn btn-primary btn-md btn-block mt-1" tabindex="4">Save Email Settings</button>
                    </div>
                    <div class="col-lg-4 mt-3">
                        <label>Click to Turn On All Emails</label>
                        <a href="#!" class="btn btn-success btn-md btn-block mt-1 turnOnAll" tabindex="4">Turn On All Emails</a>
                    </div>
                    <div class="col-lg-4 mt-3"></div>
                    <div class="col-lg-4 mt-3"><div class="remove-messages"></div></div>
                    <div class="col-lg-4 mt-3"></div>
                        
                    
                </div>
                </form>
            </div>
          </div>
            
        <div class="card">
            <div class="card-header">
              <h4>Your Paypal Email where Payout will be Send. We'll Send Payout of Net <?php echo grab_payouts_date($pdo) ; ?> of Each Month & Minimum Payout should be $<?php echo grab_minimum_payout($pdo) ; ?></h4>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" class="userPayoutEmail">
                <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4 mt-3">
                    <input type="email" name="payoutEmail" class="form-control" required placeholder="Paypal Email" value="<?php echo user_payout_email($pdo) ; ?>" maxlength="80" >
                    <input type="hidden" name="btn_action" value="saveMyPayoutEmail">
                    <div class="remove-payoutmessages"></div>
                    <button type="submit" class="btn btn-primary btn-md btn-block mt-3" tabindex="4">Save Payout Email</button></div>
                    <div class="col-lg-4"></div>
                </div>
                </form>
            </div>
        </div>
            
        <div class="card">
            <div class="card-header">
              <h4>Change Password [ Note : New Password should be at least 8 Characters, 1 Uppercase, 1 Lowercase & 1 Number ]</h4>
            </div>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data" class="changeUserPassword">
                <div class="row">
                    <div class="col-lg-4"></div>
                    <div class="col-lg-4 mt-3">
                    
                        <input class="form-control" type="password"  id="example-text-input" name="oldpass" maxlength="50" placeholder="Old Password*" required>
                        <input class="form-control mt-1" type="password"  id="example-text-input" name="newpass" maxlength="50" placeholder="New Password*" required>
                        <input class="form-control passw mt-1" type="text"  id="example-text-input" name="repass" maxlength="50" placeholder="Reconfirm New Password*" required autocomplete="off">
                        
                    <input type="hidden" name="btn_action" value="changeMyPassword">
                    <div class="remove-passwordmessages"></div>
                    <button type="submit" class="btn btn-primary btn-md btn-block mt-3" tabindex="4">Change Password</button></div>
                    <div class="col-lg-4"></div>
                </div>
                </form>
            </div>
        </div>
            
        </div>
    </div>
              
    </section>
</div>
<?php include("footer_main.php") ; ?>