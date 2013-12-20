<ul class="nav navbar-nav side-nav">
	<li class="<?php if (strpos($_SERVER['REQUEST_URI'], '/index/reports/') !== FALSE){print "active";} ?>"><a href="/index/reports/"><i class="fa fa-table"></i> Reports</a></li>
	<li class="<?php if (strpos($_SERVER['REQUEST_URI'], '/index/statistics/') !== FALSE){print "active";} ?>"><a href="/index/statistics/"><i class="fa fa-bar-chart-o"></i> Statistics</a></li>
	<li class="<?php if (strpos($_SERVER['REQUEST_URI'], '/index/search/') !== FALSE){print "active";} ?>"><a href="/index/search/"><i class="fa fa-search"></i> Search</a></li>
	<li class="<?php if (strpos($_SERVER['REQUEST_URI'], '/index/upload/') !== FALSE){print "active";} ?>"><a href="/index/upload/"><i class="fa fa-cloud-upload"></i> Upload</a></li>
	<li class="<?php if (strpos($_SERVER['REQUEST_URI'], '/index/users/') !== FALSE){print "active";} ?>"><a href="/index/users/"><i class="fa fa-users"></i> Users</a></li>
	
	<!-- User Related -->         
	<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $user->first_name; ?> <?php echo $user->last_name; ?> <b class="caret"></b></a>
		<ul class="dropdown-menu">
			<li><a href="/users/profile/"><i class="fa fa-user"></i> Profile</a></li>
			<li><a href="/users/logout/"><i class="fa fa-power-off"></i> Log Out</a></li>
			<li class="divider"></li>
		</ul>
	</li>
</ul>