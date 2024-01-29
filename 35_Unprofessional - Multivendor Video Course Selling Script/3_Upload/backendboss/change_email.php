<?php include("header.php") ; ?>
<?php include("sidebar.php") ; ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1 class="text-muted"><i class="fa fa-envelope"></i> Change Email </h1>
      </div>
      <div class="row">
            <div class="col-lg-3"></div>  
            <div class="col-lg-6">
              <div class="card">
                <div class="card-body">
                    <form method="post" id="email_validation" class="email_validation">
                        <div class="form-group">
                            <label for="email"><i class="fa fa-envelope"></i> New Email*</label>
                            <input type="email" class="form-control" name="newemail" id="newemail" placeholder="New Email" maxlength="50" required>
                        </div>
                        <div class="form-group">
                            <label for="oldpass"><i class="fa fa-key"></i> Password*</label>
                            <input type="password" class="form-control" name="passw" id="passw" placeholder="Password" maxlength="50" required>
                        </div>
                        <div class="col-md-12 text-center">
                            <div class="remove-messages"></div>
                            <input type="hidden" name="btn_action" value="change_admin_email" />
                            <input type="submit" id="email_submit" name="email_submit" class="btn btn-primary text-center form_submit" value="Update Email" />
                        </div>
                    </form>
                </div>
              </div>
            </div>
            <div class="col-lg-3"></div> 
      </div>
    </section>
</div>
<?php include("footer.php") ; ?>
