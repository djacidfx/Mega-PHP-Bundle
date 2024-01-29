<?php include("header.php") ; ?>
<?php 
$settings = "active" ; 
$analyticSettings = "active" ;
$userOn = ga_on_user($pdo);
$adminOn = ga_on_admin($pdo);
$com = "";
?>
<?php include("sidebar.php") ; ?>
<!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1 class="text-muted"><i class="fa fa-cog"></i> Google Analytic Settings </h1>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>You can Turn On / Off Google Analytics for User & Admin Panel.</h4>              
                </div>
                <div class="card-body">
                    <form method="post" enctype="multipart/form-data" class="ga_settings">
                    <div class="row">
                        <div class="col-lg-3 mt-3">
                        </div>
                        <div class="col-lg-6 mt-3">
                            <label><i class="fab fa-google"></i>&ensp; Google Analytics Javascript Code </label>
                            <textarea name="gCode" class="form-control textareaVeryLarge" required><?php echo ga_code($pdo); ?></textarea>
                            <label class="mt-2">Turn On Analytics for User Pages* </label>
                            <select name="userOn" class="form-control" required>
                                <option value="1" <?php if($userOn == '1'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>Yes</option>
                                <option value="0"<?php if($userOn == '0'){ echo $sub = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>No</option>
                            </select>
                            <label class="mt-2">Turn On Analytics for Admin Pages* </label>
                            <select name="adminOn" class="form-control" required>
                                <option value="1" <?php if($adminOn == '1'){ echo $com = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>Yes</option>
                                <option value="0"<?php if($adminOn == '0'){ echo $sub = 'selected = "selected" ' ; } else { echo $com = '' ; } ?>>No</option>
                            </select>
                        </div> 
                        <div class="col-lg-3 mt-3">
                            
                        </div>
                        
                        <div class="col-lg-4 mt-3"></div>
                        <div class="col-lg-4 mt-3">
                            <div class="remove-messages"></div>
                             <input type="hidden" name="btn_action" value="saveGASettings">
                            <button type="submit" class="btn btn-primary btn-md btn-block mt-3" tabindex="4">Save Analytic Settings</button>
                        </div>
                        <div class="col-lg-4 mt-3"></div>
                        
                    </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        </section>
    </div>

<?php include("footer.php") ; ?>