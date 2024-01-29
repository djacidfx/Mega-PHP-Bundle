<?php
include("db.php") ;
$pageSlug = filter_var($_GET['slug'], FILTER_SANITIZE_STRING) ;
if(check_page_slug($pdo,$pageSlug) == '0'){
    header("location: ".BASE_URL."");
}
$pageId = pageid_by_page_slug($pdo,$pageSlug);
$pageDescription = pagedescription_by_page_slug($pdo,$pageSlug);
$pageTitle = get_page_title($pdo,$pageSlug) ; 
include("head_pages.php") ;
include("header.php") ;
?>
<div class="row p-0">
    <div class="col-lg-1"></div>
    <div class="col-lg-10">
        <div class="row p-0">
            <div class="card newShadow <?php echo colormode('bg_color') ; ?> pe-0 ps-0 mb-3">
                <div class="card-header">
                    <h2 class="text-muted"><i class="bi bi-journal-bookmark text-primary me-2"></i> <?php echo $pageTitle ; ?></h2>
                </div>
                <div class="card-body <?php echo colormode('border_top') ; ?>">
                    <p class="<?php echo colormode('default_text') ; ?>"><?php echo ($pageDescription) ; ?></p>
                </div>
            </div>                
        </div>
    </div>
    <div class="col-lg-1"></div>
</div>
<?php
include("js.php") ;
?>
