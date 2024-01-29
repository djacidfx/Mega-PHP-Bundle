<?php include("header_session.php") ; ?>
<?php $webtitle = "Edit Item" ; ?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>
<?php 
$itemId = filter_var($_GET['item_id'], FILTER_SANITIZE_NUMBER_INT) ;
checking_edit_item($pdo,$itemId) ;
$username = get_username_by_itemid($pdo,$itemId) ;
$shortUrlTitle = item_urltitle_by_id($pdo,$itemId) ;
$itemTitle = long_title_by_id($pdo,$itemId) ;
$previewFile = find_edit_image($pdo,$itemId) ;
$demoFile = find_edit_video($pdo,$itemId) ;
$mainFile =  find_edit_file($pdo,$itemId) ;
$nt = '2' ;
?>
<?php include("sidebar_index.php"); ?>
<?php echo check_user_logged_in($pdo) ; ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1>Edit Item</h1>
      </div>
        <div class="row">
            <div class="col-lg-8">
              <div class="card">
                <div class="card-header justify-content-center">
                  <h4>Read the Checklist Before Submit.&ensp;<small>(Note : Step 1 will not be reviewed. You can change anytime.)</small> </h4>
                </div>
                <div class="card-body">
                    <form class="user_edit_upload" method="post" enctype="multipart/form-data">
                    <div class="row text-muted">
                        <div class="col-lg-8">
                            <label>Video Course Title*</label>
                            <input type="text" name="video_title" class="form-control" value="<?php echo $itemTitle ; ?>" maxlength="50" required autocomplete="off" autofocus>
                        </div>
                        <div class="col-lg-4">
                            <label>Price*(USD $)</label>
                            <input type="number" min="1" max="1000" value="<?php echo find_activeitem_price($pdo,$itemId) ; ?>" name="video_price" class="form-control" required autofocus>
                        </div>
                        <div class="col-lg-12 mt-2">
                            <label>Course Description*</label>
                            <textarea name="item_message" id="item_message" class="form-control" autofocus required><?php echo active_itemdescription_by_id($pdo,$itemId)  ; ?></textarea>
                        </div>
                        <div class="col-lg-12 mt-2">
                            <label>Tags* (It will Boost SEO & Item Search)</label>
                            <textarea name="item_tag" id="item_tag" class="form-control textareaMedium" placeholder="Example : Video Course, PHP Video Tutorial, PHP Course, Photoshop Tutorials etc..." autofocus required rows="4" ><?php echo active_itemtags_by_id($pdo,$itemId) ; ?></textarea>
                        </div>
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6 mt-2">
                            <div class="form-group justify-content-center">
                                <input type="hidden" name="item_Id" value="<?php echo $itemId ; ?>" >
                                <input type="hidden" name="btn_action" id="btn_action" value="SaveEditUploadStepOne">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4" id="action_log_step1">Continue</button>
                            </div>
                        </div>
                        <div class="col-lg-3"></div>
                    </div>
                    </form>
                    <?php if(checking_update_pending($pdo,$itemId) == 0){ ?>
                    <form class="user_edit_upload_step2" method="post" enctype="multipart/form-data">
                        <div class="row text-muted">
                            <div class="col-lg-2"></div>
                            
                            <div class="col-lg-8">
                                <div class="remove-messages"></div>
                                <div class="col-lg-12">
                                    <label>Choose Category*</label>
                                    <select class="custom-select" name="category" required autofocus>
                                        <?php echo selected_old_category_by_itemid($pdo,$itemId) ; ?>
                                        <?php echo choose_category_by_itemid($pdo,$itemId) ; ?>
                                    </select>
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <?php if($previewFile == '') {?>
                                    <div class="prvw">
                                        <label>Only (.jpg / .jpeg /.png) Allowed</label>
                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input" id="uploadPreviewImage" name="uploadPreviewImage" accept="image/x-png,image/jpeg" >
                                          <label class="custom-file-label" for="customFile">Choose Preview Image</label>
                                        </div>
                                    </div>
                                    <div class="remove-messagespreview"></div>
                                    <div class="col-lg-12 col-md-12 thumbprogress">
                                        <div class="progress">
                                            <div class="progress-bar preview-bar bg-success"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <?php } else { ?>
                                    <div class="alert alert-success">Previous Preview Image Uploaded.</div>
                                    <?php } ?>
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <?php if($demoFile == '') {?>
                                    <div class="demovid">
                                        <label>Only (.mp4, .mov, .wmv, .flv, .avi, .webm, .mkv, .mpeg, .ogg, .mpg, .mpv, .m4p, .m4p, .m4v, .qt, .swf & .avchd) Allowed</label>
                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input" id="uploadDemoVideo" name="uploadDemoVideo" accept="video/*" >
                                          <label class="custom-file-label" for="customFile">Choose Demo Video</label>
                                        </div>
                                    </div>
                                    <div class="remove-messagesdemo"></div>
                                    <div class="col-lg-12 col-md-12 demoprogress">
                                        <div class="progress">
                                            <div class="progress-bar demo-bar bg-success"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <?php } else { ?>
                                    <div class="alert alert-success">Previous Demo Video Uploaded.</div>
                                    <?php } ?>
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <?php if($mainFile == '') {?>
                                    <div class="mainzip">
                                        <label>Only (.zip) Allowed</label>
                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input" id="uploadMainFile" name="uploadMainFile" accept="application/x-zip-compressed" >
                                          <label class="custom-file-label" for="customFile">Choose Main File</label>
                                        </div>
                                    </div>
                                    <div class="remove-messagesmain"></div>
                                    <div class="col-lg-12 col-md-12 mainprogress">
                                        <div class="progress">
                                            <div class="progress-bar main-bar bg-success"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <?php } else { ?>
                                    <div class="alert alert-success">Previous Main Zip File Uploaded.</div>
                                    <?php } ?>
                                </div>
                                <div class="col-lg-12 mt-2">
                                <label>Comments to Reviewer(Optional)</label>
                                <textarea name="comment" id="comment" class="form-control textareaLarge" placeholder="Example : I have updated Preview Image or Demo Video or Main File. Please approve it. Thanks." rows="4" maxlength="300" ></textarea>
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <div class="form-group justify-content-center">
                                        <input type="hidden" name="itemId" class="itemId">
                                        <input type="hidden" name="btn_action" id="btn_action" value="SaveEditUploadStepTwo">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4" id="action_temp_log">Submit For Review</button>
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="col-lg-2"></div>
                        </div>
                    </form>
                    <?php } ?>
                    <?php if(checking_update_pending($pdo,$itemId) > 0){ ?>
                    <div class="row hiddenUpdateButton">
                        <div class="col-lg-12">
                            <div class="col-md-8 offset-md-2">
                                <div class="col-lg-12 p-1">
                                    <div class="col-lg-12">
                                Update is in Progress. You can wait or cancel update.
                            </div>
                                    <div class="form-group justify-content-center">
                                        <button class="btn btn-danger btn-lg btn-block cancelUpdateItem" tabindex="4" id="<?php echo $itemId ; ?>" >Cancel Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                                <?php } ?>
                    <div class="row step_3show">
                        <div class="col-lg-12">
                            <div class="col-md-8 offset-md-2">
                                <div class="col-lg-12 p-1">
                                    <div class="col-lg-12">
                                Update is in Progress. You can wait or cancel update.
                            </div>
                                    <div class="form-group justify-content-center">
                                        <button class="btn btn-danger btn-lg btn-block cancelUpdateItem" tabindex="4" id="<?php echo $itemId ; ?>" >Cancel Update</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="card gradient-bottom">
                <div class="card-header">
                  <h4 >Checklist ( <i class="fas fa-check-circle text-success"></i> Do's &ensp;&&ensp; <i class="fas fa-times-circle text-danger"></i> Don'ts  )</h4>
                </div>
                <div class="card-body" id="top-5-scroll">
                  <ul class="list-unstyled list-unstyled-border">
                    <li class="media">
                      <div class="media-body">
                        <div class="float-left">
                            <div class="font-weight-600 text-muted text-small"><i class="fas fa-check-circle text-success"></i> You've Prepared <b>.zip</b> Main File.</div>
                        </div>
                      </div>
                    </li>
                    <li class="media">
                      <div class="media-body">
                        <div class="float-left">
                            <div class="font-weight-600 text-muted text-small"><i class="fas fa-check-circle text-success"></i>  You've Prepared <b>600 x 300 px</b> Preview Image</div>
                        </div>
                      </div>
                    </li>
                    <li class="media">
                      <div class="media-body">
                        <div class="float-left">
                            <div class="font-weight-600 text-muted text-small"><i class="fas fa-check-circle text-success"></i>  You've Prepared <b>Demo Video</b> of your Course</div>
                        </div>
                      </div>
                    </li>
                    <li class="media">
                      <div class="media-body">
                        <div class="float-left">
                            <div class="font-weight-600 text-muted text-small"><i class="fas fa-check-circle text-success"></i>  Short Descriptive Title <b>max 50 Characters</b> </div>
                        </div>
                      </div>
                    </li>
                    <li class="media">
                      <div class="media-body">
                        <div class="float-left">
                            <div class="font-weight-600 text-muted text-small"><i class="fas fa-check-circle text-success"></i>  Professional Course Description<b> No Limit</b> </div>
                        </div>
                      </div>
                    </li>
                    
                    <li class="media">
                      <div class="media-body">
                        <div class="float-left">
                            <div class="font-weight-600 text-muted text-small"><i class="fas fa-times-circle text-danger"></i> Not Upload <b> Hard Rejected</b> Course without modification. By Doing so, Your Uploading rights will be revoked.</div>
                        </div>
                      </div>
                    </li>
                    <li class="media">
                      <div class="media-body">
                        <div class="float-left">
                            <div class="font-weight-600 text-muted text-small"><i class="fas fa-times-circle text-danger"></i>  .zip File<b> Not Greater Than <?php echo main_zip_max_size ; ?> MB.</b> </div>
                        </div>
                      </div>
                    </li>
                  </ul>
                </div>
                
              </div>
            </div>
          </div>
    </section>
</div>
<?php include("footer_main.php") ; ?>