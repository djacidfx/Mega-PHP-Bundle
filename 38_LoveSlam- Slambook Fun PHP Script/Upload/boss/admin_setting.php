<?php include("header.php") ; ?>

<div class="col-lg-12 mt-1">
    <div class="card shadow-lg">
        <div class="card-header">
            <h1 class="text-muted text-start"> <i class="bi bi-gear-fill text-danger "></i> Main Settings </h1>
        </div>
    </div>
</div>
<div class="col-lg-3"></div>
<div class="col-lg-6 mt-2">
    <form method="post" class="gaCode">
        <div class="card newShadow">
            <div class="card-header">
                <h6><i class="bi bi-laptop text-warning"></i> Google Analytics Setting</h6>
            </div>
            <div class="card-body">
                <div class="col-lg-12 mt-2 text-start">
                    <label class="text-muted">Paste Google Analytics Javascript Code*</label>
                    <textarea name="ga_code" class="form-control" rows="8"><?php echo analytics_code($pdo) ; ?></textarea>
                </div>
                <div class="row">
                <div class="col-lg-6 mt-2 text-start">
                    <label class="text-muted ">For User Panel*</label>
                    <select name="user_status" class="form-control"> 
                        <option value="2" <?php if(analytics_user_status($pdo) == '0'){ ?> selected="selected" <?php } ?> >Turned Off</option>
                        <option value="1" <?php if(analytics_user_status($pdo) == '1'){ ?> selected="selected" <?php } ?>>Turned On</option>
                    </select>
                </div>
                
                <div class="col-lg-6 mt-2 text-start">
                    <label class="text-muted ">For Admin Panel*</label>
                    <select name="admin_status" class="form-control"> 
                        <option value="2" <?php if(analytics_admin_status($pdo) == '0'){ ?> selected="selected" <?php } ?> >Turned Off</option>
                        <option value="1" <?php if(analytics_admin_status($pdo) == '1'){ ?> selected="selected" <?php } ?>>Turned On</option>
                    </select>
                </div>
                </div>
                <div class="col-lg-12 mt-4">
                    <div class="gamessage"></div>
                    <input type="hidden" name="btn_action" value="saveGaCode">
                    <button type="submit"  class="btn btn-sm btn-danger buttonga"><i class="bi bi-gear text-white"></i> Save Setting</button>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="col-lg-3"></div>
<div class="col-lg-3"></div>
<div class="col-lg-6 mt-2">
    <form method="post" class="aboutUsInfo">
        <div class="card newShadow">
            <div class="card-header">
                <h6><i class="bi bi-laptop text-warning"></i> Footer Copyright Name</h6>
            </div>
            <div class="card-body">
                <div class="col-lg-12 mt-2 text-start">
                    <label class="text-muted ">Coyright Name*</label>
                    <input name="copyright" type="text" maxlength="50" class="form-control" value="<?php echo copyright_name($pdo) ; ?>" >
                </div>   
                
                <div class="col-lg-12 mt-4">
                    <div class="aboutmessage"></div>
                    <input type="hidden" name="btn_action" value="saveaboutus">
                    <button type="submit"  class="btn btn-sm btn-danger buttonabout "><i class="bi bi-gear text-white "></i> Save Setting</button>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="col-lg-3"></div>

<div class="col-lg-3"></div>
<div class="col-lg-6 mt-2">
    <form method="post" class="extraInfo">
        <div class="card newShadow">
            <div class="card-header">
                <h6><i class="bi bi-laptop text-warning"></i> Block Message</h6>
            </div>
            <div class="card-body">
                <div class="col-lg-12 mt-2 text-start">
                    <label class="text-muted">User Blocked Message* (Max 250 Chars)</label>
                    <textarea name="blk" class="form-control" rows="8" maxlength="250"><?php echo block_message($pdo) ; ?></textarea>
                </div> 
                
                <div class="col-lg-12 mt-4">
                    <div class="extramessage"></div>
                    <input type="hidden" name="btn_action" value="saveextra">
                    <button type="submit"  class="btn btn-sm btn-danger buttonextra"><i class="bi bi-gear text-white "></i> Save Setting</button>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="col-lg-3"></div>
<div class="col-lg-3"></div>
<div class="col-lg-6 mt-2">
    <div class="row">
        <div class="col-lg-12">
            <form method="post" class="changeEmail">
                <div class="card newShadow">
                    <div class="card-header">
                        <h6><i class="bi bi-laptop text-warning"></i> Change Email</h6>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12 mt-2 text-start">
                            <label class="text-muted">Email*</label>
                            <input name="email" type="email" maxlength="50" class="form-control" value="<?php echo admin_email($pdo) ; ?>" >
                        </div>
                        <div class="col-lg-12 mt-2 text-start">
                            <label class="text-muted ">Password*</label>
                            <input name="password" type="password" maxlength="100" class="pass form-control " value="" >
                        </div>   

                        <div class="col-lg-12 mt-4">
                            <div class="emailmessage"></div>
                            <input type="hidden" name="btn_action" value="saveemail">
                            <button type="submit"  class="btn btn-sm btn-danger buttonemail"><i class="bi bi-gear text-white "></i> Change Email</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="col-lg-12 mt-2">
            <form method="post" class="changePassword">
                <div class="card newShadow">
                    <div class="card-header">
                        <h6><i class="bi bi-laptop text-warning"></i> Change Password</h6>
                    </div>
                    <div class="card-body">
                        <div class="col-lg-12 mt-2 text-start">
                            <label class="text-muted">Old Password*</label>
                            <input name="oldpass" type="password" maxlength="50" class="form-control" value="" >
                        </div>
                        <div class="col-lg-12 mt-2 text-start">
                            <small class="text-muted">Password must contain minimum 8 characters, 1 Uppercase character, 1 Lowercase character & 1 number.</small>
                            <br>
                            <label class="text-muted ">New Password*</label>                        
                            <input name="newpass" type="password" maxlength="100" class="pass form-control " value="" >
                        </div>
                        
                        <div class="col-lg-12 mt-2 text-start">
                            <label class="text-muted ">Confirm New Password*</label>
                            <input name="repass" type="text" maxlength="100" class="pass form-control " value="" >
                        </div> 

                        <div class="col-lg-12 mt-4">
                            <div class="passmessage"></div>
                            <input type="hidden" name="btn_action" value="savepassword">
                            <button type="submit"  class="btn btn-sm btn-danger buttonpass"><i class="bi bi-gear text-white "></i> Change Password</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
    </div>
</div>
<div class="col-lg-3"></div>

<?php include("footer.php") ; ?>