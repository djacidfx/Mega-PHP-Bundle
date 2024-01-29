<?php
ob_start();
session_start();
include("../config/database.php") ;
include("../functions.php") ;
include("../language/lang.php") ;
include("../mode/mode.php") ;
check_admin_logged_in($pdo);
$err = 0 ;
if(isset($_POST['btn_action'])) {
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
    
    if($_POST['btn_action'] == 'fetch_description')
	{	
		if(!empty($_POST['id'])){
			$noteId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
			$announce = $pdo->prepare("select * from ot_notes where note_id = ?");
			$announce->execute(array($noteId));
			$result = $announce->fetchAll(PDO::FETCH_ASSOC);
			foreach($result as $row) {
				$output['noteDescription'] = nl2br(strip_tags($row['note']));
			}
			echo json_encode($output) ;
		} 
	}
    
    if($_POST['btn_action'] == 'note_delete')
	{	
		if(!empty($_POST['id'])){
			$noteId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
			$announce = $pdo->prepare("delete from ot_notes where note_id = ?");
			$announce->execute(array($noteId));
			echo userlang('note_deleted') ;
		} 
	}
    
    if($_POST['btn_action'] == 'note_delete_block_ip')
	{	
		if(!empty($_POST['id'])){
			$noteId = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);
            $userIp = get_userip($pdo , $noteId) ;
            $statement = $pdo->prepare("insert into ot_blocked_ip (ip_address) values ('".$userIp."') ") ;
            $statement->execute();
			$announce = $pdo->prepare("delete from ot_notes where note_id = ?");
			$announce->execute(array($noteId));
			echo userlang('note_deleted_with_ip') ;
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
}
?>