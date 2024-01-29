<?php
ob_start();
session_start();
include("../config/database.php") ;
include("../functions.php") ;
include("../language/lang.php") ;
include("../mode/mode.php") ;
check_admin_logged_in($pdo);
$userIp = filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP) ;
$err = "0" ;
function image_has_size($file, $width, $height)
{
    $result = getimagesize($file);
    if (count($result) < 2) {
        return null;
    }

    list($file_width, $file_height) = $result;

    return ($file_width == (int) $width) 
           && ($file_height == (int) $height);
}
if(!empty($_FILES['uploadFile']))
{
    
	$targetDir = "../blogimages/"; 
	$allowTypes = array('png' , 'jpg' , 'jpeg'); 
	$fileName = filter_var($_FILES["uploadFile"]["name"], FILTER_SANITIZE_STRING) ;
	$temp = explode(".", $fileName);
	$newfilename = round(microtime(true)) . '.' . end($temp);
	$targetFilePath = $targetDir.$newfilename; 
	// Check whether file type is valid 
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
    
	$tmpFileName = filter_var($_FILES["uploadFile"]["tmp_name"], FILTER_SANITIZE_STRING) ;
    $blogId = filter_var($_POST['bid'], FILTER_SANITIZE_NUMBER_INT) ;
    $oldBlogImage = blogimage_by_blog_id($pdo,$blogId) ;
	$blogtitle = filter_var($_POST['blog_name'], FILTER_SANITIZE_STRING) ;
	$shortdescription = filter_var($_POST['shortdescription'], FILTER_SANITIZE_STRING) ;
    $blogSlug = strtolower(preg_replace("/[^\w]+/", "-", $blogtitle));
    $description = base64_encode($_POST["description"]) ;
    $imageHasCorrectSize = image_has_size($tmpFileName, 1600, 800);
    if(check_blog_slug_byId($pdo,$blogSlug,$blogId) == '0') {
        if(in_array($fileType, $allowTypes)){ 
            $fileSize = ($_FILES['uploadFile']['size'])/1024 ;
            if($fileSize <= BLOG_IMAGE_LIMIT) {
                if($imageHasCorrectSize) {
                    if(!empty($blogtitle) && !empty($shortdescription) && !empty($description) ){
                        // Upload file to the server 
                        if(move_uploaded_file($tmpFileName , $targetFilePath)){ 
                             //delete old image
                            unlink($targetDir.$oldBlogImage); 
                            
                            $upd = $pdo->prepare("update ot_blogs set blog_title = '".$blogtitle."' , blog_short_description = '".$shortdescription."' , blog_slug = '".$blogSlug."' , blog_image = '".$newfilename."' , blog_description = '".$description."' where blog_id = '".$blogId."'");
                            $upd->execute();
                            $form_msg =  userlang('blog_edited') ;
                            $output = array( 
                                    'form_msg' => $form_msg,
                                    'err' => '0'
                                    );
                            echo json_encode($output);
                        }
                    } else {
                        $form_msg =  userlang('form_empty')  ;
                        $output = array( 
                                'form_msg' => $form_msg,
                                'err' => '5'
                                );
                        echo json_encode($output);
                    }
                } else {
                    $form_msg =  userlang('img_dimension')  ;
                    $output = array( 
                            'form_msg' => $form_msg,
                            'err' => '1'
                            );
                    echo json_encode($output);
                }
            } else {
                $form_msg =  userlang('img_limit') ;
                $output = array( 
                        'form_msg' => $form_msg,
                        'err' => '2'
                        );
                echo json_encode($output);
            }

        } else {
            $form_msg =  userlang('should_be_image') ;
            $output = array( 
                    'form_msg' => $form_msg,
                    'err' => '3'
                    );
            echo json_encode($output);
        } 
    
    } else {
        $form_msg =  userlang('duplicate_blog_name') ;
            $output = array( 
                    'form_msg' => $form_msg,
                    'err' => '4'
                    );
            echo json_encode($output);
    }
	 
} else {
    $blogId = filter_var($_POST['bid'], FILTER_SANITIZE_NUMBER_INT) ;
    $blogtitle = filter_var($_POST['blog_name'], FILTER_SANITIZE_STRING) ;
	$shortdescription = filter_var($_POST['shortdescription'], FILTER_SANITIZE_STRING) ;
    $blogSlug = strtolower(preg_replace("/[^\w]+/", "-", $blogtitle));
    $description = base64_encode($_POST["description"]) ;
    if(check_blog_slug_byId($pdo,$blogSlug,$blogId) > 0){
        $form_msg =  userlang('duplicate_blog_name') ;
        $output = array( 
                'form_msg' => $form_msg,
                'err' => '4'
                );
        echo json_encode($output);
    } else {
        if(!empty($blogtitle) && !empty($shortdescription) && !empty($description) ){
            $upd = $pdo->prepare("update ot_blogs set blog_title = '".$blogtitle."' , blog_short_description = '".$shortdescription."' , blog_slug = '".$blogSlug."' , blog_description = '".$description."' where blog_id = '".$blogId."'");
            $upd->execute();
            $form_msg =  userlang('blog_edited') ;
            $output = array( 
                    'form_msg' => $form_msg,
                    'err' => '0'
                    );
            echo json_encode($output);
        } else {
            $form_msg =  userlang('form_empty')  ;
            $output = array( 
                    'form_msg' => $form_msg,
                    'err' => '5'
                    );
            echo json_encode($output);
        }
    }
}

?>