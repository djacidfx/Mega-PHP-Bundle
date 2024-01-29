<?php include("header.php") ; ?>
<?php 
$pages = "active" ; 
$createPage = "active" ;
if(!empty($_GET['id'])) {
	$pageId = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT) ;
	$page_statement = $pdo->prepare("select * from ot_admin_pages where page_id = '".$pageId."'");
	$page_statement->execute();
	$page_item = $page_statement->rowCount(); 
	$page_result = $page_statement->fetchAll(PDO::FETCH_ASSOC);
	if($page_item > 0){
		foreach($page_result as $pageRow) {
			$pageName = strip_tags($pageRow['page_name']) ;
			$pageSlug = _e($pageRow['page_slug']) ;
			$pageContent = base64_decode($pageRow['page_text']) ;
		}
	} else {
		header('location: '.ADMIN_URL.'createpage') ;
	}
}
?>
<?php include("sidebar.php") ; ?>
<!-- Main Content -->
    <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1 class="text-muted"><?php if(isset($page_item) > 0){ ?><i class="fa fa-pencil-alt"></i> Edit Page  <?php } else { ?><i class="fa fa-file"></i> Create Pages <?php } ?></h1>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>You can create Unlimited Pages for Users. Note : Slug must be unique for every page.</h4>              
                </div>
                <div class="card-body">
                    <?php if(isset($page_item) > 0){ ?>
                    <form method="post" enctype="multipart/form-data" class="editPage">
                    <div class="row">
                        <div class="col-lg-4 mt-3">
                            <label>Page Name* <small>(Max 25 Chars)</small></label>
					        <input type="text" name="page_name" class="form-control" maxlength="25" autocomplete="off" autofocus required placeholder="Privacy Policy" value="<?php echo $pageName ; ?>">
                        </div>
                        <div class="col-lg-4 mt-3">
                           <label>Page Slug* <small>(Max 25 Chars & No Special Char/Numbers)</small></label>
					       <input type="text" name="page_slug" class="page_slug lowercase form-control" maxlength="25" autocomplete="off" autofocus required placeholder="privacy" value="<?php echo $pageSlug ; ?>">
                        </div> 
                        <div class="col-lg-4 mt-3">
                            <label>Page URL*</label>
					        <input type="text" name="page_url" class="page_url form-control" autocomplete="off" autofocus  placeholder="<?php echo BASE_URL.'page/privacy/' ; ?>" readonly="readonly" value="<?php echo BASE_URL.'page/'.$pageSlug ; ?>">
                        </div>
                        <div class="col-lg-12 mt-3">
                            <label>Page Content*</label>
					        <textarea name="page_content" id="item_message" class="form-control" autofocus required><?php echo $pageContent ; ?></textarea>
                        </div>
                        <div class="col-lg-4 mt-3"></div>
                        <div class="col-lg-4 mt-3">
                            <div class="remove-messages"></div>
                             <input type="hidden" name="pageId" value="<?php echo $pageId ; ?>" >
                            <input type="hidden" name="btn_action" id="btn_action" value="edit_page">
                            <button type="submit" class="btn btn-primary btn-md btn-block mt-3" tabindex="4" id="action_page">Edit Page</button>
                        </div>
                        <div class="col-lg-4 mt-3"></div>
                        
                    </div>
                    </form>
                    <div class="step2">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <p class="text-success">Your Page has been Edited Successfully. &ensp; <a href="<?php echo ADMIN_URL ; ?>managepage" class="btn btn-success btn-sm">Change Status of Page</a>
                            </div>
                        </div>
                    </div>
                    <?php } else { ?>
                    <form method="post" enctype="multipart/form-data" class="savePage">
                    <div class="row">
                        <div class="col-lg-4 mt-3">
                            <label>Page Name* <small>(Max 25 Chars)</small></label>
					        <input type="text" name="page_name" class="form-control" maxlength="25" autocomplete="off" autofocus required placeholder="Privacy Policy">
                        </div>
                        <div class="col-lg-4 mt-3">
                           <label>Page Slug* <small>(Max 25 Chars & No Special Char/Numbers)</small></label>
					       <input type="text" name="page_slug" class="page_slug lowercase form-control" maxlength="25" autocomplete="off" autofocus required placeholder="privacy">
                        </div> 
                        <div class="col-lg-4 mt-3">
                            <label>Page URL*</label>
					        <input type="text" name="page_url" class="page_url form-control" autocomplete="off" autofocus  placeholder="<?php echo BASE_URL.'page/privacy/' ; ?>" readonly="readonly">
                        </div>
                        <div class="col-lg-12 mt-3">
                            <label>Page Content*</label>
					        <textarea name="page_content" id="item_message" class="form-control" autofocus required></textarea>
                        </div>
                        <div class="col-lg-4 mt-3"></div>
                        <div class="col-lg-4 mt-3">
                            <div class="remove-messages"></div>
                             <input type="hidden" name="btn_action" value="save_page">
                            <button type="submit" class="btn btn-primary btn-md btn-block mt-3" tabindex="4" id="action_page">Publish Page</button>
                        </div>
                        <div class="col-lg-4 mt-3"></div>
                        
                    </div>
                    </form>
                    <div class="step3">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <p class="text-success">Your Page has been Published. &ensp; <a href="<?php echo ADMIN_URL ; ?>createpage" class="btn btn-success btn-sm">Create New Page</a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
              </div>
            </div>
          </div>
        
        </section>
    </div>

<?php include("footer.php") ; ?>