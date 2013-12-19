<?php

class base_controller {
	
	public $user;
	public $userObj;
	public $template;
	public $email_template;
	public $unprocessed_reports;
	
	/*-------------------------------------------------------------------------------------------------

	-------------------------------------------------------------------------------------------------*/
	public function __construct() {
						
		# Instantiate User obj
			$this->userObj = new User();
			
		# Authenticate / load user
			$this->user = $this->userObj->authenticate();					
						
		# Set up templates
			$this->template 	  = View::instance('_v_template');
			$this->email_template = View::instance('_v_email');			
								
		# So we can use $user in views			
			$this->template->set_global('user', $this->user);
			
		# Determine if there is unprocessed XML files in the XML directory and specify the count to be processed in the view.
			
			//Set Variables.
			$reportdir = APP_PATH.'xml/';
			
			//Look for only .xml files.
			$files = glob($reportdir.'*.xml');
			//Count!
			$unprocessed_reports = count($files);
			
			//Set the variable to the template to be used for processing.
			$this->template->set_global('unprocessed_reports', $unprocessed_reports);
						
	}
	
} # eoc
