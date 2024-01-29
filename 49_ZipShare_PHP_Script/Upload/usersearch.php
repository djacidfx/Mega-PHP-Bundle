<?php
include("db.php") ;
$search = filter_var($_GET['term'] , FILTER_SANITIZE_STRING) ;
if(!isset($_GET['term'])){
    header("location:".BASE_URL." ") ;
}
include("head_search.php") ;
include("header.php") ;
?>
<div class="row p-0">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <div class="row p-0">
            <div class="col-lg-7">
                <?php echo show_search_default($pdo,$search); ?>
                <div class="jQueryLoadMoreSearchFiles"></div>
            </div>
            <div class="col-lg-1"></div>
            <div class="col-lg-4">
                <?php include("sidebar.php") ; ?>
            </div>
        </div>
    </div>
    <div class="col-lg-1"></div>
</div>
<?php
include("js.php") ;
?>
