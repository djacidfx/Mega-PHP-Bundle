<?php
if(isset($_POST['btn-action-pro'])) {
	if($_POST['btn-action-pro'] == 'Fetch'){
		if ( !empty($_POST['amount']) && !empty($_POST['gst']) && !empty($_POST['tax']) ) {
			$amount = filter_var($_POST['amount'], FILTER_SANITIZE_STRING) ;
			$gst = filter_var($_POST['gst'], FILTER_SANITIZE_NUMBER_INT) ;
			$tax = filter_var($_POST['tax'], FILTER_SANITIZE_STRING) ;
			$output = '' ;
			if($gst === '1'){
				$taxAmt = ($amount*$tax)/100 ;
				$taxAmt = number_format((float)$taxAmt , 2, '.', '');
				$netAmt = ($amount + $taxAmt) ;
				$netAmt = number_format((float)$netAmt , 2, '.', '');
				$output = array( 
					'taxAmt' 	=> $taxAmt,
					'netAmt' => $netAmt
					);
				echo json_encode($output);
			} 
			if($gst === '2'){
				$taxAmt = $amount - (($amount*(100/(100 + $tax)))) ;
				$taxAmt = number_format((float)$taxAmt , 2, '.', '');
				$netAmt = ($amount - $taxAmt) ;
				$netAmt = number_format((float)$netAmt , 2, '.', '');
				$output = array( 
					'taxAmt' 	=> $taxAmt,
					'netAmt' => $netAmt
					);
				echo json_encode($output);
			}
		
		}  else {
			$form_message = "Amount & Tax % are mandatory. Try Again.";
				$output = array(
					'form_message' => $form_message 
					);
				echo json_encode($output);
		}
	}

}