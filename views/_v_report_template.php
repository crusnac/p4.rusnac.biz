<?php ob_start(); ?>
<!DOCTYPE html>
<html>
	<head>
		<title><?php if(isset($title)) echo $title; ?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css">
		<link rel="stylesheet" href="http://bootswatch.com/yeti/bootstrap.min.css">
		<link rel="stylesheet" href="/css/report.css">
		<style>
			.empty {
			border: 1px #ccc;
			background-color: none;
			}
			.strong {
			font-weight: 700;
			}
			.critical-badge {
			background-color: #b20000;
			color: #fff;
			}
			.critical{
			color: #b20000;
			font-weight: 700;
			}
			.high {
			color: #d9534f;
			font-weight: 700;
			}
			.high-badge {
			background-color: #d9534f;
			color: #fff;
			}
			.medium {
			color: #ed9c28;
			font-weight: 700;
			}
			.medium-badge {
			background-color: #ed9c28;
			color: #fff;
			}
			.low {
			color: #428BCA;
			font-weight: 700;
			}
			.low-badge {
			background-color: #428BCA;
			color: #fff;
			}
			pre {font-size: 80%;}
			.nav-tabs li.active {font-weight: 700;}
			.tab-pane {padding: 15px; padding-bottom: 30px; 
			border-left: 1px solid #dddddd; border-right: 1px solid #dddddd; border-bottom: 1px solid #dddddd; margin-bottom: 10px;
			}
			/* Sticky footer styles -------------------------------------------------- */
			html,
			body {
			height: 100%;
			/* The html and body elements cannot have any padding or margin. */
			}
			/* Wrapper for page content to push down footer */
			#wrap {
			min-height: 100%;
			height: auto;
			/* Negative indent footer by its height */
			margin: 0 auto -60px;
			/* Pad bottom by footer height */
			padding: 0 0 60px;
			}
			/* Set the fixed height of the footer here */
			#footer {
			height: 60px;
			background-color: #f5f5f5;
			}
			/* Custom page CSS
			-------------------------------------------------- */
			/* Not required for template or sticky footer method. */
			#wrap > .container {
			padding: 60px 15px 0;
			}
			.container .text-muted {
			margin: 20px 0;
			}
			#footer > .container {
			padding-left: 15px;
			padding-right: 15px;
			}
			code {
			font-size: 80%;
			}
		</style>
		
		<!-- Font Awesome CSS -->
		<link href="http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
		
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		
		<!-- Google Charts -->
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		
		<!-- Latest compiled and minified JavaScript -->
		<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
		
		<!-- Controller Specific JS/CSS -->
		<?php if(isset($client_files_head)) echo $client_files_head; ?>
		
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->	
	</head>
	<body>
		
		<!-- Wrap All Content Here -->
		<div id="wrap">
			<?php if(isset($content)) echo $content; ?>
			<?php if(isset($client_files_body)) echo $client_files_body; ?>
		</div>
	</body>
</html>
<?php
	// Get the content that is in the buffer and put it in your file //
	file_put_contents(APP_PATH.'html/'.$stats[0]['filename'].'.html', ob_get_contents());
?>