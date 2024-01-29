<?php include("header.php") ; ?>
<?php
$postId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT) ;
if(check_post_id($pdo , $postId) == 0) {
    header("location: ".ADMIN_URL."dashboard");
}
post_seen($pdo,$postId) ;
$postTitle = post_title_by_id($pdo,$postId) ;
$postDescription = post_description_by_id($pdo,$postId) ; 
?>
<div class="col-lg-2 mt-2"></div>
<div class="col-lg-8 mt-2">
    <div class="card bg-dark text-white newShadow">
        <div class="card-header text-start">
            <h5><i class="bi bi-signpost-2-fill text-danger"></i> Edit Secret / Confessions </h5>
        </div>
    </div>
    <div class="card bg-dark text-white newShadow mt-2">
        <div class="card-header">
            <form method="post" class="editSecret">
                <div class="form-group">
                    <input type="text" name="title" maxlength="100" class="form-control bg-dark text-white customBorder" placeholder="Unique Title & Max 100 Character" autocomplete="off" required value="<?php echo $postTitle; ?>" >
                </div>
                <div class="form-group mt-1">
                    <textarea name="description" class="form-control new_txtarea" autofocus required><?php echo $postDescription ; ?></textarea>
                </div>
                <div class="form-group mt-3 justify-content-center text-center">
                    <div class="remove-messages"></div>
                    <input type="hidden" name="pid" value="<?php echo $postId ; ?>" >
                    <input type="hidden" name="btn_action" value="editPostSecret" >
                    <button type="submit" id="action_sb" class="action_sb btn btn-grey btn-md"><i class="bi bi-pencil-square text-primary"></i> Edit</button>
                </div>
            </form>
        </div>
    </div>
    <div class="card bg-dark text-white newShadow mt-4">
        <div class="card-header text-start">
            <h5><i class="bi bi-signpost-2-fill text-danger"></i> <?php echo $postTitle; ?> </h5>
        </div>
        <div class="card-body text-start">
            <?php echo $postDescription ; ?>
        </div>
    </div>
</div>
<div class="col-lg-2 mt-2"></div>
<?php include("footer.php") ; ?>