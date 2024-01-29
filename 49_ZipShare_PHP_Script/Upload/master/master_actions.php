<?php
ob_start();
session_start();
include("../config/database.php") ;
include("../functions.php") ;
include("../language/lang.php") ;
include("../mode/mode.php") ;
check_admin_logged_in($pdo);

if(isset($_POST['btn_action'])) {
    
    if($_POST['btn_action'] == 'btnAdCode') {
        $adcode = base64_encode($_POST['adcode']) ;
        $adcode = filter_var($adcode, FILTER_SANITIZE_STRING) ;
        $adon = filter_var($_POST['ad_on'], FILTER_SANITIZE_NUMBER_INT) ;
        if($adon == '1'){
            $adon = 1 ;
        } else {
            $adon = 0 ;
        }
        if(!empty($adcode)){
            $upd = $pdo->prepare("update ot_admin set ad_code = '".$adcode."' , ad_code_on = '".$adon."' where id = '1'") ;
            $upd->execute();
            $form_msg =  userlang('setting_saved') ;
            $output = array( 
                    'form_msg' => $form_msg,
                    'err' => '0'
                    );
            echo json_encode($output);
                
        } else {
            $form_msg =  userlang('form_empty') ;
            $output = array( 
                    'form_msg' => $form_msg,
                    'err' => '1'
                    );
            echo json_encode($output);
        }
    }
    
    if($_POST['btn_action'] == 'btnAnalyticCode') {
        $adcode = base64_encode($_POST['adcode']) ;
        $adcode = filter_var($adcode, FILTER_SANITIZE_STRING) ;
        $adon = filter_var($_POST['ad_on'], FILTER_SANITIZE_NUMBER_INT) ;
        if($adon == '1'){
            $adon = 1 ;
        } else {
            $adon = 0 ;
        }
        if(!empty($adcode)){
            $upd = $pdo->prepare("update ot_admin set analytic_code = '".$adcode."' , analytic_code_on = '".$adon."' where id = '1'") ;
            $upd->execute();
            $form_msg =  userlang('setting_saved') ;
            $output = array( 
                    'form_msg' => $form_msg,
                    'err' => '0'
                    );
            echo json_encode($output);
                
        } else {
            $form_msg =  userlang('form_empty') ;
            $output = array( 
                    'form_msg' => $form_msg,
                    'err' => '1'
                    );
            echo json_encode($output);
        }
    }
    
    if($_POST['btn_action'] == 'btnSetting') {
        $aboutus = filter_var($_POST['aboutus'], FILTER_SANITIZE_STRING) ;
        $copyrightname = filter_var($_POST['copyrightname'], FILTER_SANITIZE_STRING) ;
        $defaultlimit = filter_var($_POST['defaultlimit'], FILTER_SANITIZE_NUMBER_INT) ;
        $loadmorelimit = filter_var($_POST['loadmorelimit'], FILTER_SANITIZE_NUMBER_INT) ;
        $approve = filter_var($_POST['approve'], FILTER_SANITIZE_NUMBER_INT) ;
        if($approve == '1'){
            $approve = 1 ;
        } else {
            $approve = 0 ;
        }
        if(!empty($aboutus) && !empty($defaultlimit) && !empty($loadmorelimit) && !empty($copyrightname) ){
            $upd = $pdo->prepare("update ot_admin set about_us = '".$aboutus."' , auto_approve = '".$approve."' , show_default = '".$defaultlimit."' , show_load_more = '".$loadmorelimit."' , copyright_name = '".$copyrightname."' where id = '1'") ;
            $upd->execute();
            $form_msg =  userlang('setting_saved') ;
            $output = array( 
                    'form_msg' => $form_msg,
                    'err' => '0'
                    );
            echo json_encode($output);
                
        } else {
            $form_msg =  userlang('form_empty') ;
            $output = array( 
                    'form_msg' => $form_msg,
                    'err' => '1'
                    );
            echo json_encode($output);
        }
    }
    
    // Change Admin Username
    if($_POST['btn_action'] == 'btnChangeUsername') {
        $newUsername = filter_var($_POST['username'], FILTER_SANITIZE_STRING) ;
        $password = filter_var($_POST['password'], FILTER_SANITIZE_STRING) ;
        if(!empty($newUsername) && !empty($password)){
            $checkUser =  $pdo->prepare("SELECT * FROM ot_admin WHERE id = '1'");
            $checkUser->execute();
            $user_ok = $checkUser->rowCount();
            $user_data = $checkUser->fetchAll(PDO::FETCH_ASSOC);
            //checking admin credential
            if($user_ok > 0){
                foreach($user_data as $row){
                    $auth_pass = ($row['password']);
                }
                if(password_verify($password, $auth_pass)) {
                    $upd = $pdo->prepare("update ot_admin set username = '".$newUsername."' where id = '1'") ;
                    $upd->execute();
                    $form_msg =  userlang('username_changed') ;
                    $output = array( 
                            'form_msg' => $form_msg,
                            'err' => '0'
                            );
                    echo json_encode($output);
                } else {
                    $form_msg =  userlang('wrong_password') ;
                    $output = array( 
                            'form_msg' => $form_msg,
                            'err' => '1'
                            );
                    echo json_encode($output);
                }
            }  
        } else {
            $form_msg =  userlang('form_empty') ;
            $output = array( 
                    'form_msg' => $form_msg,
                    'err' => '2'
                    );
            echo json_encode($output);
        }
    }
    
    // Changing Admin Password 
    if($_POST['btn_action'] == 'btnChangePass') {
        if(!empty($_POST['oldpass'])  && !empty($_POST['newpass']) && !empty($_POST['repass'])  ) {
            $oldpass = filter_var($_POST['oldpass'], FILTER_SANITIZE_STRING) ;
            $newpass = filter_var($_POST['newpass'], FILTER_SANITIZE_STRING) ;
            $repass = filter_var($_POST['repass'], FILTER_SANITIZE_STRING) ;
            
            $uppercase = preg_match('@[A-Z]@', $newpass);
            $lowercase = preg_match('@[a-z]@', $newpass);
            $number    = preg_match('@[0-9]@', $newpass);
            $statement = $pdo->prepare("select * from ot_admin where id = '1'");
            $statement->execute() ;
            $result = $statement->fetchAll(PDO::FETCH_ASSOC); 
            $user_ok = $statement->rowCount();
            if($user_ok > 0) {
                foreach($result as $row){
                    $auth_pass = _e($row['password']) ;
                }
                if(password_verify($oldpass, $auth_pass)) {
                    if($newpass == $repass) {
                        //validate password
                        if(!$uppercase || !$lowercase || !$number || strlen($newpass) < 8) {
                            $form_msg =  userlang('min_password') ;
                            $output = array( 
                                    'form_msg' => $form_msg,
                                    'err' => '3'
                                    );
                            echo json_encode($output);
                        } else {
                            $update_password = $pdo->prepare("update ot_admin set password = ? where id = '1'");
                            $update_password->execute(array(password_hash($newpass, PASSWORD_DEFAULT)));
                            
                            $form_msg =  userlang('password_changed') ;
                            $output = array( 
                                    'form_msg' => $form_msg,
                                    'err' => '1'
                                    );
                            echo json_encode($output);
                        }
                    } else {
                        $form_msg =  userlang('password_error') ;
                        $output = array( 
                                'form_msg' => $form_msg,
                                'err' => '2'
                                );
                        echo json_encode($output);
                    }
                } else {
                    $form_msg =  userlang('wrong_password') ;
                    $output = array( 
                            'form_msg' => $form_msg,
                            'err' => '0'
                            );
                    echo json_encode($output);
                }
            }
        } else {
            $form_msg =  userlang('form_empty') ;
            $output = array( 
                    'form_msg' => $form_msg,
                    'err' => '4'
                    );
            echo json_encode($output);
        }
    }
    
   if($_POST['btn_action'] == 'save_page'){
       
        if(!empty($_POST['page_name'])  && !empty($_POST['description']) ) {
            $pageName = filter_var($_POST['page_name'] , FILTER_SANITIZE_STRING) ;
            $pageSlug =  strtolower(preg_replace("/[^\w]+/", "-", $pageName));
            $pageContent = base64_encode($_POST['description']) ;
            $pageContent = filter_var($pageContent , FILTER_SANITIZE_STRING) ;
            $checkSlug = check_page_slug($pdo,$pageSlug) ;
            if($checkSlug == '1') {
                $form_msg =  userlang('duplicate_page_name') ;
                $output = array( 
                        'form_msg' => $form_msg,
                        'err' => '2'
                        );
                echo json_encode($output); 
            } else {
                $ins = $pdo->prepare("insert into ot_pages (page_name, page_slug, page_description) values (?,?,?)") ;
                $ins->execute(array($pageName, $pageSlug, $pageContent));
                $form_msg =  userlang('page_published') ;
                $output = array( 
                        'form_msg' => $form_msg,
                        'err' => '0'
                        );
                echo json_encode($output); 
            }
        } else {
            $form_msg =  userlang('empty_page_field') ;
            $output = array( 
                    'form_msg' => $form_msg,
                    'err' => '1'
                    );
            echo json_encode($output); 
        }
   }
    
    if($_POST['btn_action'] == 'edit_page'){
       
        if(!empty($_POST['page_name'])  && !empty($_POST['description']) && !empty($_POST['pid']) ) {
            $pageId = filter_var($_POST['pid'] , FILTER_SANITIZE_NUMBER_INT) ;
            $pageName = filter_var($_POST['page_name'] , FILTER_SANITIZE_STRING) ;
            $pageSlug =  strtolower(preg_replace("/[^\w]+/", "-", $pageName));
            $pageContent = base64_encode($_POST['description']) ;
            $pageContent = filter_var($pageContent , FILTER_SANITIZE_STRING) ;
            $checkSlug = check_page_slug_byId($pdo,$pageSlug,$pageId) ;
            if($checkSlug == '1') {
                $form_msg =  userlang('duplicate_page_name') ;
                $output = array( 
                        'form_msg' => $form_msg,
                        'err' => '2'
                        );
                echo json_encode($output); 
            } else {
                $ins = $pdo->prepare("update ot_pages set page_name = '".$pageName."', page_slug = '".$pageSlug."', page_description = '".$pageContent."' where page_id = '".$pageId."'") ;
                $ins->execute();
                $form_msg =  userlang('page_edited') ;
                $output = array( 
                        'form_msg' => $form_msg,
                        'err' => '0'
                        );
                echo json_encode($output); 
            }
        } else {
            $form_msg =  userlang('empty_page_field') ;
            $output = array( 
                    'form_msg' => $form_msg,
                    'err' => '1'
                    );
            echo json_encode($output); 
        }
   }
    
    if($_POST['btn_action'] == 'fetch_description')
	{	
		if(!empty($_POST['id'])){
			$noteId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
			$announce = $pdo->prepare("select * from ot_zip where zip_id = ?");
			$announce->execute(array($noteId));
			$result = $announce->fetchAll(PDO::FETCH_ASSOC);
			foreach($result as $row) {
				$output['noteDescription'] = nl2br(strip_tags($row['zip_description']));
			}
			echo json_encode($output) ;
		} 
	}
    
    if($_POST['btn_action'] == 'approve_zip')
	{	
		if(!empty($_POST['id'])){
			$zipId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
			$announce = $pdo->prepare("update ot_zip set zip_status = '1' where zip_id = ?");
			$announce->execute(array($zipId));
			echo userlang('approve_zip') ;
		} 
	}
    
    if($_POST['btn_action'] == 'make_unfeatured')
	{	
		if(!empty($_POST['id'])){
			$zipId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
			$announce = $pdo->prepare("update ot_zip set zip_featured = '0' where zip_id = ?");
			$announce->execute(array($zipId));
			echo userlang('unfeatured_zip') ;
		} 
	}
    
    if($_POST['btn_action'] == 'make_featured')
	{	
		if(!empty($_POST['id'])){
			$zipId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
			$announce = $pdo->prepare("update ot_zip set zip_featured = '1' , zip_popular = '0' where zip_id = ?");
			$announce->execute(array($zipId));
			echo userlang('featured_zip') ;
		} 
	}
    
    if($_POST['btn_action'] == 'make_unpopular')
	{	
		if(!empty($_POST['id'])){
			$zipId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
			$announce = $pdo->prepare("update ot_zip set zip_popular = '0' where zip_id = ?");
			$announce->execute(array($zipId));
			echo userlang('unpopular_zip') ;
		} 
	}
    
    if($_POST['btn_action'] == 'make_popular')
	{	
		if(!empty($_POST['id'])){
			$zipId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
			$announce = $pdo->prepare("update ot_zip set zip_featured = '0' , zip_popular = '1' where zip_id = ?");
			$announce->execute(array($zipId));
			echo userlang('popular_zip') ;
		} 
	}
    
    if($_POST['btn_action'] == 'zip_delete')
	{	
		if(!empty($_POST['id'])){
			$zipId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
            $zipFile = getzipfile_by_id($pdo,$zipId) ;
            $targetDir = "../zipfiles/";
            //delete old image
            unlink($targetDir.$zipFile); 
			$announce = $pdo->prepare("delete from ot_zip where zip_id = ?");
			$announce->execute(array($zipId));
			echo userlang('zip_deleted') ;
		} 
	}
    
    if($_POST['btn_action'] == 'zip_delete_block_ip')
	{	
		if(!empty($_POST['id'])){
			$zipId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
            $userIp = get_userip($pdo , $zipId) ;
            $zipFile = getzipfile_by_id($pdo,$zipId) ;
            $targetDir = "../zipfiles/";
            //delete old image
            unlink($targetDir.$zipFile); 
            $statement = $pdo->prepare("insert into ot_blocked_ip (ip_address) values ('".$userIp."') ") ;
            $statement->execute();
			$announce = $pdo->prepare("delete from ot_zip where zip_id = ?");
			$announce->execute(array($zipId));
			echo userlang('zip_deleted_with_ip') ;
		} 
	}
    
    if($_POST['btn_action'] == 'un_block_ip')
	{	
		if(!empty($_POST['id'])){
			$id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
			$announce = $pdo->prepare("delete from ot_blocked_ip where blocked_ip = ?");
			$announce->execute(array($id));
			echo userlang('unblocked_ip') ;
		} 
	}
    
    if($_POST['btn_action'] == 'btnAddCategory')
	{	
		if(!empty($_POST['catName'])){
			$catName = filter_var($_POST['catName'], FILTER_SANITIZE_STRING);
            $catSlug =  strtolower(preg_replace("/[^\w]+/", "-", $catName));
            if(check_category_slug($pdo,$catSlug) > 0) {
                $form_msg =  userlang('duplicate_category_name') ;
                $output = array( 
                        'form_msg' => $form_msg,
                        'err' => '1'
                        );
                echo json_encode($output); 
            } else {
              $announce = $pdo->prepare("insert into ot_category (category_name, category_slug) values ('".$catName."' , '".$catSlug."')");
              $announce->execute();
                $output = array( 
                        'err' => '0'
                        );
                echo json_encode($output);  
            }
			
		} 
	}
    
    if($_POST['btn_action'] == 'fetch_category')
	{	
		if(!empty($_POST['id'])){
			$noteId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
			$announce = $pdo->prepare("select * from ot_category where cat_id = ?");
			$announce->execute(array($noteId));
			$result = $announce->fetchAll(PDO::FETCH_ASSOC);
			foreach($result as $row) {
				$output['catName'] = strip_tags($row['category_name']);
				$output['cid'] = _e($row['cat_id']);
			}
			echo json_encode($output) ;
		} 
	}
    
    if($_POST['btn_action'] == 'btnEditCategory')
	{	
		if(!empty($_POST['catName']) && !empty($_POST['cid'])){
            $catId = filter_var($_POST['cid'], FILTER_SANITIZE_NUMBER_INT);
			$catName = filter_var($_POST['catName'], FILTER_SANITIZE_STRING);
            $catSlug =  strtolower(preg_replace("/[^\w]+/", "-", $catName));
            if(check_category_slug_byId($pdo,$catSlug,$catId) > 0) {
                $form_msg =  userlang('duplicate_category_name') ;
                $output = array( 
                        'form_msg' => $form_msg,
                        'err' => '1'
                        );
                echo json_encode($output); 
            } else {
              $announce = $pdo->prepare("update ot_category set category_name = '".$catName."' , category_slug = '".$catSlug."' where cat_id = '".$catId."'");
              $announce->execute();
                $output = array( 
                        'err' => '0'
                        );
                echo json_encode($output);  
            }
			
		} 
	}
    
    if($_POST['btn_action'] == 'disable_category')
	{	
		if(!empty($_POST['id'])){
			$catId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
			$announce = $pdo->prepare("update ot_category set category_status = '0' where cat_id = ?");
			$announce->execute(array($catId));
            $upd = $pdo->prepare("update ot_zip set zip_status = '0' where zip_category = '".$catId."'");
            $upd->execute();
			echo userlang('category_deactivated') ;
		} 
	}
    
    if($_POST['btn_action'] == 'enable_category')
	{	
		if(!empty($_POST['id'])){
			$catId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
			$announce = $pdo->prepare("update ot_category set category_status = '1' where cat_id = ?");
			$announce->execute(array($catId));
            $upd = $pdo->prepare("update ot_zip set zip_status = '1' where zip_category = '".$catId."'");
            $upd->execute();
			echo userlang('category_activated') ;
		} 
	}
    
    if($_POST['btn_action'] == 'category_delete')
	{	
		if(!empty($_POST['id'])){
            
			$catId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
            $upd = $pdo->prepare("select * from ot_zip where zip_category = '".$catId."'");
            $upd->execute();
            $result = $upd->fetchAll();
            foreach($result as $row){
                $zipId = _e($row['zip_id']) ;
                $zipFile = getzipfile_by_id($pdo,$zipId) ;
                $targetDir = "../zipfiles/";
                //delete old image
                unlink($targetDir.$zipFile); 
                $announce = $pdo->prepare("delete from ot_zip where zip_id = ?");
                $announce->execute(array($zipId));
            }
            $del = $pdo->prepare("delete from ot_category where cat_id = ?");
			$del->execute(array($catId));
			
			echo userlang('category_zip_deleted') ;
		} 
	}
    
    if($_POST['btn_action'] == 'enable_blog')
	{	
		if(!empty($_POST['id'])){
			$blogId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
			$announce = $pdo->prepare("update ot_blogs set blog_status = '1' where blog_id = ?");
			$announce->execute(array($blogId));
			echo userlang('blog_activated') ;
		} 
	}
    
    if($_POST['btn_action'] == 'disable_blog')
	{	
		if(!empty($_POST['id'])){
			$blogId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
			$announce = $pdo->prepare("update ot_blogs set blog_status = '0' where blog_id = ?");
			$announce->execute(array($blogId));
			echo userlang('blog_deactivated') ;
		} 
	}
    
    if($_POST['btn_action'] == 'blog_delete')
	{	
		if(!empty($_POST['id'])){
            
			$blogId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
            $blogSlug = blogslug_by_blogid($pdo,$blogId) ;
            $blogImage = blogimage_by_blog_slug($pdo,$blogSlug) ;
            $targetDir = "../blogimages/";
            //delete blog image
            unlink($targetDir.$blogImage);                 
            $del = $pdo->prepare("delete from ot_blogs where blog_id = ?");
			$del->execute(array($blogId));			
			echo userlang('blog_deleted') ;
		} 
	}
    
    if($_POST['btn_action'] == 'enable_page')
	{	
		if(!empty($_POST['id'])){
			$pageId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
			$announce = $pdo->prepare("update ot_pages set page_status = '1' where page_id = ?");
			$announce->execute(array($pageId));
			echo userlang('page_activated') ;
		} 
	}
    
    if($_POST['btn_action'] == 'disable_page')
	{	
		if(!empty($_POST['id'])){
			$pageId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
			$announce = $pdo->prepare("update ot_pages set page_status = '0' where page_id = ?");
			$announce->execute(array($pageId));
			echo userlang('page_deactivated') ;
		} 
	}
    
    if($_POST['btn_action'] == 'page_delete')
	{	
		if(!empty($_POST['id'])){
            
			$pageId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);         
            $del = $pdo->prepare("delete from ot_pages where page_id = ?");
			$del->execute(array($pageId));			
			echo userlang('page_deleted') ;
		} 
	}
    
}
?>