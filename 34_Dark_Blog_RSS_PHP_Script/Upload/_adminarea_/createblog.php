<?php 
include("header.php") ; 
if(!empty($_GET['id'])) {
	$pageId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT) ;
	$page_statement = $pdo->prepare("select * from anony_post where id = '".$pageId."'");
	$page_statement->execute();
	$page_item = $page_statement->rowCount(); 
	$page_result = $page_statement->fetchAll(PDO::FETCH_ASSOC);
	if($page_item > 0){
		foreach($page_result as $pageRow) {
            $catId = _e($pageRow['cat_id']) ;
			$pageName = strip_tags($pageRow['post_title']) ;
			$pageSlug = _e($pageRow['id']) ;
			$pageContent = base64_decode($pageRow['post_description']) ;
		}
	} else {
		header('location: '.ADMIN_URL.'createblog.php') ;
	}
}
?>
<div class="app-title">
        <div>
		<?php 
		if(isset($page_item) > 0){ ?>
          <h1><i class="fa fa-pencil-alt"></i> Edit Blog</h1>
		  <p class="text-success">Requirements (Title, Category & Content.)</p>
		<?php } else { ?>
          <h1><i class="fa fa-rss-square text-success"></i> Blog</h1>
		  <p class="text-success">Create / Edit Unlimited Blogs for Users.</p>
		  <?php } ?>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?php echo ADMIN_URL ; ?>dashboard.php">Dashboard</a></li>
        </ul>
</div>
<div class="tile">
<?php if(isset($page_item) > 0){ ?>
<form method="post" enctype="multipart/form-data" class="editBlog" >
	<div class="row">
			<div class="col-lg-8">
				<div class="form-group">
                    <label class="text-muted">Blog Title* <small>(Max 100 Characters)</small></label>
					<input type="text" name="blog_title" class="form-control" maxlength="100" autocomplete="off" autofocus required placeholder="Example - How to Create Sitemap in PHP ?" value="<?php echo $pageName ; ?>">
				</div>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
                    <label class="text-muted">Category*</label>
					<select class="form-control" name="catId" id="catId" required>
                        <?php echo get_selected_category($pdo,$pageId) ; ?>
                        <?php echo not_selected_category($pdo,$catId) ; ?>
                    </select>
				</div>
			</div>
			
			<div class="col-lg-12">
				<div class="form-group">
					<label>Page Content*</label>
					<textarea name="page_content" id="item_message" class="form-control" autofocus required><?php echo $pageContent ; ?></textarea>
				</div>
			</div>
	</div>
	<div class="row mt-4">
		<div class="col-lg-12 text-center">
			<div class="remove-messages"></div>
			<input type="hidden" name="postId" value="<?php echo $pageId ; ?>" >
			<input type="hidden" name="btn_action" id="btn_action" value="edit_blog">
			<input type="submit" name="action_page" class="btn btn-md btn-info" value="Edit Blog" >
		
		</div>
	</div>
</form>
<div class="step2">
	<div class="row">
		<div class="col-lg-12 text-center">
			<p class="text-success">Your Blog has been Edited Successfully. &ensp; <a href="<?php echo ADMIN_URL ; ?>manageblogs.php" class="btn btn-success btn-sm">Change Status of Blog</a>
		</div>
	</div>
</div>
<?php } else { ?>
<form method="post" enctype="multipart/form-data" class="saveBlog" >
	<div class="row">
			<div class="col-lg-8">
				<div class="form-group">
					<label class="text-muted">Blog Title* <small>(Max 100 Characters)</small></label>
					<input type="text" name="blog_title" class="form-control" maxlength="100" autocomplete="off" autofocus required placeholder="Example - How to Create Sitemap in PHP ?">
				</div>
			</div>
			<div class="col-lg-4">
				<div class="form-group">
					<label class="text-muted">Category*</label>
					<select class="form-control" name="catId" id="catId" required>
                        <option value="">Please Choose Category</option>
                        <?php echo active_category_select($pdo) ; ?>
                    </select>
				</div>
			</div>
			
			<div class="col-lg-12">
				<div class="form-group">
					<label class="text-muted">Blog Content*</label>
					<textarea name="page_content" id="item_message" class="form-control" autofocus required></textarea>
				</div>
			</div>
	</div>
	<div class="row mt-4">
		<div class="col-lg-12 text-center">
			<div class="remove-messages"></div>
			<input type="hidden" name="btn_action" id="btn_action" value="save_blog">
			<input type="submit" name="action_page" class="btn btn-md btn-info" value="Publish Blog" >
		</div>
	</div>
</form>
<div class="step3">
	<div class="row">
		<div class="col-lg-12 text-center">
			<p class="text-success">Your Blog has been Published. &ensp; <a href="<?php echo ADMIN_URL ; ?>createblog.php" class="btn btn-success btn-sm">Create New Blog</a>
		</div>
	</div>
</div>
<?php } ?>
</div>

<?php include("footer.php") ; ?>