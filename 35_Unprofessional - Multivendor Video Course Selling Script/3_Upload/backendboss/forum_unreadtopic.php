<?php include("header.php") ; ?>
<?php 
$topicseen = "active" ; 
$forum = "active" ;
?>
<?php include("sidebar.php") ; ?>
<!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1 class="text-muted"><i class="fa fa-question-circle"></i> Forum Unread Topic </h1>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>When Someone added a new reply to Topic. Then Topic will open again to Unread Topic</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 remove-messages"></div>
                        <div class="table-responsive">
                            <table  class="table table-bordered table-hover manageForumTopicTable" >
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Topic ID</th>
                                        <th>Title</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                        <th>Replies</th>
                                        <th>Solved</th>
                                        <th>View</th>
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