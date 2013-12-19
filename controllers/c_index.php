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
	
		//Check to make sure user is logged in.
		if(!$this->user) {
			Router::redirect('/users/login/');
		
			//If logged in Continue...	
			}else{
		
				//Set Main Template Variables.
				$this->template = View::instance('_v_index_dashboard_template');
	
				$this->template->content = View::instance('v_index_reports');
				
				# View within a view        
				$this->template->sidemenu = View::instance('v_index_reports_sidemenu');
				
				
				# Now set the <title> tag
				$this->template->title = "Hello World";
					
			
				//Query the Reports table to and return the Array.  Sort of the file timestamp.
				$q = "select * from reports ORDER BY file_timestamp DESC";	
				$reports = DB::instance(DB_NAME)->select_rows($q);	
							
				// #### Set Pagination Variables #### //
					
				
					//Items per page
					$items_per_page = 13;
					
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
			
			}//End of Else

	}//End of Function
	
	
	########### //Process the XML and Send to View ###########
	public function search($request = NULL) {
	
		//Check to make sure user is logged in.
		if(!$this->user) {
			Router::redirect('/users/login/');
		
			//If logged in Continue...	
			}else{
				//Define view parameters			
				$this->template = View::instance('_v_index_dashboard_template');
		
				$this->template->content = View::instance('v_index_search');
					
				// View within a view        
				$this->template->sidemenu = View::instance('v_index_reports_sidemenu');
					
					
				//Set Title
				$this->template->title = "Hello World";
		
					
				//Display the template
				echo $this->template;
				
			}// End if else

		
	}// End of Fuction
	
	
	########### //Process the XML and Send to View ###########
	public function report($report = NULL) {
	
		//Check to make sure user is logged in.
		if(!$this->user) {
			Router::redirect('/users/login/');
		
			//If logged in Continue...	
			}else{
					//Define view parameters			
				$this->template = View::instance('_v_index_dashboard_template');
		
				$this->template->content = View::instance('v_index_report');
					
				//Query the Reports table to and return the Array.  Sort of the file timestamp.
				$q = "select * from reports where reportid = $report";	
				$report = DB::instance(DB_NAME)->select_rows($q);	
				
				$this->template->content->report = $report;
					
				// View within a view        
				$this->template->sidemenu = View::instance('v_index_reports_sidemenu');
				
				//Convert filesize to human readable 
				function formatBytes($size, $precision = 2){
						$base = log($size) / log(1024);
						$suffixes = array('', 'k', 'M', 'G', 'T');   
					
						return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
					}
					
					
				//Set Title
				$this->template->title = "Report Details";
				
				//Display the template
				echo $this->template;
				
			} // End of Else

		
	}// End of Fuction
	
	########### //Process Stats  ###########
	public function statistics() {
	
		//Check to make sure user is logged in.
		if(!$this->user) {
			Router::redirect('/users/login/');
		
			//If logged in Continue...	
			}else{
	
				//Define view parameters			
				$this->template = View::instance('_v_index_dashboard_template');
		
				$this->template->content = View::instance('v_index_statistics');
					
				// View within a view        
				$this->template->sidemenu = View::instance('v_index_reports_sidemenu');
					
					
				//Set Title
				$this->template->title = "Report Statistics";
				
				
				//Set Month variables or each month e.x. Jan = 1
				$current_year = date("Y");
				$current_month = date("n", strtotime("this month"));
				$minus_1_month = date("n", strtotime('-1 months'));
				$minus_2_month = date("n", strtotime('-2 months'));
				$minus_3_month = date("n", strtotime('-3 months'));
				$minus_4_month = date("n", strtotime('-4 months'));
				$minus_5_month = date("n", strtotime('-5 months'));
				$minus_6_month = date("n", strtotime('-6 months'));
				
				//Query the DB
				$current_month_q = "select * from reports WHERE (start_time LIKE '%$current_month/_/$current_year%') OR (start_time LIKE '%$current_month/__/$current_year%')";
				
				$current_month = DB::instance(DB_NAME)->select_rows($current_month_q);		
				
				$minus_1_month_q = "select * from reports WHERE (start_time LIKE '%$minus_1_month/_/$current_year%') OR (start_time LIKE '%$minus_1_month/__/$current_year%')";	
				$minus_1_month = DB::instance(DB_NAME)->select_rows($minus_1_month_q);		
				
				$minus_2_month_q = "select * from reports WHERE (start_time LIKE '%$minus_2_month/_/$current_year%') OR (start_time LIKE '%$minus_2_month/__/$current_year%')";	
				$minus_2_month = DB::instance(DB_NAME)->select_rows($minus_2_month_q);
				
				$minus_3_month_q = "select * from reports WHERE (start_time LIKE '%$minus_3_month/_/$current_year%') OR (start_time LIKE '%$minus_3_month/__/$current_year%')";	
				$minus_3_month = DB::instance(DB_NAME)->select_rows($minus_3_month_q);		
		
				$minus_4_month_q = "select * from reports WHERE (start_time LIKE '%$minus_4_month/_/$current_year%') OR (start_time LIKE '%$minus_4_month/__/$current_year%')";	
				$minus_4_month = DB::instance(DB_NAME)->select_rows($minus_4_month_q);		
		
				$minus_5_month_q = "select * from reports WHERE (start_time LIKE '%$minus_5_month/_/$current_year%') OR (start_time LIKE '%$minus_5_month/__/$current_year%')";	
				$minus_5_month = DB::instance(DB_NAME)->select_rows($minus_5_month_q);	
				
				$minus_6_month_q = "select * from reports WHERE (start_time LIKE '%$minus_6_month/_/$current_year%') OR (start_time LIKE '%$minus_6_month/__/$current_year%')";	
				$minus_6_month = DB::instance(DB_NAME)->select_rows($minus_6_month_q);		
				
				
				//Send data to stats view to be included in graph
				$this->template->content->current_month = count($current_month);
				$this->template->content->minus_1_month = count($minus_1_month);
				$this->template->content->minus_2_month = count($minus_2_month);
				$this->template->content->minus_3_month = count($minus_3_month);
				$this->template->content->minus_4_month = count($minus_4_month);
				$this->template->content->minus_5_month = count($minus_5_month);
				$this->template->content->minus_6_month = count($minus_6_month);
		
		
				//Display the template
				echo $this->template;
				
			}//End of Else

		
	}// End of Fuction
	
	
	########### //Upload  ###########
	public function upload() {
	
		//Check to make sure user is logged in.
		if(!$this->user) {
			Router::redirect('/users/login/');
		
			//If logged in Continue...	
			}else{
	
				//Define view parameters			
				$this->template = View::instance('_v_index_dashboard_template');
		
				$this->template->content = View::instance('v_index_upload');
					
				// View within a view        
				$this->template->sidemenu = View::instance('v_index_reports_sidemenu');
					
					
				//Set Title
				$this->template->title = "Upload";
				
				//Display the template
				echo $this->template;
				
			} // End of Else
	
	
	}//End of Function
	
	
	
	########### //Upload Process  ###########
	public function upload_process() {	
	
		//Check to make sure user is logged in.
		if(!$this->user) {
			Router::redirect('/users/login/');
		
			//If logged in Continue...	
			}else{	
		
				Upload::upload($_FILES, "/xml/", array("xml"),$FILES['name']);
				
				//Redirect to view posts with a success message.
				Router::redirect('/process/reports/');
				
			}//End of Else
		
	
	}//End of Function
	
	########### //Users  ###########
	public function users($users = NULL) {	
	
		//Check to make sure user is logged in.
		if(!$this->user) {
			Router::redirect('/users/login/');
		
			//If logged in Continue...	
			}else{	
		
				
				//Define view parameters			
				$this->template = View::instance('_v_index_dashboard_template');
		
				$this->template->content = View::instance('v_index_users');		
				
				// View within a view        
				$this->template->sidemenu = View::instance('v_index_reports_sidemenu');
			
				//Set Title
				$this->template->title = "Users";
				
				//Current User
				$current_user = $this->user->userid;
							
				
				//Query the DB for all the Users - and ignore current logged in user.
				$q = "select * from users WHERE NOT userid = $current_user";	
				$users = DB::instance(DB_NAME)->select_rows($q);
				
				//Send Array to View
				$this->template->content->users = $users;
		

				//Display the template
				echo $this->template;
				
			}//End of Else
		
	
	}//End of Function
		
	
	
} # End of class
