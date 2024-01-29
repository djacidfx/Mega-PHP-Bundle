<?php include("header.php") ;  ?>
<div class="app-title">
        <div>
          <h1><i class="fa fa-laptop"></i> Admin Dashboard</h1>
		  <p class="text-success">Hassle Free Analysis</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?php echo ADMIN_URL ; ?>dashboard.php">Dashboard</a></li>
        </ul>
 </div>
<div class="row mt-4">
 		<div class="col-lg-12 col-md-12">
				<h5 class="border-bottom text-muted">Comment Analysis</h5>
			</div>
        <div class="col-md-4 col-lg-4">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-comments fa-3x"></i>
            <div class="info">
              <h5 class="font-italic text-muted">Total Comment</h5>
              <p><b><?php echo count_total_comments($pdo) ; ?></b></p>
            </div>
          </div>
        </div>
		<div class="col-md-4 col-lg-4">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-check fa-3x"></i>
            <div class="info">
              <h5 class="font-italic text-muted">Replied Comment</h5>
              <p><b><?php echo  count_total_replied_comment($pdo) ; ?></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-lg-4">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-times fa-3x"></i>
            <div class="info">
              <h5 class="font-italic text-muted">Unreplied Comment</h5>
              <p><b><?php echo  count_total_unreplied_comment($pdo) ; ?></b></p>
            </div>
          </div>
        </div>
</div>
<div class="row mt-4">
 		<div class="col-lg-12 col-md-12">
				<h5 class="border-bottom text-muted">Blog Analysis</h5>
			</div>
        <div class="col-md-4 col-lg-4">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-cubes fa-3x"></i>
            <div class="info">
              <h5 class="font-italic text-muted">Total Blog</h5>
              <p><b><?php echo count_total_post($pdo) ; ?></b></p>
            </div>
          </div>
        </div>
		<div class="col-md-4 col-lg-4">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-check fa-3x"></i>
            <div class="info">
              <h5 class="font-italic text-muted">Active Blog</h5>
              <p><b><?php echo  count_total_active_post($pdo) ; ?></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-lg-4">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-times fa-3x"></i>
            <div class="info">
              <h5 class="font-italic text-muted">Deactive Blog</h5>
              <p><b><?php echo  count_total_deactive_post($pdo) ; ?></b></p>
            </div>
          </div>
        </div>
</div>
 <div class="row mt-4">
 	<div class="col-lg-12 col-md-12 mt-3">
		<h5 class="border-bottom text-muted"><i class="fa fa-heart text-danger"></i>&ensp;Top 5 Loved Blog</h5>
	</div>
	<div class="col-lg-12 col-md-12 bg-white rounded p-3">
		<canvas id="loveCanvas"></canvas>
	</div>
 </div>
 <div class="row mt-4">
 	<div class="col-lg-12 col-md-12 mt-3">
		<h5 class="border-bottom text-muted"><i class="fa fa-heart text-danger"></i>&ensp;Top 5 Liked Blog</h5>
	</div>
	<div class="col-lg-12 col-md-12 bg-white rounded p-3">
		<canvas id="likeCanvas"></canvas>
	</div>
 </div>
  <div class="row mt-4">
 	<div class="col-lg-12 col-md-12 mt-3">
		<h5 class="border-bottom text-muted"><i class="fa fa-heart text-danger"></i>&ensp;Top 5 Viewed Blog</h5>
	</div>
	<div class="col-lg-12 col-md-12 bg-white rounded p-3">
		<canvas id="viewCanvas"></canvas>
	</div>
 </div>



<?php include("footer.php") ; ?>
