<?php include("header.php") ; ?>
<?php 
$curMonth = date("m") ;
$curYear = date("Y") ;

$month = filter_var($_GET['month'], FILTER_SANITIZE_NUMBER_INT) ;
$year = filter_var($_GET['year'], FILTER_SANITIZE_NUMBER_INT) ;
$curMonthYear = date($year."-".$month) ;

$previousMonthYear = date('Y-m', strtotime($curMonthYear." -1 month"));
$previousMonth = strtotime($previousMonthYear);
$previousMonth = date("m",$previousMonth) ;
$concatPreviousYear = date("Y",strtotime($previousMonthYear)) ;

$nextMonthYear = date('Y-m', strtotime($curMonthYear." +1 month"));
$nextMonth = strtotime($nextMonthYear);
$nextMonth = date("m",$nextMonth) ;
$concatNextYear = date("Y",strtotime($nextMonthYear)) ;


$dateObj   = DateTime::createFromFormat('!m', $month);
$monthName = $dateObj->format('F');

$concatThisMonthYear = date($curYear."-".$curMonth) ;

$startDate = date($year."-".$month."-01");
$startDate = $startDate." 00:00:00" ;
$endDate = date($year."-".$month."-31");
$endDate = $endDate." 23:59:59" ;
?>
<?php include("sidebar.php") ; ?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1 class="text-muted"><i class="fa fa-chart-area"></i> <?php echo $monthName ; ?> <?php echo $year ; ?> Analysis</h1>
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
                      if(!empty(viewcount_curmonthalltotal_sales($pdo,$startDate,$endDate))){
                         echo viewcount_curmonthalltotal_sales($pdo,$startDate,$endDate) ;  
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
                      if(!empty(viewcount_curmonthalltotal_sales_amount($pdo,$startDate,$endDate))){
                         echo viewcount_curmonthalltotal_sales_amount($pdo,$startDate,$endDate) ;  
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
                      if(!empty(viewcount_curmonthalltotal_refunds($pdo,$startDate,$endDate))){
                         echo viewcount_curmonthalltotal_refunds($pdo,$startDate,$endDate) ;  
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
                      if(!empty(viewcount_curmonthalltotal_refundsamt($pdo,$startDate,$endDate))){
                         echo "-".viewcount_curmonthalltotal_refundsamt($pdo,$startDate,$endDate) ;  
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
                      if(!empty(viewcount_curmonthalltotal_reversal($pdo,$startDate,$endDate))){
                         echo viewcount_curmonthalltotal_reversal($pdo,$startDate,$endDate) ;  
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
                      if(!empty(viewcount_curmonthalltotal_reversalamt($pdo,$startDate,$endDate))){
                         echo "-".viewcount_curmonthalltotal_reversalamt($pdo,$startDate,$endDate) ;  
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
                      if(!empty(viewcount_curmonthtotal_sales($pdo,$startDate,$endDate))){
                         echo viewcount_curmonthtotal_sales($pdo,$startDate,$endDate) ;  
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
                      if(!empty(viewcount_curmonthtotal_sales_amount($pdo,$startDate,$endDate))){
                         echo viewcount_curmonthtotal_sales_amount($pdo,$startDate,$endDate) ;  
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
                      if(!empty(viewgrab_curmonth_totalamount_ofadmin($pdo,$startDate,$endDate))){
                         echo viewgrab_curmonth_totalamount_ofadmin($pdo,$startDate,$endDate) ;  
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
                      if(!empty(viewgrab_curmonth_totalamount_ofauthor($pdo,$startDate,$endDate))){
                         echo viewgrab_curmonth_totalamount_ofauthor($pdo,$startDate,$endDate) ;  
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
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <a href="<?php echo ADMIN_URL ; ?>monthlyanalysis/<?php echo $previousMonth ; ?>/<?php echo $concatPreviousYear ; ?>" class="btn btn-primary btn-sm"><i class="fa fa-chevron-left"></i> Previous</a>
                    &ensp;
                    <?php if($curMonthYear != $concatThisMonthYear) { ?> 
                    <a href="<?php echo ADMIN_URL ; ?>monthlyanalysis/<?php echo $nextMonth ; ?>/<?php echo $concatNextYear ; ?>" class="btn btn-primary btn-sm">Next <i class="fa fa-chevron-right"></i></a>
                    <?php } ?>
                    
                </div>
            </div>          
        </div>
        <div class="col-lg-4"></div>          
      </div>
        
        
    </section>
</div>
<?php include("footer.php") ; ?>