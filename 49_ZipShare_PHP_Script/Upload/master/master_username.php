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
            <div class="col-lg-6 mb-3 cUsername">
                <form method="post" class="UsernameForm">
                    <div class="card <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> newShadow">
                        <div class="card-header">
                            <h4 class="text-muted"> <i class="bi bi-person-check text-success"></i> <?php echo userlang('change_admin_username') ; ?></h4>
                        </div>
                        <div class="card-body">
                        <div class="form-group">
                            <label class="text-muted"><?php echo userlang('old_admin_username') ; ?></label>
                            <input type="text"  maxlength="50" value="<?php echo get_admin_username($pdo) ; ?>" class="<?php echo colormode('border') ; ?> <?php echo colormode('default_text') ; ?> <?php echo colormode('textarea-bgcolor') ; ?> form-control" readonly>
                        </div>
                        <div class="form-group mt-2">
                            <label class="text-muted"><?php echo userlang('new_admin_username') ; ?></label>
                            <input type="text" name="username"  maxlength="50" class="<?php echo colormode('border') ; ?> <?php echo colormode('default_text') ; ?> <?php echo colormode('textarea-bgcolor') ; ?> form-control" required autocomplete="off">
                        </div>
                        <div class="form-group mt-2">
                            <label class="text-muted"><?php echo userlang('password_heading') ; ?></label>
                            <input type="password" name="password"  maxlength="50" class="<?php echo colormode('border') ; ?> <?php echo colormode('default_text') ; ?> <?php echo colormode('textarea-bgcolor') ; ?> form-control" required>
                        </div>
                        <div class="form-group mt-2">
                            <div class="ad-messages <?php echo colormode('default_text') ; ?>"></div>
                        </div>
                        </div>
                        <div class="card-footer text-center">
                            <input type="hidden" name="btn_action" value="btnChangeUsername">
                            <button type="submit" class="btn btn-primary btn-md" id="action_log"><?php echo userlang('change') ; ?></button>
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