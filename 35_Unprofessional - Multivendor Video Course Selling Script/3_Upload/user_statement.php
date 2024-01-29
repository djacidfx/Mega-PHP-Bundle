<?php include("header_session.php") ; ?>
<?php  
$username = username_by_id($pdo,$_SESSION['unprofessional']['id']) ; 
$nt = '3' ;
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
?>
<?php $webtitle = $monthName." Monthly Statement" ; ?>
<?php include("header_main.php") ; ?>
<?php include("navbar_index.php"); ?>

<?php include("sidebar_index.php"); ?>
<?php $concatThisMonthYear = date($curYear."-".$curMonth) ; ?>
<?php echo check_user_logged_in($pdo) ; ?>
<?php

$startDate = date($year."-".$month."-01");
$endDate = date($year."-".$month."-31");
$startTimeStamp = " 00:00:00" ;
$endTimeStamp = " 23:59:59" ;
$startTimeStamp = $startDate.$startTimeStamp ;
$endTimeStamp = $endDate.$endTimeStamp ;
$statement = $pdo->prepare("select * from ot_author_statement where author_id = '".$_SESSION['unprofessional']['id']."' and s_time >=  '".$startTimeStamp."' and s_time <= '".$endTimeStamp."' order by statement_id desc") ;
$statement->execute();
$result = $statement->fetchAll();
?>
<!-- Main Content -->
<div class="main-content">
    <section class="section">
      <div class="section-header">
        <h1 class="text-muted"><i class="fas fa-chart-area fa-lg"></i> <?php echo $monthName ; ?> <?php echo $year ; ?> Statement </h1>
      </div>
    <div class="row">
        
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="card card-statistic-2">
            <div class="card-icon shadow-primary bg-primary">
              <i class="fas fa-chart-area"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Total Sales</h4>
              </div>
              <div class="card-body smFont">
                <?php echo user_solditems_by_username($pdo,$username) ; ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="card card-statistic-2">
            <div class="card-icon shadow-primary bg-primary">
              <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4>Sold Amount</h4>
              </div>
              <div class="card-body smFont">
                <?php echo count_author_sold_amount($pdo,$_SESSION['unprofessional']['id']) ; ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="card card-statistic-2">
            <div class="card-icon shadow-primary bg-primary">
              <i class="fas fa-chart-area"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4><?php echo $monthName ; ?> Sales</h4>
              </div>
              <div class="card-body smFont">
                <?php echo grab_author_item_sold_monthly($pdo,$_SESSION['unprofessional']['id'],$startDate,$endDate)  ; ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-12">
          <div class="card card-statistic-2">
            <div class="card-icon shadow-primary bg-primary">
              <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="card-wrap">
              <div class="card-header">
                <h4><?php echo $monthName ; ?> Earning</h4>
              </div>
              <div class="card-body smFont">
                <?php echo grab_author_total_amount_monthly($pdo,$_SESSION['unprofessional']['id'],$startDate,$endDate) ; ?>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="table-responsive">
                            <table  class="table table-bordered table-hover" >
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Date</th>
                                        <th>Item Name</th>
                                        <th>Type</th>
                                        <th>Earning ($)</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sum = 0 ;
                                        foreach($result as $row){
                                            $sum = $sum + 1 ;
                                            $saleDate = _e($row['s_time']) ;
                                            $saleDate =  date('d F, Y',strtotime($saleDate));
                                            $itemId = _e($row['s_item_id']) ;
                                            $itemName = long_title_by_id($pdo,$itemId) ; 
                                            $earning = _e($row['s_author_earning']) ;
                                            $type = _e($row['s_type']) ;
                                            $paid = _e($row['s_paid']) ;
                                            if($paid == '0') {
                                                $paid = "<b class='text-danger'>Not Paid</b>" ;
                                            } else {
                                                $paid = "<b class='text-success'>Paid</b>" ;
                                            }
                                            $statusType = "" ;
                                            if($type == '1'){
                                                $earning = _e($row['s_author_earning']) ;
                                                $statusType = '<button class="btn btn-success btn-xs" disabled>Sale</button>' ;
                                            }
                                            if($type == '0'){
                                                $earning = "-".$earning ;
                                                $statusType = '<button class="btn btn-danger btn-xs" disabled>Sale Reversal</button>' ;
                                            }
                                            if($type == '2'){
                                                $earning = "-".$earning ;
                                                $statusType = '<button class="btn btn-danger btn-xs" disabled>Refund</button>' ;
                                            }
                                        ?>
                                            <tr>
                                                <td><?php echo $sum ; ?></td>
                                                <td><?php echo $saleDate ; ?></td>
                                                <td><?php echo $itemName ; ?></td>
                                                <td><?php echo $statusType ; ?></td>
                                                <td><?php echo $earning ; ?></td>
                                                <td><?php echo $paid ; ?></td>                                           
                                            </tr>
                                        <?php
                                        }
                                    ?>
                                </tbody>
                            </table><!-- /table -->
                        </div>
                        
                        
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
                    <a href="<?php echo BASE_URL ;?>statement/<?php echo $previousMonth ; ?>/<?php echo $concatPreviousYear ; ?>" class="btn btn-primary btn-sm"><i class="fa fa-chevron-left"></i> Previous</a>
                    &ensp;
                    <?php if($curMonthYear != $concatThisMonthYear) { ?> 
                    <a href="<?php echo BASE_URL ;?>statement/<?php echo $nextMonth ; ?>/<?php echo $concatNextYear ; ?>" class="btn btn-primary btn-sm">Next <i class="fa fa-chevron-right"></i></a>
                    <?php } ?>
                    
                </div>
            </div>          
        </div>
        <div class="col-lg-4"></div>          
      </div>
    </section>
</div>
<?php include("footer_main.php") ; ?>