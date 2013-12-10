<?php

class index_controller extends base_controller {
	
	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
		parent::__construct();
	} 
		
	/*-------------------------------------------------------------------------------------------------
	Accessed via http://localhost/index/index/
	-------------------------------------------------------------------------------------------------*/
	public function index(){
		
		//Redirect to the Dashoard page
		Router::redirect('/index/dashboard/');
		
		
	}//End of Function
	
	
	
	public function dashboard($page = NULL) {
		
			//Set Main Template.
			$this->template->content = View::instance('v_index');
			
			# Now set the <title> tag
			$this->template->title = "Hello World";
				
		
			//Query the Reports table to and return the Array.  Sort of the file timestamp.
			$q = "select * from reports ORDER BY file_timestamp DESC";	
			$reports = DB::instance(DB_NAME)->select_rows($q);	
						
			// #### Set Pagination Variables #### //
			
				//Items per page
				$items_per_page = 15;
				
				//Total number of reports
				$total_reports = count($reports);
				
				//Set total number of pages derived by dividing total reports by the items_per_page variable.
				$total_pages = ceil($total_reports / $items_per_page);
				
				//Specify the Current Page - passed via URL parameter ex. ?page=1
				$current_page = $page;
				
				//End Number of the array to display
				$offset = ($current_page * $items_per_page) + $items_per_page;
				
				//Beginning number of the array
				$start_offset = $offset - $items_per_page;
				
				//Sliced array using the start and end offset.  False will not preserve the array keys. http://php.net/array_slice
				$reports_paged = array_slice($reports, $start_offset, $items_per_page, false);
			
			//Send Sliced array to the View
			$this->template->content->reports = $reports_paged;
			      					     		
			// Render the view
			echo $this->template;

	} # End of method
	
	
} # End of class
