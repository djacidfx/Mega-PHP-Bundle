<?php include("header.php") ; ?>
<?php 
$items = "active" ; 
$featured = "active" ;
?>
<?php include("sidebar.php") ; ?>
<!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1 class="text-muted"><i class="fa fa-video"></i> Make Featured Items </h1>
          </div>
          <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4"><div class="remove-messages"></div></div>
            <div class="col-lg-4"></div>
            <div class="col-lg-6 mt-2">
              <div class="card">
                <div class="card-header">
                  <h4>All Items which you want to Make Featured. Note : Once Item is Featured, You cannot reverse back to Unfeatured.</h4>              
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table  class="table table-bordered table-hover nonFeaturedItemTable" id="nonFeaturedItemTable" >
                                <thead>
                                    <tr>
                                        <th>S.No.</th>	
                                        <th>Item ID</th>	
                                        <th>Title</th>
                                        <th>Price</th>
                                        <th>Sales</th>
                                        <th>Loves</th>
                                        <th>Views</th>
                                        <th><i class="fa fa-eye"></i></th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table><!-- /table -->
                        </div>
                        
                        
                    </div>
                </div>
              </div>
            </div>
            <div class="col-lg-6 mt-2">
              <div class="card">
                <div class="card-header">
                  <h4>Featured Items. Note : MakeFeaturedAgain means Item will be featured again as a New Featured Item.</h4>              
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table  class="table table-bordered table-hover FeaturedItemTable" id="FeaturedItemTable" >
                                <thead>
                                    <tr>
                                        <th>S.No.</th>	
                                        <th>Item ID</th>	
                                        <th>Title</th>
                                        <th>Price</th>
                                        <th>Sales</th>
                                        <th>Loves</th>
                                        <th>Views</th>
                                        <th><i class="fa fa-eye"></i></th>
                                        <th>Action</th>
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