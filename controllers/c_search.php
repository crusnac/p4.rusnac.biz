<?php

class search_controller extends base_controller {
	
	
	########### //Process the XML and Send to View ###########
	public function report_json($request = NULL) {
			
		//Query DB for request
		$q = "select * from reports where request_number like '%$request%' limit 20";	
		$report = DB::instance(DB_NAME)->select_rows($q);
					
		//Send Query data to view to process - Encode into JSON to be processed by AJAX/JQuery in View
		print_r(json_encode($report));

		
	}// End of Fuction
	
			
	
	
} # End of class
