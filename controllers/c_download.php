<?php

class download_controller extends base_controller {
	

	########### //Process the XML and Send to View ###########
	public function csv($report = NULL) {

		//Define location of the process file directory.
		$file = 'csv/'.$report.'.csv';
		
		//Check to See if the File Exsits... if so, send the file to the user.			
		if (file_exists($file))
			{
			    header('Content-Description: File Transfer');
			    header('Content-Type: application/octet-stream');
			    header('Content-Disposition: attachment; filename='.basename($file));
			    header('Content-Transfer-Encoding: binary');
			    header('Expires: 0');
			    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			    header('Pragma: public');
			    header('Content-Length: ' . filesize($file));
			    ob_clean();
			    flush();
			    readfile($file);
			    exit;
			
			}else{
			
			    //Redirect because the files does not exsit.
			    echo "File does not exists";
			}		

	}// End of Fuction
	
	########### //Process the XML and Send to View ###########
	public function html($report = NULL) {
	
		//Define location of the process file directory.
		$file = 'html/'.$report.'.html';
		
		//Check to See if the File Exsits... if so, send the file to the user.			
		if (file_exists($file))
			{
			    header('Content-Description: File Transfer');
			    header('Content-Type: application/octet-stream');
			    header('Content-Disposition: attachment; filename='.basename($file));
			    header('Content-Transfer-Encoding: binary');
			    header('Expires: 0');
			    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
			    header('Pragma: public');
			    header('Content-Length: ' . filesize($file));
			    ob_clean();
			    flush();
			    readfile($file);
			    exit;
			
			}else{
			
			    //Redirect because the files does not exsit.
			    echo "File does not exists";
			}		
		
		
	}//End of function
	
		
	
	
} # End of class
