<?php

class report_controller extends base_controller {
	

	########### //Process the XML and Send to View ###########
	public function view($report = NULL) {

		//Define location of the process file directory.
		$reportdir = APP_PATH.'xml/processed/';
		
		//Check to see if the files exists.
		if (file_exists($reportdir.$report)) {
			
			//Get Request Number and make available to view title.
			$q = "select * from reports where filename = '$report'";	
			$report_stats = DB::instance(DB_NAME)->select_rows($q);	
			$request_number = $report_stats[0]['request_number'];
			
			//Define view parameters
			$this->template = View::instance('_v_report_template');
			
			$this->template->content = View::instance('v_report_view');
			$this->template->title  = "View Web Application Assessment Report | $request_number";
			
			//Define the main report that is passed via _GET parameter
			$report = simplexml_load_file($reportdir.$report);
						
			
			//Create Array to display vulnerability and severy in array to be sent to view
			foreach($report->Issues->Issue as $vuln){
				$vulns[] = array('Name' => (string)$vuln->Name, 'Severity' => (string)$vuln->Severity);
			}
											
			//Send Entire XML array to the view to process -- Only show unique vulnerability list
			$this->template->content->unique_vulns = array_unique($vulns, SORT_REGULAR);
			
			//Send Entire XML array to the view to process
			$this->template->content->report = $report;
			
			//Send Query data to view to process
			$this->template->stats = $report_stats;
			$this->template->content->stats = $report_stats;
			
			//Display the template
			echo $this->template;

			
			} else {
			
				//Redirect with an error message
				echo "The file does not exist";
				
		}//End of If
		
					

	}// End of Fuction
	
	
	########### //Process the XML report saves ###########
	public function csv($report = NULL) {
		
	$reportdir = APP_PATH.'xml/processed/';
	$csvdir = APP_PATH.'csv/';
		
		if (file_exists($reportdir.$report)) {
			
			$xml = simplexml_load_file($reportdir.$report);
						
			$csv_file = fopen($csvdir.$report.'.csv', 'w');
			
			//Create new array of values of the fields that need to be included in the CSV
			$filtered_issue = array();
				
				//Process new ARRAY		
				foreach($xml->Issues->Issue as $issue){
					if ($issue->Severity >= 1) {
							array_push($filtered_issue, array(
								"Severity" => (string)$issue->Severity,
					            "Name" => (string)$issue->Name,
					            "URL" => (string)$issue->URL,
					            "Summary" => filter_var($issue->ReportSection->SectionText, FILTER_SANITIZE_STRING),
					            "Fix" => filter_var($issue->ReportSection[3]->SectionText, FILTER_SANITIZE_STRING)
					            
					        ));    
				        } 
			    }
		    
			//Add Headers to the CSV File
			fputcsv($csv_file, array_keys($filtered_issue[0]));
			
			//Add Each array Value as a new Row to the CSV File
			foreach ($filtered_issue as $issue) {
				fputcsv($csv_file, array_values($issue));
				}
				
			fclose($csv_file);
			
			//Redirect to Download URL
			Router::redirect('/download/csv/'.$report);
			
		}
	
	} // End of Function
	

	public function noninteractive($report = NULL) {
	
		//Define location of the process file directory.
		$reportdir = APP_PATH.'xml/processed/';	
		
		//Check to see if the files exists.
		if (file_exists($reportdir.$report)) {
			
			//Get Request Number and make available to view title.
			$q = "select * from reports where filename = '$report'";	
			$report_stats = DB::instance(DB_NAME)->select_rows($q);	
			$request_number = $report_stats[0]['request_number'];
			
			//Define view parameters
			$this->template = View::instance('_v_report_noninteractive_template');
			
			$this->template->content = View::instance('v_report_noninteractive');
			$this->template->title  = "View Web Application Assessment Report | $request_number";
			
			//Define the main report that is passed via _GET parameter
			$report = simplexml_load_file($reportdir.$report);
			
			//Create Array to display vulnerability and severy in array to be sent to view
			foreach($report->Issues->Issue as $vuln){
				$vulns[] = array('Name' => (string)$vuln->Name, 'Severity' => (string)$vuln->Severity);
			}
											
			//Send Entire XML array to the view to process -- Only show unique vulnerability list
			$this->template->content->unique_vulns = array_unique($vulns, SORT_REGULAR);
			
			//Send Entire XML array to the view to process
			$this->template->content->report = $report;
			
			//Send Query data to view to process
			$this->template->stats = $report_stats;
			
			//Send Query data to view to process
			$this->template->content->stats = $report_stats;
			
			//Display the template
			echo $this->template;

			
			} else {
			
				//Redirect with an error message
				echo "The file does not exist";
				
		}//End of if

	
	}//End of Function
	
	
	
	########### //Process the XML report And Pass to mPDF ###########
	public function pdf($report = NULL) {
	
		//Define location of the process file directory.
		$reportdir = APP_PATH.'xml/processed/';		
		
		
		if (file_exists($reportdir.$report)) {
		
		
			//Get Request Number and make available to view title.
			$q = "select * from reports where filename = '$report'";	
			$report_stats = DB::instance(DB_NAME)->select_rows($q);	
			$request_number = $report_stats[0]['request_number'];
		
			//Define view parameters
			$this->template = View::instance('_v_report_pdf_template');
			$this->template->content = View::instance('v_report_pdf');
			$this->template->title  = "View Web Application Assessment Report | $request_number";

			//Send XML array to the view to process
			$report = simplexml_load_file($reportdir.$report);
			$this->template->content->report = $report;
			
			//Send Query data to view to process
			$this->template->stats = $report_stats;
			$this->template->content->stats = $report_stats;
			
			
			//Display the template
			echo $this->template;
					
			}else{
			
				echo "The file does not exist";
				
		}// End of If
			
	}// End of Function
	
	########### //Delete Report ###########
	public function delete($report = NULL) {
	
		//Check to make sure user is logged in.
		if(!$this->user) {
			Router::redirect('/users/login/');
		
				//If logged in Continue...	
				}else{	
				
					//Check to make sure report exsits.
					$q = "select * from reports where reportid = $report";	
					$report_check = DB::instance(DB_NAME)->select_rows($q);
					
					if(!empty($report_check)){
					
							//Set Vars
							$reportdir = APP_PATH.'xml/processed/';	
							$htmlreportdir = APP_PATH.'html/';
							$csvreportdir = APP_PATH.'csv/';

							$report_file = $report_check[0]['filename'];
						
							//Delete report from disk
							unlink($reportdir.$report_file);
							unlink($htmlreportdir.$report_file.".html");
							unlink($csvreportdir.$report_file.".csv");

							
							//Delete the report from DB.
							DB::instance(DB_NAME)->delete('reports', "WHERE reportid = '$report'");
							
							//Redirect with success message
							Router::redirect('/index/reports/?report-deleted');
							
					
						}else{
								
							//Redirect with success message
							Router::redirect('/index/reports/?no-report');
							
						}//End of Else
			
			
			}//End of Else
		
	}//End of Function
	
	
	
	
} # End of class
