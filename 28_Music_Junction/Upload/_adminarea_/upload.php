<?php 
include("header.php") ; 
if(!empty($_GET['item_id'])) {
	$ItemId = filter_var($_GET['item_id'], FILTER_SANITIZE_NUMBER_INT) ;
	$item_statement = $pdo->prepare("select * from item_db where item_id = '".$ItemId."'");
	$item_statement->execute();
	$total_item = $item_statement->rowCount(); 
	$item_result = $item_statement->fetchAll(PDO::FETCH_ASSOC);
	if($total_item > 0){
		foreach($item_result as $itemRow) {
			$itemName = strip_tags($itemRow['item_name']) ;
			$catId = _e($itemRow['main_category']) ;
			$catName = fetch_active_category_name($pdo,$catId) ;
			$itemTags = strip_tags($itemRow['item_tags']) ;
			$albumName = _e($itemRow['item_album_name']) ;
		}
	} else {
		$_SESSION['item_error_msg'] = "This Item is not exist. Please Upload New Item instead.";
		header('location: '.ADMIN_URL.'upload.php') ;
	}
}
?>
<div class="app-title">
        <div>
		<?php 
		if(isset($total_item) > 0){ ?>
          <h1><i class="fa fa-upload"></i> Edit Music</h1>
		  <p class="text-success">Requirements (Music Title, Artist, Tags.)</p>
		<?php } else { ?>
		   <h1><i class="fa fa-upload"></i> Upload Music</h1>
		   <p class="text-success">Requirements (Music Title, Artist, Tags & Main Audio File).</p>
		<?php } ?>
		  
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?php echo ADMIN_URL ; ?>dashboard.php">Dashboard</a></li>
        </ul>
 </div>
<div class="tile">
<?php 
					if(! empty($_SESSION['item_error_msg'])){ ?>
						<div  class="alert alert-danger errorMessage">
						<button type="button" class="close float-right" aria-label="Close" >
						  <span aria-hidden="true" id="hide">&times;</span>
						</button>
				<?php
						echo $_SESSION['item_error_msg'] ;
						unset($_SESSION['item_error_msg']);
				?>
						</div>
			<?php } ?>
<!-- STEP 1 Start-->
<div class="step1">
<?php if(isset($total_item) > 0){ ?>
<form method="post" enctype="multipart/form-data" class="step1formedit">
	<div class="row">
		<div class="col-lg-12">
		<h4 class="text-muted">Music Title & Artist</h4>
		<hr>
		</div>
		<div class="col-lg-6">
			<div class="form-group">
				<label>Music Title* (Max 50 Characters)</label>
				<input type="text" name="item_name" class="form-control" maxlength="50" autocomplete="off" autofocus required value="<?php echo $itemName ; ?>">
			</div>
		</div>
		<div class="col-lg-3">
			<div class="form-group">
				<label>Album Name (Max 25 Characters)</label>
				<input type="text" name="album_name" class="form-control" maxlength="25" autocomplete="off" autofocus value="<?php echo $albumName ; ?>">
			</div>
		</div>
		<div class="col-lg-3">
			<div class="form-group">
				<label>Artist Name*</label>
				<select name="cat" id="cat" required class="form-control">
					<?php echo $catName ; ?>
					<?php echo get_active_category_selected($pdo,$catId) ; ?>
				</select>
			</div>
		</div>
		
	</div>
	
	<div class="row mt-2">
		<div class="col-lg-12">
		<h4 class="text-muted">Music Tags* <small class="text-muted">(Tags will Boost the SEO & Music Search)</small></h4>
		<hr>
		</div>
		<div class="col-lg-12">
		<textarea name="item_tag" id="item_tag" class="form-control" placeholder="Example : Music, Ambient Music, Pitbull Music etc..." autofocus required><?php echo $itemTags ; ?></textarea>
		</div>
	</div>
	<div class="row mt-4">
		<div class="col-lg-12 text-center">
			<div class="remove-messages"></div>
			<input type="hidden" id="item_id" name="item_id" value="<?php echo $ItemId ; ?>">
			<input type="hidden" name="btn-action" id="btn-action" value="edit_step_1">
			<input type="submit" name="action-item" class="btn btn-md btn-success" value="Save & Next" >
		</div>
	</div>
</form>
<?php } else { ?>
<form method="post" enctype="multipart/form-data" class="step1form">
	<div class="row">
		<div class="col-lg-12">
		<h4 class="text-muted">Music Title & Artist</h4>
		<hr>
		</div>
		<div class="col-lg-6">
			<div class="form-group">
				<label>Music Title* (Max 50 Characters)</label>
				<input type="text" name="item_name" class="form-control" maxlength="50" autocomplete="off" autofocus required>
			</div>
		</div>
		<div class="col-lg-3">
			<div class="form-group">
				<label>Album Name (Max 25 Characters)</label>
				<input type="text" name="album_name" class="form-control" maxlength="25" autocomplete="off" autofocus >
			</div>
		</div>
		<div class="col-lg-3">
			<div class="form-group">
				<label>Artist Name*</label>
				<select name="cat" id="cat" required class="form-control">
					<option value="">Select Artist</option>
					<?php echo get_active_category($pdo) ; ?>
				</select>
			</div>
		</div>
		
	</div>
	
	<div class="row mt-2">
		<div class="col-lg-12">
		<h4 class="text-muted">Music Tags* <small class="text-muted">(Tags will Boost the SEO & Music Search)</small></h4>
		<hr>
		</div>
		<div class="col-lg-12">
		<textarea name="item_tag" id="item_tag" class="form-control" placeholder="Example : Music, Ambient Music, Pitbull Music, etc..." autofocus required></textarea>
		</div>
	</div>
	<div class="row mt-4">
		<div class="col-lg-12 text-center">
			<div class="remove-messages"></div>
			<input type="hidden" name="btn-action" id="btn-action" value="save_step_1">
			<input type="submit" name="action-item" class="btn btn-md btn-success" value="Save & Next" >
		</div>
	</div>
</form>
<?php } ?>
</div>
<!-- STEP 1 End-->
<!-- STEP 2 Start-->
<div class="step2">
<form  method="post" id="uploadFilesNew" class="uploadFilesNew">
	<div class="row mt-4">
		<div class="col-lg-3"></div>
		<div class="col-lg-6">
			<div class="col-lg-12 col-md-12">
				<div class="form-group mainfile">
					<label>Audio File<?php if(isset($total_item) == 0){ ?>* <?php } ?><small>(Only .mp3, .ogg, .wav & .m4a, 50 MB Allowed)</small></label>
					<input type="file" name="uploadMainFile" id="uploadMainFile" class="form-control" accept="audio/mp3,audio/ogg,audio/m4a,audio/wav" <?php if(isset($total_item) == 0){ ?> required <?php } ?>/>
				</div>
				<div class="remove-messagesmainfile"></div>
			</div>
			
			<div class="col-lg-12 col-md-12 mainfileprogress">
				<div class="progress">
					<div class="progress-bar mainfile-bar bg-success"  role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
				</div>
			</div>
		</div>
		<div class="col-lg-3"></div>
			
				
		<div class="col-lg-12 text-center">
			<input type="hidden" name="btn-action-3" id="btn-action-3" value="save_step_3">
			<input type="hidden" id="item_id" name="item_id" class="item_id">
			<input type="submit" class="btn btn-md btn-success" name="action_files" id="action_files" <?php if(isset($total_item) == 0){ ?> value="Publish Music"  <?php } else { ?>value="Update Files / Publish Music" <?php } ?>>&ensp;
			<?php if(isset($total_item) > 0){ ?>
			<a class="btn btn-danger btn-md draftupdateitem text-white" id="<?php echo $ItemId ; ?>">Save into Draft</a>
			<?php } else { ?>
			<a class="btn btn-danger btn-md draftitem text-white">Save into Draft</a>
			<?php } ?>
		</div>
	</div>
</form>
</div>
<!-- STEP 2 End-->
<!-- STEP 3 Start-->
<div class="step3">
	<div class="row">
		<div class="col-lg-12 text-center">
			<p class="text-success">Your Music has been Published. Go to <a href="<?php echo ADMIN_URL ; ?>items.php">Music Option</a>
		</div>
	</div>
</div>
<!-- STEP 3 End-->
<!-- STEP 4 Start-->
<div class="step4">
	<div class="row">
		<div class="col-lg-12 text-center">
			<p class="text-danger">Your Music has been saved into Draft. Go to <a href="<?php echo ADMIN_URL ; ?>drafts.php">Draft Option</a>
		</div>
	</div>
</div>
<!-- STEP 4 End-->
</div>
<!-- Add Save Edit Modal -->
	<div id="editModal" class="modal fade" data-backdrop="static" data-keyboard="false">
    	<div class="modal-dialog">
    			<div class="modal-content">
    				<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						  <span aria-hidden="true">&times;</span>
						</button>
    				</div>
    				<div class="modal-body">
						<div class="row justify-content-center">
						<h5 class="text-success ">You Edit has been saved successfully.</h5>
						</div>						
    				</div> 
    				<div class="modal-footer"> 
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
    				</div>
    			</div>
    	</div>
    </div>
<?php include("footer.php") ; ?>