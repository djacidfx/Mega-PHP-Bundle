<?php include("header.php") ;  ?>
<div class="app-title">
        <div>
          <h1><i class="fa fa-laptop"></i> Admin Dashboard</h1>
		  <p class="text-success">More Analysis will be available on V-1.1 .</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="<?php echo ADMIN_URL ; ?>dashboard.php">Dashboard</a></li>
        </ul>
 </div>
<div class="row">
 		<div class="col-lg-12 col-md-12">
				<h5 class="border-bottom text-muted">Music Analysis</h5>
			</div>
        <div class="col-md-4 col-lg-4">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-cubes fa-3x"></i>
            <div class="info">
              <h5 class="font-italic text-muted">Total Music</h5>
              <p><b><?php echo count_total_item($pdo) ; ?></b></p>
            </div>
          </div>
        </div>
		<div class="col-md-4 col-lg-4">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-music fa-3x"></i>
            <div class="info">
              <h5 class="font-italic text-muted">Active Music</h5>
              <p><b><?php echo  count_total_active_item($pdo) ; ?></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-lg-4">
          <div class="widget-small danger coloured-icon"><i class="icon fa fa-music fa-3x"></i>
            <div class="info">
              <h5 class="font-italic text-muted">Deactive Music</h5>
              <p><b><?php echo  count_total_deactive_item($pdo) ; ?></b></p>
            </div>
          </div>
        </div>
</div>


<?php include("footer.php") ; ?>
