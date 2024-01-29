<?php

$whitelist = array(
    '127.0.0.1',
    '::1'
);

function _e($string) {
	return htmlentities(strip_tags($string), ENT_QUOTES, 'UTF-8');
}

function file_get_contents_ssl($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_REFERER, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3000); // 3 sec.
    curl_setopt($ch, CURLOPT_TIMEOUT, 10000); // 10 sec.
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;
}

function find_blocked_ip($pdo , $blockIp) {
    $query = "SELECT * FROM ot_ip_blocked WHERE blocked_ip = '".$blockIp."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function check_admin_logged_in($pdo){
    if(!isset($_SESSION['boss'])) 
    {
        header("location: ".ADMIN_URL."signout");
        exit;
    } 
}

function total_slams_answers($pdo){
    $query = "SELECT * FROM ot_slambook_answers WHERE 1";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function count_total_slamsanswers_today($pdo){
    $start = date("Y-m-d") ;
    $start = $start." 00:00:00" ;
    $end = date("Y-m-d") ;
    $end = $end." 23:59:59" ;
	$query = "SELECT * FROM ot_slambook_answers WHERE slamanswer_time >= '".$start."' and slamanswer_time <= '".$end."' ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function count_total_slamsanswers_thismonth($pdo){
    $start = date("Y-m-01") ;
    $start = $start." 00:00:00" ;
    $end = date("Y-m-t") ;
    $end = $end." 23:59:59" ;
	$query = "SELECT * FROM ot_slambook_answers WHERE slamanswer_time >= '".$start."' and slamanswer_time <= '".$end."' ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function total_slams($pdo){
    $query = "SELECT * FROM ot_slambook WHERE 1";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function count_total_slams_today($pdo){
    $start = date("Y-m-d") ;
    $start = $start." 00:00:00" ;
    $end = date("Y-m-d") ;
    $end = $end." 23:59:59" ;
	$query = "SELECT * FROM ot_slambook WHERE slambook_time >= '".$start."' and slambook_time <= '".$end."' ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function count_total_slams_thismonth($pdo){
    $start = date("Y-m-01") ;
    $start = $start." 00:00:00" ;
    $end = date("Y-m-t") ;
    $end = $end." 23:59:59" ;
	$query = "SELECT * FROM ot_slambook WHERE slambook_time >= '".$start."' and slambook_time <= '".$end."' ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function check_slambook_id($pdo , $slambookId) {
    $query = "SELECT * FROM ot_slambook WHERE slambook_id='".$slambookId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function check_answer_id($pdo , $answerId) {
    $query = "SELECT * FROM ot_slambook_answers WHERE answer_id='".$answerId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function urltitle_by_id($pdo,$slambookId) {
    $query = "SELECT * FROM ot_slambook WHERE slambook_id='".$slambookId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $title = _e($row['username']) ;
        $title = preg_replace("/[^\w]+/", "-", $title);
        $title = strtolower($title)  ;
        $output .= strtolower($title) ;
    }
    return $output ;
}

function username_by_id($pdo,$slambookId) {
    $query = "SELECT * FROM ot_slambook WHERE slambook_id='".$slambookId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $title = _e($row['username']) ;
        $output .= ucfirst($title) ;
    }
    return $output ;
}

function slambookid_by_answerid($pdo,$answerId) {
    $query = "SELECT * FROM ot_slambook_answers WHERE answer_id='".$answerId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $slambookId = _e($row['ans_slambook_id']) ;
        $output .= $slambookId ;
    }
    return $output ;
}

function answerusername_by_id($pdo,$answerId) {
    $query = "SELECT * FROM ot_slambook_answers WHERE answer_id='".$answerId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $slambookId = _e($row['ans_username']) ;
        $output .= ucfirst($slambookId) ;
    }
    return $output ;
}

function urlanswername_by_id($pdo,$answerId) {
    $query = "SELECT * FROM ot_slambook_answers WHERE answer_id='".$answerId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $title = _e($row['ans_username']) ;
        $title = preg_replace("/[^\w]+/", "-", $title);
        $title = strtolower($title)  ;
        $output .= strtolower($title) ;
    }
    return $output ;
}

function check_question_form($pdo,$slambookId) {
    $query = "SELECT * FROM ot_slambook_quest WHERE sb_slambook_id='".$slambookId."' order by sb_quest_id asc";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
    $newquestId = '' ;
    foreach($result as $row)
	{
        $ps = '$_POST[' ;
        $ps2 = ']' ;
        $questId = _e($row['sb_quest_id']) ;
        $newquestId = "(!empty(".$ps."'quest".$questId."'".$ps2.")) && " ;
        $output .= $newquestId ;
    }
    $output =  substr($output, 0, -3) ;
    $output = trim($output) ;
    return $output ;
}


function question_form($pdo,$slambookId) {
    $query = "SELECT * FROM ot_slambook_quest WHERE sb_slambook_id='".$slambookId."' order by sb_quest_id asc";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
    $quest = "quest" ;
    $sum = "0" ;
	foreach($result as $row)
	{
        $userIp = $_SERVER['REMOTE_ADDR'];
        $userIp = filter_var($userIp, FILTER_VALIDATE_IP) ;
        $sum = $sum + 1 ; 
        $question = strip_tags($row['sb_questions']) ;
        $questId = _e($row['sb_quest_id']) ;
        $newQuestName = $quest.$questId ;
        
        $output .= '<label class="text-muted">Q - '.$sum.' ) '.$question.'</label>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1"><i class="bi bi-suit-heart-fill text-danger"></i> </span>
                      <input type="text" name="'.$newQuestName.'" maxlength="100" class="form-control" autofocus  aria-label="Username" aria-describedby="basic-addon1" required autocomplete="off" >
                    </div>                  
        ' ;
    }
        $output .= '<div class="form-group mt-3 text-center">
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <input type="text" name="name" maxlength="20" required class="form-control" autocomplete="off" autofocus placeholder="Enter Your Name">
                            </div>
                            <div class="col-lg-3"></div>
                        </div>
                    </div>
                    <div class="form-group mt-2 justify-content-center text-center">
                        <div class="g-recaptcha" data-sitekey="'.SITE_KEY.'" ></div>
                    </div>
                    <div class="form-group mt-3 text-center">
                        <input type="hidden" name="btn_action" value="saveQuestAnswer" >
                        <button type="submit" id="action_sb" class="btn btn-md btn-danger"><i class="bi bi-suit-heart"></i> Post Slambook Answer</button>
                    </div>' ;
    return $output ;
}

function answer_form($pdo,$slambookId,$answerId) {
    $query = "SELECT sb_questions, all_answer from ot_slambook_quest LEFT JOIN ot_all_answers ON (ot_slambook_quest.sb_quest_id = ot_all_answers.all_quest_id) where ot_all_answers.all_answer_id = '".$answerId."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
    $quest = "quest" ;
    $sum = "0" ;
	foreach($result as $row)
	{
        $sum = $sum + 1 ; 
        $question = strip_tags($row['sb_questions']) ;
        $answer = strip_tags($row['all_answer']) ;
        
        $output .= '<label class="text-muted">Q - '.$sum.' ) '.$question.'</label>
                    <div class="input-group mb-3">
                      <span class="input-group-text" id="basic-addon1"><i class="bi bi-suit-heart-fill text-danger"></i> </span>
                      <input type="text" value="'.$answer.'" maxlength="100" class="form-control"  aria-label="Username" aria-describedby="basic-addon1" readonly autocomplete="off" >
                    </div>                  
        ' ;
    }
        
    return $output ;
}

function copyright_name($pdo) {
    $query = "SELECT * FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= strip_tags($row['adm_name']) ;
    }
    return $output ;
}

function admin_email($pdo) {
    $query = "SELECT * FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= strip_tags($row['adm_email']) ;
    }
    return $output ;
}

function analytics_code($pdo) {
    $query = "SELECT * FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= base64_decode($row['ga_code']) ;
    }
    return $output ;
}

function analytics_user_status($pdo) {
    $query = "SELECT * FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['user_on']) ;
    }
    return $output ;
}

function analytics_admin_status($pdo) {
    $query = "SELECT * FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['admin_on']) ;
    }
    return $output ;
}

function block_message($pdo){
  $query = "SELECT * FROM ot_admin WHERE id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $lovemsg = strip_tags($row['block_msg']) ;
        $output .= $lovemsg ;
    }
    return $output ;  
}

function ad_header468_status($pdo) {
    $query = "SELECT * FROM ot_ads WHERE ad_id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['ad_status']) ;
    }
    return $output ;
}


function ad_header468_js_code($pdo) {
    $query = "SELECT * FROM ot_ads WHERE ad_id='1'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= base64_decode($row['ad_code']) ;
    }
    return $output ;
}

function ad_header320_status($pdo) {
    $query = "SELECT * FROM ot_ads WHERE ad_id='2'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['ad_status']) ;
    }
    return $output ;
}

function ad_header320_js_code($pdo) {
    $query = "SELECT * FROM ot_ads WHERE ad_id='2'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= base64_decode($row['ad_code']) ;
    }
    return $output ;
}

function ad_sidebar600_status($pdo) {
    $query = "SELECT * FROM ot_ads WHERE ad_id='3'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['ad_status']) ;
    }
    return $output ;
}

function ad_sidebar600_js_code($pdo) {
    $query = "SELECT * FROM ot_ads WHERE ad_id='3'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= base64_decode($row['ad_code']) ;
    }
    return $output ;
}

function ad_sidebar600left_status($pdo) {
    $query = "SELECT * FROM ot_ads WHERE ad_id='4'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['ad_status']) ;
    }
    return $output ;
}

function ad_sidebar600left_js_code($pdo) {
    $query = "SELECT * FROM ot_ads WHERE ad_id='4'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $output .= base64_decode($row['ad_code']) ;
    }
    return $output ;
}
?>