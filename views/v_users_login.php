<!-- Start Notices -->
<?php if(isset($_GET['login-error'])): ?>
<div class="alert alert-danger fade in">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<strong><i class="fa fa-exclamation-triangle"></i> I am unable to log you in.</strong>  Please try again!
</div>
<?php endif; ?>

<?php if(isset($_GET['user-exists'])): ?>
<div class="alert alert-danger fade in">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<strong><i class="fa fa-exclamation-triangle"></i> That user already exists! </strong>  You can login using your existing account or <a class="alert-link" href="/users/signup/">sign up</a> as a new user.
</div>
<div class="alert alert-warning fade in">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<strong><i class="fa fa-exclamation-triangle"></i> Reset your Password! </strong>  If you forgot your password, you can <a class="alert-link" href="/password/reset/">reset</a> it.
</div>
<?php endif; ?>

<?php if(isset($_GET['user-created'])): ?>
<div class="alert alert-success fade in">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<strong><i class="fa fa-exclamation-triangle"></i> Your user has been created!</strong>  Login to continue. 
</div>

<div class="alert alert-warning fade in">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<strong><i class="fa fa-exclamation-triangle"></i> You are not an authorized User.</strong> This is an administrative application and your user will required approval!
</div>
<?php endif; ?>

<?php if(isset($_GET['password-updated'])): ?>
<div class="alert alert-success fade in">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<strong><i class="fa fa-exclamation-triangle"></i> Your Password has been updated!</strong>  Login to continue. 
</div>
<?php endif; ?>

<?php if(isset($_GET['not-authorized'])): ?>
<div class="alert alert-warning fade in">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<strong><i class="fa fa-exclamation-triangle"></i> You are not an authorized User.</strong> This is an administrative application and your user will required approval!
</div>
<?php endif; ?>
<!-- End Notices -->


<div class="jumbotron">
	<form class="form-signin" method="POST" action='/users/p_login'>
		<h2 class="form-signin-heading">Please Sign In</h2>
		
		<label><small>Your Email Address</small></label>
		<input type="text" name="email" class="form-control" placeholder="Email address" autofocus="">
		
		<label><small>Your Password</small></label>
		<input type="password" name="password" class="form-control" placeholder="Password">
			
		<label>Don't have an account? <a href="/users/signup/">Sign-up</a></label>
			
		<div class="row">
			<div class="col-md-6">
				<button class="btn btn-lg btn-primary btn-block" type="submit"><i class="icon-lock"></i> Sign In</button>
			</div>
			
			<div class="col-md-6">
				<a href="/password/reset/" class="btn btn-lg btn-default btn-block" type="submit"><i class="icon-refresh"></i> Reset Your Password</a>
			</div>
		
		</div>
	
		<?php print_r($files); ?>

	</form>
</div>
</form>