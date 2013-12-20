<h1>Statistics</h1>

<script type="text/javascript" src="https://www.google.com/jsapi"></script>

<script type="text/javascript">
	google.load("visualization", "1", {packages:["corechart"]});
	google.setOnLoadCallback(drawChart);
	function drawChart() {
	  var data = google.visualization.arrayToDataTable([
	    ['Month', 'Reports'],
	    ['<?php echo date("m-Y", strtotime("this month")); ?>',  <?php echo $current_month; ?>],
	    ['<?php echo date("m-Y", strtotime('-1 months')); ?>',  <?php echo $minus_1_month; ?>],
	    ['<?php echo date("m-Y", strtotime('-2 months')); ?>',  <?php echo $minus_2_month; ?>],
	    ['<?php echo date("m-Y", strtotime('-3 months')); ?>',  <?php echo $minus_3_month; ?>],
	    ['<?php echo date("m-Y", strtotime('-4 months')); ?>',  <?php echo $minus_4_month; ?>],
	    ['<?php echo date("m-Y", strtotime('-5 months')); ?>',  <?php echo $minus_5_month; ?>],
	    ['<?php echo date("m-Y", strtotime('-6 months')); ?>',  <?php echo $minus_6_month; ?>]
	
	  ]);
	
	  var options = {
	  
	  	colors: ['#008cba'],
	  };
	
	  var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
	  chart.draw(data, options);
	}
</script>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Generated Reports by Month</h3>
	</div>
	
	<div class="panel-body">
		<div id="chart_div" style="width: 100%; height: 500px;"></div>
	</div>
</div>