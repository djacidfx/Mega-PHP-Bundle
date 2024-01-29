<?php include("header.php") ; ?>
<?php 
$authorBadges = "active" ; 
$badges = "active" ;
?>
<?php include("sidebar.php") ; ?>
<!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1 class="text-muted"><i class="fa fa-trophy"></i> Author Badges </h1>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <small>Author Badges Depends on Item Sold Price in USD($). Note : Each Level must be Bigger than Previous Otherwise Badges not Showing Correct.</small>
                </div>
                <div class="card-body">
                    <form method="post" class="postAuthorBadges" enctype="multipart/form-data">
                        <div class="row">
                            
                            <div class="col-lg-3 mt-3">
                                <label>Author Level 1 : Sold Item Price($)</label>
                                <input type="number" min="1" class="form-control" name="level_one" value="<?php echo get_author_level_requirement($pdo,1) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Author Level 2 : Sold Item Price($)</label>
                                <input type="number" min="1" class="form-control" name="level_two" value="<?php echo get_author_level_requirement($pdo,2) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Author Level 3 : Sold Item Price($)</label>
                                <input type="number" min="1" class="form-control" name="level_three" value="<?php echo get_author_level_requirement($pdo,3) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Author Level 4 : Sold Item Price($)</label>
                                <input type="number" min="1" class="form-control" name="level_four" value="<?php echo get_author_level_requirement($pdo,4) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Author Level 5 : Sold Item Price($)</label>
                                <input type="number" min="1" class="form-control" name="level_five" value="<?php echo get_author_level_requirement($pdo,5) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Author Level 6 : Sold Item Price($)</label>
                                <input type="number" min="1" class="form-control" name="level_six" value="<?php echo get_author_level_requirement($pdo,6) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Author Level 7 : Sold Item Price($)</label>
                                <input type="number" min="1" class="form-control" name="level_seven" value="<?php echo get_author_level_requirement($pdo,7) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Author Level 8 : Sold Item Price($)</label>
                                <input type="number" min="1" class="form-control" name="level_eight" value="<?php echo get_author_level_requirement($pdo,8) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Author Level 9 : Sold Item Price($)</label>
                                <input type="number" min="1" class="form-control" name="level_nine" value="<?php echo get_author_level_requirement($pdo,9) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Author Level 10 : Sold Item Price($)</label>
                                <input type="number" min="1" class="form-control" name="level_ten" value="<?php echo get_author_level_requirement($pdo,10) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Author Level 11 : Sold Item Price($)</label>
                                <input type="number" min="1" class="form-control" name="level_eleven" value="<?php echo get_author_level_requirement($pdo,11) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Author Level 12 : Sold Item Price($)</label>
                                <input type="number" min="1" class="form-control" name="level_twelve" value="<?php echo get_author_level_requirement($pdo,12) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Author Level 13 : Sold Item Price($)</label>
                                <input type="number" min="1" class="form-control" name="level_thirteen" value="<?php echo get_author_level_requirement($pdo,13) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Author Level 14 : Sold Item Price($)</label>
                                <input type="number" min="1" class="form-control" name="level_fourteen" value="<?php echo get_author_level_requirement($pdo,14) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Author Level 15 : Sold Item Price($)</label>
                                <input type="number" min="1" class="form-control" name="level_fifteen" value="<?php echo get_author_level_requirement($pdo,15) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Author Level 16 : Sold Item Price($)</label>
                                <input type="number" min="1" class="form-control" name="level_sixteen" value="<?php echo get_author_level_requirement($pdo,16) ; ?>" required >
                            </div>
                            
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4  mt-3 text-center">
                                    <div class="remove-authorbadgemessages"></div>
                                    <input type="hidden" name="btn_action" value="SaveAuthorBadge" >
                                    <button type="submit" class="btn btn-primary btn-md">Save Author Level Badges</button>
                                </div>
                                <div class="col-lg-4"></div>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
            
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <small>Uploader Badges Depends on Item Approved. Note : Each Level must be Bigger than Previous Otherwise Badges not Showing Correct.</small>
                </div>
                <div class="card-body">
                    <form method="post" class="postAuthorUploaderBadges" enctype="multipart/form-data">
                        <div class="row">
                            
                            <div class="col-lg-3 mt-3">
                                <label>Uploader Level 1 : Approved Item</label>
                                <input type="number" min="1" class="form-control" name="level_one" value="<?php echo get_uploader_level_requirement($pdo,1) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Uploader Level 2 : Approved Item</label>
                                <input type="number" min="1" class="form-control" name="level_two" value="<?php echo get_uploader_level_requirement($pdo,2) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Uploader Level 3 : Approved Item</label>
                                <input type="number" min="1" class="form-control" name="level_three" value="<?php echo get_uploader_level_requirement($pdo,3) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Uploader Level 4 : Approved Item</label>
                                <input type="number" min="1" class="form-control" name="level_four" value="<?php echo get_uploader_level_requirement($pdo,4) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Uploader Level 5 : Approved Item</label>
                                <input type="number" min="1" class="form-control" name="level_five" value="<?php echo get_uploader_level_requirement($pdo,5) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Uploader Level 6 : Approved Item</label>
                                <input type="number" min="1" class="form-control" name="level_six" value="<?php echo get_uploader_level_requirement($pdo,6) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Uploader Level 7 : Approved Item</label>
                                <input type="number" min="1" class="form-control" name="level_seven" value="<?php echo get_uploader_level_requirement($pdo,7) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Uploader Level 8 : Approved Item</label>
                                <input type="number" min="1" class="form-control" name="level_eight" value="<?php echo get_uploader_level_requirement($pdo,8) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Uploader Level 9 : Approved Item</label>
                                <input type="number" min="1" class="form-control" name="level_nine" value="<?php echo get_uploader_level_requirement($pdo,9) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Uploader Level 10 : Approved Item</label>
                                <input type="number" min="1" class="form-control" name="level_ten" value="<?php echo get_uploader_level_requirement($pdo,10) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Uploader Level 11 : Approved Item</label>
                                <input type="number" min="1" class="form-control" name="level_eleven" value="<?php echo get_uploader_level_requirement($pdo,11) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Uploader Level 12 : Approved Item</label>
                                <input type="number" min="1" class="form-control" name="level_twelve" value="<?php echo get_uploader_level_requirement($pdo,12) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Uploader Level 13 : Approved Item</label>
                                <input type="number" min="1" class="form-control" name="level_thirteen" value="<?php echo get_uploader_level_requirement($pdo,13) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Uploader Level 14 : Approved Item</label>
                                <input type="number" min="1" class="form-control" name="level_fourteen" value="<?php echo get_uploader_level_requirement($pdo,14) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Uploader Level 15 : Approved Item</label>
                                <input type="number" min="1" class="form-control" name="level_fifteen" value="<?php echo get_uploader_level_requirement($pdo,15) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Uploader Level 16 : Approved Item</label>
                                <input type="number" min="1" class="form-control" name="level_sixteen" value="<?php echo get_uploader_level_requirement($pdo,16) ; ?>" required >
                            </div>
                            
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4  mt-3 text-center">
                                    <div class="remove-uploaderbadgemessages"></div>
                                    <input type="hidden" name="btn_action" value="SaveAuthorUploaderBadge" >
                                    <button type="submit" class="btn btn-primary btn-md">Save Uploader Level Badges</button>
                                </div>
                                <div class="col-lg-4"></div>
                        </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
            
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <small>Elite Author, Power Elite Author & Uploader King Badges depends on which Level Achieved.</small>
                </div>
                <div class="card-body">
                    <form method="post" class="postAuthorEliteBadges" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-lg-4">
                                <label>Elite Author : Author Level Achieved</label>
                                <input type="number" min="1" max="16" name="eliteAuthor" class="form-control" value="<?php echo get_elite_level_requirement($pdo) ; ?>" >
                            </div>
                            <div class="col-lg-4">
                                <label>Power Elite Author : Author Level Achieved</label>
                                <input type="number" min="1" max="16" name="powereliteAuthor" class="form-control" value="<?php echo get_power_elite_level_requirement($pdo) ; ?>" >
                            </div>
                            <div class="col-lg-4">
                                <label>Uploader King : Uploader Level Achieved</label>
                                <input type="number" min="1" max="16" name="uploaderKing" class="form-control" value="<?php echo  get_uploader_king_level_requirement($pdo) ; ?>" >
                            </div>
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4  mt-3 text-center">
                                <div class="remove-elitebadgemessages"></div>
                                <input type="hidden" name="btn_action" value="SaveAuthorEliteBadge" >
                                <button type="submit" class="btn btn-primary btn-md">Save Badges Settings</button>
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