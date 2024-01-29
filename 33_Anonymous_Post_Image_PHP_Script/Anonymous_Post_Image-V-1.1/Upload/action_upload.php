<?php 
require_once('_adminarea_/db/config.php') ;
require_once('_adminarea_/db/post_functions.php') ;
if(!empty($_FILES['uploadFile']))
{
    if(isset($_POST['g-recaptcha-response'])){
        $captcha=$_POST['g-recaptcha-response'];
    }
    $secretKey = SECRET_KEY ;
    $ip = $_SERVER['REMOTE_ADDR'];
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
    $response = file_get_contents($url);
    $responseKeys = json_decode($response,true);
    $approveValue = get_approve_post($pdo) ;
    $output = '';
    if($responseKeys["success"]) {
        $targetDir = "postImage/" ; 
        $allowTypes = array( 'jpg', 'png', 'jpeg'); 
        $fileName = filter_var($_FILES["uploadFile"]["name"], FILTER_SANITIZE_STRING) ;
        $temp = explode(".", $fileName);
        $newfilename = round(microtime(true)) . '.' . end($temp);
        $targetFilePath = $targetDir.$newfilename; 
        // Check whether file type is valid 
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
        $tmpFileName = filter_var($_FILES["uploadFile"]["tmp_name"], FILTER_SANITIZE_STRING) ;
        $date = filter_var(date("Y-m-d"), FILTER_SANITIZE_STRING) ;
        $caption = filter_var($_POST['caption'], FILTER_SANITIZE_STRING) ;
        if(check_duplicate_caption($pdo,$caption) == 0){
            $catId = filter_var($_POST['catId'], FILTER_SANITIZE_NUMBER_INT) ;
            if(in_array($fileType, $allowTypes)){ 
                // Upload file to the server 
                if(move_uploaded_file($tmpFileName , $targetFilePath)){ 
                    if($approveValue == '1') {
                        $upd = $pdo->prepare("insert into anony_post (post_type, cat_id, post_title, post_image, post_date, post_status) values ('0', '".$catId."','".$caption."','".$newfilename."','".$date."', '1')");
                        $upd->execute();
                        $statement = $pdo->query("SELECT LAST_INSERT_ID()");
				        $postId = $statement->fetchColumn();
                        $output = array( 
						'err' => '1',
						'postId' => $postId
						);
				        echo json_encode($output);
                    } else {
                        $upd = $pdo->prepare("insert into anony_post (post_type, cat_id, post_title, post_image, post_date, post_status) values ('0', '".$catId."','".$caption."','".$newfilename."','".$date."', '0')");
                        $upd->execute();
                        echo "3" ;
                    }
                    
                } 
            } 
        } else {
            echo "0" ;
        }
    } else {
        echo "2" ;
    }
}
?>