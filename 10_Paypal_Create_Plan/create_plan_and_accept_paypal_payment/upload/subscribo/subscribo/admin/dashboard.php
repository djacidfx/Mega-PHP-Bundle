<?php include("header.php") ; ?>

<div class="app-title">
        <div>
          <h1><i class="fa fa-laptop"></i> Dashboard Analysis</h1>
          <p>It counts only Active Subscription Plan & Completed Transaction. </p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
        </ul>
 </div>
 <div class="row">
 		<div class="col-lg-12 col-md-12">
				<h5 class="border-bottom text-muted">Today Analysis</h5>
			</div>
        <div class="col-md-4 col-lg-4">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-arrows-alt fa-3x"></i>
            <div class="info">
              <h5 class="font-italic text-muted">Active Plans</h5>
              <p><b><?php echo count_total_activeplan_curday($pdo) ; ?></b></p>
            </div>
          </div>
        </div>
		<div class="col-md-4 col-lg-4">
          <div class="widget-small warning coloured-icon"><i class="icon fa fa-bookmark fa-3x"></i>
            <div class="info">
              <h5 class="font-italic text-muted">Purchases</h5>
              <p><b><?php echo count_total_purchase_curday($pdo) ; ?></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-lg-4">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-usd fa-3x"></i>
            <div class="info">
              <h5 class="font-italic text-muted">Earning</h5>
              <p><b><?php echo count_total_purchase_value_curday($pdo) ; ?></b></p>
            </div>
          </div>
        </div>
</div>
<div class="row">
 		<div class="col-lg-12 col-md-12">
				<h5 class="border-bottom text-muted">This Month Analysis</h5>
			</div>
        <div class="col-md-4 col-lg-4">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-arrows-alt fa-3x"></i>
            <div class="info">
              <h5 class="font-italic text-muted">Active Plans</h5>
              <p><b><?php echo count_total_activeplan_curmonth($pdo) ; ?></b></p>
            </div>
          </div>
        </div>
		<div class="col-md-4 col-lg-4">
          <div class="widget-small warning coloured-icon"><i class="icon fa fa-bookmark fa-3x"></i>
            <div class="info">
              <h5 class="font-italic text-muted">Purchases</h5>
              <p><b><?php echo count_total_purchase_curmonth($pdo) ; ?></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-lg-4">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-usd fa-3x"></i>
            <div class="info">
              <h5 class="font-italic text-muted">Earning</h5>
              <p><b><?php echo count_total_purchase_value_curmonth($pdo) ; ?></b></p>
            </div>
          </div>
        </div>
        
      </div>
<div class="row">
 		<div class="col-lg-12 col-md-12">
				<h5 class="border-bottom text-muted">Total Analysis</h5>
			</div>
        <div class="col-md-4 col-lg-4">
          <div class="widget-small primary coloured-icon"><i class="icon fa fa-arrows-alt fa-3x"></i>
            <div class="info">
              <h5 class="font-italic text-muted">Active Plans</h5>
              <p><b><?php echo count_total_activeplan($pdo) ; ?></b></p>
            </div>
          </div>
        </div>
		<div class="col-md-4 col-lg-4">
          <div class="widget-small warning coloured-icon"><i class="icon fa fa-bookmark fa-3x"></i>
            <div class="info">
              <h5 class="font-italic text-muted">Purchases</h5>
              <p><b><?php echo count_total_purchase($pdo) ; ?></b></p>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-lg-4">
          <div class="widget-small info coloured-icon"><i class="icon fa fa-usd fa-3x"></i>
            <div class="info">
              <h5 class="font-italic text-muted">Earning</h5>
              <p><b><?php echo count_total_purchase_value($pdo) ; ?></b></p>
            </div>
          </div>
        </div>
        
      </div>
<?php include("footer.php") ; ?>