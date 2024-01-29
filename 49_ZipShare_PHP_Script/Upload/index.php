<?php
include("db.php") ;
include("head.php") ;
include("header.php") ;
?>
<div class="row p-0">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <div class="row p-0">
            <div class="col-lg-7">
                <?php echo show_index_default($pdo); ?>
                <div class="jQueryLoadMoreIndexFiles"></div>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-4">
                <?php include("sidebar.php") ; ?>
            </div>
            <div class="col-lg-12">
                <?php echo index_page_blog($pdo); ?> 
            </div>
        </div>
    </div>
    <div class="col-lg-1"></div>
</div>
<?php
include("js.php") ;
?>
