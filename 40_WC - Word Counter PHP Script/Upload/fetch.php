<?php
if(isset($_POST['btn_action']))
{
    if($_POST['btn_action'] == 'fetch_counter')
	{
        if(!empty($_POST['value'])) {
            
            $text = $_POST['value'] ;
            $nchars = strlen($text);
            $lines = preg_split('/\n|\r/',$text);
            $nlines = count($lines);
            $nwords = 0;
            foreach ($lines as $line) {
                $line = trim($line);		// strip leading and trailing spaces
                if (strlen($line) != 0) {		// handle empty lines correctly
                $words = preg_split('/[\s]+/', $line);		
                $nwords += count($words);
                }
            }
            $output = array( 
							'err' => '0',
                            'lines' => $nlines,
                            'words' => $nwords,
                            'chars' => $nchars
							) ;
            echo json_encode($output);
            
        } else {
            $output = array( 
							'err' => '1'
							) ;
            echo json_encode($output);
        }
    }
}
?>
