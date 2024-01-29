<?php include("header.php") ; ?>
<?php 
$buyerBadges = "active" ; 
$badges = "active" ;
?>
<?php include("sidebar.php") ; ?>
<!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1 class="text-muted"><i class="fa fa-trophy"></i> Buyer Badges </h1>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <small>Buyer Badges Depends on number of Item Purchased . Note : Each Level must be Bigger than Previous Otherwise Badges not Showing Correct.</small>
                </div>
                <div class="card-body">
                    <form method="post" class="postBuyerBadges" enctype="multipart/form-data">
                        <div class="row">
                            
                            <div class="col-lg-3 mt-3">
                                <label>Buyer Level 1 : Purchases </label>
                                <input type="number" min="1" class="form-control" name="level_one" value="<?php echo get_buyer_level_requirement($pdo,1) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Buyer Level 2 : Purchases </label>
                                <input type="number" min="1" class="form-control" name="level_two" value="<?php echo get_buyer_level_requirement($pdo,2) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Buyer Level 3 : Purchases </label>
                                <input type="number" min="1" class="form-control" name="level_three" value="<?php echo get_buyer_level_requirement($pdo,3) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Buyer Level 4 : Purchases </label>
                                <input type="number" min="1" class="form-control" name="level_four" value="<?php echo get_buyer_level_requirement($pdo,4) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Buyer Level 5 : Purchases </label>
                                <input type="number" min="1" class="form-control" name="level_five" value="<?php echo get_buyer_level_requirement($pdo,5) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Buyer Level 6 : Purchases </label>
                                <input type="number" min="1" class="form-control" name="level_six" value="<?php echo get_buyer_level_requirement($pdo,6) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Buyer Level 7 : Purchases </label>
                                <input type="number" min="1" class="form-control" name="level_seven" value="<?php echo get_buyer_level_requirement($pdo,7) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Buyer Level 8 : Purchases </label>
                                <input type="number" min="1" class="form-control" name="level_eight" value="<?php echo get_buyer_level_requirement($pdo,8) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Buyer Level 9 : Purchases </label>
                                <input type="number" min="1" class="form-control" name="level_nine" value="<?php echo get_buyer_level_requirement($pdo,9) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Buyer Level 10 : Purchases </label>
                                <input type="number" min="1" class="form-control" name="level_ten" value="<?php echo get_buyer_level_requirement($pdo,10) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Buyer Level 11 : Purchases </label>
                                <input type="number" min="1" class="form-control" name="level_eleven" value="<?php echo get_buyer_level_requirement($pdo,11) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Buyer Level 12 : Purchases </label>
                                <input type="number" min="1" class="form-control" name="level_twelve" value="<?php echo get_buyer_level_requirement($pdo,12) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Buyer Level 13 : Purchases </label>
                                <input type="number" min="1" class="form-control" name="level_thirteen" value="<?php echo get_buyer_level_requirement($pdo,13) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Buyer Level 14 : Purchases </label>
                                <input type="number" min="1" class="form-control" name="level_fourteen" value="<?php echo get_buyer_level_requirement($pdo,14) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Buyer Level 15 : Purchases </label>
                                <input type="number" min="1" class="form-control" name="level_fifteen" value="<?php echo get_buyer_level_requirement($pdo,15) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Buyer Level 16 : Purchases </label>
                                <input type="number" min="1" class="form-control" name="level_sixteen" value="<?php echo get_buyer_level_requirement($pdo,16) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Elite Buyer : Achieved Level</label>
                                <input type="number" min="1" max="16" class="form-control" name="eliteBuyer" value="<?php echo get_elite_buyer_level_requirement($pdo) ; ?>" required >
                            </div>
                            <div class="col-lg-3 mt-3">
                                <label>Power Elite Buyer : Achieved Level</label>
                                <input type="number" min="1" max="16" class="form-control" name="powerEliteBuyer" value="<?php echo get_power_elite_buyer_level_requirement($pdo) ; ?>" required >
                            </div>
                            
                        </div>
                            <div class="row">
                                <div class="col-lg-4"></div>
                                <div class="col-lg-4  mt-3 text-center">
                                    <div class="remove-buyerbadgemessages"></div>
                                    <input type="hidden" name="btn_action" value="SaveBuyerBadge" >
                                    <button type="submit" class="btn btn-primary btn-md">Save Buyer Badges</button>
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