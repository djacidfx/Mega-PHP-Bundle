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
                <form method="post" class="AnalyticForm">
                    <div class="card <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> newShadow">
                        <div class="card-header">
                            <h4 class="text-muted"> <i class="bi bi-graph-up-arrow text-success"></i> <?php echo userlang('analytic_setting') ; ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="text-muted"><?php echo userlang('analytic_javascript') ; ?></label>
                                <textarea name="adcode" class="form-control <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> <?php echo colormode('border') ; ?>" rows="6" required><?php echo find_analyticcode($pdo) ; ?></textarea>
                            </div>
                            <div class="form-group mt-2">
                                <label class="text-muted"><?php echo userlang('analytic_javascript_on') ; ?></label>
                                <select name="ad_on" class="form-select <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> <?php echo colormode('border') ; ?>" required>
                                    <?php if(find_analyticcode_on($pdo) > '0') { ?> 
                                        <option value="1" selected><?php echo userlang('yes') ; ?></option>
                                        <option value="0"><?php echo userlang('no') ; ?></option>
                                    <?php } else { ?> 
                                        <option value="1"><?php echo userlang('yes') ; ?></option>
                                        <option value="0" selected><?php echo userlang('no') ; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <div class="analytic-messages <?php echo colormode('default_text') ; ?>"></div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <input type="hidden" name="btn_action" value="btnAnalyticCode">
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