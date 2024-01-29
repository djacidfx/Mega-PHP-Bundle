<?php
ob_start();
session_start();
include("config/database.php") ;
include("functions.php") ;
include("language/lang.php") ;
include("mode/mode.php") ;
$userIp = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP) ;
$err = "0" ;
$permitted_chars = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz@1234567890';
$characters_length = 8;
$code = "";
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
    $privatenote = filter_var($_POST['privatenote'], FILTER_SANITIZE_STRING) ; 
    $code .= generate_string($permitted_chars, 8 , $pdo);
    
    $secretKey = SECRET_KEY ;
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
    $response = file_get_contents_ssl($url);
    $responseKeys = json_decode($response,true);
    if($responseKeys["success"]) {
        if(in_array($fileType, $allowTypes)){ 
            $fileSize = ($_FILES['uploadFile']['size'])/1024 ;
            if($fileSize <= ZIP_LIMIT) {
                // Upload file to the server 
                if(move_uploaded_file($tmpFileName , $targetFilePath)){ 
                    $ins = $pdo->prepare("insert into ot_notes (user_ip, note_unique_id, note, zip_file) values ('".$userIp."' , '".$code."' , '".$privatenote."' ,'".$newfilename."')");
                    $ins->execute() ;
                    $newstatement = $pdo->query("SELECT LAST_INSERT_ID()");
                    $noteId = $newstatement->fetchColumn();
                    $noteUniqueId = get_unique_note_id($pdo, $noteId) ;
                    $noteUrl = BASE_URL."note/".$noteUniqueId ;
                    $form_msg =  $noteUrl ;
                    $text = colormode('default_text') ;
                    $border = colormode('border') ;
                    $color = colormode('textarea-bgcolor') ;
                    $design = '<div class="input-group"><input type="text" id="txt" class="form-control '.$text.' '.$border.' '.$color.' " readonly="readonly" value="'.$form_msg.'"><button class="btn btn-primary tk" id="tk" type="button" data-clipboard-target="#txt"><i class="bi bi-clipboard"></i></button></div>' ;
                    $output = array( 
                            'form_msg' => $design,
                            'err' => '0'
                            );
                    echo json_encode($output);
                }
            } else {
                $form_msg =  userlang('zip_limit') ;
                $output = array( 
                        'form_msg' => $form_msg,
                        'err' => '1'
                        );
                echo json_encode($output);
            }

        } else {
            $form_msg =  userlang('should_be_zip') ;
            $output = array( 
                    'form_msg' => $form_msg,
                    'err' => '2'
                    );
            echo json_encode($output);
        } 
            
            
        
    } else {
        $form_msg =  userlang('spam_msg') ;
        $output = array( 
                'form_msg' => $form_msg,
                'err' => '3'
                );
        echo json_encode($output);
    }
	 
} 
if(!empty($_FILES['uploadFilePass']))
{
    $targetDir = "zipfiles/"; 
	$allowTypes = array('zip'); 
	$fileName = filter_var($_FILES["uploadFilePass"]["name"], FILTER_SANITIZE_STRING) ;
	$temp = explode(".", $fileName);
	$newfilename = round(microtime(true)) . '.' . end($temp);
	$targetFilePath = $targetDir.$newfilename; 
	// Check whether file type is valid 
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
    
	$tmpFileName = filter_var($_FILES["uploadFilePass"]["tmp_name"], FILTER_SANITIZE_STRING) ;
    $privatenote = filter_var($_POST['privatenote'], FILTER_SANITIZE_STRING) ; 
    $code .= generate_string($permitted_chars, 8 , $pdo);
    $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING) ; 
    $repassword = filter_var($_POST['repassword'], FILTER_SANITIZE_STRING) ;
    $secretKey = SECRET_KEY ;
    $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
    $response = file_get_contents_ssl($url);
    $responseKeys = json_decode($response,true);
    if($responseKeys["success"]) {
        if(in_array($fileType, $allowTypes)){ 
            $fileSize = ($_FILES['uploadFilePass']['size'])/1024 ;
            if($fileSize <= ZIP_LIMIT) {
                if($password === $repassword){
                    // Upload file to the server 
                    if(move_uploaded_file($tmpFileName , $targetFilePath)){ 
                        $password = password_hash($password, PASSWORD_DEFAULT) ;
                        $ins = $pdo->prepare("insert into ot_notes (user_ip, note_unique_id, note, note_password , zip_file) values ('".$userIp."' , '".$code."' , '".$privatenote."' , '".$password."' ,'".$newfilename."')");
                        $ins->execute() ;
                        $newstatement = $pdo->query("SELECT LAST_INSERT_ID()");
                        $noteId = $newstatement->fetchColumn();
                        $noteUniqueId = get_unique_note_id($pdo, $noteId) ;
                        $noteUrl = BASE_URL."note/".$noteUniqueId ;
                        $form_msg =  $noteUrl ;
                        $text = colormode('default_text') ;
                        $border = colormode('border') ;
                        $color = colormode('textarea-bgcolor') ;
                        $design = '<div class="input-group"><input type="text" id="txt" class="form-control '.$text.' '.$border.' '.$color.' " readonly="readonly" value="'.$form_msg.'"><button class="btn btn-primary tk" id="tk" type="button" data-clipboard-target="#txt"><i class="bi bi-clipboard"></i></button></div>' ;
                        $output = array( 
                                'form_msg' => $design,
                                'err' => '0'
                                );
                        echo json_encode($output); 
                    }
                } else {
                    $form_msg =  userlang('password_error') ;
                    $output = array( 
                            'form_msg' => $form_msg,
                            'err' => '4'
                            );
                    echo json_encode($output);
                }
            } else {
                $form_msg =  userlang('zip_limit') ;
                $output = array( 
                        'form_msg' => $form_msg,
                        'err' => '1'
                        );
                echo json_encode($output);
            }

        } else {
            $form_msg =  userlang('should_be_zip') ;
            $output = array( 
                    'form_msg' => $form_msg,
                    'err' => '2'
                    );
            echo json_encode($output);
        } 
            
            
        
    } else {
        $form_msg =  userlang('spam_msg') ;
        $output = array( 
                'form_msg' => $form_msg,
                'err' => '3'
                );
        echo json_encode($output);
    }
}
?>