<?php
include("db.php") ;
include("head.php") ;
include("header.php") ;
check_admin_logged_in($pdo);
?>
<div class="row mt-2">
    <div class="col-lg-12 <?php echo colormode('default_text') ; ?> ">
        <div class="row p-0">
            <div class="col-lg-12 mb-3 ">
                <h1 class="text-muted"> <i class="bi bi-clipboard-x text-danger"></i> <?php echo userlang('deactive_blog') ; ?></h1>
            </div>
            <div class="table-responsive p-3 <?php echo colormode('bg_color') ; ?> rounded newShadow">
                <div class="remove-messages <?php echo colormode('default_text') ; ?>"></div>
                <table class="table table-bordered <?php echo colormode('tbl_dark') ; ?> table-hover cell-border manage_deactiveblog_table" >
                    <thead>
                        <tr>
                            <th><?php echo userlang('serial_number') ; ?></th>
                            <th><?php echo userlang('date') ; ?></th>
                            <th><?php echo userlang('blog_id') ; ?></th>
                            <th><?php echo userlang('blog_name') ; ?></th>
                            <th><?php echo userlang('blog_image') ; ?></th>
                            <th><?php echo userlang('action') ; ?></th>
                        </tr>
                    </thead>
                </table><!-- /table -->
            </div>
        </div>
    </div>
</div>
<?php
include("js.php") ;
?>