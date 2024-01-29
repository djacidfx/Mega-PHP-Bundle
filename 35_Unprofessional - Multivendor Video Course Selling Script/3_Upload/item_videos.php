<?php 
ob_start();
session_start();
include("backendboss/config/db.php") ; 
include("backendboss/controller/functions.php") ;
include("active_sidebar.php") ;
$itemId = filter_var($_GET['item_id'], FILTER_SANITIZE_NUMBER_INT) ;
checking_active_item($pdo,$itemId) ;
$username = get_username_by_itemid($pdo,$itemId) ;
$shortUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
$itemTitle = long_title_by_id($pdo,$itemId) ;
increase_active_item_view($pdo,$itemId) ;
$authorId = find_user_id_by_itemid($pdo,$itemId) ;
if(!empty($_SESSION['unprofessional']['id'])){
    $userId = $_SESSION['unprofessional']['id'] ;
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include("item_head.php") ; ?>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
        <?php include("navbar_index.php"); ?>
        <?php include("sidebar_index.php"); ?>
     <div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1 class="text-muted"><i class="fas fa-bookmark fa-lg"></i> <?php echo long_title_by_id($pdo,$itemId) ; ?></h1>
      </div>
      <div class="row">
            <div class="col-lg-8">
              <div class="card">
                <div class="card-header">
                  <h4><i class="fas fa-video"></i> Demo Video</h4>
                </div>
                <div class="card-body">
                    <?php echo active_itemdemovideo_by_id($pdo,$itemId); ?>
                </div>
              </div>
                <div class="card">
            <div class="card-header">
                <h4><i class="fas fa-pencil"></i> Description</h4>
            </div>
            <div class="card-body myPost">
                <?php echo active_itemdescription_by_id($pdo,$itemId); ?>
            </div>
            </div>
            </div>
            <div class="col-lg-4">
              <div class="card">
                <div class="card-header">
                  <h5 class="text-muted align-text-bottom"><i class="fas fa-shopping-cart fa-lg text-success"></i> <?php echo active_itemsales_by_id($pdo,$itemId) ; ?> Sales</h5>
                </div>
              </div>
             <div class="card mt-n4">
                <a href="<?php echo BASE_URL ; ?>comments/<?php echo $itemId ; ?>/<?php echo $shortUrlTitle ; ?>">
                    <div class="card-header">
                      <h5 class="text-info align-text-bottom"><i class="fas fa-comment fa-lg text-info"></i> <?php echo count_comments($pdo,$itemId) ; ?> Comments</h5>
                    </div>
                </a>
              </div>
              <div class="card mt-n4">
                <?php if(empty($_SESSION['unprofessional'])) { ?>
                  <a href="<?php echo BASE_URL ; ?>login">
                    <div class="card-header">
                     <h5 class="text-muted align-text-bottom"><i class="fas fa-heart fa-lg text-danger"></i> <?php echo count_loves($pdo,$itemId) ; ?> Love</h5>
                    </div>
                  </a>
                <?php } else { ?>
                  <?php if(check_loved_items($pdo,$itemId) > 0) { ?>
                  <span class="showlovedItem">
                      <a href="#!" class="unlovedItem" id="<?php echo $itemId ; ?>">
                          <div class="card-header">
                            <h5 class="text-muted align-text-bottom"><i class="fas fa-heart fa-lg text-danger"></i> <?php echo count_loves($pdo,$itemId) ; ?> Love</h5>
                          </div>
                      </a>
                  </span>
                  <span class="showunlovedItem"></span>
                  <?php } else { ?>
                  <span class="showunlovedItem">
                    <a href="#!" class="lovedItem" id="<?php echo $itemId ; ?>">
                      <div class="card-header">
                        <h5 class="text-muted align-text-bottom"><i class="fas fa-heart fa-lg faNewColor"></i> <?php echo count_loves($pdo,$itemId) ; ?> Love</h5>
                      </div>
                    </a>
                  </span>
                  <span class="showlovedItem"></span>
                <?php } } ?>
              </div>
              <div class="card mt-n4">
                <div class="card-header">
                    <div class="row">
                    <div class="col-lg-2">
                        <span class="align-bottom"><i class="fas fa-star fa-lg align-bottom text-warning"></i> </span>
                    </div>
                    <div class="col-lg-10">
                    <?php echo active_itemrating_star_by_id($pdo,$itemId) ; ?>
                    </div>
                    </div>
                </div>
              </div>
                <?php if(item_featured($pdo,$itemId) > 0) { ?>
            <div class="card mt-n4 bg-info text-success ">
                <div class="card-header align-bottom justify-content-center">
                  <h5 class=""><i class="fa fa-certificate"></i> Featured Item</h5>
                </div>
              </div>
                <?php } ?>
                <?php if(empty($_SESSION['unprofessional'])){ ?> 
                    <a href="<?php echo BASE_URL ; ?>login" class="btn btn-primary btn-block mt-n4 bigFont"><b>Buy Now $<?php echo find_activeitem_price($pdo,$itemId) ; ?></b></a>
                <?php } else { ?>
                    <?php if($authorId == $_SESSION['unprofessional']['id']) { ?> 
                    <a href="<?php echo BASE_URL ; ?>edititem/<?php echo $itemId ; ?>" class="btn btn-success btn-block mt-n4 bigFont"><b>Edit Item - $<?php echo find_activeitem_price($pdo,$itemId) ; ?></b></a>
                    <?php } else { ?>
                            <?php if(checking_user_purchased($pdo,$_SESSION['unprofessional']['id'],$itemId) > 0) { ?> 
                                    <a href="<?php echo BASE_URL ; ?>downloads" class="btn btn-success btn-block mt-n4 bigFont"><b>Go To Downloads</b></a>
                            <?php } else { ?> 
                                    <button class="viewPreview btn btn-primary btn-block mt-n4 bigFont"><b>Buy Now $<?php echo find_activeitem_price($pdo,$itemId) ; ?></b></button>
                            <?php } ?>
                        
                    <?php } ?>
                <?php } ?>
                <div class="card mt-4">
                    <div class="card-header justify-content-center">
                      <div class="row pb-2">
                        <div class="col-lg-12 ">
                          <div class="avatar-item mb-0">
                              <a href="<?php echo BASE_URL ; ?>user/<?php echo $username ; ?>"><img alt="image" src="<?php echo BASE_URL.get_author_profilepic_name_url($pdo,$authorId) ; ?>" class="img-fluid rounded-circle videoProfilePic"></a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-body p-3">
                        <a href="<?php echo BASE_URL ; ?>user/<?php echo $username ; ?>" class="btn btn-block btn-primary btn-md">View Author's Profile</a>
                    </div>
                </div>
                
              <div class="card mt-4">
                <div class="card-header">
                  <h5 class="text-success align-text-bottom"><i class="fas fa-trophy fa-lg "></i> Achievements</h5>
                </div>
                <div class="card-body p-3">
                  <?php echo get_membership_badge($pdo,$username) ; ?><?php echo get_power_elite_author_badge($pdo,$username) ; ?><?php echo get_elite_author_badge($pdo,$username)  ; ?><?php echo get_author_badge($pdo,$username) ; ?><?php echo get_authorlevel_badge($pdo,$username) ; ?><?php echo get_featuredfile_badge($pdo,$username) ; ?><?php echo get_trending_badge($pdo,$username) ; ?><?php echo get_uploader_king_badge($pdo,$username) ; ?><?php echo get_uploaderlevel_badge($pdo,$username)  ; ?><?php echo get_follower_rockstar_badge($pdo,$username) ; ?><?php echo get_followerlevel_badge($pdo,$username) ; ?><?php echo get_community_superstar_badge($pdo,$username) ; ?><?php echo get_counsellorlevel_badge($pdo,$username) ; ?><?php echo get_power_elite_buyer_badge($pdo,$username) ; ?><?php echo get_elite_buyer_badge($pdo,$username) ; ?><?php echo get_buyerlevel_badge($pdo,$username) ; ?>
                </div>
              </div>
            <div class="card mt-4">
                <div class="card-header p-0 justify-content-center mt-1">
                  <div class="row ml-1 text-center ">
                    <a href="http://www.facebook.com/share.php?u=<?php echo BASE_URL."video/".$itemId."/".$shortUrlTitle ; ?>" target="_blank" class="text-primary"><i class="fab fa-facebook-square fa-lg"></i></a>
                      <a href="https://twitter.com/share?url=<?php echo BASE_URL."video/".$itemId."/".$shortUrlTitle ; ?>&text=<?php echo $itemTitle ; ?>" target="_blank" class="text-info ml-3"><i class="fab fa-twitter-square fa-lg"></i></a>
                      <a href="https://wa.me/?text=<?php echo BASE_URL."video/".$itemId."/".$shortUrlTitle ; ?>" target="_blank" class="text-success ml-3"><i class="fab fa-whatsapp fa-lg"></i></a>
                  </div>
                </div>
            </div>
            </div>
          <div class="col-lg-8">
            
          </div>
          <div class="col-lg-4"></div>
          </div>
    </section>
</div>
    <?php include("common_footer.php") ; ?>
    </div>
</div>
<!-- Preview & Checkout Modal -->
	<div id="previewModal" class="modal fade previewModal"  data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    			<div class="modal-content">
    				<div class="modal-header bg-primary">
						<h4 class="modal-title text-white"><i class="fa fa-keyboard-o"></i> Preview & Checkout</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true" class="text-white">&times;</span>
						</button>
    				</div>
					<form method="post" class="selectPay" enctype="multipart/form-data">
    				<div class="modal-body">
					
						<div class="row">
							<div class="col-lg-6">
								<div class="form-group">
								<label>Name</label>
								<input type="text" name="userName" value="<?php echo user_fullname($pdo) ;  ?>" class="form-control" readonly="readonly"  />
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
								<label>Email</label>
								<input type="text" name="userEmail" value="<?php echo useremail_by_id($pdo,$userId) ; ?>" class="form-control" readonly="readonly"  />
								</div>
							</div>
							<div class="col-lg-12">
								<div class="form-group">
								<label>Item Name</label>
								<input type="text" name="itemName" value="<?php echo long_title_by_id($pdo,$itemId) ; ?>" class="form-control" readonly="readonly" />
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
								<label>Payment Method*</label>
								<select name="paymentMethod" class="form-control paymentMethod" data-status="<?php echo $itemId ; ?>" required>
									<option value="">Choose Payment Method</option>
									<?php echo payment_method($pdo) ; ?>
								</select>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="form-group">
								<label>Item Amount($)</label>
								<input type="text" name="itemAmount" value="<?php echo find_activeitem_price($pdo,$itemId) ; ?>" class="form-control itemAmount" readonly="readonly" />
								</div>
							</div>
                            <div class="col-lg-12">
                                <div class="remove-message"></div>
                            </div>
						</div>
					
    				</div> 
    				<div class="modal-footer">
						<input type="hidden" name="itemNumber" value="<?php echo $itemId ; ?>"  />
						<input type="hidden" name="userId" value="<?php echo $userId ; ?>"  />
						<input type="hidden" name="btn_action" value="selectPayment"  />
						<input type="submit" value="Proceed To Checkout" name="actionBtn" class="actionBtn btn btn-md btn-primary"  />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
					</form>
    			</div>
    		
    	</div>
    </div>
    <!-- Stripe Checkout Modal -->
	<div id="stripePayModal" class="modal fade stripePayModal"  data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    			<div class="modal-content">
    				<div class="modal-header bg-primary">
						<h4 class="modal-title text-white"><i class="fa fa-credit-card"></i> Pay via Stripe</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true" class="text-white">&times;</span>
						</button>
    				</div>
					<form action="<?php echo BASE_URL."stripemsg" ; ?>" method="post" class="stripePay" enctype="multipart/form-data" id="payment_form">
    				<div class="modal-body">
					
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
    				<div class="modal-footer">
						<input type="hidden" name="itemAmount" value="<?php echo find_activeitem_price($pdo,$itemId) ; ?>" />
						<input type="hidden" name="itemNumber" value="<?php echo $itemId ; ?>"  />
						<input type="hidden" name="userId" value="<?php echo $userId ; ?>"  />
						<input type="hidden" name="btn_action" value="selectPaymentStripe"  />
						<input type='hidden' name='currency_code' value='USD'> 
						<input type="submit" value="Pay $<?php echo find_activeitem_price($pdo,$itemId) ; ?>" name="stripepayactionBtn" class="stripepayactionBtn btn btn-md btn-primary"  />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
					</form>
    			</div>
    		
    	</div>
    </div>
    
    <!--Paypal Checkout Modal-->
	<div id="paypalPayModal" class="modal fade paypalPayModal"  data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    			<div class="modal-content">
    				<div class="modal-header bg-primary">
						<h4 class="modal-title text-white"><i class="fa fa-credit-card"></i> Pay via Paypal</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true" class="text-white">&times;</span>
						</button>
    				</div>
					<form action="<?php echo BASE_URL."paypalpay" ; ?>" method="post" enctype="multipart/form-data" >
    				<div class="modal-body">
					
						<h4 class="text-muted text-center">Reconfirm & Go to Paypal</h4>
					
    				</div> 
    				<div class="modal-footer">
						<input type="hidden" name="item_amount" value="<?php echo find_activeitem_price($pdo,$itemId) ; ?>" />
						<input type="hidden" name="item_number" value="<?php echo $itemId ; ?>"  />
						<input type="hidden" name="uid" value="<?php echo $userId ; ?>"  />
						<input type="hidden" name="cmd" value="_xclick" />
						<input type="hidden" name="no_note" value="1" /> 
						<input type="hidden" name="lc" value="UK" /> 
						<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynow_LG.gif:NonHostedGuest" /> 
						<input type="submit" value="Pay $<?php echo find_activeitem_price($pdo,$itemId) ; ?> via Paypal"  class="btn btn-md btn-primary"  />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
					</form>
    			</div>
    		
    	</div>
    </div>
    
    <!--Wallet Checkout Modal-->
	<div id="wPayModal" class="modal fade wPayModal"  data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    			<div class="modal-content">
    				<div class="modal-header bg-primary">
						<h4 class="modal-title text-white"><i class="fa fa-credit-card"></i> Pay via Wallet</h4>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true" class="text-white">&times;</span>
						</button>
    				</div>
					<form action="<?php echo BASE_URL."wpay" ; ?>" method="post" enctype="multipart/form-data" >
    				<div class="modal-body text-center">
					
						<h4 class="text-muted text-center">Reconfirm, $<?php echo find_activeitem_price($pdo,$itemId) ; ?> will be Deducted from Your Wallet</h4>
					
    				</div> 
    				<div class="modal-footer">
						<input type="hidden" name="item_amount" value="<?php echo find_activeitem_price($pdo,$itemId) ; ?>" />
						<input type="hidden" name="item_number" value="<?php echo $itemId ; ?>"  />
						<input type="hidden" name="Wallet_Purchase" value="Wallet"  />
						<input type="hidden" name="uid" value="<?php echo $userId ; ?>"  />
						<input type="submit" value="Pay $<?php echo find_activeitem_price($pdo,$itemId) ; ?> via Wallet"  class="btn btn-md btn-primary"  />
    					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
					</form>
    			</div>
    		
    	</div>
    </div>
  <?php include("item_js.php") ; ?>
  <?php include("footer_stripe.php") ; ?>
</body>
</html>