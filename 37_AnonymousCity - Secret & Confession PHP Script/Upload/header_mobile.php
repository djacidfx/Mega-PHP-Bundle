<nav class="navbar navbar-expand-lg navbar-dark bg-dark customBottomBorder">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?php echo BASE_URL ; ?>"><img src="<?php echo BASE_URL ; ?>img/logomobile.png" class="rounded-circle img-fluid logoMobile"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="col-lg-12 mt-2">
            <a href="<?php echo BASE_URL ; ?>" class="btn btn-grey w-100"><i class="bi bi-house-fill text-secondary"></i> Home</a>
        </div>
        <div class="col-lg-12 mt-2">
            <a href="<?php echo BASE_URL ; ?>sharesecret" class="btn btn-grey w-100"><i class="bi bi-signpost-2-fill text-danger"></i> Post Secret / Confession</a>
        </div>
        <div class="col-lg-12 mt-2">
            <a href="<?php echo BASE_URL ; ?>featured" class="btn btn-grey w-100"><i class="bi bi-bookmark-star text-warning"></i> Featured</a>
        </div>
        <div class="col-lg-12 mt-2">
            <a href="<?php echo BASE_URL ; ?>trending" class="btn btn-grey w-100 align-left"><i class="bi bi-graph-up text-success"></i> Trending</a>
        </div>            
        <div class="col-lg-12 mt-2">
            <a href="<?php echo BASE_URL ; ?>new" class="btn btn-grey w-100"><i class="bi bi-broadcast text-info"></i> New</a>
        </div>
        <?php if(!isset($search)) { ?> 
            <div class="col-lg-12 mt-2">
                <a href="#!" class="btn btn-grey w-100 mySearch"><i class="bi bi-search text-warning"></i> Search</a>
            </div>
        <?php } ?>
    </div>
  </div>
</nav>