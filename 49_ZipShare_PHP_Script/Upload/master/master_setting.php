<?php
include("db.php") ;
include("head.php") ;
include("header.php") ;
check_admin_logged_in($pdo);
?>
<div class="row mt-2">
    <div class="col-lg-12 <?php echo colormode('default_text') ; ?> ">
        <div class="row p-0">
            <div class="col-lg-3 mb-3 "></div>
            <div class="col-lg-6 mb-3">
                <form method="post" class="SettingForm">
                    <div class="card <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> newShadow">
                        <div class="card-header">
                            <h4 class="text-muted"> <i class="bi bi-gear text-success"></i> <?php echo userlang('main_setting') ; ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="row p-0">
                                <div class="col-lg-12">
                                    <label class="text-muted"><?php echo userlang('about_us') ; ?><small>( <?php echo  userlang('max_char') ; ?> )</small></label>
                                    <textarea name="aboutus" maxlength="200" class="form-control <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> <?php echo colormode('border') ; ?>" rows="6" required><?php echo find_aboutus($pdo) ; ?></textarea>
                                </div>
                                <div class="col-lg-6 mt-2">
                                    <label class="text-muted"><?php echo userlang('show_default_limit') ; ?></label>
                                    <input type="number" name="defaultlimit" class="form-control <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> <?php echo colormode('border') ; ?>" min="1" value="<?php echo find_default_limit($pdo) ; ?>" required>
                                </div>
                                <div class="col-lg-6 mt-2">
                                    <label class="text-muted"><?php echo userlang('show_loadmore_limit') ; ?></label>
                                    <input type="number" name="loadmorelimit" class="form-control <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> <?php echo colormode('border') ; ?>" min="1" value="<?php echo find_loadmore_limit($pdo) ; ?>" required>
                                </div>
                                <div class="col-lg-6 mt-2">
                                    <label class="text-muted"><?php echo userlang('autoapprove_on') ; ?></label>
                                    <select name="approve" class="form-select <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> <?php echo colormode('border') ; ?>" required>
                                        <?php if(find_auto_approve($pdo) > '0') { ?> 
                                            <option value="1" selected><?php echo userlang('yes') ; ?></option>
                                            <option value="0"><?php echo userlang('no') ; ?></option>
                                        <?php } else { ?> 
                                            <option value="1"><?php echo userlang('yes') ; ?></option>
                                            <option value="0" selected><?php echo userlang('no') ; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-lg-6 mt-2">
                                    <label class="text-muted"><?php echo userlang('copyright_name') ; ?></label>
                                    <input type="text" name="copyrightname" class="form-control <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> <?php echo colormode('border') ; ?>" maxlength="100" value="<?php echo find_copyrightname($pdo) ; ?>" required>
                                </div>
                                <div class="form-group mt-2">
                                    <div class="setting-messages <?php echo colormode('default_text') ; ?>"></div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="card-footer text-center">
                            <input type="hidden" name="btn_action" value="btnSetting">
                            <button type="submit" class="btn btn-primary btn-md action_log" id="action_log"><?php echo userlang('save') ; ?></button>
                        </div>
                    </div>
                    
                </form>
            </div>
            <div class="col-lg-3 mb-3 "></div>
        </div>
    </div>
</div>
<?php
include("js.php") ;
?>