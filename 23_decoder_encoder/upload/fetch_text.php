<?php
if(isset($_POST['btn-action-pro'])) {
	if($_POST['btn-action-pro'] == 'Fetch'){
		if ( !empty($_POST['myText']) && !empty($_POST['enc']) ) {
			$myText = filter_var($_POST['myText'], FILTER_SANITIZE_STRING) ;
			$enc = filter_var($_POST['enc'], FILTER_SANITIZE_NUMBER_INT) ;
			$output = '' ;
			if($enc === '1'){
				$newText = urlencode($myText) ;
				$output = array( 
					'newText' 	=> $newText
					);
				echo json_encode($output);
			} 
			if($enc === '2'){
				$newText = urldecode($myText) ;
				$output = array( 
					'newText' 	=> $newText
					);
				echo json_encode($output);
			}
		
		}  else {
			$form_message = "Text is mandatory. Try Again.";
				$output = array(
					'form_message' => $form_message 
					);
				echo json_encode($output);
		}
	}

}