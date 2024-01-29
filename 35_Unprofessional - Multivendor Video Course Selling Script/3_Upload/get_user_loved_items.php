<?php include("header_session.php") ; ?>
<?php 
$nt = '2' ;
$username = filter_var($_GET['username'], FILTER_SANITIZE_STRING) ;
$webtitle = $username. " Loved Videos";
$userId = userid_by_username($pdo,$username) ;
?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>

<?php include("sidebar_index.php"); ?>
<?php checking_userprofile($pdo,$username) ; ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      
      <div class="row mt-n2">
              <div class="col-12 col-md-12 col-lg-12">
                <div class="card profile-widget">
                  <div class="profile-widget-header">
                    <img alt="image" src="<?php echo BASE_URL.get_user_profilepic_name_url_username($pdo,$username) ; ?>" class="rounded-circle profile-widget-picture">
                    <div class="profile-widget-items">
                      <div class="profile-widget-item" data-toggle="tooltip" data-placement="top" title="Sales : <?php echo user_solditems_by_username($pdo,$username) ; ?>">
                        <div class="profile-widget-item-label"><i class="fas fa-shopping-cart"></i></div>
                        <div class="profile-widget-item-value"><?php echo user_solditems_by_username($pdo,$username) ; ?></div>
                      </div>
                      <div class="profile-widget-item newHover" data-toggle="tooltip" data-placement="top" title="Videos : <?php echo user_course_count($pdo,$username) ; ?>">
                        <a href="<?php echo BASE_URL ; ?>uservideos/<?php echo $username ; ?>">
                        <div class="profile-widget-item-label newHoverElement"><i class="fas fa-video"></i></div>
                        <div class="profile-widget-item-value newHoverElement"><?php echo user_course_count($pdo,$username) ; ?></div>
                        </a>
                      </div>
                      <div class="profile-widget-item newHover bg-info" data-toggle="tooltip" data-placement="top" title="Loved Videos : <?php echo user_loveditems_by_username($pdo,$username) ; ?>">
                        <a href="<?php echo BASE_URL ; ?>loves/<?php echo $username ; ?>">
                        <div class="profile-widget-item-label newHoverElement text-white"><i class="fas fa-heart"></i></div>
                        <div class="profile-widget-item-value newHoverElement text-white"><?php echo user_loveditems_by_username($pdo,$username) ; ?></div>
                        </a>
                      </div>
                      <div class="profile-widget-item newHover" data-toggle="tooltip" data-placement="top" title="Followers : <?php echo count_followers_by_username($pdo,$username) ; ?>" >
                        <a href="<?php echo BASE_URL ; ?>followers/<?php echo $username ; ?>">
                        <div class="profile-widget-item-label newHoverElement "><i class="fas fa-users"></i></div>
                        <div class="profile-widget-item-value newFollower newHoverElement "><?php echo count_followers_by_username($pdo,$username) ; ?></div>
                        </a>
                      </div>
                      <div class="profile-widget-item newHover" data-toggle="tooltip" data-placement="top" title="Following : <?php echo count_following_by_username($pdo,$username) ; ?>">
                        <a href="<?php echo BASE_URL ; ?>following/<?php echo $username ; ?>">
                        <div class="profile-widget-item-label newHoverElement"><i class="fas fa-recycle"></i></div>
                        <div class="profile-widget-item-value newHoverElement"><?php echo count_following_by_username($pdo,$username) ; ?></div>
                        </a>
                      </div>
                    </div>
                  </div>
                  <div class="profile-widget-description">
                      <div class="row mt-lg-n5" >
                          <div class="col-lg-12 text-center mt-lg-4">
                              <div class="col-lg-6 text-lg-left ml-lg-3">@<?php echo $username ; ?></div>
                              <div class="col-lg-6 float-lg-right mt-lg-n4">
                              <a href="<?php echo BASE_URL ; ?>user/<?php echo $username ; ?>" class="btn btn-sm btn-primary float-lg-right">Back to Profile</a>
                              </div>  
                          </div>
                      </div>
                  </div>
                    
                </div>
              </div>
        </div>
        
        <div class="row mt-2">
            <div class="col-12 col-md-12 col-lg-12">
                <?php echo grab_loved_items($pdo,$username); ?>
                <div class="jQueryMoreLovesItems"></div>
            </div>
        </div>
                
    </section>
</div>
<?php include("footer_main.php") ; ?>
