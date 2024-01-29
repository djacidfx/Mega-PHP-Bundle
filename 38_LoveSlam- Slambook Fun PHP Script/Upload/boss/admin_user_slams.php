<?php  include("header.php") ; ?>
<div class="col-lg-12 mt-1">
    <div class="card shadow-lg">
        <div class="card-header">
            <h1 class="text-muted text-start"> <i class="bi bi-suit-heart-fill text-danger "></i> User Slams </h1>
        </div>
    </div>
</div>

<div class="col-lg-12  mt-4">
    <div class="remove-messages"></div>
    <div class="table-responsive bg-light p-3 text-start">   
        <table class="table table-bordered table-hover table-light" id="manageSlamsTable">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Date</th>
                    <th>User IP</th>
                    <th>Username</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>
<?php  include("footer.php") ; ?>