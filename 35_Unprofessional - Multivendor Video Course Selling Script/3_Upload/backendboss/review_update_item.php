<?php include("header.php") ; ?>
<?php 
$itemId = filter_var($_GET['item_id'], FILTER_SANITIZE_NUMBER_INT) ;
checking_update_item_list($pdo,$itemId) ;
$previewImage = find_edit_image($pdo,$itemId) ;
$demoVideo = find_edit_video($pdo,$itemId) ;
$mainfile = find_edit_file($pdo,$itemId) ;
$updateCatId = find_updatecategory_id($pdo,$itemId) ;
$catId = find_cat_id_active_item($pdo,$itemId) ;
$oldCatName = category_name($pdo,$catId) ;
$newCatName = category_name($pdo,$updateCatId) ;
$userComment = update_reviewercomment_by_id($pdo,$itemId) ; 
?>
<?php include("sidebar.php") ; ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1 class="text-muted"><i class="fa fa-bookmark fa-lg"></i> <?php echo long_title_by_id($pdo,$itemId) ; ?></h1>
        </div>
        <div class="row">
           <?php if($catId != $updateCatId) { ?>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Old Category</h4>
                        </div>
                        <div class="card-body">
                            <h4><?php echo $oldCatName ; ?></h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>New Category</h4>
                        </div>
                        <div class="card-body">
                            <h4><?php echo $newCatName ; ?></h4>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if(!empty($previewImage)){ ?> 
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Old Image</h4>
                        </div>
                        <div class="card-body">
                           <?php echo  active_itempreview_big_by_id($pdo,$itemId) ; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>New Image</h4>
                        </div>
                        <div class="card-body">
                            <div class="p-2"><img src="<?php echo BASE_URL ; ?>tmpImg/<?php echo $previewImage ; ?>" class="img-fluid" ></div>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if(!empty($demoVideo)){ ?> 
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Old Video</h4>
                        </div>
                        <div class="card-body">
                           <?php echo  active_itemdemovideo_by_id($pdo,$itemId) ; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>New Video</h4>
                        </div>
                        <div class="card-body">
                            <?php echo update_itemdemovideo_by_id($pdo,$itemId) ; ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if(!empty($mainfile)){ ?> 
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Old Main File</h4>
                        </div>
                        <div class="card-body">
                           <?php echo  live_mainfile_download_by_id($pdo,$itemId) ; ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>New Main File</h4>
                        </div>
                        <div class="card-body">
                            <?php echo update_mainfile_download_by_id($pdo,$itemId) ; ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
        <form method="post" class="adminItemUpdate" enctype="multipart/form-data">
            <div class="row mt-2">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="card p-3">
                        <?php if(!empty($userComment)){ ?> 
                        <div class="col-lg-12">
                            <label class="text-muted">User Comment to Reviewer</label>
                            <p><?php echo nl2br($userComment) ; ?></p>
                            <hr>
                        </div>
                        <?php } ?>
                        <div class="col-lg-12 mt-2">
                            <label>Comment to User(Optional)</label>
                            <textarea name="comment" id="comment" class="form-control textareaLarge" placeholder="" rows="4" maxlength="300" ></textarea>
                        </div>
                        <div class="col-lg-12 mt-2">
                            <select name="status" required class="form-control">
                                <option value="">Select Your Decision</option>
                                <option value="1">Approve Item Update</option>
                                <option value="2">Reject Item Update</option>
                            </select>
                        </div>
                        <div class="col-lg-12 mt-4 text-center">
                            <input type="hidden" name="itemId" value="<?php echo $itemId ; ?>" >
                            <input type="hidden" name="btn_action" value="itemUpdateDecision">
                            <button type="submit" class="btn btn-success btn-sm">Submit Decision</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3"></div>
            </div>
        </form>
    </section>
</div>
<?php include("footer.php") ; ?>