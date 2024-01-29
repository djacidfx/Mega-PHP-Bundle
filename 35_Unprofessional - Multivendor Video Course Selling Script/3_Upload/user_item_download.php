<?php include("header_session.php") ; ?>
<?php $webtitle = "Download Purchased Items" ; ?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>
<?php  
$username = username_by_id($pdo,$_SESSION['unprofessional']['id']) ;
$nt = '1' ;
?>
<?php include("sidebar_index.php"); ?>
<?php echo check_user_logged_in($pdo) ; ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1 class="text-muted"><i class="fas fa-download fa-lg"></i> Download Your Purchased Items</h1>
      </div>
        <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>Download Your Purchased Item as soon as Possible.</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table  class="table table-bordered table-hover manageDownloadItemTable" >
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Preview Image</th>
                                        <th>Title</th>
                                        <th>Link</th>
                                        <th>Item Status</th>
                                        <th>Download</th>
                                    </tr>
                                </thead>
                            </table><!-- /table -->
                        </div>
                        
                        
                    </div>
                </div>
              </div>
            </div>
          </div>
    </section>
</div>
<?php include("footer_main.php") ; ?>