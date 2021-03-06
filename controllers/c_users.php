<?php
class users_controller extends base_controller {


	public function __construct() {
        parent::__construct();
    } 


	########### //Inital Signup Function ###########
	public function signup(){
		
		//Define view paramters
		$this->template->content = View::instance('v_users_signup');
		$this->template->title   = "Sign Up";
		
		//Display view
		echo $this->template;		
	}
	
	
	########### //Process Signup Function ###########
	public function p_signup(){
	
		//Sanitize _POST
		$_POST = DB::instance(DB_NAME)->sanitize($_POST);
		
		//Check to make sure all form values are filled in.
		foreach($_POST as $key => $value){ 
			if((!isSet($value)) || (!$value) || ($value = "")) { 
				   	Router::redirect('/users/signup/?partial-registration');
                 } 
             } 		
		
		//Check to make sure the password match
		if(isset($_POST['password'], $_POST['password_check'])) {
			if($_POST['password'] != $_POST['password_check']){
				
				Router::redirect('/users/signup/?password-match');
			}
		}
		
		//Do some error checking gainst the email to make sure it's a valid email construct.
		$email = $_POST['email'];
		
		if($email == '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
			Router::redirect('/users/signup/?email-error');
		}
		
		//Query the DB for a email / password and set it as a variable.
		$q = "SELECT * FROM users WHERE email = '".$_POST['email']."'"; 
	
		//Execute query against DB
		$exsitingUsers = DB::instance(DB_NAME)->select_rows($q);
		
		//Check to determine if the user exsits.
		if(!empty($exsitingUsers)){
		
			//Redirect to the login page
			Router::redirect('/users/login/?user-exists');
		
				//If is doesn't exsit, continue with processing signup.
				}else{
				
					//Add XSS and html tag filtering
					$firstname = $_POST['first_name'];
					$firstname = strip_tags(htmlentities(stripslashes(nl2br($firstname)),ENT_NOQUOTES,"Utf-8"));
					
					//Add XSS and html tag filtering
					$lastname = $_POST['last_name'];
					$lastname = strip_tags(htmlentities(stripslashes(nl2br($lastname)),ENT_NOQUOTES,"Utf-8"));

					//Add XSS and html tag filtering
					$employeeid = $_POST['employee_id'];
					$employeeid = strip_tags(htmlentities(stripslashes(nl2br($employeeid)),ENT_NOQUOTES,"Utf-8"));


					// Specify created and modified time that will be posted to the DB.
					$email = $_POST['email'];
					$created  = Time::now();
					$modified  = Time::now();
					
					//Create an encrypted token via their email address and a random string
					$token = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string()); 
					
					//Create a hashed password
					$password = sha1(PASSWORD_SALT.$_POST['password']);
					
					$data = Array('first_name' => $firstname, 'last_name' => $lastname, 'employee_id' => $employeeid, 'email' => $email, 'password' => $password, 'token' => $token, 'created' => $created, 'modified' => $modified);
					
					// Process from _POST parameters and insert them into the DB. 
					$user_id = DB::instance(DB_NAME)->insert('users', $data);
					
										
					//Redirect to user login page after user has been created in the DB
					Router::redirect('/users/login/?user-created');
		
			}// End if 
		
	}//End of function
	
	
	########### //Login function ###########
	public function login(){
			
		//Check to see if the user is logged in, if they are, redirect them to the profile page
		if($this->user) {
			Router::redirect('/users/profile');
			
			//If not logged in, display the login box
			}else{
			
				//Define view parameters
				$this->template->content = View::instance('v_users_login');
				$this->template->title   = "Login";
						
			
			//Display view
			echo $this->template;		
			
			}//End else
		
	}// End function
	
	
	########### //Process login function ###########
	public function p_login(){
	
		//Sanitize _POST
		$_POST = DB::instance(DB_NAME)->sanitize($_POST);
		
		//Set HASH from the form _POST
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
		
		//Query the DB for a email / password and set it as a variable.
		$q =    "SELECT token 
        		FROM users 
				WHERE email = '".$_POST['email']."' 
				AND password = '".$_POST['password']."'"; 
			
		$token = DB::instance(DB_NAME)->select_field($q);   

		if($token == "") {
			// Redirect to allow user to enter in new credentials and specify an error.
			Router::redirect("/users/login/?login-error"); 
        
        	// Successfull Login  
    		} else {
    		
    			//Check to Make sure the user is authorized to login
    			$q =    "SELECT authorized 
        				FROM users 
						WHERE email = '".$_POST['email']."' 
						AND password = '".$_POST['password']."'"; 
						
				
				$authorized = DB::instance(DB_NAME)->select_field($q);
				
				if($authorized == "0"){
					Router::redirect("/users/login/?not-authorized"); 
				}
    			
    		
		        /* 
		        Store this token in a cookie using setcookie()
		        Important Note: *Nothing* else can echo to the page before setcookie is called
		        Not even one single white space.
		        param 1 = name of the cookie
		        param 2 = the value of the cookie
		        param 3 = when to expire
		        param 4 = the path of the cooke (a single forward slash sets it for the entire domain)
		        */
	        	setcookie("token", $token, strtotime('+1 year'), '/');

				// Redirect them to the main page - this should be the main login page.
				Router::redirect("/users/profile?login-success"); 
		
			} // End of else	
		
		} //End of function
		
		
	
		########### //Profile function ###########
		public function profile($user = NULL){
				
			//Check to see if a user is logged in, if not - redirect to login page.
			if(!$this->user) {
				Router::redirect('/users/login');
				
				}else{
		
				//Define view parameters
				//Set Main Template Variables.
				$this->template = View::instance('_v_index_dashboard_template');
				
				# View within a view        
				$this->template->sidemenu = View::instance('v_index_reports_sidemenu');
				
				$this->template->content = View::instance('v_users_profile');
				$this->template->title = $this->user->first_name .' ' . $this->user->last_name. " | Profile";
				
				$user_id = $this->user->userid;
												
				//Query the DB for a email / password and set it as a variable.
				$q = "SELECT * FROM users WHERE userid = $user_id"; 
	
				//Execute query against DB
				$user = DB::instance(DB_NAME)->select_rows($q);
				
				$this->template->content->user = $user;

				//Display template
				echo $this->template;
				
				} // End of else
			
		}//End of function
		


		########### //Update Profile function ###########
		public function p_profile(){
		
			//Sanitize _POST
			$_POST = DB::instance(DB_NAME)->sanitize($_POST);
			
			//Check to make sure all form values are filled in.
			foreach($_POST as $key => $value){ 
				if((!isSet($value)) || (!$value) || ($value = "")) { 
					Router::redirect('/users/profile/?partial-form');
					
					} 
			}//End for Each
			 									
				$currentUser = $this->user->userid;
	
				$q = "SELECT email FROM users WHERE userid = $currentUser";
				
				$_POST['email'] = DB::instance(DB_NAME)->select_field($q);
				
				
				//Add XSS and html tag filtering
				$firstname = $_POST['first_name'];
				$firstname = strip_tags(htmlentities(stripslashes(nl2br($firstname)),ENT_NOQUOTES,"Utf-8"));
				
				//Add XSS and html tag filtering
				$lastname = $_POST['last_name'];
				$lastname = strip_tags(htmlentities(stripslashes(nl2br($lastname)),ENT_NOQUOTES,"Utf-8"));
				
				//Add XSS and html tag filtering
				$employeeid = $_POST['employee_id'];
				$employeeid = strip_tags(htmlentities(stripslashes(nl2br($employeeid)),ENT_NOQUOTES,"Utf-8"));
									
				// Specify created and modified time that will be posted to the DB.
				$_POST['modified'] = Time::now();
				
				$data = Array('first_name' => $firstname, 'last_name' => $lastname, 'employee_id' => $employeeid, 'modified' => $modified);
	
				// Process from _POST parameters and updated them into the DB. 
				$userid = DB::instance(DB_NAME)->update('users', $data, "WHERE userid = $currentUser");
								
			//Redirect to user login page after user has been created in the DB
			Router::redirect('/users/profile/?profile-updated');
	
			
		}// End of function
		
		
		########### //Update Profile Password function ###########
		public function p_profile_password(){
			
			//Sanitize _POST
			$_POST = DB::instance(DB_NAME)->sanitize($_POST);
			
			//Check to make sure the password is not empty
			if((empty($_POST['password']))) { 
				Router::redirect('/users/profile/?empty-password');
				} 

			
			//Check to make sure the password match
			if(isset($_POST['password'], $_POST['password_check'])) {
				if($_POST['password'] != $_POST['password_check']){
					
					Router::redirect('/users/profile/?password-match');
				}
			}
			
			$currentUser = $this->user->userid;
			$newpassword = sha1(PASSWORD_SALT.$_POST['password']);
			$data = Array('password' => $newpassword);

			DB::instance(DB_NAME)->update("users", $data, "WHERE userid = $currentUser");
			
			Router::redirect('/users/profile/?password-updated');
			
			
		}// End of Function		
		
		
		########### //Logout function ###########
		public function logout(){
			
			// Generate a new token for the next login
			$new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());
			
			//Specify what we are updating = the token
			$data = Array("token" => $new_token);
			
			//Update the with then new token
			DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");
			
			//Delete exsiting cookie by setting a negative year
			setcookie("token", "", strtotime('-1 year'), '/');
			
			//Redirect to index
			Router::redirect("/");
			
		}//End of function
		
		
		########### //Authorize User  ###########
		public function authorize($userid =  NULL) {	
	
		//Check to make sure user is logged in.
		if(!$this->user) {
			Router::redirect('/users/login/');
		
			//If logged in Continue...	
			}else{	
			
				//Update user record to 1 = authorized
				$data = Array("authorized" => 1);
				
				//Update the with then new token
				DB::instance(DB_NAME)->update("users", $data, "WHERE userid = $userid");
				
				//Redirect with Message Once complete
				Router::redirect('/index/users/?authorized');
			
			}//End of Else
	
		}//End of Function
		
		
		########### //Deauthorize User  ###########
		public function deauthorize($userid = NULL){
		
		
			//Check to make sure user is logged in.
			if(!$this->user) {
				Router::redirect('/users/login/');
		
				//If logged in Continue...	
				}else{	
				
					//Update user record to 0 = deauthorized
					$data = Array("authorized" => 0);
						
					//Update the with then new token
					DB::instance(DB_NAME)->update("users", $data, "WHERE userid = $userid");
										
					//Redirect with Message Once complete
					Router::redirect('/index/users/?deauthorized');
				
				}//End of Else
		
			
		
		}//End of function


	########### //Deauthorize User  ###########
		public function delete($userid = NULL){
		
		
			//Check to make sure user is logged in.
			if(!$this->user) {
				Router::redirect('/users/login/');
		
				//If logged in Continue...	
				}else{	
				
		
					//Query to determine if the user exists
					$q = "select * from users where userid = $userid";	
					$user = DB::instance(DB_NAME)->select_rows($q);
					
					if(!empty($user)){
									
						//Delete the post.
						DB::instance(DB_NAME)->delete('users', "WHERE userid = '$userid'");
				
						//Redirect to view posts with a success message.
						Router::redirect('/index/users/?delete-success');
						
							//The query will be empty if the user did not create the post.		
							}else{
			
								//Redirect to view posts stream with an error
								Router::redirect('/index/users/?no-user');
			
							}//end of else		

														
				}//End of Else
		
			
		
		}//End of function
		

		

	
	
} # end of class
