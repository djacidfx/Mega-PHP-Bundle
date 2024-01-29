<?php include("header.php") ; ?>
<?php 
$users = "active" ; 
$blockedUsers = "active" ;
?>
<?php include("sidebar.php") ; ?>
<!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1 class="text-muted"><i class="fa fa-users"></i> Blocked Users </h1>
          </div>
          <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4"><div class="remove-messages"></div></div>
            <div class="col-lg-4"></div>
            <div class="col-lg-12 mt-2">
              <div class="card">
                <div class="card-header">
                  <h4>Here's the list of Only Blocked User whose status is note active or blocked. Note : You cannot Unblock those Users who had Sale Reversal in Past or Not Verify SignUp OTP. Those Users are Permanently Blocked.</h4>              
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table  class="table table-bordered table-hover blockedUsersTable" id="blockedUsersTable" >
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>User ID</th>
                                        <th>Profile Pic</th>
                                        <th>Fullname</th>
                                        <th>Username</th>
                                        <th>Email</th>	
                                        <th>SignUp Date</th>
                                        <th>Status</th>
                                        <th>Unblock</th>
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


<?php include("footer.php") ; ?>