<?php 
include("header.php") ; 
if(!empty($_GET['id'])) {
	$pageId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT) ;
	$page_statement = $pdo->prepare("select * from anony_comment where comment_id = '".$pageId."'");
	$page_statement->execute();
	$page_item = $page_statement->rowCount(); 
	$page_result = $page_statement->fetchAll(PDO::FETCH_ASSOC);
	if($page_item > 0){
		foreach($page_result as $pageRow) {
			$postId = _e($pageRow['post_id']) ;
            $postTitle = get_post_title($pdo,$postId) ;
            $comment = base64_decode($pageRow['comment']) ;
            $username = _e($pageRow['user_name']) ;
            $useremail = _e($pageRow['user_email']) ;
            $adminReply = base64_decode($pageRow['admin_reply']) ;
		}
	} else {
		header('location: '.ADMIN_URL.'unreplied.php') ;
	}
}
?>
<div class="app-title">
        <div>
		<?php 
		if(isset($page_item) > 0){ ?>
          <h1><i class="fa fa-pencil-alt"></i> Post Title</h1>
		  <p class="text-success"><?php echo $postTitle ; ?></p>
		<?php } ?>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?php echo BASE_URL ; ?>post/<?php echo $postId ; ?>" target="_blank">View Post</a></li>
        </ul>
</div>
<div class="tile">
<?php if(isset($page_item) > 0){ ?>
<form method="post" enctype="multipart/form-data" class="editComment" >
	<div class="row">
			<div class="col-lg-6">
				<div class="form-group">
					<label>User Name*</label>
					<input type="text" name="username" class="form-control" autocomplete="off" autofocus required value="<?php echo $username ; ?>" maxlength="50">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="form-group">
					<label>User Email*</label>
					<input type="text" name="email" class="form-control" maxlength="50" autocomplete="off" autofocus required value="<?php echo $useremail ; ?>">
				</div>
			</div>
			<div class="col-lg-12">
				<div class="form-group">
					<label>User Comment*</label>
					<textarea name="comment"  class="new_txtarea form-control" autofocus required><?php echo $comment ; ?></textarea>
				</div>
			</div>
            <div class="col-lg-12">
				<div class="form-group">
					<label>Admin Reply*</label>
					<textarea name="comment_reply"  class="new_txtarea form-control" autofocus required><?php echo $adminReply ; ?></textarea>
				</div>
			</div>
	</div>
	<div class="row mt-4">
		<div class="col-lg-12 text-center">
			<div class="remove-messages"></div>
			<input type="hidden" name="cId" value="<?php echo $pageId ; ?>" >
			<input type="hidden" name="btn_action" id="btn_action" value="save_comment">
			<input type="submit" name="action_page" class="btn btn-md btn-info" value="Edit / Post Admin Reply" >
		
		</div>
	</div>
</form>
<?php } ?>
</div>

<?php include("footer.php") ; ?>