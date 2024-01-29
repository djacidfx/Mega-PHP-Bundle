<?php include("header.php") ; ?>
<?php 
$viewcategory = "active" ; 
$dashboard = "active" ;
?>
<?php include("sidebar.php") ; ?>
<!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1 class="text-muted"><i class="fa fa-clone"></i> View Category </h1>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>Edit, Activate / Deactivate Category</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table  class="table table-bordered table-hover manageCategoryTable" >
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Category ID</th>
                                        <th>Preview Image</th>
                                        <th>Category Name</th>
                                        <th>Views</th>
                                        <th>Courses</th>
                                        <th>Status</th>
                                        <th><i class="fa fa-pencil-alt"></i></th>
                                        <th><i class="fa fa-ban"></i></th>
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