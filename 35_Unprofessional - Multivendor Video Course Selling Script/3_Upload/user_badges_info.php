<?php include("header_session.php") ; ?>
<?php $webtitle = "Badges" ; ?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>
<?php 
$badges = "active" ; 
$dashboard = "active" ;
$nt = '1' ;
?>
<?php include("sidebar_index.php"); ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
          <div class="row">
            <div class="col-lg-12"><h1 class="text-primary"><i class="fas fa-trophy fa-lg"></i> Badges</h1></div>
            <div class="col-lg-12 mt-1"><h6>We Always Respect Your Work & Time as an Author as well as Buyer.</h6></div>
          </div>
      </div>
      <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header justify-content-center">
                  <h4>Membership Badges</h4>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-lg-3">
                            <img src="<?php echo BASE_URL ; ?>badges/member_new.png" class="img-fluid w-50">
                            <p class="mt-2">User who has completed 1 Year Membership.</p>
                        </div>
                        <div class="col-lg-3">
                            <img src="<?php echo BASE_URL ; ?>badges/member_2.png" class="img-fluid w-50">
                            <p class="mt-2">User who has completed 2 Year Membership.</p>
                        </div>
                        <div class="col-lg-3">
                            <img src="<?php echo BASE_URL ; ?>badges/member_3.png" class="img-fluid w-50">
                            <p class="mt-2">User who has completed 3 Year Membership.</p>
                        </div>
                        <div class="col-lg-3">
                            <img src="<?php echo BASE_URL ; ?>badges/member_4.png" class="img-fluid w-50">
                            <p class="mt-2">User who has less than 4 Year Membership.</p>
                        </div>
                        <div class="col-lg-3">
                            <img src="<?php echo BASE_URL ; ?>badges/member_5.png" class="img-fluid w-50">
                            <p class="mt-2">User who has completed 5 Year Membership.</p>
                        </div>
                        <div class="col-lg-3">
                            <img src="<?php echo BASE_URL ; ?>badges/member_6.png" class="img-fluid w-50">
                            <p class="mt-2">User who has completed 6 Year Membership.</p>
                        </div>
                        <div class="col-lg-3">
                            <img src="<?php echo BASE_URL ; ?>badges/member_7.png" class="img-fluid w-50">
                            <p class="mt-2">User who has completed 7 Year Membership.</p>
                        </div>
                        <div class="col-lg-3">
                            <img src="<?php echo BASE_URL ; ?>badges/member_8.png" class="img-fluid w-50">
                            <p class="mt-2">User who has completed 8 Year Membership.</p>
                        </div>
                        <div class="col-lg-3">
                            <img src="<?php echo BASE_URL ; ?>badges/member_9.png" class="img-fluid w-50">
                            <p class="mt-2">User who has completed 9 Year Membership.</p>
                        </div>
                        <div class="col-lg-3">
                            <img src="<?php echo BASE_URL ; ?>badges/member_10.png" class="img-fluid w-50">
                            <p class="mt-2">User who has completed 10+ Year Membership.</p>
                        </div>
                    </div>
                </div>
              </div>
                
                <div class="card">
                    <div class="card-header justify-content-center">
                      <h4>Author Badges</h4>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/author_badge.png" class="img-fluid w-50">
                                <p class="mt-2">User who has approved at least 1 Video.</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/author_level_1.png" class="img-fluid w-50">
                                <p class="mt-2">Author Level 1 : Sold more than $<?php echo get_author_level_requirement($pdo,1) ; ?>+ worth of Items</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/author_level_2.png" class="img-fluid w-50">
                                <p class="mt-2">Author Level 2 : Sold more than $<?php echo get_author_level_requirement($pdo,2) ; ?>+ worth of Items</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/author_level_3.png" class="img-fluid w-50">
                                <p class="mt-2">Author Level 3 : Sold more than $<?php echo get_author_level_requirement($pdo,3) ; ?>+ worth of Items</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/author_level_4.png" class="img-fluid w-50">
                                <p class="mt-2">Author Level 4 : Sold more than $<?php echo get_author_level_requirement($pdo,4) ; ?>+ worth of Items</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/author_level_5.png" class="img-fluid w-50">
                                <p class="mt-2">Author Level 5 : Sold more than $<?php echo get_author_level_requirement($pdo,5) ; ?>+ worth of Items</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/author_level_6.png" class="img-fluid w-50">
                                <p class="mt-2">Author Level 6 : Sold more than $<?php echo get_author_level_requirement($pdo,6) ; ?>+ worth of Items</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/author_level_7.png" class="img-fluid w-50">
                                <p class="mt-2">Author Level 7 : Sold more than $<?php echo get_author_level_requirement($pdo,7) ; ?>+ worth of Items</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/author_level_8.png" class="img-fluid w-50">
                                <p class="mt-2">Author Level 8 : Sold more than $<?php echo get_author_level_requirement($pdo,8) ; ?>+ worth of Items</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/author_level_9.png" class="img-fluid w-50">
                                <p class="mt-2">Author Level 9 : Sold more than $<?php echo get_author_level_requirement($pdo,9) ; ?>+ worth of Items</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/author_level_10.png" class="img-fluid w-50">
                                <p class="mt-2">Author Level 10 : Sold more than $<?php echo get_author_level_requirement($pdo,10) ; ?>+ worth of Items</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/author_level_11.png" class="img-fluid w-50">
                                <p class="mt-2">Author Level 11 : Sold more than $<?php echo get_author_level_requirement($pdo,11) ; ?>+ worth of Items</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/author_level_12.png" class="img-fluid w-50">
                                <p class="mt-2">Author Level 12 : Sold more than $<?php echo get_author_level_requirement($pdo,12) ; ?>+ worth of Items</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/author_level_13.png" class="img-fluid w-50">
                                <p class="mt-2">Author Level 13 : Sold more than $<?php echo get_author_level_requirement($pdo,13) ; ?>+ worth of Items</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/author_level_14.png" class="img-fluid w-50">
                                <p class="mt-2">Author Level 14 : Sold more than $<?php echo get_author_level_requirement($pdo,14) ; ?>+ worth of Items</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/author_level_15.png" class="img-fluid w-50">
                                <p class="mt-2">Author Level 15 : Sold more than $<?php echo get_author_level_requirement($pdo,15) ; ?>+ worth of Items</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/author_level_16.png" class="img-fluid w-50">
                                <p class="mt-2">Author Level 16 : Sold more than $<?php echo get_author_level_requirement($pdo,16) ; ?>+ worth of Items</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/featured_badge.png" class="img-fluid w-50">
                                <p class="mt-2">Featured Item : Had qualified for Featured Item</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/trending_badge.png" class="img-fluid w-50">
                                <p class="mt-2">Trendsetter : Had an Item that was Trending</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/elite_badge.png" class="img-fluid w-50">
                                <p class="mt-2">Elite Author : Who Achieved <?php echo get_elite_level_requirement($pdo) ; ?>th Author Level</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/power_elite_badge.png" class="img-fluid w-50">
                                <p class="mt-2">Power Elite Author : Who Achieved <?php echo get_power_elite_level_requirement($pdo) ; ?>th Author Level</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/uploader_level_1.png" class="img-fluid w-50">
                                <p class="mt-2">Uploader Level 1 : Had Uploaded <?php echo get_uploader_level_requirement($pdo,1) ; ?> Approved Video</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/uploader_level_2.png" class="img-fluid w-50">
                                <p class="mt-2">Uploader Level 2 : Had Uploaded <?php echo get_uploader_level_requirement($pdo,2) ; ?> Approved Videos</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/uploader_level_3.png" class="img-fluid w-50">
                                <p class="mt-2">Uploader Level 3 : Had Uploaded <?php echo get_uploader_level_requirement($pdo,3) ; ?> Approved Videos</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/uploader_level_4.png" class="img-fluid w-50">
                                <p class="mt-2">Uploader Level 4 : Had Uploaded <?php echo get_uploader_level_requirement($pdo,4) ; ?> Approved Videos</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/uploader_level_5.png" class="img-fluid w-50">
                                <p class="mt-2">Uploader Level 5 : Had Uploaded <?php echo get_uploader_level_requirement($pdo,5) ; ?> Approved Videos</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/uploader_level_6.png" class="img-fluid w-50">
                                <p class="mt-2">Uploader Level 6 : Had Uploaded <?php echo get_uploader_level_requirement($pdo,6) ; ?> Approved Videos</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/uploader_level_7.png" class="img-fluid w-50">
                                <p class="mt-2">Uploader Level 7 : Had Uploaded <?php echo get_uploader_level_requirement($pdo,7) ; ?> Approved Videos</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/uploader_level_8.png" class="img-fluid w-50">
                                <p class="mt-2">Uploader Level 8 : Had Uploaded <?php echo get_uploader_level_requirement($pdo,8) ; ?> Approved Videos</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/uploader_level_9.png" class="img-fluid w-50">
                                <p class="mt-2">Uploader Level 9 : Had Uploaded <?php echo get_uploader_level_requirement($pdo,9) ; ?> Approved Videos</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/uploader_level_10.png" class="img-fluid w-50">
                                <p class="mt-2">Uploader Level 10 : Had Uploaded <?php echo get_uploader_level_requirement($pdo,10) ; ?> Approved Videos</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/uploader_level_11.png" class="img-fluid w-50">
                                <p class="mt-2">Uploader Level 11 : Had Uploaded <?php echo get_uploader_level_requirement($pdo,11) ; ?> Approved Videos</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/uploader_level_12.png" class="img-fluid w-50">
                                <p class="mt-2">Uploader Level 12 : Had Uploaded <?php echo get_uploader_level_requirement($pdo,12) ; ?> Approved Videos</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/uploader_level_13.png" class="img-fluid w-50">
                                <p class="mt-2">Uploader Level 13 : Had Uploaded <?php echo get_uploader_level_requirement($pdo,13) ; ?> Approved Videos</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/uploader_level_14.png" class="img-fluid w-50">
                                <p class="mt-2">Uploader Level 14 : Had Uploaded <?php echo get_uploader_level_requirement($pdo,14) ; ?> Approved Videos</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/uploader_level_15.png" class="img-fluid w-50">
                                <p class="mt-2">Uploader Level 15 : Had Uploaded <?php echo get_uploader_level_requirement($pdo,15) ; ?> Approved Videos</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/uploader_level_16.png" class="img-fluid w-50">
                                <p class="mt-2">Uploader Level 16 : Had Uploaded <?php echo get_uploader_level_requirement($pdo,16) ; ?> Approved Videos</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/uploader_king.png" class="img-fluid w-50">
                                <p class="mt-2">Uploader King : Had Achieved Uploader Level <?php echo get_uploader_king_level_requirement($pdo) ; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header justify-content-center">
                      <h4>Follower Badges</h4>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/follower_level_1.png" class="img-fluid w-50">
                                <p class="mt-2">Follower Level 1 : Has more than <?php echo get_follower_level_requirement($pdo,1) ; ?>+ Followers</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/follower_level_2.png" class="img-fluid w-50">
                                <p class="mt-2">Follower Level 2 : Has more than <?php echo get_follower_level_requirement($pdo,2) ; ?>+ Followers</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/follower_level_3.png" class="img-fluid w-50">
                                <p class="mt-2">Follower Level 3 : Has more than <?php echo get_follower_level_requirement($pdo,3) ; ?>+ Followers</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/follower_level_4.png" class="img-fluid w-50">
                                <p class="mt-2">Follower Level 4 : Has more than <?php echo get_follower_level_requirement($pdo,4) ; ?>+ Followers</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/follower_level_5.png" class="img-fluid w-50">
                                <p class="mt-2">Follower Level 5 : Has more than <?php echo get_follower_level_requirement($pdo,5) ; ?>+ Followers</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/follower_level_6.png" class="img-fluid w-50">
                                <p class="mt-2">Follower Level 6 : Has more than <?php echo get_follower_level_requirement($pdo,6) ; ?>+ Followers</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/follower_level_7.png" class="img-fluid w-50">
                                <p class="mt-2">Follower Level 7 : Has more than <?php echo get_follower_level_requirement($pdo,7) ; ?>+ Followers</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/follower_level_8.png" class="img-fluid w-50">
                                <p class="mt-2">Follower Level 8 : Has more than <?php echo get_follower_level_requirement($pdo,8) ; ?>+ Followers</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/follower_level_9.png" class="img-fluid w-50">
                                <p class="mt-2">Follower Level 9 : Has more than <?php echo get_follower_level_requirement($pdo,9) ; ?>+ Followers</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/follower_level_10.png" class="img-fluid w-50">
                                <p class="mt-2">Follower Level 10 : Has more than <?php echo get_follower_level_requirement($pdo,10) ; ?>+ Followers</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/follower_level_11.png" class="img-fluid w-50">
                                <p class="mt-2">Follower Level 11 : Has more than <?php echo get_follower_level_requirement($pdo,11) ; ?>+ Followers</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/follower_level_12.png" class="img-fluid w-50">
                                <p class="mt-2">Follower Level 12 : Has more than <?php echo get_follower_level_requirement($pdo,12) ; ?>+ Followers</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/follower_level_13.png" class="img-fluid w-50">
                                <p class="mt-2">Follower Level 13 : Has more than <?php echo get_follower_level_requirement($pdo,13) ; ?>+ Followers</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/follower_level_14.png" class="img-fluid w-50">
                                <p class="mt-2">Follower Level 14 : Has more than <?php echo get_follower_level_requirement($pdo,14) ; ?>+ Followers</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/follower_level_15.png" class="img-fluid w-50">
                                <p class="mt-2">Follower Level 15 : Has more than <?php echo get_follower_level_requirement($pdo,15) ; ?>+ Followers</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/follower_level_16.png" class="img-fluid w-50">
                                <p class="mt-2">Follower Level 16 : Has more than <?php echo get_follower_level_requirement($pdo,16) ; ?>+ Followers</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/follower_rockstar.png" class="img-fluid w-50">
                                <p class="mt-2">Rockstar : Had Achieved Follower Level <?php echo get_follower_rockstar_level_requirement($pdo) ; ?></p>
                            </div>
                            
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header justify-content-center">
                      <h4>Community Badges</h4>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/counsellor_level_1.png" class="img-fluid w-50">
                                <p class="mt-2">Counsellor Level 1 : Has Solved <?php echo get_community_level_requirement($pdo,1) ; ?>+ Problems on Forum</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/counsellor_level_2.png" class="img-fluid w-50">
                                <p class="mt-2">Counsellor Level 2 : Has Solved <?php echo get_community_level_requirement($pdo,2) ; ?>+ Problems on Forum</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/counsellor_level_3.png" class="img-fluid w-50">
                                <p class="mt-2">Counsellor Level 3 : Has Solved <?php echo get_community_level_requirement($pdo,3) ; ?>+ Problems on Forum</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/counsellor_level_4.png" class="img-fluid w-50">
                                <p class="mt-2">Counsellor Level 4 : Has Solved <?php echo get_community_level_requirement($pdo,4) ; ?>+ Problems on Forum</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/counsellor_level_5.png" class="img-fluid w-50">
                                <p class="mt-2">Counsellor Level 5 : Has Solved <?php echo get_community_level_requirement($pdo,5) ; ?>+ Problems on Forum</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/counsellor_level_6.png" class="img-fluid w-50">
                                <p class="mt-2">Counsellor Level 6 : Has Solved <?php echo get_community_level_requirement($pdo,6) ; ?>+ Problems on Forum</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/counsellor_level_7.png" class="img-fluid w-50">
                                <p class="mt-2">Counsellor Level 7 : Has Solved <?php echo get_community_level_requirement($pdo,7) ; ?>+ Problems on Forum</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/counsellor_level_8.png" class="img-fluid w-50">
                                <p class="mt-2">Counsellor Level 8 : Has Solved <?php echo get_community_level_requirement($pdo,8) ; ?>+ Problems on Forum</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/counsellor_level_9.png" class="img-fluid w-50">
                                <p class="mt-2">Counsellor Level 9 : Has Solved <?php echo get_community_level_requirement($pdo,9) ; ?>+ Problems on Forum</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/counsellor_level_10.png" class="img-fluid w-50">
                                <p class="mt-2">Counsellor Level 10 : Has Solved <?php echo get_community_level_requirement($pdo,10) ; ?>+ Problems on Forum</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/counsellor_level_11.png" class="img-fluid w-50">
                                <p class="mt-2">Counsellor Level 11 : Has Solved <?php echo get_community_level_requirement($pdo,11) ; ?>+ Problems on Forum</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/counsellor_level_12.png" class="img-fluid w-50">
                                <p class="mt-2">Counsellor Level 12 : Has Solved <?php echo get_community_level_requirement($pdo,12) ; ?>+ Problems on Forum</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/counsellor_level_13.png" class="img-fluid w-50">
                                <p class="mt-2">Counsellor Level 13 : Has Solved <?php echo get_community_level_requirement($pdo,13) ; ?>+ Problems on Forum</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/counsellor_level_14.png" class="img-fluid w-50">
                                <p class="mt-2">Counsellor Level 14 : Has Solved <?php echo get_community_level_requirement($pdo,14) ; ?>+ Problems on Forum</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/counsellor_level_15.png" class="img-fluid w-50">
                                <p class="mt-2">Counsellor Level 15 : Has Solved <?php echo get_community_level_requirement($pdo,15) ; ?>+ Problems on Forum</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/counsellor_level_16.png" class="img-fluid w-50">
                                <p class="mt-2">Counsellor Level 16 : Has Solved <?php echo get_community_level_requirement($pdo,16) ; ?>+ Problems on Forum</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/community_superstar.png" class="img-fluid w-50">
                                <p class="mt-2">Community Superstar : Had Achieved Cousellor Level <?php echo get_community_superstar_level_requirement($pdo) ; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header justify-content-center">
                      <h4>Buyer Badges</h4>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/buyer_level_1.png" class="img-fluid w-50">
                                <p class="mt-2">Buyer Level 1 : Had Purchased <?php echo get_buyer_level_requirement($pdo,1) ; ?>+ Items</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/buyer_level_2.png" class="img-fluid w-50">
                                <p class="mt-2">Buyer Level 2 : Had Purchased <?php echo get_buyer_level_requirement($pdo,2) ; ?>+ Items</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/buyer_level_3.png" class="img-fluid w-50">
                                <p class="mt-2">Buyer Level 3 : Had Purchased <?php echo get_buyer_level_requirement($pdo,3) ; ?>+ Items</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/buyer_level_4.png" class="img-fluid w-50">
                                <p class="mt-2">Buyer Level 4 : Had Purchased <?php echo get_buyer_level_requirement($pdo,4) ; ?>+ Items</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/buyer_level_5.png" class="img-fluid w-50">
                                <p class="mt-2">Buyer Level 5 : Had Purchased <?php echo get_buyer_level_requirement($pdo,5) ; ?>+ Items</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/buyer_level_6.png" class="img-fluid w-50">
                                <p class="mt-2">Buyer Level 6 : Had Purchased <?php echo get_buyer_level_requirement($pdo,6) ; ?>+ Items</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/buyer_level_7.png" class="img-fluid w-50">
                                <p class="mt-2">Buyer Level 7 : Had Purchased <?php echo get_buyer_level_requirement($pdo,7) ; ?>+ Items</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/buyer_level_8.png" class="img-fluid w-50">
                                <p class="mt-2">Buyer Level 8 : Had Purchased <?php echo get_buyer_level_requirement($pdo,8) ; ?>+ Items</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/buyer_level_9.png" class="img-fluid w-50">
                                <p class="mt-2">Buyer Level 9 : Had Purchased <?php echo get_buyer_level_requirement($pdo,9) ; ?>+ Items</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/buyer_level_10.png" class="img-fluid w-50">
                                <p class="mt-2">Buyer Level 10 : Had Purchased <?php echo get_buyer_level_requirement($pdo,10) ; ?>+ Items</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/buyer_level_11.png" class="img-fluid w-50">
                                <p class="mt-2">Buyer Level 11 : Had Purchased <?php echo get_buyer_level_requirement($pdo,11) ; ?>+ Items</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/buyer_level_12.png" class="img-fluid w-50">
                                <p class="mt-2">Buyer Level 12 : Had Purchased <?php echo get_buyer_level_requirement($pdo,12) ; ?>+ Items</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/buyer_level_13.png" class="img-fluid w-50">
                                <p class="mt-2">Buyer Level 13 : Had Purchased <?php echo get_buyer_level_requirement($pdo,13) ; ?>+ Items</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/buyer_level_14.png" class="img-fluid w-50">
                                <p class="mt-2">Buyer Level 14 : Had Purchased <?php echo get_buyer_level_requirement($pdo,14) ; ?>+ Items</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/buyer_level_15.png" class="img-fluid w-50">
                                <p class="mt-2">Buyer Level 15 : Had Purchased <?php echo get_buyer_level_requirement($pdo,15) ; ?>+ Items</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/buyer_level_16.png" class="img-fluid w-50">
                                <p class="mt-2">Buyer Level 16 : Had Purchased <?php echo get_buyer_level_requirement($pdo,16) ; ?>+ Items</p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/elite_buyer.png" class="img-fluid w-50">
                                <p class="mt-2">Elite Buyer : Had Achieved Buyer Level <?php echo get_elite_buyer_level_requirement($pdo) ; ?> </p>
                            </div>
                            <div class="col-lg-3">
                                <img src="<?php echo BASE_URL ; ?>badges/power_elite_buyer.png" class="img-fluid w-50">
                                <p class="mt-2">Power Elite Buyer : Had Achieved Buyer Level <?php echo get_power_elite_buyer_level_requirement($pdo) ; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
          </div>
    </section>
</div>
<?php include("footer_main.php") ; ?>