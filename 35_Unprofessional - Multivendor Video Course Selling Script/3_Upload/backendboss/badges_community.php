<?php include("header.php") ; ?>
<?php 
$communityBadges = "active" ; 
$badges = "active" ;
?>
<?php include("sidebar.php") ; ?>
<!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1 class="text-muted"><i class="fa fa-trophy"></i> Community Badges </h1>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <small>Community Badges Depends on number of Solved Problems on Forum . Note : Each Level must be Bigger than Previous Otherwise Badges not Showing Correct.</small>
                </div>
                <div class="card-body">
                    <form method="post" class="postCommunityBadges" enctype="multipart/form-data">
                        <div class="row">
                            
                            <div class="col-lg-3 mt-3">
                                <label>Counsellor Level 1 </label>
                                <input type="number" min="1" class="form-control" name="level_one" value="<?php echo get_community_level_requirement($pdo,1) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Counsellor Level 2 </label>
                                <input type="number" min="1" class="form-control" name="level_two" value="<?php echo get_community_level_requirement($pdo,2) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Counsellor Level 3 </label>
                                <input type="number" min="1" class="form-control" name="level_three" value="<?php echo get_community_level_requirement($pdo,3) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Counsellor Level 4 </label>
                                <input type="number" min="1" class="form-control" name="level_four" value="<?php echo get_community_level_requirement($pdo,4) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Counsellor Level 5 </label>
                                <input type="number" min="1" class="form-control" name="level_five" value="<?php echo get_community_level_requirement($pdo,5) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Counsellor Level 6 </label>
                                <input type="number" min="1" class="form-control" name="level_six" value="<?php echo get_community_level_requirement($pdo,6) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Counsellor Level 7 </label>
                                <input type="number" min="1" class="form-control" name="level_seven" value="<?php echo get_community_level_requirement($pdo,7) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Counsellor Level 8 </label>
                                <input type="number" min="1" class="form-control" name="level_eight" value="<?php echo get_community_level_requirement($pdo,8) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Counsellor Level 9 </label>
                                <input type="number" min="1" class="form-control" name="level_nine" value="<?php echo get_community_level_requirement($pdo,9) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Counsellor Level 10 </label>
                                <input type="number" min="1" class="form-control" name="level_ten" value="<?php echo get_community_level_requirement($pdo,10) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Counsellor Level 11 </label>
                                <input type="number" min="1" class="form-control" name="level_eleven" value="<?php echo get_community_level_requirement($pdo,11) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Counsellor Level 12 </label>
                                <input type="number" min="1" class="form-control" name="level_twelve" value="<?php echo get_community_level_requirement($pdo,12) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Counsellor Level 13 </label>
                                <input type="number" min="1" class="form-control" name="level_thirteen" value="<?php echo get_community_level_requirement($pdo,13) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Counsellor Level 14 </label>
                                <input type="number" min="1" class="form-control" name="level_fourteen" value="<?php echo get_community_level_requirement($pdo,14) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Counsellor Level 15 </label>
                                <input type="number" min="1" class="form-control" name="level_fifteen" value="<?php echo get_community_level_requirement($pdo,15) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Counsellor Level 16 </label>
                                <input type="number" min="1" class="form-control" name="level_sixteen" value="<?php echo get_community_level_requirement($pdo,16) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Community Superstar : On Level</label>
                                <input type="number" min="1" max="16" class="form-control" name="communitySuperstar" value="<?php echo get_community_superstar_level_requirement($pdo) ; ?>" required >
                            </div>
                            
                        </div>
                            <div class="row">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4  mt-3 text-center">
                                    <div class="remove-communitybadgemessages"></div>
                                    <input type="hidden" name="btn_action" value="SaveCommunityBadge" >
                                    <button type="submit" class="btn btn-primary btn-md">Save Community Badges</button>
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