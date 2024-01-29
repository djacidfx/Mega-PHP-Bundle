<?php
include("db.php") ;
include("head.php") ;
include("header.php") ;
check_admin_logged_in($pdo);
$pageSlug = filter_var($_GET['slug'], FILTER_SANITIZE_STRING) ;
if(check_page_slug($pdo,$pageSlug) == '0'){
    header("location: ".ADMIN_URL."");
}
$pageId = pageid_by_page_slug($pdo,$pageSlug);
$pageDescription = pagedescription_by_page_slug($pdo,$pageSlug);
$pageTitle = get_page_title($pdo,$pageSlug) ; 
?>
<div class="row p-0">
    <div class="col-lg-12 text-center">
        <h1 class="<?php echo colormode('default_text') ; ?>"> <i class="bi bi-journal-bookmark text-primary"></i> <?php echo userlang('edit_page') ; ?></h1>
    </div>
    <div class="col-lg-2"></div>
    <div class="col-lg-8">
        <div class="card <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> newShadow mb-2">
            <div class="card-body">
                <form method="post" class="editPage">
                    <div class="row">
                        <div class="col-lg-12">
                            <label class="text-muted"><?php echo userlang('page_name') ; ?> <small><?php echo userlang('page_name_unique') ; ?></small></label>
                            <input type="text" name="page_name" class="mt-3 mb-3 form-control <?php echo colormode('bg_color') ; ?> <?php echo colormode('default_text') ; ?> <?php echo colormode('border') ; ?>" value="<?php echo $pageTitle ; ?>" maxlength="25" autofocus autocomplete="off" required>
                        </div>
                        <div class="col-lg-12">
                            <label class="text-muted mb-2"><?php echo userlang('page_description') ; ?></label>
                            <textarea name="description" class="form-control new_txtarea" required><?php echo $pageDescription ; ?></textarea>
                        </div>
                        <div class="col-lg-12 mt-4 text-center">
                            <div class="remove-messages"></div>
                            <input type="hidden" name="pid" value="<?php echo $pageId ; ?>" >
                            <input type="hidden" name="btn_action" value="edit_page">
                            <button type="submit" class="btn btn-primary btn-md action_log"><i class="bi bi-box-arrow-in-right me-1"></i><?php echo userlang('edit_page') ; ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-2"></div>
</div>
<?php
include("js.php") ;
?>