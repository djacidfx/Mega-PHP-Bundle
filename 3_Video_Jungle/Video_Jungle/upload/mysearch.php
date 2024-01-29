<?php 
include("header.php") ; 
if(check_user_verify_status($pdo) == 0) {
		header("location: ".BASE_URL."");
	}
$search = filter_var($_GET['search_keyword'], FILTER_SANITIZE_STRING) ;
?>
<div class="container-fluid  mt-5 p-5 search-image-bg">
 	<div class="row">
		<div class="col-lg-3"></div>
		<div class="col-lg-6 mt-5">
		<form  action="<?php echo BASE_URL.'usersearch.php' ; ?>" method="post">
		<div id="custom-search-input">
                <div class="input-group col-md-12">
                    <input type="text" class="form-control input-lg" placeholder="e.g. Photo Slide Show"  name="search_keyword" value="<?php echo $search ; ?>" />
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
			<?php echo fetch_searchallproduct_foruser($pdo,$search) ; ?>
			<div class="jQueryLoadSearchItem"></div>
		</div>
		<div class="col-lg-1"></div>
		</div>
	</div>
</div> 
<?php include("footer_js.php") ; ?>