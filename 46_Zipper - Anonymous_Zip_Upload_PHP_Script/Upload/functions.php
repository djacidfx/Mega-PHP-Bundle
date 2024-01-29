<?php


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

function check_admin_logged_in($pdo){
    if(!isset($_SESSION['owner'])) 
    {
        header("location: ".ADMIN_URL."logout");
        exit;
    } 
}

function generate_string($input, $strength = 10, $pdo) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $statement =  $pdo->prepare("SELECT * FROM ot_notes WHERE note_unique_id = '".$random_character."'");
        $statement->execute();
        $total = $statement->rowCount();
        if($total === 0) {
           $random_string .= $random_character; 
        }        
    }
  
    return $random_string;
}

function get_unique_note_id($pdo, $noteId){
    $statement =  $pdo->prepare("SELECT * FROM ot_notes WHERE note_id = '".$noteId."'");
    $statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$output = '';
	foreach($result as $row)
	{
        $output .= strip_tags($row['note_unique_id']) ;
    }
    return $output ;
}

function get_unique_note($pdo, $noteUniqueId){
    $statement =  $pdo->prepare("SELECT * FROM ot_notes WHERE note_unique_id = '".$noteUniqueId."'");
    $statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$output = '';
	foreach($result as $row)
	{
        $output .= nl2br(strip_tags($row['note'])) ;
    }
    return $output ;
}

function get_zipfile($pdo,$noteUniqueId) {
    $statement =  $pdo->prepare("SELECT * FROM ot_notes WHERE note_unique_id = '".$noteUniqueId."'");
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $zipFile = _e($row['zip_file']) ;
        $output .= ($zipFile) ;
    }
    return $output ;
}

function get_zipfile_bynoteid($pdo,$noteId) {
    $statement =  $pdo->prepare("SELECT * FROM ot_notes WHERE note_id = '".$noteId."'");
	$statement->execute();
	$result = $statement->fetchAll();
	$output = '';
	foreach($result as $row)
	{
        $zipFile = _e($row['zip_file']) ;
        $output .= ($zipFile) ;
    }
    return $output ;
}

function get_noteunique_id_readstatus($pdo , $noteUniqueId) {
    $statement =  $pdo->prepare("SELECT * FROM ot_notes WHERE note_unique_id = '".$noteUniqueId."'");
    $statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['note_status']) ;
    }
    return $output ;
}

function check_note_pass($pdo , $noteUniqueId) {
    $statement =  $pdo->prepare("SELECT * FROM ot_notes WHERE note_unique_id = '".$noteUniqueId."'");
    $statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['note_password']) ;
    }
    return $output ;
}

function check_unique_note_id_status($pdo, $noteUniqueId){
    $statement =  $pdo->prepare("SELECT * FROM ot_notes WHERE note_unique_id = '".$noteUniqueId."' and note_status = '2'");
    $statement->execute();
    $total = $statement->rowCount();
    return $total ;
}

function check_noteunique_id($pdo , $noteUniqueId) {
    $statement =  $pdo->prepare("SELECT * FROM ot_notes WHERE note_unique_id = '".$noteUniqueId."'");
    $statement->execute();
    $total = $statement->rowCount();
    return $total ;
}

function update_noteunique_id_readstatus($pdo , $noteUniqueId , $i) {
    $i = (int)$i + 1 ;
    $statement =  $pdo->prepare("update ot_notes set note_status = '".$i."' WHERE note_unique_id = '".$noteUniqueId."' and note_password is NULL");
    $statement->execute();
    return true ;
}

function find_blocked_ip($pdo , $userNewIp) {
    $query = "SELECT * FROM ot_blocked_ip WHERE ip_address = '".$userNewIp."'";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function count_total_notes($pdo) {
    $statement =  $pdo->prepare("SELECT * FROM ot_notes WHERE 1");
    $statement->execute();
    $total = $statement->rowCount();
    return $total ;
}

function count_total_unreadnotes($pdo) {
    $statement =  $pdo->prepare("SELECT * FROM ot_notes WHERE note_status = '0'");
    $statement->execute();
    $total = $statement->rowCount();
    return $total ;
}

function count_total_readnotes($pdo) {
    $statement =  $pdo->prepare("SELECT * FROM ot_notes WHERE note_status != '0'");
    $statement->execute();
    $total = $statement->rowCount();
    return $total ;
}

function count_total_thismonthnotes($pdo) {
    $start = date("Y-m-01") ;
    $start = $start." 00:00:00" ;
    $end = date("Y-m-t") ;
    $end = $end." 23:59:59" ;
	$query = "SELECT * FROM ot_notes WHERE note_date >= '".$start."' and note_date <= '".$end."' ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return ($total) ;
}

function count_total_todaynotes($pdo) {
    $start = date("Y-m-d") ;
    $start = $start." 00:00:00" ;
    $end = date("Y-m-d") ;
    $end = $end." 23:59:59" ;
	$query = "SELECT * FROM ot_notes WHERE note_date >= '".$start."' and note_date <= '".$end."' ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return ($total) ;
}

function count_total_blockedip($pdo){
	$query = "SELECT * FROM ot_blocked_ip WHERE 1 ";
	$statement = $pdo->prepare($query);
	$statement->execute();
	$total = $statement->rowCount();
	return _e($total) ;
}

function get_admin_username($pdo){
    $statement =  $pdo->prepare("SELECT * FROM ot_admin WHERE id = '1' ");
    $statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$output = '';
	foreach($result as $row)
	{
        $output .= ($row['username']) ;
    }
    return $output ;
}

function get_userip($pdo , $noteId) {
    $statement =  $pdo->prepare("SELECT * FROM ot_notes WHERE note_id = '".$noteId."'");
    $statement->execute();
    $total = $statement->rowCount();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
	$output = '';
	foreach($result as $row)
	{
        $output .= _e($row['user_ip']) ;
    }
    return $output ;
}
?>