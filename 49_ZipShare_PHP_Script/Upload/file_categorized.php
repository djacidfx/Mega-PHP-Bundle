<?php
include("db.php") ;
$urlTitle = filter_var($_GET['slug'], FILTER_SANITIZE_STRING) ;
$catId = get_categoryid_byslug($pdo,$urlTitle) ;
$catName = get_catname_byid($pdo,$catId) ;
if(check_cat_id($pdo,$catId) == 0) {
    header("location: ".BASE_URL."");
}
include("head_category.php") ;
include("header.php") ;
?>
<div class="row p-0">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <div class="row p-0">
            <div class="col-lg-7 ">
                <?php echo show_category_default($pdo,$catId); ?>
                <div class="jQueryLoadMoreCategoryFiles"></div>
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
