<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?=APP_NAME?> | <?php if(isset($title)) echo $title; ?></title>

	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://bootswatch.com/yeti/bootstrap.min.css">

    <!-- Add custom CSS here -->
    <link href="/css/dashboard.css" rel="stylesheet">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    
        <!-- JavaScript -->
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
	<script src="/js/dashboard.js"></script>

  </head>

  <body>


      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <a class="navbar-brand" href="/"><i class="fa fa-cogs"></i> <?=APP_NAME?></title>
</a>
        </div>
        
      </nav>

      <div id="page-wrapper">

        <div class="row">
          <div class="col-lg-12">      
                
            
            <?php if(isset($content)) echo $content; ?>
			<?php if(isset($client_files_body)) echo $client_files_body; ?>            
            
            
          </div>
        </div><!-- /.row -->

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

  </body>
</html>