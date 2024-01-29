<?php include("header_session.php") ; ?>
<?php $webtitle = "Deleted Items" ; ?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>
<?php 
$deletedItem = "active" ; 
$dashboard = "active" ;
$nt = '1' ;
?>
<?php include("sidebar_index.php"); ?>
<?php echo check_user_logged_in($pdo) ; ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1 class="text-muted"><i class="fas fa-trash fa-lg"></i> Deleted Items</h1>
      </div>
      <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>All Items which you've Deleted or Deleted by Reviewer.<small>&ensp;(Note : Main Zip File & Demo Video has been deleted completely & No longer available. Deleted Items cannot be restore)</small></h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 remove_message_pause"></div>
                        <div class="table-responsive">
                            <table  class="table table-bordered table-hover manageDeletedItemsTable" >
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Item ID</th>
                                        <th>Video Title</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Sales</th>
                                        <th>Rating</th>
                                        <th>Rated By</th>
                                        <th>Loved By</th>
                                        <th>Views</th>
                                        <th>Comments</th>
                                        <th>Status</th>
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