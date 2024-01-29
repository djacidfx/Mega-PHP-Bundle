<?php
ob_start();
session_start();
include("config/db.php") ; 
include("controller/functions.php") ; 
check_admin_logged_in($pdo) ;

$Statement = $pdo->prepare("SELECT * FROM ot_users WHERE ( user_status = '0' or user_blocked = '1' ) order by id desc");
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
    $blocked = _e($row['user_blocked']) ;
    $userstatus = _e($row['user_status']) ;
    $status = "" ;
    $unblock = "" ;
    $userSaleReversal = checking_salereversal_users($pdo,$userId) ;
    if($blocked == '1'){
        if($userSaleReversal == '1'){
            $status = "Permanently Blocked due to Sale Reversal in Past." ;
        } else {
            if($userstatus == '1'){
                $status = "Blocked by Admin" ;
                $unblock = '<button class="btn btn-success btn-sm unblockUser" id="'.$userId.'">Unblock</button>' ;
            } else {
                $status = "Unable to Verify SignUp OTP." ;
            }
        }
    }
    $output['data'][] = array( 		
        $sum,
        $userId,
        $profilePic,
        $fullname,
        $username,
        $email,
        $date,
        $status,
        $unblock

    ); 	 
}
echo json_encode($output);
?>