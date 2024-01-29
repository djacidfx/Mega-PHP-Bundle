<?php include("header.php") ; ?>
<?php 
$items = "active" ; 
$disabledItems = "active" ;
?>
<?php include("sidebar.php") ; ?>
<!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1 class="text-muted"><i class="fa fa-video"></i> Disabled Items </h1>
          </div>
          <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4"><div class="remove-messages"></div></div>
            <div class="col-lg-4"></div>
            <div class="col-lg-12 mt-2">
              <div class="card">
                <div class="card-header">
                  <h4>Note : Enabled Item will be live for Users & can be downloaded. You can disable anytime. You can also delete the Item only here. Deleted Item will only Delete the Main Zip File & Demo Video. No one can access the Deleted Item.</h4>              
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table  class="table table-bordered table-hover disableItemTable" id="disableItemTable" >
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Author ID</th>
                                        <th>Username</th>
                                        <th>Item ID</th>	
                                        <th>Title</th>
                                        <th>Preview</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                        <th>Price</th>
                                        <th>Sales</th>
                                        <th>Loves</th>
                                        <th>Views</th>
                                        <th>Rating</th>
                                        <th>Rated By</th>
                                        <th>Featured</th>
                                        <th>Action</th>
                                        <th>Delete</th>
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