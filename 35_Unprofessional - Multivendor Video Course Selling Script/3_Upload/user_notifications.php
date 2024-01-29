<?php include("header_session.php") ; ?>
<?php  
$username = username_by_id($pdo,$_SESSION['unprofessional']['id']) ; 
$nt = '1' ;
?>
<?php echo check_user_logged_in($pdo) ; ?>
<?php $webtitle = "Notifications" ; ?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>

<?php include("sidebar_index.php"); ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1 class="text-muted"><i class="fas fa-bell fa-lg"></i> Notifications </h1>
      </div>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
            <div class="card-icon shadow-primary bg-primary">
              <i class="fas fa-bell"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Notifications</h4>
              </div>
              <div class="card-body smFont">
                <?php echo count_total_notifications($pdo) ; ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
            <div class="card-icon shadow-danger bg-danger">
              <i class="fas fa-bell"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Unseen Notifications</h4>
              </div>
              <div class="card-body smFont">
                <?php echo count_unseen_notifications($pdo) ; ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
            <div class="card-icon shadow-success bg-success">
              <i class="fas fa-bell"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Seen Notifications</h4>
              </div>
              <div class="card-body smFont">
                <?php echo count_seen_notifications($pdo) ; ?>
              </div>
            </div>
          </div>
        </div>
        
        
    </div>
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            
            <div class="card">
                <div class="card-body p-0">
                  <?php echo grab_notifications_default($pdo) ; ?>
                  <div class="jQueryNewNotifications"></div>
                </div>
            </div>
          
        </div>
        <div class="col-lg-3"></div>
    </div>
    </section>
</div>
<?php include("footer_main.php") ; ?>