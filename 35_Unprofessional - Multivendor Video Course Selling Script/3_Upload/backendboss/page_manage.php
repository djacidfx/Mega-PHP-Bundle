<?php include("header.php") ; ?>
<?php 
$pages = "active" ; 
$managePage = "active" ;
?>
<?php include("sidebar.php") ; ?>
<!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1 class="text-muted"><i class="fa fa-pencil-alt"></i> Manage Pages </h1>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>You can disable your pages anytime. Note : Disabled Pages cannot viewed by Users.</h4>              
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3"></div><div class="col-lg-6"><div class="remove-messages"></div></div><div class="col-lg-3"></div>
                        <div class="table-responsive">
                            <table  class="table table-bordered table-hover managePagesTable" id="managePagesTable" >
                                <thead>
                                    <tr>
                                        <th>S.No.</th>	
                                        <th>Page Name</th>	
                                        <th>Page Slug</th>
                                        <th>Status</th>
                                        <th><i class="fa fa-eye"></i></th>
                                        <th><i class="fa fa-pencil-alt"></i></th>
                                        <th><i class="fa fa-ban text-danger"></i></th>
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