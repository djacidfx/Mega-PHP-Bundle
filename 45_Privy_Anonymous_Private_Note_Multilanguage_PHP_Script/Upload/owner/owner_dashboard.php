<?php
include("db.php") ;
include("head.php") ;
include("header.php") ;
include("body.php") ;
check_admin_logged_in($pdo);
?>
<div class="row mt-2">
    <div class="col-lg-1"></div> 
    <div class="col-lg-10 <?php echo colormode('default_text') ; ?> ">
        <div class="row p-0">
            <div class="col-lg-12 <?php //echo colormode('border_bottom') ; ?> ">
                <h1 class="text-muted text-center"> <i class="bi bi-bell-fill "></i> <?php echo userlang('notifications') ; ?></h1>
            </div>
            <div class="col-lg-3 mt-2 "></div>
            <div class="col-lg-6 mt-2 text-center">
                <button class="openUsername  btn btn-md btn-primary"><i class="bi bi-person-check me-1"></i> <?php echo userlang('change') ; ?> <?php echo userlang('username') ; ?></button>
                <button class="openPassword  btn btn-md btn-primary ms-2"><i class="bi bi-shield-lock-fill me-1"></i> <?php echo userlang('change') ; ?> <?php echo userlang('password_heading') ; ?></button>
            </div>
            <div class="col-lg-3 mt-4 "></div>
            <div class="col-lg-3 mt-4 ">
                <a href="<?php echo ADMIN_URL ; ?>notes" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo userlang('view') ; ?> <?php echo userlang('total_private_note') ; ?>">
                    <div class="card <?php echo colormode('bg_color') ; ?> text-white newShadow btn-grey">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-5 alignCenter">
                                    <i class="bi bi-signpost-2-fill text-primary veryBigFont"></i>
                                </div>
                                <div class="col-lg-7 alignCenter">
                                    <h1 class="<?php echo colormode('default_text') ; ?> "><?php echo count_total_notes($pdo) ; ?></h1>
                                </div>
                                <div class="col-lg-12 alignCenter <?php echo colormode('border_top') ; ?> text-muted p-2 pe-0 ps-0">
                                   <?php echo userlang('total_private_note') ; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 mt-4 ">
                <a href="<?php echo ADMIN_URL ; ?>unread" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo userlang('view') ; ?> <?php echo userlang('total_unreadprivate_note') ; ?>">
                    <div class="card <?php echo colormode('bg_color') ; ?> text-white newShadow btn-grey">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-5 alignCenter">
                                    <i class="bi bi-eye-slash text-danger veryBigFont"></i>
                                </div>
                                <div class="col-lg-7 alignCenter">
                                    <h1 class="<?php echo colormode('default_text') ; ?> "><?php echo count_total_unreadnotes($pdo) ; ?></h1>
                                </div>
                                <div class="col-lg-12 alignCenter <?php echo colormode('border_top') ; ?> text-muted p-2 pe-0 ps-0">
                                   <?php echo userlang('total_unreadprivate_note') ; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="col-lg-3 mt-4 ">
                <a href="<?php echo ADMIN_URL ; ?>read" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo userlang('view') ; ?> <?php echo userlang('total_readprivate_note') ; ?>">
                    <div class="card <?php echo colormode('bg_color') ; ?> text-white newShadow btn-grey">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-5 alignCenter">
                                    <i class="bi bi-eye text-info veryBigFont"></i>
                                </div>
                                <div class="col-lg-7 alignCenter">
                                    <h1 class="<?php echo colormode('default_text') ; ?> "><?php echo count_total_readnotes($pdo) ; ?></h1>
                                </div>
                                <div class="col-lg-12 alignCenter <?php echo colormode('border_top') ; ?> text-muted p-2 pe-0 ps-0">
                                   <?php echo userlang('total_readprivate_note') ; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            
            <div class="col-lg-3 mt-4 ">
                <a href="<?php echo ADMIN_URL ; ?>blocked" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo userlang('view') ; ?> <?php echo userlang('total_banned_ip') ; ?>">
                    <div class="card <?php echo colormode('bg_color') ; ?> text-white newShadow btn-grey">
                        <div class="card-header pb-0">
                            <div class="row">
                                <div class="col-lg-5 alignCenter">
                                    <i class="bi bi-slash-circle-fill text-danger veryBigFont"></i>
                                </div>
                                <div class="col-lg-7 alignCenter">
                                    <h1 class="<?php echo colormode('default_text') ; ?> "><?php echo count_total_blockedip($pdo) ; ?></h1>
                                </div>
                                <div class="col-lg-12 alignCenter <?php echo colormode('border_top') ; ?> text-muted p-2 pe-0 ps-0">
                                   <?php echo userlang('total_banned_ip') ; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
          </div>
        
        <div class="row p-0">
            
            <div class="col-lg-2"></div>
            <div class="col-lg-8 <?php echo colormode('default_text') ; ?>">
                <div class="row p-0">
                    <div class="col-lg-12 <?php //echo colormode('border_bottom') ; ?> mt-4">
                        <h1 class="text-muted text-center"> <i class="bi bi-bar-chart-fill"></i> <?php echo userlang('analysis') ; ?></h1>
                    </div>
                    <div class="col-lg-4 mt-3 ">
                            <div class="card <?php echo colormode('bg_color') ; ?> text-white newShadow btn-grey">
                                <div class="card-header pb-0">
                                    <div class="row">
                                        <div class="col-lg-5 alignCenter">
                                            <i class="bi bi-signpost-2-fill text-success veryBigFont"></i>
                                        </div>
                                        <div class="col-lg-7 alignCenter">
                                            <h1 class="<?php echo colormode('default_text') ; ?> "><?php echo count_total_notes($pdo) ; ?></h1>
                                        </div>
                                        <div class="col-lg-12 alignCenter <?php echo colormode('border_top') ; ?> text-muted p-2 pe-0 ps-0">
                                            <?php echo userlang('lifetime_notes') ; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>

                    <div class="col-lg-4 mt-3 ">
                            <div class="card <?php echo colormode('bg_color') ; ?> text-white newShadow btn-grey">
                                <div class="card-header pb-0">
                                    <div class="row">
                                        <div class="col-lg-5 alignCenter">
                                            <i class="bi bi-calendar3 text-warning veryBigFont"></i>
                                        </div>
                                        <div class="col-lg-7 alignCenter">
                                            <h1 class="<?php echo colormode('default_text') ; ?>"><?php echo count_total_thismonthnotes($pdo) ; ?></h1>
                                        </div>
                                        <div class="col-lg-12 alignCenter <?php echo colormode('border_top') ; ?> text-muted p-2 pe-0 ps-0">
                                            <?php echo userlang('thismonth_notes') ; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    
                    <div class="col-lg-4 mt-3 ">
                            <div class="card <?php echo colormode('bg_color') ; ?> text-white newShadow btn-grey">
                                <div class="card-header pb-0">
                                    <div class="row">
                                        <div class="col-lg-5 alignCenter">
                                            <i class="bi bi-calendar-plus text-primary veryBigFont"></i>
                                        </div>
                                        <div class="col-lg-7 alignCenter">
                                            <h1 class="<?php echo colormode('default_text') ; ?>"><?php echo count_total_todaynotes($pdo) ; ?></h1>
                                        </div>
                                        <div class="col-lg-12 alignCenter <?php echo colormode('border_top') ; ?> text-muted p-2 pe-0 ps-0">
                                            <?php echo userlang('today_notes') ; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    
                </div>
                
            </div>
            <div class="col-lg-2"></div>
        </div>
        
    </div>
    <div class="col-lg-1"></div> 
</div>
<div class="modal fade cUsername" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="modal-dialog">
			<div class="modal-content <?php echo colormode('bg_color') ; ?>">
                <form method="post" class="UsernameForm">
                    <div class="modal-header <?php echo colormode('border_bottom') ; ?>">
                        <h4 class="modal-title text-danger"><i class="bi bi-person-check"></i> <?php echo userlang('change_admin_username') ; ?></h4>
                        <button type="button" class="close btn btn-grey btn-sm " data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-start">
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
                    <div class="modal-body text-end">
                        <input type="hidden" name="btn_action" value="btnChangeUsername">
                        <button type="submit" class="btn btn-primary btn-md" id="action_log"><?php echo userlang('change') ; ?></button>
                    </div>
                </form>
			</div>
	</div>
</div>

<div class="modal fade adPass" data-bs-backdrop="static" data-bs-keyboard="false">
	<div class="modal-dialog">
			<div class="modal-content <?php echo colormode('bg_color') ; ?>">
                <form method="post" class="PasswordForm">
                    <div class="modal-header <?php echo colormode('border_bottom') ; ?>">
                        <h4 class="modal-title text-danger"><i class="bi bi-shield-lock-fill"></i> <?php echo userlang('change_admin_password') ; ?></h4>
                        <button type="button" class="close btn btn-grey btn-sm " data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-start">
                        <div class="form-group">
                            <label class="text-muted"><?php echo userlang('old_admin_password') ; ?></label>
                            <input name="oldpass" type="password"  maxlength="50" class="<?php echo colormode('border') ; ?> <?php echo colormode('default_text') ; ?> <?php echo colormode('textarea-bgcolor') ; ?> form-control" required autocomplete="off">
                        </div>
                        <div class="form-group mt-2">
                            <label class="text-muted"><?php echo userlang('new_admin_password') ; ?></label><br>
                            <small class="text-muted"><?php echo userlang('min_password') ; ?></small>
                            <input name="newpass" type="password" maxlength="50" class="<?php echo colormode('border') ; ?> <?php echo colormode('default_text') ; ?> <?php echo colormode('textarea-bgcolor') ; ?> form-control" required autocomplete="off">
                        </div>
                        <div class="form-group mt-2">
                            <label class="text-muted"><?php echo userlang('repassword_heading') ; ?></label>
                            <input name="repass" type="text"  maxlength="50" class="<?php echo colormode('border') ; ?> <?php echo colormode('default_text') ; ?> <?php echo colormode('textarea-bgcolor') ; ?> form-control" required>
                        </div>
                        <div class="form-group mt-2">
                            <div class="adpass-messages <?php echo colormode('default_text') ; ?>"></div>
                        </div>
                    </div>
                    <div class="modal-body text-end">
                        <input type="hidden" name="btn_action" value="btnChangePass">
                        <button type="submit" class="btn btn-primary btn-md action_log" id="action_log"><?php echo userlang('change') ; ?></button>
                    </div>
                </form>
			</div>
	</div>
</div>
<?php
include("js.php") ;
include("body_end.php") ;
?>