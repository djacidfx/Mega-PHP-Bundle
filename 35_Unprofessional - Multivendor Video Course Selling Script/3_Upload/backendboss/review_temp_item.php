<?php include("header.php") ; ?>
<?php 
$inreview = "active" ; 
$dashboard = "active" ;
$tempId = filter_var($_GET['temp_id'], FILTER_SANITIZE_NUMBER_INT) ;
checking_temp_item($pdo,$tempId) ;
?>
<?php include("sidebar.php") ; ?>
<!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <div class="row w-100">
                <div class="col-lg-8">
                    <div class="col-lg-12 p-2">
                    <h1 class="text-muted"><i class="fa fa-file"></i> Title : <?php echo itemtitle_by_id($pdo,$tempId) ; ?> </h1>
                    </div>
                    <div class="col-lg-12 p-2">
                    <h5 class="text-primary"><i class="fa fa-align-center text-primary"></i> Category : <?php echo categoryname_by_tempid($pdo,$tempId) ; ?> </h5>
                    </div>
                </div>
                <div class="col-lg-4 text-center">
                    <h1 class="text-muted priceBig">$<?php echo find_item_price($pdo,$tempId) ; ?></h1>
                </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header">
                  <h4>Preview Image</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php echo itempreview_by_id($pdo,$tempId) ; ?> 
                    </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6">
              <div class="card">
                <div class="card-header">
                  <h4>Demo Video - <?php echo itemdemo_videosize_by_id($pdo,$tempId) ; ?> MB</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php echo itemdemovideo_by_id($pdo,$tempId) ; ?> 
                    </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>Item Description</h4>
                </div>
                <div class="card-body">
                    <div class="row d-block ml-1 myPost">
                        <?php echo itemdescription_by_id($pdo,$tempId) ; ?> 
                    </div>
                </div>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
              <div class="card minH">
                <div class="card-header">
                  <h4>Item Tags</h4>
                </div>
                <div class="card-body">
                    <div class="row d-block ml-1">
                        <?php echo itemtags_by_id($pdo,$tempId) ; ?> 
                    </div>
                    <div class="row d-block ml-1 mr-1 mt-3">
                        <?php echo temp_mainfile_download_by_id($pdo,$tempId) ;?>
                    </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card minH">
                <div class="card-header">
                  <h4>Comment to Reviewer</h4>
                </div>
                <div class="card-body">
                    <div class="row d-block ml-1">
                        <?php echo reviewercomment_by_id($pdo,$tempId) ; ?> 
                    </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card minH">
                <div class="card-header">
                  <h4>Take Action</h4>
                </div>
                <div class="card-body">
                    <div class="row d-block ml-1 mr-1">
                        <button class="btn btn-success btn-block approve_item" id="<?php echo $tempId ; ?>"><i class="fa fa-check-square"></i> <b>Approve</b></button>
                    </div>
                    <div class="row d-block ml-1 mr-1 mt-2">
                        <button class="btn btn-warning btn-block soft_reject"><i class="fa fa-exclamation-circle"></i> <b>Soft Reject</b></button>
                    </div>
                    <div class="row d-block ml-1 mr-1 mt-2">
                        <button class="btn btn-danger btn-block hard_reject"><i class="fa fa-window-close"></i> <b>Hard Reject</b></button>
                    </div>
                </div>
              </div>
            </div>
        </div>    
        
        </section>
    </div>
<!-- Hard Reject Modal -->
<div id="hardRejectModal" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <form method="post" id="hard_reject_form" class="hard_reject_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-times"></i> Hard Reject</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                            <label>Hard Reject Title*</label>
                            <select class="form-control" required name="hardRejectTitle">
                                <option value="">Choose Email Title</option>
                                <?php echo choose_hr_title($pdo) ; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Hard Reject Reason*</label>
                            <select class="form-control" required name="hardRejectReason">
                                <option value="">Choose Email Body</option>
                                <?php echo choose_hr_reason($pdo) ; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>User Comment</label>
                            <textarea name="userComment" id="userComment" class="form-control textareaLarge" rows="4" readonly ><?php echo reviewercomment_by_id($pdo,$tempId) ; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Addition Instruction to User<small>(Max 300 Characters)</small></label>
                            <textarea name="instruction" id="instruction" class="form-control textareaLarge" rows="4" maxlength="300"  ></textarea>
                        </div>
                </div> 
                <div class="modal-footer"> 
                    <div class="col-lg-12 remove-messages"></div>
                    <input type="hidden" name="tempId" value="<?php echo $tempId ; ?>" >
                    <input type="hidden" name="userId" value="<?php echo find_user_id($pdo,$tempId) ; ?>" >
                    <input type="hidden" name="catId" value="<?php echo find_cat_id($pdo,$tempId) ; ?>" >
                    <input type="hidden" name="itemTitle" value="<?php echo itemtitle_by_id($pdo,$tempId) ; ?>" >
                    <input type="hidden" name="btn_action" class="btn_action" />
                    <input type="submit" name="action_hard_reject" id="action_hard_reject" class="btn btn-danger" value="Hard Reject & Send Email" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Soft Reject Modal -->
<div id="softRejectModal" class="modal fade" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <form method="post" id="soft_reject_form" class="soft_reject_form">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><i class="fa fa-exclamation-circle"></i> Soft Reject</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 p-2">
                            <label>Title Issue*</label>
                            <select name="titleIssue" class="form-control" required autofocus>
                                <option value="">Choose</option>
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        <div class="col-lg-6 p-2">
                            <label>Price Issue*</label>
                            <select name="priceIssue" class="form-control" required autofocus>
                                <option value="">Choose</option>
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        <div class="col-lg-6 p-2">
                            <label>Description Issue*</label>
                            <select name="descriptionIssue" class="form-control" required autofocus>
                                <option value="">Choose</option>
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        <div class="col-lg-6 p-2">
                            <label>Tags Issue*</label>
                            <select name="tagsIssue" class="form-control" required autofocus>
                                <option value="">Choose</option>
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        <div class="col-lg-6 p-2">
                            <label>Category Issue*</label>
                            <select name="categoryIssue" class="form-control" required autofocus>
                                <option value="">Choose</option>
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        <div class="col-lg-6 p-2">
                            <label>Preview Issue*</label>
                            <select name="previewIssue" class="form-control" required autofocus>
                                <option value="">Choose</option>
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        <div class="col-lg-6 p-2">
                            <label>Demo Video Issue*</label>
                            <select name="demoIssue" class="form-control" required autofocus>
                                <option value="">Choose</option>
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        <div class="col-lg-6 p-2">
                            <label>Main File Issue*</label>
                            <select name="mainfileIssue" class="form-control" required autofocus>
                                <option value="">Choose</option>
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                        <div class="col-lg-12 mt-2 p-2">
                        <div class="form-group">
                            <label>User Comment</label>
                            <textarea name="userComment" id="userComment" class="form-control textareaLarge" rows="4" readonly ><?php echo reviewercomment_by_id($pdo,$tempId) ; ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Addition Instruction to User*<small>(Max 300 Characters)</small></label>
                            <textarea name="instruction" id="instruction" class="form-control textareaLarge" rows="4" maxlength="300" required  ></textarea>
                        </div>
                        </div>
                    </div>
                </div> 
                <div class="modal-footer"> 
                    <div class="col-lg-12 remove-messages"></div>
                    <input type="hidden" name="tempId" value="<?php echo $tempId ; ?>" >
                    <input type="hidden" name="userId" value="<?php echo find_user_id($pdo,$tempId) ; ?>" >
                    <input type="hidden" name="catId" value="<?php echo find_cat_id($pdo,$tempId) ; ?>" >
                    <input type="hidden" name="itemTitle" value="<?php echo itemtitle_by_id($pdo,$tempId) ; ?>" >
                    <input type="hidden" name="btn_action" class="btn_action" />
                    <input type="submit" name="action_soft_reject" id="action_soft_reject" class="btn btn-warning" value="Soft Reject & Send Email" />
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php include("footer.php") ; ?>