<?php include("header.php") ; ?>
<?php 
$followerBadges = "active" ; 
$badges = "active" ;
?>
<?php include("sidebar.php") ; ?>
<!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1 class="text-muted"><i class="fa fa-trophy"></i> Follower Badges </h1>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <small>Follower Badges Depends on number of Followers. Note : Each Level must be Bigger than Previous Otherwise Badges not Showing Correct.</small>
                </div>
                <div class="card-body">
                    <form method="post" class="postFollowerBadges" enctype="multipart/form-data">
                        <div class="row">
                            
                            <div class="col-lg-3 mt-3">
                                <label>Follower Level 1 : Followers</label>
                                <input type="number" min="1" class="form-control" name="level_one" value="<?php echo get_follower_level_requirement($pdo,1) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Follower Level 2 : Followers</label>
                                <input type="number" min="1" class="form-control" name="level_two" value="<?php echo get_follower_level_requirement($pdo,2) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Follower Level 3 : Followers</label>
                                <input type="number" min="1" class="form-control" name="level_three" value="<?php echo get_follower_level_requirement($pdo,3) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Follower Level 4 : Followers</label>
                                <input type="number" min="1" class="form-control" name="level_four" value="<?php echo get_follower_level_requirement($pdo,4) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Follower Level 5 : Followers</label>
                                <input type="number" min="1" class="form-control" name="level_five" value="<?php echo get_follower_level_requirement($pdo,5) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Follower Level 6 : Followers</label>
                                <input type="number" min="1" class="form-control" name="level_six" value="<?php echo get_follower_level_requirement($pdo,6) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Follower Level 7 : Followers</label>
                                <input type="number" min="1" class="form-control" name="level_seven" value="<?php echo get_follower_level_requirement($pdo,7) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Follower Level 8 : Followers</label>
                                <input type="number" min="1" class="form-control" name="level_eight" value="<?php echo get_follower_level_requirement($pdo,8) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Follower Level 9 : Followers</label>
                                <input type="number" min="1" class="form-control" name="level_nine" value="<?php echo get_follower_level_requirement($pdo,9) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Follower Level 10 : Followers</label>
                                <input type="number" min="1" class="form-control" name="level_ten" value="<?php echo get_follower_level_requirement($pdo,10) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Follower Level 11 : Followers</label>
                                <input type="number" min="1" class="form-control" name="level_eleven" value="<?php echo get_follower_level_requirement($pdo,11) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Follower Level 12 : Followers</label>
                                <input type="number" min="1" class="form-control" name="level_twelve" value="<?php echo get_follower_level_requirement($pdo,12) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Follower Level 13 : Followers</label>
                                <input type="number" min="1" class="form-control" name="level_thirteen" value="<?php echo get_follower_level_requirement($pdo,13) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Follower Level 14 : Followers</label>
                                <input type="number" min="1" class="form-control" name="level_fourteen" value="<?php echo get_follower_level_requirement($pdo,14) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Follower Level 15 : Followers</label>
                                <input type="number" min="1" class="form-control" name="level_fifteen" value="<?php echo get_follower_level_requirement($pdo,15) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Follower Level 16 : Followers</label>
                                <input type="number" min="1" class="form-control" name="level_sixteen" value="<?php echo get_follower_level_requirement($pdo,16) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Rockstar : Achieved Follower Level</label>
                                <input type="number" min="1" max="16" class="form-control" name="rockstar" value="<?php echo get_follower_rockstar_level_requirement($pdo) ; ?>" required >
                            </div>
                            
                        </div>
                            <div class="row">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4  mt-3 text-center">
                                    <div class="remove-followerbadgemessages"></div>
                                    <input type="hidden" name="btn_action" value="SaveFollowerBadge" >
                                    <button type="submit" class="btn btn-primary btn-md">Save Follower Badges</button>
                                </div>
                                <div class="col-lg-4"></div>
                            </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
 </section>
    </div>
<?php include("footer.php") ; ?>