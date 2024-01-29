<?php
ob_start();
session_start();
include("_adminarea_/db/config.php");
include("_adminarea_/db/item_functions.php");
// Checking User is logged in or not
if(!isset($_SESSION['user'])) {
	unset($_SESSION['user']);
	header("location: ".BASE_URL."");
	exit;
}
if($_POST['name_submit_pr']){
	if($_POST['name_submit_pr'] == 'SubmitName') {
		$oldpass = filter_var($_POST['userPassword'], FILTER_SANITIZE_STRING) ;
		$newName = filter_var($_POST['userName'], FILTER_SANITIZE_STRING) ;
		$id = filter_var($_SESSION['user']['user_id'], FILTER_SANITIZE_NUMBER_INT) ;
		$statement = $pdo->prepare("select * from ot_user where user_id = ?");
		$statement->execute(array($id)) ;
		$result = $statement->fetchAll(PDO::FETCH_ASSOC); 
		$user_ok = $statement->rowCount();
		if($user_ok > 0) {
			foreach($result as $row){
				$auth_pass = _e($row['user_pass']) ;
			}
			//validate password
			if(password_verify($oldpass, $auth_pass)) {
				
					$update_name = $pdo->prepare("update ot_user set user_name = ? where user_id = ?");
					$update_name->execute(array($newName,$id));
					$form_message = "Name Updated Successfully.";
					$output = array( 
							'form_message' => $form_message,
							'name' => $newName
							) ;
					echo json_encode($output);
				
				
			} else {
				$form_message = "Password is wrong. Try Again.";
				$output = array( 
						'form_message' => $form_message
						) ;
				echo json_encode($output);
			}
		} else {
			$form_message = "This is not authorized user.";
			$output = array( 
					'form_message' => $form_message
					) ;
			echo json_encode($output);
		}
	}
} 
?>
