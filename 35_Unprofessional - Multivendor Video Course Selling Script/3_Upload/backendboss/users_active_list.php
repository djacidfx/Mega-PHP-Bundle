<?php
ob_start();
session_start();
include("config/db.php") ; 
include("controller/functions.php") ; 
check_admin_logged_in($pdo) ;

$Statement = $pdo->prepare("SELECT * FROM ot_users WHERE user_status = '1' and user_blocked = '0' order by id desc");
$Statement->execute(); 
$total = $Statement->rowCount();    
$result = $Statement->fetchAll(PDO::FETCH_ASSOC); 
$output = array('data' => array());
$sum = 0 ;
foreach($result as $row) {
    $sum = $sum + 1 ;
    $userId = _e($row['id']) ;
    $fullname = _e($row['user_fullname']) ;
    $username = _e($row['user_name']) ;
    $dpName = BASE_URL.get_user_profilepic_name_url_username($pdo,$username) ;
    $profilePic = "<img src=".$dpName." class='rounded-circle img-fluid' width='50' >" ;
    $email = _e($row['user_email']) ;
    $date = _e($row['reg_date']) ;
    $date =  date('d F, Y',strtotime($date));
    $solditem =  _e($row['user_sold_items']) ;
    $soldamt =  "<b>$"._e($row['user_sold_price'])."</b>" ;
    $purchases = _e($row['user_purchased_items']) ;
    $solutions = _e($row['community_problem_solved']) ;
    $followers = _e($row['user_followers']) ;
    $following = _e($row['user_following']) ;
    $wallet = "<b>$"._e($row['user_wallet'])."</b>" ;
    $addCredit = '<button class="btn btn-success btn-sm addCredit" id="'.$userId.'">+AddCredit</button>' ;
    $viewProfile = '<a href="'.BASE_URL.'user/'.$username.'" class="btn btn-sm btn-light" target="_blank"><i class="fa fa-eye"></i></button>';
    $block = '<button class="btn btn-danger btn-sm blockUser" id="'.$userId.'">Block</button>' ;
    $output['data'][] = array( 		
        $sum,
        $userId,
        $profilePic,
        $fullname,
        $username,
        $email,
        $date,
        $solditem,
        $soldamt,
        $purchases,
        $solutions,
        $followers,
        $following,
        $wallet,
        $addCredit,
        $viewProfile,
        $block

    ); 	 
}
echo json_encode($output);
?>