<?php include("header.php") ; ?>
<?php 
$createcategory = "active" ; 
$dashboard = "active" ;
if(!empty($_GET['edit'])){
    $catId = filter_var($_GET['edit'], FILTER_SANITIZE_NUMBER_INT) ;
    $query = "SELECT * FROM ot_category WHERE id = '".$catId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
    $total = $statement->rowCount();
	$result = $statement->fetchAll();
    if($total > 0) {
        $catName = category_name($pdo,$catId) ;
    } else{
        header("location:".ADMIN_URL."category") ;
    }
}
?>
<?php include("sidebar.php") ; ?>
<!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1 class="text-muted"><?php if(isset($total) == 0) { ?><i class="fa fa-clone"></i> Create New Category <?php } else { ?> <i class="fa fa-pencil-alt"></i> Edit Category<?php } ?></h1>
          </div>
          <div class="row">
            <div class="col-lg-8">
              <div class="card">
                <div class="card-header justify-content-center">
                  <h4>Requirements ( Category Name <?php if(isset($total) == 0) { ?> & Preview Image <?php } ?>)</h4>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <div class="remove-messages"></div>
                    <form method="post" enctype="multipart/form-data" class="catName">
                      <label>Category Name*<small>(Max 25 Characters)</small></label>
                      <input type="text" maxlength="25" class="form-control" name="catName"  autofocus autocomplete="off" <?php if(isset($total) > 0) { ?> value="<?php echo $catName ; ?>" <?php } ?> >
                      <div class="form-group mt-2">
                        
                        <?php if(isset($total) == 0) { ?>
                          <input type="hidden" name="btn_action" id="btn_action" value="SaveCategoryName">
                        <?php } else { ?>
                          <input type="hidden" name="editcatId" value="<?php echo $catId ; ?>" >
                          <input type="hidden" name="btn_action" id="btn_action" value="EditCategoryName">
                        <?php } ?>
                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4" id="action_log">
                         Continue
                        </button>
                      </div>
                    </form>
                    <div class="step2">
                        <form  method="post" id="uploadFilesNew" class="uploadFilesNew activateCategory">
                            <div class="form-group prvw">
                                <label>Preview Image <small>(Only .jpeg, .jpg, .png allowed, 10 MB Allowed, Best View 300px * 300px)</small></label>
                                <input type="file" name="uploadPreview" id="uploadPreview" class="form-control" accept="image/x-png,image/jpeg"  <?php if(isset($total) == 0) { ?> required <?php } ?> />
                            </div>
                            <div class="remove-messagespreview"></div>
                            <div class="col-lg-12 col-md-12 thumbprogress">
                                <div class="progress">
                                    <div class="progress-bar thumb-bar bg-success"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="form-group mt-2">
                                <input type="hidden" name="catId" class="catId" >
                                <input type="hidden" name="btn_action" id="btn_action" value="ActivateCategory">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4" id="action_log">
                                 Activate Category
                                </button>
                            </div>
                        </form>
                        <form method="post" class="deactivateCategory">
                            <div class="form-group mt-2">
                                <input type="hidden" name="catId" class="catId" >
                                <input type="hidden" name="btn_action" id="btn_action" value="DeactivateCategory">
                                <button type="submit" class="btn btn-danger btn-lg btn-block" tabindex="4">
                                 Saves into Draft
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="step3">
                        <a href="<?php echo ADMIN_URL ; ?>category" class="btn btn-primary btn-lg btn-block" tabindex="4">Create New Category</a>
                    </div>
                    </div>
                    <div class="col-lg-3"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card gradient-bottom">
                <div class="card-header">
                  <h4 >Last 5 Categories</h4>
                  <div class="card-header-action dropdown">
                    <a href="<?php echo ADMIN_URL ; ?>viewcategory" class="btn btn-danger">View All</a>
                  </div>
                </div>
                <div class="card-body" id="top-5-scroll">
                  <ul class="list-unstyled list-unstyled-border">
                    <?php echo last_five_categories($pdo) ; ?>
                  </ul>
                </div>
                
              </div>
            </div>
          </div>
        </section>
    </div>
<?php include("footer.php") ; ?>