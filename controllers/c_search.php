<?php

class search_controller extends base_controller {
	

	########### //Process the XML and Send to View ###########
	public function report($request = NULL) {
	
		//Define view parameters			
		$this->template->content = View::instance('v_search_report');
		$this->template->title  = "Search Reports";

			
		//Display the template
		echo $this->template;

		
	}// End of Fuction
	
	
	########### //Process the XML and Send to View ###########
	public function report_json($request = NULL) {
			
		//Query DB for request
		$q = "select * from reports where request_number like '%$request%' limit 20";	
		$report = DB::instance(DB_NAME)->select_rows($q);
					
		//Send Query data to view to process - Encode into JSON to be processed by AJAX/JQuery in View
		print_r(json_encode($report));

		
	}// End of Fuction
	
			
	
	
} # End of class
