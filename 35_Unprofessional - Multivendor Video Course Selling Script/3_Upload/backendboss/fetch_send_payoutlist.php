<?php
ob_start();
session_start();
include("config/db.php") ; 
include("controller/functions.php") ; 
check_admin_logged_in($pdo) ;

$curMonth = date("m") ;
$curYear = date("Y") ;
$curMonthYear = date($curYear."-".$curMonth) ;
$previousMonthYear = date('Y-m', strtotime($curMonthYear." -1 month"));
$previousMonth = strtotime($previousMonthYear);
$previousMonth = date("m",$previousMonth) ;
$concatPreviousYear = date("Y",strtotime($previousMonthYear)) ;
$endDate = date($concatPreviousYear."-".$previousMonth."-31");
$endTimeStamp = " 23:59:59" ;
$endTimeStamp = $endDate.$endTimeStamp ;
$Statement = $pdo->prepare("SELECT author_id FROM ot_author_statement WHERE s_time <= '".$endTimeStamp."'  group by author_id");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
$payBtn = "" ;
foreach($result as $row) {
    $minPayout = grab_minimum_payout($pdo) ;
    $startTime = date($curYear."-".$curMonth."-01 00:00:00") ;
    $endTime =  date($curYear."-".$curMonth."-31 23:59:59") ;
    $sum = $sum + 1 ;
    $authorId = _e($row['author_id']) ;
    $authorUnpaidAmt = "<b>$".grab_author_total_unpaidamount_monthly($pdo,$authorId,$endDate)."</b>" ;
    $authorEmail = useremail_by_id($pdo,$authorId) ;
    $authorUsername = username_by_id($pdo,$authorId) ;
    $authorPayoutEmail = user_payout_email_for_admin($pdo,$authorId) ;
    $status = "" ;
    $viewBreakup = "" ;
    $new = $pdo->prepare("select * from ot_author_payouts WHERE payout_time >= '".$startTime."' and payout_time <= '".$endTime."' and p_author_id = '".$authorId."'") ;
    $new->execute() ;
    $newtotal = $new->rowCount();    
    $newresult = $new->fetchAll(PDO::FETCH_ASSOC); 
    
    if($newtotal > 0){
        $status = '<button class="btn btn-success btn-xs">Paid</button>' ;
    } else {
        if(grab_author_total_unpaidamount_monthly($pdo,$authorId,$endDate) > $minPayout ){
            $payBtn = '<button class="btn btn-success btn-sm authorSendPayout" id="'.$authorId.'" data-status="'.grab_author_total_unpaidamount_monthly($pdo,$authorId,$endDate).'">SendPayout</button>' ;
        } else {
            $payBtn = '<b class="text-danger"> Not Qualified for Minimum Payout</b>' ;
        }
        $status = '<button class="btn btn-danger btn-xs">NotPaid</button>' ;
    }
    $sendDate = base64_encode($endDate) ;
    $viewBreakup = '<button class="btn btn-primary btn-sm viewBreakup" id="'.$authorId.'" data-status="'.$sendDate.'" >ViewBreakups</button>' ;
    $output['data'][] = array( 		
        $sum,
        $authorId,
        $authorUsername,
        $authorEmail,
        $authorPayoutEmail,
        $authorUnpaidAmt,
        $status,
        $viewBreakup,
        $payBtn

    ); 	
}
echo json_encode($output);
?>