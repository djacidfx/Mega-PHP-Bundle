<?php
ob_start();
session_start();
include("config/database.php") ;
include("functions.php") ;
include("language/lang.php") ;
include("mode/mode.php") ;
$userIp = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP) ;
$err = 0 ;
$permitted_chars = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz1234567890';
$characters_length = 8;
$code = "";
if(isset($_POST['btn_action'])) {
   
    if($_POST['btn_action'] == 'btnCreateNote') {
        if(!empty($_POST['privatenote'])){
            if(isset($_POST['g-recaptcha-response'])){
                $captcha=$_POST['g-recaptcha-response'];
            }
            $output = "" ;
            $secretKey = SECRET_KEY ;
            $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
            $response = file_get_contents_ssl($url);
            $responseKeys = json_decode($response,true);
            if($responseKeys["success"]) {
                $privatenote = filter_var($_POST['privatenote'], FILTER_SANITIZE_STRING) ; 
                $code .= generate_string($permitted_chars, 8 , $pdo);
                $ins = $pdo->prepare("insert into ot_notes (user_ip, note_unique_id, note) values ('".$userIp."' , '".$code."' , '".$privatenote."')");
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
            } else {
                $form_msg =  userlang('spam_msg') ;
                $output = array( 
                        'form_msg' => $form_msg,
                        'err' => '3'
                        );
                echo json_encode($output);
            }
            
        } else {
            $form_msg =  userlang('empty_note_error') ;
                $output = array( 
                        'form_msg' => $form_msg,
                        'err' => '1'
                        );
                echo json_encode($output);
        }
    }
    
    if($_POST['btn_action'] == 'btnCreateNotewithPassword') {
        if(!empty($_POST['privatenote']) && !empty($_POST['password']) && !empty($_POST['repassword'])){
            if(isset($_POST['g-recaptcha-response'])){
                $captcha=$_POST['g-recaptcha-response'];
            }
            $output = "" ;
            $secretKey = SECRET_KEY ;
            $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
            $response = file_get_contents_ssl($url);
            $responseKeys = json_decode($response,true);
            if($responseKeys["success"]) {
                $privatenote = filter_var($_POST['privatenote'], FILTER_SANITIZE_STRING) ; 
                $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING) ; 
                $repassword = filter_var($_POST['repassword'], FILTER_SANITIZE_STRING) ; 
                if($password === $repassword){
                   $code .= generate_string($permitted_chars, 8 , $pdo);
                    $password = password_hash($password, PASSWORD_DEFAULT) ;
                    $ins = $pdo->prepare("insert into ot_notes (user_ip, note_unique_id, note, note_password) values ('".$userIp."' , '".$code."' , '".$privatenote."' , '".$password."')");
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
                } else {
                    $form_msg =  userlang('password_error') ;
                    $output = array( 
                            'form_msg' => $form_msg,
                            'err' => '4'
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
            
        } else {
            $form_msg =  userlang('empty_note_error_password') ;
                $output = array( 
                        'form_msg' => $form_msg,
                        'err' => '1'
                        );
                echo json_encode($output);
        }
    }
    
    
    
    if($_POST['btn_action'] == 'btnPassword') {
        if(!empty($_POST['privatenote']) && !empty($_POST['password'])){
            if(isset($_POST['g-recaptcha-response'])){
                $captcha=$_POST['g-recaptcha-response'];
            }
            $output = "" ;
            $secretKey = SECRET_KEY ;
            $url = 'https://www.google.com/recaptcha/api/siteverify?secret=' . urlencode($secretKey) .  '&response=' . urlencode($captcha);
            $response = file_get_contents_ssl($url);
            $responseKeys = json_decode($response,true);
            if($responseKeys["success"]) {
                
                $privatenote = filter_var($_POST['privatenote'], FILTER_SANITIZE_STRING) ; 
                $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING) ; 
                $encryptedPassword = check_note_pass($pdo , $privatenote) ;
                if(password_verify($password, $encryptedPassword)) {
                    $ins = $pdo->prepare("update ot_notes set note_status = '2' where note_unique_id = '".$privatenote."'");
                    $ins->execute() ;
                    $text = colormode('default_text') ;
                    $border = colormode('border') ;
                    $color = colormode('textarea-bgcolor') ;
                    $bgColor = colormode('bg_color') ;
                    $design = '
                    <div class="card '.$bgColor.' '.$text.' '.$border.' shadow-lg">
                        <div class="card-header">
                            <div class="row p-0">
                                <div class="col-lg-8">
                                    <h4 class="'.$text.' mt-2"><i class="bi bi-pencil text-primary me-2"></i> '.userlang('note_heading').'</h4>
                                </div>
                                <div class="col-lg-4">
                                    <a href="'.BASE_URL.'" class="text-muted btn btn-md btn-warning float-md-end "><i class="bi bi-file-earmark-person"></i> '.userlang('create_pvt_note').'</a>
                                </div>
                                <div class="col-lg-12 mt-3">
                                    <p class="text-danger"><small><i class="bi bi-exclamation-triangle-fill text-danger me-2"></i>'.userlang('note_destroy_msg').'</small></p>
                                </div>
                            </div>


                        </div>
                        <div class="card-body hide errorMessage">
                            <div class="col-lg-12">
                                <form action="'.BASE_URL.'download" method="post" enctype="multipart/form-data">
                                    <input type="hidden" name="zipfile" value="'.get_zipfile($pdo, $privatenote).'">
                                    <button type="submit" name="submit" class="btn btn-md btn-success"><i class="bi bi-download me-1"></i> '.userlang('download').'</button>
                                </form>
                            </div>
                        </div>
                        <div class="card-footer" id="txt">
                            <div class="col-lg-12">
                                '.get_unique_note($pdo, $privatenote).'
                            </div>
                            <div class="col-lg-12 mt-2 text-center">
                                <button class="btn btn-primary tk" id="tk" type="button" data-clipboard-target="#txt"><i class="bi bi-clipboard"></i></button>
                            </div>
                        </div>    
                    </div>
                    ';
                    $output = array( 
                            'form_msg' => $design,
                            'err' => '0'
                            );
                    echo json_encode($output); 
                } else {
                    $form_msg =  userlang('note_password_error') ;
                    $output = array( 
                            'form_msg' => $form_msg,
                            'err' => '4'
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
            
        } else {
            $form_msg =  userlang('empty_note_password_error') ;
                $output = array( 
                        'form_msg' => $form_msg,
                        'err' => '1'
                        );
                echo json_encode($output);
        }
    }
    
}
?>