<?php include("header.php") ; ?>
<?php 
$settings = "active" ; 
$mainSettings = "active" ;
$com = "";
$defaultLoad = get_limit_default($pdo) ;
$onLoad = get_limit_onload($pdo) ;
?>
<?php include("sidebar.php") ; ?>
<!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1 class="text-muted"><i class="fa fa-cog"></i> Main Settings </h1>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>Please Be careful. This is the Main Setting which will affect the whole website.</h4>              
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" class="admin_settings">
                    <div class="row">
                        <div class="col-lg-4 mt-3">
                            <label>Admin Name* <small>(Label of Email Inbox, Like CodeDaddy)</small></label>
                            <input class="form-control" type="text"  id="example-text-input" name="adminName" maxlength="50" placeholder="Admin Name" value="<?php echo admin_name($pdo) ; ?>" required>
                        </div>
                        <div class="col-lg-4 mt-3">
                            <label>Quick Link Name* <small>(Shows in Footer, Like - Quick Links)</small></label>
                            <input class="form-control" type="text"  id="example-text-input" name="quickLinkName" maxlength="20" placeholder="Quick Link Name" value="<?php echo quicklink_name($pdo) ; ?>" required>
                        </div> 
                        <div class="col-lg-4 mt-3">
                            <label>About Us Name* <small>(Shows in Footer, Like - About Us)</small></label>
                            <input class="form-control" type="text"  id="example-text-input" name="aboutusName" maxlength="25" placeholder="About Us Name" value="<?php echo aboutus_name($pdo) ; ?>" required>
                        </div>
                        <div class="col-lg-4 mt-3">
                            <label>Copyright Name* <small>(Shows in Footer, Like Company Name)</small></label>
                            <input class="form-control" type="text"  id="example-text-input" name="copyrightName" maxlength="50" placeholder="Copyright Name" value="<?php echo admin_copyright_name($pdo) ; ?>" required>
                        </div>
                        <div class="col-lg-4 mt-3">
                            <label>Default Load*<small>(Shows Without Load More Button)</small></label>
                            <select name="default_load" class="form-control" required>
                                <option value="3" <?php if($defaultLoad == '3'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>3</option>
                                <option value="6" <?php if($defaultLoad == '6'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>6</option>
                                <option value="9" <?php if($defaultLoad == '9'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>9</option>
                                <option value="12" <?php if($defaultLoad == '12'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>12</option>
                                <option value="15" <?php if($defaultLoad == '15'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>15</option>
                            </select>
                        </div>
                        <div class="col-lg-4 mt-3">
                            <label>On Load*<small>(When Load More Button Pressed)</small></label>
                            <select name="on_load" class="form-control" required>
                                <option value="3" <?php if($onLoad == '3'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>3</option>
                                <option value="6" <?php if($onLoad == '6'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>6</option>
                                <option value="9" <?php if($onLoad == '9'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>9</option>
                                <option value="12" <?php if($onLoad == '12'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>12</option>
                                <option value="15" <?php if($onLoad == '15'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>15</option>
                            </select>
                        </div>
                        <div class="col-lg-4 mt-3">
                            <label>Commission % <small>(Take from Authors*)</small></label>
                            <input class="form-control" type="number"  id="example-text-input" name="commission" min="1"  max="99" placeholder="Select Commission" value="<?php echo admin_commission_forsettings($pdo) ; ?>" required>
                        </div>
                        <div class="col-lg-4 mt-3">
                            <label>Minimum Wallet Recharge Amt* (USD $)</label>
                            <input class="form-control" type="number"  id="example-text-input" name="minwallet" min="1" value="<?php echo find_min_wallet($pdo) ; ?>" required>
                        </div>
                        <div class="col-lg-4 mt-3">
                            <label>Maximum Wallet Recharge Amt* (USD $)</small></label>
                            <input class="form-control" type="number"  id="example-text-input" name="maxwallet" min="1"  max="999"  value="<?php echo find_max_wallet($pdo) ; ?>" required>
                        </div>
                        <div class="col-lg-4 mt-3">
                            <label>Show Community Earnings in Footer*</label>
                            <select name="show_community" class="form-control" required>
                                <option value="1" <?php if(check_show_community_earning($pdo) == '1'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>Yes</option>
                                <option value="0" <?php if(check_show_community_earning($pdo) == '0'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>No</option>
                            </select>
                        </div>
                        <div class="col-lg-4 mt-3">
                            <label>Max Refund Day* <small>(Also Author Decision Time)</small></label>
                            <input class="form-control" type="number"  id="example-text-input" name="maxrefund" min="1"  value="<?php echo find_max_refund_day($pdo) ; ?>" required>
                        </div>
                        <div class="col-lg-4 mt-3">
                            <label>No. of Chances to Verify SignUp OTP</label>
                            <input class="form-control" type="number"  id="example-text-input" name="otpchances" min="1" max="9"  value="<?php echo admin_user_chances($pdo) ; ?>" required>
                        </div>
                        <div class="col-lg-4 mt-3">
                            <label>Turn On / Off Stripe Payments*</label>
                            <select name="stripe" class="form-control" required>
                                <option value="1" <?php if(payment_stripeon($pdo) == '1'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>Turn On</option>
                                <option value="0" <?php if(payment_stripeon($pdo) == '0'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>Turn Off</option>
                            </select>
                        </div>
                        <div class="col-lg-4 mt-3">
                            <label>Turn On / Off Paypal Payments*</label>
                            <select name="paypal" class="form-control" required>
                                <option value="1" <?php if(payment_paypalon($pdo) == '1'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>Turn On</option>
                                <option value="0" <?php if(payment_paypalon($pdo) == '0'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>Turn Off</option>
                            </select>
                        </div>
                        <div class="col-lg-4 mt-3">
                            <label>Send Payout Day*</label>
                            <input class="form-control" type="number"  id="example-text-input" name="payoutday" min="1" max="31"  value="<?php echo grab_payouts_date($pdo) ; ?>" required>
                        </div>
                        <div class="col-lg-4 mt-3">
                            <label>Turn On / Off User Panel*</label>
                            <select name="userpanel" class="form-control" required>
                                <option value="1" <?php if(show_userpanel($pdo) == '1'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>No</option>
                                <option value="0" <?php if(show_userpanel($pdo) == '0'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>Yes</option>
                            </select>
                        </div>
                        <div class="col-lg-12 mt-3">
                            <label> User Panel Turned OFF Message* <small>(Keep Short & Descriptive within 200 Character.)</small>&ensp;<a href="<?php echo ADMIN_URL ; ?>demomaintenance">Check Demo Maintenance Link</a></label>
                            <textarea name="panelmsg" class="form-control textareaLarge" maxlength="200" required><?php echo show_userpanel_msg($pdo); ?></textarea>
                        </div>
                        <div class="col-lg-12 mt-3">
                            <label> About Us Info* <small>(Shows in Footer, Example - Company Short Description 200 Character.)</small></label>
                            <textarea name="aboutUsInfo" class="form-control textareaLarge" maxlength="200" required><?php echo get_aboutus_info($pdo); ?></textarea>
                        </div>
                        <div class="col-lg-4 mt-3">
                            <label>PayPal IPN URL* <small>(Paste it in Paypal)</small></label>
                            <input type="text" class="form-control" readonly value="<?php echo BASE_URL ; ?>paypalverify" >
                        </div>
                        <div class="col-lg-4 mt-3">
                            <label>PayPal Success URL* <small>(Paste it in Paypal)</small></label>
                            <input type="text" class="form-control" readonly value="<?php echo BASE_URL ; ?>paypalsuccess" >
                        </div>
                        <div class="col-lg-4 mt-3">
                            <label>PayPal Cancel URL* <small>(No need to paste it)</small></label>
                            <input type="text" class="form-control" readonly value="<?php echo BASE_URL ; ?>" >
                        </div>
                        <div class="col-lg-4 mt-3"></div>
                        <div class="col-lg-4 mt-3">
                            <div class="remove-messages"></div>
                             <input type="hidden" name="btn_action" value="saveMainSettings">
                            <button type="submit" class="btn btn-primary btn-md btn-block mt-3" tabindex="4">Save Main Settings</button>
                        </div>
                        <div class="col-lg-4 mt-3"></div>
                        
                    </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </section>
    </div>

<?php include("footer.php") ; ?>