<?php include("header.php") ; ?>

<!--====================================================
                        PAGE CONTENT
======================================================-->
<div class="container-fluid  mt-5 p-5 search-image-bg">
 	<div class="row">
		<div class="col-lg-3"></div>
		<div class="col-lg-6 mt-5">
		<form  action="<?php echo BASE_URL.'usersearch.php' ; ?>" method="post">
		<div id="custom-search-input">
                <div class="input-group col-md-12">
                    <input type="text" class="form-control input-lg" placeholder="e.g. Wordpress Theme, PHP Script, Logos ..."  name="search_keyword" />
                    <span class="input-group-btn">
                        <button class="btn btn-info btn-lg" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
		</div>
		<div class="row text-white p-3">
			Recommend: &ensp;<?php echo get_recommend_category($pdo) ; ?>
		</div> 
		</form>
		</div>  
		<div class="col-lg-3"></div>
    </div>
</div>
<div class="page-content d-flex align-items-stretch minH">
	<div class="content-inner w-100">
		<!--***** Items *****-->  
		<div class="row">
		<div class="col-lg-1"></div>
		<div class="col-lg-10">
			<h2 class="text-muted"><i class="fa fa-diamond text-muted"></i> New Items
			<a class="btn btn-success btn-sm float-right" href="<?php echo BASE_URL."new/" ; ?>">Browse All</a>
			</h2>
			<hr>
			<?php echo new_item_on_index_page($pdo) ; ?>
			<h2 class="text-muted"><i class="fa fa-signal text-muted"></i> Top Viewed Items</h2>
			<hr>
			<?php echo top_viewed_item($pdo) ; ?>
			<?php echo top_loved_item_on_index_page($pdo) ; ?>
			<?php echo top_downloaded_item_on_index_page($pdo) ; ?>
		</div>
		<div class="col-lg-1"></div>
		</div>
	</div>
</div> 

<?php include("footer.php") ; ?> 