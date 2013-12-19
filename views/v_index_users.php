<?php if(isset($_GET['deauthorized'])): ?>
<div class="alert alert-danger fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong><i class="fa fa-exclamation-triangle"></i> Deauthorized!</strong>
</div>
<?php endif; ?>

<?php if(isset($_GET['authorized'])): ?>
<div class="alert alert-success fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong><i class="fa fa-exclamation-triangle"></i> Authorized!</strong>
</div>
<?php endif; ?>

<?php if(isset($_GET['delete-success'])): ?>
<div class="alert alert-success fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong><i class="fa fa-exclamation-triangle"></i> User has been deleted!</strong>
</div>
<?php endif; ?>

<?php if(isset($_GET['no-user'])): ?>
<div class="alert alert-warning fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong><i class="fa fa-exclamation-triangle"></i> That user does not exist!</strong>
</div>
<?php endif; ?>


<h1>Users</h1>




<ul class="list-group">

	<?php foreach ($users as $user): ?>
			
		
					<li class="list-group-item">
					
							<!-- Action -->
							<div class="btn-group">
							  <button class="btn btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown">
							    <i class="fa fa-cog"></i> Action <span class="caret"></span>
							  </button>
							  <ul class="dropdown-menu" role="menu">
									<?php if ($user['authorized'] == '0'): ?>
									
											<li><a href="/users/authorize/<?= $user['userid']; ?>"><i class="fa fa-unlock-alt"></i>  Authorize</a></li>
											
										<?php else: ?>
										
											<li><a href="/users/deauthorize/<?= $user['userid']; ?>"><i class="fa fa-lock"></i> De-Authorize</a></li>
											
									<?php endif; ?>		
									
										<li><a href="/users/delete/<?= $user['userid']; ?>"><i class="fa fa-times"></i>  Delete</a></li>		    
							  </ul>
							</div>			
									<?php if ($user['authorized'] == '0'): ?>
											
											<span class="critical"><strong><?= $user['first_name']; ?> <?=$user['last_name']; ?></strong></span>
											<span class="badge"><?= $user['employee_id']; ?></span>
																						
										<?php else: ?>
										
											<span class="low"><strong><?= $user['first_name']; ?> <?=$user['last_name']; ?></strong></span>
											<span class="badge"><?= $user['employee_id']; ?></span>
											
									<?php endif; ?>	
									
								
					</li>
	
	<?php endforeach; ?>

</ul>