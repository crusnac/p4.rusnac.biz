<?php

class process_controller extends base_controller {
	

	########### //Process Reports in the XML directory & Create DB Entry ###########
	public function reports() {

		//Set path of unprocessed XML files.
		$xmldir = APP_PATH.'xml/';
		
		
		//Check to see if there are any .xml files in the XML directory, if not redirect 
		if (count(glob($xmldir."*.xml")) === 0 ) { // empty
		
			//Redirect to report index with error
			Router::redirect('/index/reports/?no-reports');
		}
		
			//If Directory exsits.
			if (is_dir($xmldir)) {
			
				//Open Directory Stream
			    if ($xml = opendir($xmldir)) {
			        
			        //Go through each file and process....
			        while (($file = readdir($xml)) !== false) {
			        		
			        	//Only show files with a .xml extension	    	
			        	if ($file != "." && $file != ".." && strtolower(substr($file, strrpos($file, '.') + 1)) == 'xml') {
			            	
			            	$filexml = simplexml_load_file($xmldir.$file);
			            	
			            	
			            	//Set arrays for each of the vulnerability criticalities.  This will be needed for the counts.
							$criticalVulns = array();
							$highVulns = array();
							$mediumVulns = array();
							$lowVulns = array();
							$informationalVulns = array();
			            				            	
			            	//Process Critical Vulns and put each record into an array				            				            
			            	foreach ($filexml->Issues->Issue as $severity) {
			            			if ($severity->Severity == 4) {
			            				$criticalVulns[] = $severity->Severity;
			            			}
			      			}
			      			
			      			//Process High Vulns and put each record into an array				            				            
			            	foreach ($filexml->Issues->Issue as $severity) {
			            			if ($severity->Severity == 3) {
			            				$highVulns[] = $severity->Severity;
			            			}
			      			}
			      			
			      			//Process Medium Vulns and put each record into an array				            				            
			            	foreach ($filexml->Issues->Issue as $severity) {
			            			if ($severity->Severity == 2) {
			            				$mediumVulns[] = $severity->Severity;
			            			}
			      			}
			      			
			      			//Process Low Vulns and put each record into an array				            				            
			            	foreach ($filexml->Issues->Issue as $severity) {
			            			if ($severity->Severity == 1) {
			            				$lowVulns[] = $severity->Severity;
			            			}
			      			}
			      			
			      			//Process Informational Vulns and put each record into an array				            				            
			            	foreach ($filexml->Issues->Issue as $severity) {
			            			if ($severity->Severity == 0) {
			            				$informationalVulns[] = $severity->Severity;
			            			}
			      			}
							
							
							// ##### Create variables that will be written to the DB. ##### //
							
								//Scan Request number
								$request_number = intval($filexml->Name);
								
								//Scanned URL - Filtered from the file to only display the URL portion of the string.
								preg_match_all('~(https?://([-\w\.]+)+(:\d+)?(/([\w/_\.]*(\?\S+)?)?)?)~', $filexml->Name, $scanned_url_filtered);
								$scanned_url = reset($scanned_url_filtered);
								$scanned_url = $scanned_url[0];
								
								//Date Created
								$created = Time::now();
								
								//Policy
								$policy = $filexml->PolicyName;
								
								//Scan Name
								$scan_name = $filexml->Name;
								
								//Scan Start Time
								$start_time = $filexml->StartTime;
								
								//Scan Duration
								$duration = $filexml->Duration;
								
								//File Modified Timestamp								
								$file_timestamp = filemtime($xmldir.$file);
								
								//Filesize in bytes								
								$filesize = filesize($xmldir.$file);
								
								//Clean up filename and convert filename to a Hash - example - 1b89.....6c2da206a4694-43473.xml
								$file = str_replace(' ','-', $file);
								
								//Create the hash of the file with -request_number.xml
								$hash = hash_file('sha256', $xmldir.$file);	
								$filename = $hash."-$file";

								
								//Vulnerability Counts
								$vulns_critical = count($criticalVulns);
								$vulns_high = count($highVulns);			            	
								$vulns_medium = count($mediumVulns);			            	
								$vulns_low =count($lowVulns);			            	
				            	$vulns_informational = count($informationalVulns);
							
														
								// Insert data into the database for each report.
								$data = Array(	'request_number' => $request_number, 
												'scanned_url' => $scanned_url, 
												'scan_name' => $scan_name, 
												'created' => $created, 
												'policy' => $policy, 
												'start_time' => $start_time,
												'duration' => $duration,
												'file_timestamp' => $file_timestamp,
												'filename' => $filename,
												'filesize' => $filesize,
												'vulns_critical' => $vulns_critical,
												'vulns_high' => $vulns_high,
												'vulns_medium' => $vulns_medium,
												'vulns_low' => $vulns_low,
												'vulns_informational' => $vulns_informational,
												);
					
								// Process files data and insert them into the DB. 
								$reportid = DB::instance(DB_NAME)->insert('reports', $data);
								
								//Move the file to the processed folder
								rename($xmldir.$file, $xmldir.'processed/'.$filename);		            	
			            	
								}
										        
							}
			        
			        //Close Directory Stream
			        closedir($xml);
			        
			        
		    }
		}
			
		//Redirect to the report list
		Router::redirect('/index/reports/?processed');

	}// End of Fuction
	
	
	########### //Delete Cache Files ###########
	public function cache() {
		
		echo "Cache Function";
	
	}
	
	
	########### //Archive Files ###########
	public function archive() {
		echo "Archive Function";
	
	}
	
	
	

	
	
} # End of class
