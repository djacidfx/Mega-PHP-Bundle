<?php include("header.php") ; ?>

<div class="col-lg-12 mt-2">
    <div class="card bg-dark text-white newShadow">
        <div class="card-header text-start">
            <h5><i class="bi bi-bookmark-star text-warning"></i> Featured Secret / Confessions </h5>
        </div>
    </div>
</div>
<div class="col-lg-12 mt-4">
    <div class="remove-messages p-3"></div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover table-dark cell-border dataTableWidth" id="manageFeaturedPostsTable">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>User IP</th>
                    <th>Post ID</th>
                    <th>Post Title</th>		
                    <th>Date</th>
                    <th>Views</th>
                    <th>Love</th>
                    <th>Comments</th>
                    <th>Seen/Unseen</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table><!-- /table -->
    </div>
</div>
<?php include("footer.php") ; ?>