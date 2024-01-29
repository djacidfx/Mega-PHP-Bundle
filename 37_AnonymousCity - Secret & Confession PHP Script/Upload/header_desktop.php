<div class="d-none d-sm-none d-md-block d-lg-block">
    <div class="row">
        <div class="col-lg-3 position-fixed customRightBorder border-start-0 border-bottom-0 border-top-0 text-white text-center h-100">
                  
            
            <div class="col-lg-12 p-5 pb-0">
                <a href="<?php echo BASE_URL ; ?>"><img src="<?php echo BASE_URL ; ?>img/logo.png" class="rounded-circle img-fluid logoDesktop"></a>
            </div>
            <div class="col-lg-12 p-5  pb-0 mt-0">
                <a href="<?php echo BASE_URL ; ?>" class="btn btn-grey w-100"><i class="bi bi-house-fill text-secondary"></i> Home</a>
            </div>
            <div class="col-lg-12 p-5  pt-2 pb-0 mt-0">
                <a href="<?php echo BASE_URL ; ?>sharesecret" class="btn btn-grey w-100"><i class="bi bi-signpost-2-fill text-danger"></i> Post Secret / Confession</a>
            </div>
            <div class="col-lg-12 p-5 pt-2 pb-0 mt-0">
                <a href="<?php echo BASE_URL ; ?>featured" class="btn btn-grey w-100"><i class="bi bi-bookmark-star text-warning"></i> Featured</a>
            </div>
            <div class="col-lg-12 p-5 pt-2 pb-0 mt-0">
                <a href="<?php echo BASE_URL ; ?>trending" class="btn btn-grey w-100 align-left"><i class="bi bi-graph-up text-success"></i> Trending</a>
            </div>            
            <div class="col-lg-12 p-5 pt-2 pb-0 mt-0">
                <a href="<?php echo BASE_URL ; ?>new" class="btn btn-grey w-100"><i class="bi bi-broadcast text-info"></i> New</a>
            </div>
            <?php if(!isset($search)) { ?> 
                <div class="col-lg-12 p-5 pt-2 pb-0 mt-0">
                    <a href="#!" class="btn btn-grey w-100 mySearch"><i class="bi bi-search text-warning"></i> Search</a>
                </div>
            <?php } ?>
            
        </div>
        <div class="col-lg-6">
           
        </div>
        <div class="col-lg-3">

        </div>
    </div>                
</div>