<?php
ob_start();
session_start();
include("config/database.php") ;
include("functions.php") ;
include("language/lang.php") ;
include("mode/mode.php") ;
$userIp = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP) ;
$err = "0" ;
if(isset($_POST['g-recaptcha-response'])){
    $captcha=$_POST['g-recaptcha-response'];
}
if(!empty($_FILES['uploadFile']))
{
    
	$targetDir = "zipfiles/"; 
	$allowTypes = array('zip'); 
	$fileName = filter_var($_FILES["uploadFile"]["name"], FILTER_SANITIZE_STRING) ;
	$temp = explode(".", $fileName);
	$newfilename = round(microtime(true)) . '.' . end($temp);
	$targetFilePath = $targetDir.$newfilename; 
	// Check whether file type is valid 
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
    
	$tmpFileName = filter_var($_FILES["uploadFile"]["tmp_name"], FILTER_SANITIZE_STRING) ;
	$ziptitle = filter_var($_POST['ziptitle'], FILTER_SANITIZE_STRING) ;
    $zipSlug = strtolower(preg_replace("/[^\w]+/", "-", $ziptitle));
    $catId = filter_var($_POST['category'], FILTER_SANITIZE_NUMBER_INT) ;
    $description = filter_var($_POST["description"], FILTER_SANITIZE_STRING) ;
    $autoupload = find_auto_approve($pdo) ;
    
    $secretKey = SECRET_KEY ;
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
    $response = file_get_contents_ssl($url);
    $responseKeys = json_decode($response,true);
    if($responseKeys["success"]) {
        if(check_zip_title($pdo,$ziptitle) > 0) {
            $form_msg =  userlang('zip_title_error') ;
            $output = array( 
                    'form_msg' => $form_msg,
                    'err' => '1'
                    );
            echo json_encode($output);
        } else{
            if(empty($catId)){
                $form_msg =  userlang('category_error') ;
                $output = array( 
                        'form_msg' => $form_msg,
                        'err' => '2'
                        );
                echo json_encode($output); 
            } else {
                if(in_array($fileType, $allowTypes)){ 
                    $fileSize = ($_FILES['uploadFile']['size'])/1024 ;
                    if($fileSize <= ZIP_LIMIT) {
                        // Upload file to the server 
                        if(move_uploaded_file($tmpFileName , $targetFilePath)){ 
                            $upd = $pdo->prepare("insert into ot_zip (user_ip, zip_category, zip_name, zip_slug, zip_description, zip_file , zip_status) values ('".$userIp."' ,'".$catId."' , '".$ziptitle."' , '".$zipSlug."' , '".$description."' ,'".$newfilename."','".$autoupload."')");
                            $upd->execute();
                            $newstatement = $pdo->query("SELECT LAST_INSERT_ID()");
                            $zipId = $newstatement->fetchColumn();
                            $zipShortTitle = urltitle_by_id($pdo,$zipId) ;
                            if($autoupload > "0"){
                                $form_msg =  $zipShortTitle ;
                                $output = array( 
                                        'form_msg' => $form_msg,
                                        'err' => '0'
                                        );
                                echo json_encode($output);
                            } else {
                                $form_msg =  userlang('zip_review') ;
                                $output = array( 
                                        'form_msg' => $form_msg,
                                        'err' => '4'
                                        );
                                echo json_encode($output);
                            }
                        }
                    } else {
                        $form_msg =  userlang('zip_limit') ;
                        $output = array( 
                                'form_msg' => $form_msg,
                                'err' => '6'
                                );
                        echo json_encode($output);
                    }
                     
                } else {
                    $form_msg =  userlang('should_be_zip') ;
                    $output = array( 
                            'form_msg' => $form_msg,
                            'err' => '5'
                            );
                    echo json_encode($output);
                } 
            }
            
        }
    } else {
        $form_msg =  userlang('spam_msg') ;
        $output = array( 
                'form_msg' => $form_msg,
                'err' => '3'
                );
        echo json_encode($output);
    }
	 
} else {
    echo "Access Denied" ;
}

?>