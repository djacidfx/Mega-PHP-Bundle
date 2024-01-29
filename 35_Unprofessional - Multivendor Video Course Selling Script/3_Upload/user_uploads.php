<?php include("header_session.php") ; ?>
<?php $webtitle = "Upload New Item" ; ?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>
<?php 
$upload = "active" ; 
$dashboard = "active" ;
$nt = '1' ;
?>
<?php include("sidebar_index.php"); ?>
<?php echo check_user_logged_in($pdo) ; ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1 class="text-muted"><i class="fas fa-upload fa-lg"></i> Upload Your Video Course</h1>
      </div>
        <div class="row">
            <div class="col-lg-8">
              <div class="card">
                <div class="card-header justify-content-center">
                  <h4>Read Checklist Before Uploading </h4>
                </div>
                <div class="card-body">
                    <form class="user_tmp_upload" method="post" enctype="multipart/form-data">
                    <div class="row text-muted">
                        <div class="col-lg-8">
                            <label>Video Course Title*</label>
                            <input type="text" name="video_title" class="form-control" maxlength="50" required autocomplete="off" autofocus>
                        </div>
                        <div class="col-lg-4">
                            <label>Price*(USD $)</label>
                            <input type="number" min="1" max="1000" name="video_price" class="form-control" required autofocus>
                        </div>
                        <div class="col-lg-12 mt-2">
                            <label>Course Description*</label>
                            <textarea name="item_message" id="item_message" class="form-control" autofocus required></textarea>
                        </div>
                        <div class="col-lg-12 mt-2">
                            <label>Tags* (It will Boost SEO & Item Search)</label>
                            <textarea name="item_tag" id="item_tag" class="form-control textareaMedium" placeholder="Example : Video Course, PHP Video Tutorial, PHP Course, Photoshop Tutorials etc..." autofocus required rows="4" ></textarea>
                        </div>
                        <div class="col-lg-3"></div>
                        <div class="col-lg-6 mt-2">
                            <div class="form-group justify-content-center">
                                <input type="hidden" name="btn_action" id="btn_action" value="SaveTempUploadStepOne">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4" id="action_log_step1">Continue</button>
                            </div>
                        </div>
                        <div class="col-lg-3"></div>
                    </div>
                    </form>
                    <form class="user_tmp_upload_step2" method="post" enctype="multipart/form-data">
                        <div class="row text-muted">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="remove-messages"></div>
                                <div class="col-lg-12">
                                    <label>Choose Category*</label>
                                    <select class="custom-select" name="category" required autofocus>
                                        <option value="0">Choose Your Category</option>
                                        <?php echo choose_category($pdo) ; ?>
                                    </select>
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <div class="prvw">
                                        <label>Only (.jpg / .jpeg /.png) Allowed</label>
                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input" id="uploadPreviewImage" name="uploadPreviewImage" accept="image/x-png,image/jpeg" required>
                                          <label class="custom-file-label" for="customFile">Choose Preview Image</label>
                                        </div>
                                    </div>
                                    <div class="remove-messagespreview"></div>
                                    <div class="col-lg-12 col-md-12 thumbprogress">
                                        <div class="progress">
                                            <div class="progress-bar preview-bar bg-success"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <div class="demovid">
                                        <label>Only (.mp4, .mov, .wmv, .flv, .avi, .webm, .mkv, .mpeg, .ogg, .mpg, .mpv, .m4p, .m4p, .m4v, .qt, .swf & .avchd) Allowed</label>
                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input" id="uploadDemoVideo" name="uploadDemoVideo" accept="video/*" required>
                                          <label class="custom-file-label" for="customFile">Choose Demo Video</label>
                                        </div>
                                    </div>
                                    <div class="remove-messagesdemo"></div>
                                    <div class="col-lg-12 col-md-12 demoprogress">
                                        <div class="progress">
                                            <div class="progress-bar demo-bar bg-success"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <div class="mainzip">
                                        <label>Only (.zip) Allowed</label>
                                        <div class="custom-file">
                                          <input type="file" class="custom-file-input" id="uploadMainFile" name="uploadMainFile" accept="application/x-zip-compressed" required>
                                          <label class="custom-file-label" for="customFile">Choose Main File</label>
                                        </div>
                                    </div>
                                    <div class="remove-messagesmain"></div>
                                    <div class="col-lg-12 col-md-12 mainprogress">
                                        <div class="progress">
                                            <div class="progress-bar main-bar bg-success"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-2">
                                <label>Comments to Reviewer(Optional)</label>
                                <textarea name="comment" id="comment" class="form-control textareaLarge" placeholder="Example : I have uploaded PHP Video Course, If this item will hard reject then Please leave your valuable comment so I can improve next time. Thanks." rows="4" maxlength="300" ></textarea>
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <div class="form-group justify-content-center">
                                        <input type="hidden" name="tempId" class="tempId">
                                        <input type="hidden" name="btn_action" id="btn_action" value="SaveTempUploadStepTwo">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4" id="action_temp_log">Submit For Review</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2"></div>
                        </div>
                    </form>
                    <div class="row step_3show">
                        <div class="col-md-6 offset-md-3">
                            <div class="remove_message_success"></div>
                            <div class="col-lg-12 mt-2">
                                <a href="<?php echo BASE_URL."upload" ;?>" class="btn btn-primary btn-lg btn-block" tabindex="4">Upload Another Item</a>
                            </div>
                            <div class="col-lg-12 mt-2">
                                <a href="<?php echo BASE_URL."inreview" ;?>" class="btn btn-primary btn-lg btn-block" tabindex="4">View Review Queue</a>
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