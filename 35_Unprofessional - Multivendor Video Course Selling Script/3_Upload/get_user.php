<?php include("header_session.php") ; ?>
<?php 
$nt = '2' ;
$username = filter_var($_GET['username'], FILTER_SANITIZE_STRING) ;
$webtitle = $username. " Profile";
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
                      <div class="profile-widget-item newHover " data-toggle="tooltip" data-placement="top" title="Loved Videos : <?php echo user_loveditems_by_username($pdo,$username) ; ?>">
                        <a href="<?php echo BASE_URL ; ?>loves/<?php echo $username ; ?>">
                        <div class="profile-widget-item-label newHoverElement"><i class="fas fa-heart"></i></div>
                        <div class="profile-widget-item-value newHoverElement"><?php echo user_loveditems_by_username($pdo,$username) ; ?></div>
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
                          <?php if(!empty($_SESSION['unprofessional'])) {  ?>
                          <div class="col-lg-12 text-lg-right mt-lg-4">
                              <?php if(($_SESSION['unprofessional']['id']) != $userId ){ ?>
                              <?php if(check_following($pdo,$userId) > 0){ ?>
                              <span class="followResult<?php echo $userId ; ?>"><button class="btn btn-sm btn-light unfollowUser" id="<?php echo $userId ; ?>">Unfollow</button></span>
                              <span class="unfollowResult<?php echo $userId ; ?>"></span>
                              <?php } else { ?>
                              <span class="unfollowResult<?php echo $userId ; ?>"><button class="btn btn-sm btn-primary followUser" id="<?php echo $userId ; ?>">Follow</button></span>
                              <span class="followResult<?php echo $userId ; ?>"></span>
                              <?php } ?>
                              
                              <?php } ?>
                          </div>
                          <?php } else { ?>
                          <div class="col-lg-12 text-lg-right mt-lg-4"><a href="<?php echo BASE_URL ; ?>login" class="btn btn-sm btn-primary">Follow</a></div> 
                          <?php } ?>
                          <div class="col-lg-6 p-lg-5 mt-lg-n3">
                              <div class="profile-widget-name"><i class="fas fa-trophy"></i> Achievements</div><hr>
                              <?php echo get_membership_badge($pdo,$username) ; ?><?php echo get_power_elite_author_badge($pdo,$username) ; ?><?php echo get_elite_author_badge($pdo,$username)  ; ?><?php echo get_author_badge($pdo,$username) ; ?><?php echo get_authorlevel_badge($pdo,$username) ; ?><?php echo get_featuredfile_badge($pdo,$username) ; ?><?php echo get_trending_badge($pdo,$username) ; ?><?php echo get_uploader_king_badge($pdo,$username) ; ?><?php echo get_uploaderlevel_badge($pdo,$username)  ; ?><?php echo get_follower_rockstar_badge($pdo,$username) ; ?><?php echo get_followerlevel_badge($pdo,$username) ; ?><?php echo get_community_superstar_badge($pdo,$username) ; ?><?php echo get_counsellorlevel_badge($pdo,$username) ; ?><?php echo get_power_elite_buyer_badge($pdo,$username) ; ?><?php echo get_elite_buyer_badge($pdo,$username) ; ?><?php echo get_buyerlevel_badge($pdo,$username) ; ?>
                              
                            <?php if(get_social_network($pdo,$username) > 0){?>
                              <div class="profile-widget-name mt-4"><i class="fas fa-share-square"></i> Social Networks</div><hr>
                          
                              <?php echo get_youtube_network($pdo,$username) ; ?><?php echo get_insta_network($pdo,$username) ; ?><?php echo get_fb_network($pdo,$username) ; ?><?php echo get_twitter_network($pdo,$username) ; ?><?php echo get_linkedin_network($pdo,$username) ; ?><?php echo get_behance_network($pdo,$username) ; ?><?php echo get_dribbble_network($pdo,$username) ; ?><?php echo get_vk_network($pdo,$username) ; ?>
                              
                          <?php } ?>
                              
                              
                          </div>
                          
                      <div class="col-lg-6 p-lg-5 text-break mt-lg-n3">
                          
                          <div class="profile-widget-name">About - <?php echo user_fullname_by_username($pdo,$username) ; ?><hr></div>
                          <?php echo nl2br(get_user_aboutus_by_username($pdo,$username)) ; ?>
                      </div>
                  </div>
                    </div>
                </div>
              </div>
        </div>
    </section>
</div>
<?php include("footer_main.php") ; ?>
