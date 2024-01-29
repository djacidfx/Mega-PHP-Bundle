<?php include("header.php") ; ?>
<?php 
$home = "active" ; 
$dashboard = "active" ;
$curMonth = date("m") ;
$curYear = date("Y") ;
?>
<?php include("sidebar.php") ; ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
        <h1 class="text-muted"><i class="fa fa-bell"></i> Notifications & Shortcuts</h1>
        </div>
        
        <div class="row">
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="<?php echo ADMIN_URL."inreview" ; ?>">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-video"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>In Review</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_review_for_admin($pdo))){
                         echo count_review_for_admin($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </a>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="<?php echo ADMIN_URL."softrejectreview" ; ?>">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-exclamation"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Soft Reject</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_soft_reject_review_for_admin($pdo))){
                         echo count_soft_reject_review_for_admin($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </a>
            </div>
           
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="<?php echo ADMIN_URL."itemupdates" ; ?>">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-video"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Item Updates</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_item_updates_for_admin($pdo))){
                         echo count_item_updates_for_admin($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </a>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="<?php echo ADMIN_URL."pendingreview" ; ?>">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-times"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Pending Items</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_pending_item_for_admin($pdo))){
                         echo count_pending_item_for_admin($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </a>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="<?php echo ADMIN_URL."pendingdisputes" ; ?>">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-retweet"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Refund Disputes</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_disputes($pdo))){
                         echo count_disputes($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </a>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="<?php echo ADMIN_URL."unreadtopic" ; ?>">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-bullhorn"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Unread Topic</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_forumtopic_unseen($pdo))){
                         echo count_forumtopic_unseen($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </a>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="<?php echo ADMIN_URL."commentreport" ; ?>">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-comment"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Comment Report</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_reportedcomment_unseen($pdo))){
                         echo count_reportedcomment_unseen($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </a>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="<?php echo ADMIN_URL."replyreport" ; ?>">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-comments"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Reply Report</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_reportedcommentreply_unseen($pdo))){
                         echo count_reportedcommentreply_unseen($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </a>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <a href="<?php echo ADMIN_URL."ratingreport" ; ?>">
              <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                  <i class="fas fa-star"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Rating Report</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_reportedratings_unseen($pdo))){
                         echo count_reportedratings_unseen($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </a>
            </div>
            
        </div>
        
        <div class="section-header">
        <h1 class="text-muted"><i class="fa fa-dollar-sign"></i> Today Sales Analysis</h1>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-list-ol"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Sales</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_todaytotal_sales($pdo))){
                         echo count_todaytotal_sales($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Amount</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_todaytotal_sales_amount($pdo))){
                         echo count_todaytotal_sales_amount($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Admin Earning</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(grab_today_totalamount_ofadmin($pdo))){
                         echo grab_today_totalamount_ofadmin($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Author Earning</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(grab_today_totalamount_ofauthor($pdo))){
                         echo grab_today_totalamount_ofauthor($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            
            
        </div>
        
        <div class="section-header">
        
            <div class="row no-gutters w-100">
              <div class="col-lg-8 col-md-8 col-sm-8"><h1 class="text-muted"><i class="fa fa-dollar-sign"></i> This Month Sales Analysis</h1></div>
              <div class="col-lg-4 col-md-4 col-sm-4 text-lg-right"><a href="<?php echo ADMIN_URL ; ?>monthlyanalysis/<?php echo $curMonth ; ?>/<?php echo $curYear ; ?>" class="btn btn-sm btn-primary">View Monthwise Analysis</a></div>
            </div>
        </div>
        <div class="row">
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-list-ol"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Total Sales</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_curmonthalltotal_sales($pdo))){
                         echo count_curmonthalltotal_sales($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Sales Amount</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_curmonthalltotal_sales_amount($pdo))){
                         echo count_curmonthalltotal_sales_amount($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-list-ol"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Total Refunds</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_curmonthalltotal_refunds($pdo))){
                         echo count_curmonthalltotal_refunds($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Refund Amount</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_curmonthalltotal_refundsamt($pdo))){
                         echo "-".count_curmonthalltotal_refundsamt($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-list-ol"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Total Reversal</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_curmonthalltotal_reversal($pdo))){
                         echo count_curmonthalltotal_reversal($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Reversal Amount</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_curmonthalltotal_reversalamt($pdo))){
                         echo "-".count_curmonthalltotal_reversalamt($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-list-ol"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Actual Sales</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_curmonthtotal_sales($pdo))){
                         echo count_curmonthtotal_sales($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Actual Amount</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_curmonthtotal_sales_amount($pdo))){
                         echo count_curmonthtotal_sales_amount($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Admin Earning</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(grab_curmonth_totalamount_ofadmin($pdo))){
                         echo grab_curmonth_totalamount_ofadmin($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Authors Earning</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(grab_curmonth_totalamount_ofauthor($pdo))){
                         echo grab_curmonth_totalamount_ofauthor($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            
            
        </div>
        
        <div class="section-header">
        <h1 class="text-muted"><i class="fa fa-dollar-sign"></i> Lifetime Sales Analysis</h1>
        </div>
        <div class="row">
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-list-ol"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Total Sales</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_lifetimealltotal_sales($pdo))){
                         echo count_lifetimealltotal_sales($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Sales Amount</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_lifetimealltotal_sales_amount($pdo))){
                         echo count_lifetimealltotal_sales_amount($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-list-ol"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Total Refunds</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_lifetimealltotal_refunds($pdo))){
                         echo count_lifetimealltotal_refunds($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Refund Amount</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_lifetimealltotal_refundsamt($pdo))){
                         echo "-".count_lifetimealltotal_refundsamt($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-list-ol"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Total Reversal</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_lifetimealltotal_reversal($pdo))){
                         echo count_lifetimealltotal_reversal($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Reversal Amount</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_lifetimealltotal_reversalamt($pdo))){
                         echo "-".count_lifetimealltotal_reversalamt($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-list-ol"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Actual Sales</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_lifetimetotal_sales($pdo))){
                         echo count_lifetimetotal_sales($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Actual Amount</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_lifetimetotal_sales_amount($pdo))){
                         echo count_lifetimetotal_sales_amount($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Admin Earning</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(grab_lifetime_totalamount_ofadmin($pdo))){
                         echo grab_lifetime_totalamount_ofadmin($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-dollar-sign"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Authors Earning</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(grab_lifetime_totalamount_ofauthor($pdo))){
                         echo grab_lifetime_totalamount_ofauthor($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            
            
        </div>
        
        <div class="section-header">
        <h1 class="text-muted"><i class="fa fa-video"></i> Video Item Analysis</h1>
        </div>
        <div class="row">
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-list-ol"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Total Videos</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_totalitems($pdo))){
                         echo count_totalitems($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-list-ol"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Active Videos</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_totalitems_active($pdo))){
                         echo count_totalitems_active($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-list-ol"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Paused Videos</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_totalitems_pause($pdo))){
                         echo count_totalitems_pause($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-list-ol"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Disabled Videos</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_totalitems_disabled($pdo))){
                         echo count_totalitems_disabled($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            
        </div>
        
        <div class="section-header">
        <h1 class="text-muted"><i class="fa fa-users"></i> User Analysis</h1>
        </div>
        <div class="row">
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                  <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Total Users</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_totalusers($pdo))){
                         echo count_totalusers($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Active Users</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_totalusers_active($pdo))){
                         echo count_totalusers_active($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Blocked Users</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_totalusers_blocked($pdo))){
                         echo count_totalusers_blocked($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="fas fa-address-book"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header pr-0">
                    <h4>Total Authors</h4>
                  </div>
                  <div class="card-body">
                    <?php 
                      if(!empty(count_totalusers_authors($pdo))){
                         echo count_totalusers_authors($pdo) ;  
                      } else {
                          echo "0" ;
                      }
                    ?>
                  </div>
                </div>
              </div>
            </div>
            
         </div>
        
        <div class="section-header">
            <h1 class="text-muted"><i class="fa fa-chart-area"></i> Additional Analysis</h1>
        </div>
        
        <div class="row">
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fa fa-video"></i> Top 5 Sold Items</h4>
                    </div>
                    <div class="card-body">
                        <div class="summary">
                            <div class="summary-item">
                                <ul class="list-unstyled list-unstyled-border mb-4">
                                    <?php echo topfive_items($pdo); ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fa fa-address-book"></i> Top 5 Authors</h4>
                    </div>
                    <div class="card-body">
                        <div class="summary">
                            <div class="summary-item">
                                <ul class="list-unstyled list-unstyled-border">
                                    <?php echo topfive_authors($pdo); ?>                                
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h4><i class="fa fa-users"></i> Top 5 Buyers</h4>
                    </div>
                    <div class="card-body">
                        <div class="summary">
                            <div class="summary-item">
                                <ul class="list-unstyled list-unstyled-border">
                                    <?php echo topfive_buyers($pdo); ?>                                
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
    </section>
</div>
<?php include("footer.php") ; ?>