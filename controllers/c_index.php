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
		Router::redirect('/index/reports/');
		
		
	}//End of Function
	
	
	
	public function reports($page = NULL) {
		
			//Set Main Template.
			$this->template->content = View::instance('v_index_reports');
			
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
				$total_pages = ceil($total_reports / $items_per_page)-1;
				
				//Specify the Current Page - passed via URL parameter ex. ?page=1
				$current_page = $page;
				
				//Next & Previus Variables
				$prev = $current_page - 1;
				$next = $current_page +1;
				
				//End Number of the array to display
				$offset = ($current_page * $items_per_page) + $items_per_page;
				
				//Beginning number of the array
				$start_offset = $offset - $items_per_page;
				
				//Sliced array using the start and end offset.  False will not preserve the array keys. http://php.net/array_slice
				$reports_paged = array_slice($reports, $start_offset, $items_per_page, false);
				
				
				
			
			//Send Sliced array to the View
			$this->template->content->reports = $reports_paged;
			
			//Send Variables to the View
			$this->template->content->total_pages = $total_pages;
			$this->template->content->current_page = $current_page;
			$this->template->content->prev = $prev;
			$this->template->content->next = $next;


			      					     		
			// Render the view
			echo $this->template;

	} # End of method
	
	
} # End of class
