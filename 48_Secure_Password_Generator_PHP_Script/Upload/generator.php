<?php
include_once("setup.php");
if(isset($_POST['btn_action'])) {
    if($_POST['btn_action'] == 'btn_action') {
        if(!empty($_POST['len'])){
            if($_POST['len'] < MINIMUM_PASSWORD_LENGTH ) {
                $form_msg =  MINIMUM_PASSWORD_LENGTH_ERROR_MESSAGE ;
                $output = array( 
                        'form_msg' => $form_msg,
                        'err' => '1'
                        );
                echo json_encode($output);
            } else {
                if($_POST['len'] > MAXIMUM_PASSWORD_LENGTH ) {
                    $form_msg =  MAXIMUM_PASSWORD_LENGTH_ERROR_MESSAGE ;
                    $output = array( 
                            'form_msg' => $form_msg,
                            'err' => '2'
                            );
                    echo json_encode($output);
                
                } else {
                    $length = filter_var($_POST['len'],FILTER_SANITIZE_NUMBER_INT) ;
                    $abcd = "abcdefghijklmnpqrstuvwxyz";
                    $abcd_caps = strtoupper($abcd);
                    $numeric = "123456789";
                    $special = "!@$#*%^&*()_-+={}[]";

                    $chars = $abcd . $abcd_caps . $numeric . $special;                    
                    $chars = str_shuffle($chars);
                    $len = strlen($chars);
                    $pass = '';
                    for ($i=0;$i<$length;$i++){
                       $pass .= substr($chars, rand(0, $len-1), 1); 
                       $pass = str_shuffle($pass); 
                    }
                        
                    $form_msg =  PASSWORD_GENERATED_MESSAGE ;
                    $output = array( 
                            'form_msg' => $form_msg,
                            'passtext' => $pass,
                            'err' => '0'
                            );
                    echo json_encode($output);
                }
            }
    
        }
    }
}
?>