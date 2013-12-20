<?php
	ini_set('max_execution_time', 9000); //300 seconds = 5 minutes 
	ini_set('memory_limit', '256M'); // Large XML files need the extra memory
	?>
<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</button>
		</div>
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="/download/html/<?php echo $stats[0]['filename'];?>"><i class="fa fa-cloud-download"></i> Download</a></li>
				<li><a target="_blank" href="/report/noninteractive/<?php echo $stats[0]['filename'];?>"><i class="fa fa-print"></i> Print</a></li>
				<li><a target="_blank" href="/report/pdf/<?php echo $stats[0]['filename'];?>"><i class="fa fa-file"></i> PDF</a></li>
				<li><a href="/report/csv/<?php echo $stats[0]['filename'];?>"><i class="fa fa-table"></i> CSV</a></li>
			</ul>
		</div>
		<!--/.nav-collapse -->
	</div>
</div>
<!-- Begin page content -->
<div class="container">
	<div class="page-header">
		<h1>Web Application Assessment Report <span class="label label-default pull-right">#<?php echo $stats[0]['request_number'];?></span></h1>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead>
					<th>Scanned URL</th>
					<th>Start Time</th>
					<th>Duration</th>
				</thead>
				<tr>
					<td><?php echo $stats[0]['scanned_url'];?></td>
					<td><?php echo $stats[0]['start_time'];?></td>
					<td><?php echo $stats[0]['duration'];?></td>
				</tr>
			</table>
		</div>
	</div>
	<div class="row">
		<!-- Display Executive Summary Chart - Google Charts -->
		<div class="col-md-6">
			<div class="panel-group" id="panel-chart">
				<div class="panel panel-default">
					<div class="panel-heading">
						<a class="panel-title" data-toggle="collapse" data-parent="#chart" href="#panel-element-chart"><i class="fa fa-sort"></i> Vulnerability Executive Summary</a>
					</div>
					<div id="panel-element-chart" class="panel-collapse in">
						<div class="panel-body">
							<script type="text/javascript">
								google.load("visualization", "1", {packages:["corechart"]});
								google.setOnLoadCallback(drawChart);
								function drawChart() {
								  var data = google.visualization.arrayToDataTable([
								  
								  
								    ['Severity', 'Count'],
								    ['Critical',  <?php echo $stats[0]['vulns_critical']; ?>  ],
								    ['High',  <?php echo $stats[0]['vulns_high']; ?>],
								    ['Medium',  <?php echo $stats[0]['vulns_medium']; ?>],
								    ['Low',  <?php echo $stats[0]['vulns_low']; ?>]
								  ]);
								
								  var options = {
								              colors: ['#b20000', '#d9534f', '#ed9c28', '#428BCA'],
								              'is3D':false,
								              'legend':'bottom'
								
								    };
								
								  var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
								  chart.draw(data, options);
								}
							</script>
							<div id="chart_div" style="width: 100%; height: 500px;"> </div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Display Unique Vulns as Executive Summary -->
		<div class="col-md-6">
			<div class="panel-group" id="panel-vuln-summary">
				<div class="panel panel-default">
					<div class="panel-heading">
						<a class="panel-title" data-toggle="collapse" data-parent="#panel-panel-vuln-summary" href="#panel-panel-vuln-summary"><i class="fa fa-sort"></i> Identified Vulnerability Summary</a>
					</div>
					<div id="panel-panel-vuln-summary" class="panel-collapse in">
						<div class="panel-body">
							<table class="table">
								<!-- Critical Vulns -->
								<?php foreach ($unique_vulns as $vulns): ?>
									<?php if ($vulns['Severity'] == 4): ?>
									<tr>
										<td><span class="critical"><?php print $vulns['Name'] ?></span></td>
										<td><span class="badge strong critical-badge"><i class="fa fa-exclamation-triangle"></i> Critical</span></td>
									</tr>
									<?php endif; ?>
								<? endforeach; ?>
								
								<!-- High Vulns -->
								<?php foreach ($unique_vulns as $vulns): ?>
									<?php if ($vulns['Severity'] == 3): ?>
									<tr>
										<td><span class="high"><?php print $vulns['Name'] ?></span></td>
										<td><span class="badge strong high-badge"> High </span></td>
									</tr>
									<?php endif; ?>
								<? endforeach; ?>
								
								<!-- Medium Vulns -->
								<?php foreach ($unique_vulns as $vulns): ?>
									<?php if ($vulns['Severity'] == 2): ?>
									<tr>
										<td><span class="medium"><?php print $vulns['Name'] ?></span></td>
										<td><span class="badge strong medium-badge"> Medium </span></td>
									</tr>
									<?php endif; ?>
								<? endforeach; ?>
								
								<!-- Low Vulns -->
								<?php foreach ($unique_vulns as $vulns): ?>
									<?php if ($vulns['Severity'] == 1): ?>
									<tr>
										<td><span class="low"><?php print $vulns['Name'] ?></span></td>
										<td><span class="badge strong low-badge"> Low </span></td>
									</tr>
									<?php endif; ?>
								<? endforeach; ?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">&nbsp;</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<?php
				$total_actionable_vulns = $citicalVulns = $stats[0]['vulns_critical'] + $highVulns = $stats[0]['vulns_high'] + $mediumVulns = $stats[0]['vulns_medium'];
				?>
			<!-- Table of Contents -->
			<div class="panel-group" id="panel-toc">
				<div class="panel panel-default">
					<div class="panel-heading">
						<a class="panel-title" data-toggle="collapse" data-parent="#panel-panel-toc" href="#panel-panel-toc"> <i class="fa fa-sort"></i> Actionable Vulnerability Table of Contents</a>
						<div class="pull-right"> <span class="label label-primary strong">Actionable Vulnerability Instances:  <?php echo $total_actionable_vulns; ?></span></div>
					</div>
					<div id="panel-panel-toc" class="panel-collapse in">
						<div class="panel-body">
							<table class="table">
								<thead>
									<th>Vulnerability</th>
									<th>Severity</th>
								</thead>
								<?php //Setup a counter to be use in the anchor tags.
									$counter = 0; 
									?>
								<!-- Process Each Vulnerability and Display Only "Actionalble" Medium or High in the Content -->								
								
								<!-- Process Critical Vulns -->
								<?php foreach ($report->Issues->Issue as $issue): ?>
									<?php $counter ++; ?>
									<?php if ($issue->Severity == 4): ?>	
										<tr>
											<td><a href="#<?php echo $counter; ?>"><span class="critical"><?php print $issue->Name; ?> [<?php print $issue->VulnerabilityID; ?>]</span></a></td>
											<td><span class="badge strong critical-badge"><i class="fa fa-exclamation-triangle"></i> Critical</span></td>
										</tr>
									<?php endif; ?>
								<? endforeach; ?>
								
								<!-- Process High Vulns -->
								<?php foreach ($report->Issues->Issue as $issue): ?>
								<?php $counter ++; ?>
									<?php if ($issue->Severity == 3): ?>	
										<tr>
											<td><a href="#<?php echo $counter; ?>"><span class="high"><?php print $issue->Name; ?> [<?php print $issue->VulnerabilityID; ?>]</span></a></td>
											<td><span class="badge strong high-badge"> High </span></td>
										</tr>
									<?php endif; ?>
								<? endforeach; ?>
								
								<!-- Process Medium Vulns -->
								<?php foreach ($report->Issues->Issue as $issue): ?>
								<?php $counter ++; ?>
									<?php if ($issue->Severity == 2): ?>	
										<tr>
											<td><a href="#<?php echo $counter; ?>"><span class="medium"><?php print $issue->Name; ?> [<?php print $issue->VulnerabilityID; ?>] </span> </a></td>
											<td><span class="badge strong medium-badge"> Medium </span></td>
										</tr>
									<?php endif; ?>
								<? endforeach; ?>
								
								<!-- Display Success Message if no actionable vulns are visible -->
								<?php if ($total_actionable_vulns == 0): ?>
								<tr>
									<td colspan="2">
										<div class="alert alert-success">
											<strong>
												<center>Congratulations! You don't have any actionable vulnerabilities!</center>
											</strong>
										</div>
									</td>
								</tr>
								<?php endif; ?>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<?php 
		//Setup a counter to be use in the anchor tags.
		$counter2 = 0; 
		?>
	<!-- Process Each Vulnerability and Display Only "Actionalble" Medium or High in the Content -->
	
	<!-- Critical Vulns -->
	<?php foreach ($report->Issues->Issue as $issue): ?>
	<?php $counter2 ++; ?>
		<?php if ($issue->Severity == 4): ?>
			<a id="<?php print $counter2; ?>"></a>
			<h3 class="critical"><span class="badge strong critical-badge"> <i class="fa fa-exclamation-triangle"></i> Critical </span> <?php print $issue->Name; ?></h3>
			<!-- Nav tabs -->
			<ul class="nav nav-tabs">
				<li class="active"><a href="#vulnerability-summary<?php print $counter2; ?>" data-toggle="tab"><i class="fa fa-bug"></i> Vulnerability Summary</a></li>
				<li><a href="#vulnerability-implication<?php print $counter2; ?>" data-toggle="tab"><i class="fa fa-cog"></i> Vulnerability Implication</a></li>
				<li><a href="#vulnerability-fix<?php print $counter2; ?>" data-toggle="tab"><i class="fa fa-lightbulb-o"></i> Vulnerability Fix</a></li>
				<li><a href="#reference-information<?php print $counter2; ?>" data-toggle="tab"><i class="fa fa-info"></i> Reference Info.</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-code"></i> Vulnerability Details <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li class=""><a href="#vulnerability-url<?php print $counter2; ?>" data-toggle="tab"><i class="fa fa-code"></i> Vulnerable URL</a></li>
						<li class=""><a href="#vulnerability-session<?php print $counter2; ?>" data-toggle="tab"><i class="fa fa-code"></i> Vulnerable Session</a></li>
						<li class=""><a href="#raw-response<?php print $counter2; ?>" data-toggle="tab"><i class="fa fa-code"></i> Raw Response</a></li>
					</ul>
				</li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
				<!-- Vuln Summary -->
				<div class="tab-pane fade in active" id="vulnerability-summary<?php print $counter2; ?>">
					<?php print $issue->ReportSection->SectionText; ?>
				</div>
				<!-- Vuln Implication -->
				<div class="tab-pane" id="vulnerability-implication<?php print $counter2; ?>">
					<?php print $issue->ReportSection[2]->SectionText; ?>
				</div>
				<!-- Vuln Fix -->
				<div class="tab-pane" id="vulnerability-fix<?php print $counter2; ?>">
					<?php print $issue->ReportSection[3]->SectionText; ?>
				</div>
				<!-- Vuln Ref Info -->
				<div class="tab-pane" id="reference-information<?php print $counter2; ?>">
					<?php print $issue->ReportSection[4]->SectionText; ?>
				</div>
				<!-- Vuln URL -->
				<div class="tab-pane" id="vulnerability-url<?php print $counter2; ?>">
					<pre><?php print htmlspecialchars($issue->URL); ?></pre>
				</div>
				<!-- Vuln Session -->
				<div class="tab-pane" id="vulnerability-session<?php print $counter2; ?>">
					<pre class="pre-scrollable" style="white-space:pre-line;"><?php print htmlspecialchars($issue->VulnerableSession); ?></pre>
				</div>
				<!-- Vuln Raw Response -->
				<div class="tab-pane" id="raw-response<?php print $counter2; ?>">
					<pre class="pre-scrollable" style="white-space:pre-line;"><?php print htmlspecialchars($issue->RawResponse); ?></pre>
				</div>
			</div>
			<!-- End Tab panes -->
		<?php endif; ?>
	<? endforeach; ?>
	
	<!-- High Vulns -->
	<?php foreach ($report->Issues->Issue as $issue): ?>
	<?php $counter2 ++; ?>
		<?php if ($issue->Severity == 3): ?>
			<a id="<?php print $counter2; ?>"></a>
			<h3 class="high"><span class="badge strong high-badge"> High </span> <?php print $issue->Name; ?></h3>
			<!-- Nav tabs -->
			<ul class="nav nav-tabs">
				<li class="active"><a href="#vulnerability-summary<?php print $counter2; ?>" data-toggle="tab"><i class="fa fa-bug"></i> Vulnerability Summary</a></li>
				<li><a href="#vulnerability-implication<?php print $counter2; ?>" data-toggle="tab"><i class="fa fa-cog"></i> Vulnerability Implication</a></li>
				<li><a href="#vulnerability-fix<?php print $counter2; ?>" data-toggle="tab"><i class="fa fa-lightbulb-o"></i> Vulnerability Fix</a></li>
				<li><a href="#reference-information<?php print $counter2; ?>" data-toggle="tab"><i class="fa fa-info"></i> Reference Info.</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-code"></i> Vulnerability Details <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li class=""><a href="#vulnerability-url<?php print $counter2; ?>" data-toggle="tab"><i class="fa fa-code"></i> Vulnerable URL</a></li>
						<li class=""><a href="#vulnerability-session<?php print $counter2; ?>" data-toggle="tab"><i class="fa fa-code"></i> Vulnerable Session</a></li>
						<li class=""><a href="#raw-response<?php print $counter2; ?>" data-toggle="tab"><i class="fa fa-code"></i> Raw Response</a></li>
					</ul>
				</li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
				<!-- Vuln Summary -->
				<div class="tab-pane fade in active" id="vulnerability-summary<?php print $counter2; ?>">
					<?php print $issue->ReportSection->SectionText; ?>
				</div>
				<!-- Vuln Implication -->
				<div class="tab-pane" id="vulnerability-implication<?php print $counter2; ?>">
					<?php print $issue->ReportSection[2]->SectionText; ?>
				</div>
				<!-- Vuln Fix -->
				<div class="tab-pane" id="vulnerability-fix<?php print $counter2; ?>">
					<?php print $issue->ReportSection[3]->SectionText; ?>
				</div>
				<!-- Vuln Ref Info -->
				<div class="tab-pane" id="reference-information<?php print $counter2; ?>">
					<?php print $issue->ReportSection[4]->SectionText; ?>
				</div>
				<!-- Vuln URL -->
				<div class="tab-pane" id="vulnerability-url<?php print $counter2; ?>">
					<pre><?php print htmlspecialchars($issue->URL); ?></pre>
				</div>
				<!-- Vuln Session -->
				<div class="tab-pane" id="vulnerability-session<?php print $counter2; ?>">
					<pre class="pre-scrollable" style="white-space:pre-line;"><?php print htmlspecialchars($issue->VulnerableSession); ?></pre>
				</div>
				<!-- Vuln Raw Response -->
				<div class="tab-pane" id="raw-response<?php print $counter2; ?>">
					<pre class="pre-scrollable" style="white-space:pre-line;"><?php print htmlspecialchars($issue->RawResponse); ?></pre>
				</div>
			</div>
			<!-- End Tab panes -->
		<?php endif; ?>
	<? endforeach; ?>
	
	<!-- Medium Vulns -->
	<?php foreach ($report->Issues->Issue as $issue): ?>
	<?php $counter2 ++; ?>
		<?php if ($issue->Severity == 2): ?>
			<a id="<?php print $counter2; ?>"></a>
			<h3 class="medium"><span class="badge strong medium-badge"> Medium </span> <?php print $issue->Name; ?></h3>
			<!-- Nav tabs -->
			<ul class="nav nav-tabs">
				<li class="active"><a href="#vulnerability-summary<?php print $counter2; ?>" data-toggle="tab"><i class="fa fa-bug"></i> Vulnerability Summary</a></li>
				<li><a href="#vulnerability-implication<?php print $counter2; ?>" data-toggle="tab"><i class="fa fa-cog"></i> Vulnerability Implication</a></li>
				<li><a href="#vulnerability-fix<?php print $counter2; ?>" data-toggle="tab"><i class="fa fa-lightbulb-o"></i> Vulnerability Fix</a></li>
				<li><a href="#reference-information<?php print $counter2; ?>" data-toggle="tab"><i class="fa fa-info"></i> Reference Info.</a></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-code"></i> Vulnerability Details <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li class=""><a href="#vulnerability-url<?php print $counter2; ?>" data-toggle="tab"><i class="fa fa-code"></i> Vulnerable URL</a></li>
						<li class=""><a href="#vulnerability-session<?php print $counter2; ?>" data-toggle="tab"><i class="fa fa-code"></i> Vulnerable Session</a></li>
						<li class=""><a href="#raw-response<?php print $counter2; ?>" data-toggle="tab"><i class="fa fa-code"></i> Raw Response</a></li>
					</ul>
				</li>
			</ul>
			<!-- Tab panes -->
			<div class="tab-content">
				<!-- Vuln Summary -->
				<div class="tab-pane fade in active" id="vulnerability-summary<?php print $counter2; ?>">
					<?php print $issue->ReportSection->SectionText; ?>
				</div>
				<!-- Vuln Implication -->
				<div class="tab-pane" id="vulnerability-implication<?php print $counter2; ?>">
					<?php print $issue->ReportSection[2]->SectionText; ?>
				</div>
				<!-- Vuln Fix -->
				<div class="tab-pane" id="vulnerability-fix<?php print $counter2; ?>">
					<?php print $issue->ReportSection[3]->SectionText; ?>
				</div>
				<!-- Vuln Ref Info -->
				<div class="tab-pane" id="reference-information<?php print $counter2; ?>">
					<?php print $issue->ReportSection[4]->SectionText; ?>
				</div>
				<!-- Vuln URL -->
				<div class="tab-pane" id="vulnerability-url<?php print $counter2; ?>">
					<pre><?php print htmlspecialchars($issue->URL); ?></pre>
				</div>
				<!-- Vuln Session -->
				<div class="tab-pane" id="vulnerability-session<?php print $counter2; ?>">
					<pre class="pre-scrollable" style="white-space:pre-line;"><?php print htmlspecialchars($issue->VulnerableSession); ?></pre>
				</div>
				<!-- Vuln Raw Response -->
				<div class="tab-pane" id="raw-response<?php print $counter2; ?>">
					<pre class="pre-scrollable" style="white-space:pre-line;"><?php print htmlspecialchars($issue->RawResponse); ?></pre>
				</div>
			</div>
			<!-- End Tab panes -->
		<?php endif; ?>
	<? endforeach; ?>
</div>
</div>
<div id="footer">
	<div class="container">
		<p class="text-muted">
			<strong>XEROX Confidential | </strong>Web Application Assessment Report for Request #<?php echo $stats[0]['request_number'];?> | Report Generated: <?php echo date("F j, Y @ g:i a"); ?>
		</p>
	</div>
</div>