<?php
	ini_set('max_execution_time', 9000); //300 seconds = 5 minutes 
	ini_set('memory_limit', '256M'); // Large XML files need the extra memory
?>
<!-- Begin page content -->
<div class="container">

	<div class="page-header">
			<a href="#" onClick="window.print();return false" class="btn btn-info pull-right"><i class="fa fa-print"></i> Print</a>

		<h1>Web Application Assessment Report | #<?php echo $stats[0]['request_number'];?></h1>
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
						Vulnerability Executive Summary
					</div>
					<div id="panel-element-chart">
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
						Identified Vulnerability Summary
					</div>
					<div id="panel-panel-vuln-summary">
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
	
	<!-- Process Each Vulnerability and Display Only "Actionalble" Medium or High in the Content -->
	
	<!-- Critical Vulns -->
	<?php foreach ($report->Issues->Issue as $issue): ?>
	<?php if ($issue->Severity == 4): ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><span class="badge strong critical-badge"> <i class="fa fa-exclamation-triangle"></i> Critical </span> <?php print $issue->Name; ?></h3>
		</div>
		<div class="panel-body">
			<!-- Vuln Summary -->
			<table class="table">
				<thead>
					<th>Vulnerability Summary</th>
				</thead>
				<tbody>
					<tr>
						<td><?php print $issue->ReportSection->SectionText; ?></td>
					<tr>
				</tbody>
			</table>
			<!-- Vuln Implication -->
			<table class="table">
				<thead>
					<th>Vulnerability Implication</th>
				</thead>
				<tbody>
					<tr>
						<td><?php print $issue->ReportSection[2]->SectionText; ?></td>
					<tr>
				</tbody>
			</table>
			<!-- Vulnerability Fix -->
			<table class="table">
				<thead>
					<th>Vulnerability Fix</th>
				</thead>
				<tbody>
					<tr>
						<td><?php print $issue->ReportSection[3]->SectionText; ?></td>
					<tr>
				</tbody>
			</table>
			<!-- Vuln Ref Info -->
			<table class="table">
				<thead>
					<th>Reference Info</th>
				</thead>
				<tbody>
					<tr>
						<td><?php print $issue->ReportSection[4]->SectionText; ?></td>
					<tr>
				</tbody>
			</table>
			<!-- Vuln URL -->
			<table class="table">
				<thead>
					<th>Vulnerable URL</th>
				</thead>
				<tbody>
					<tr>
						<td>
							<pre><?php print htmlspecialchars($issue->URL); ?></pre>
						</td>
					<tr>
				</tbody>
			</table>
			<!-- Vuln Session -->
			<table class="table">
				<thead>
					<th>Vulnerable URL</th>
				</thead>
				<tbody>
					<tr>
						<td>
							<pre style="white-space:pre-line;"><?php print htmlspecialchars($issue->VulnerableSession); ?></pre>
						</td>
					<tr>
				</tbody>
			</table>
			<!-- Vuln Raw Response -->
			<table class="table">
				<thead>
					<th>Raw Response</th>
				</thead>
				<tbody>
					<tr>
						<td>
							<pre style="white-space:pre-line;"><?php print htmlspecialchars($issue->RawResponse); ?></pre>
						</td>
					<tr>
				</tbody>
			</table>
		</div>
	</div>
	<hr>
	<?php endif; ?>
	<? endforeach; ?>
	
	
	<!-- High Vulns -->
	<?php foreach ($report->Issues->Issue as $issue): ?>
	<?php if ($issue->Severity == 3): ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><span class="badge strong high-badge"> High </span> <?php print $issue->Name; ?></h3>
		</div>
		<div class="panel-body">
			<!-- Vuln Summary -->
			<table class="table">
				<thead>
					<th>Vulnerability Summary</th>
				</thead>
				<tbody>
					<tr>
						<td><?php print $issue->ReportSection->SectionText; ?></td>
					<tr>
				</tbody>
			</table>
			<!-- Vuln Implication -->
			<table class="table">
				<thead>
					<th>Vulnerability Implication</th>
				</thead>
				<tbody>
					<tr>
						<td><?php print $issue->ReportSection[2]->SectionText; ?></td>
					<tr>
				</tbody>
			</table>
			<!-- Vulnerability Fix -->
			<table class="table">
				<thead>
					<th>Vulnerability Fix</th>
				</thead>
				<tbody>
					<tr>
						<td><?php print $issue->ReportSection[3]->SectionText; ?></td>
					<tr>
				</tbody>
			</table>
			<!-- Vuln Ref Info -->
			<table class="table">
				<thead>
					<th>Reference Info</th>
				</thead>
				<tbody>
					<tr>
						<td><?php print $issue->ReportSection[4]->SectionText; ?></td>
					<tr>
				</tbody>
			</table>
			<!-- Vuln URL -->
			<table class="table">
				<thead>
					<th>Vulnerable URL</th>
				</thead>
				<tbody>
					<tr>
						<td>
							<pre><?php print htmlspecialchars($issue->URL); ?></pre>
						</td>
					<tr>
				</tbody>
			</table>
			<!-- Vuln Session -->
			<table class="table">
				<thead>
					<th>Vulnerable URL</th>
				</thead>
				<tbody>
					<tr>
						<td>
							<pre style="white-space:pre-line;"><?php print htmlspecialchars($issue->VulnerableSession); ?></pre>
						</td>
					<tr>
				</tbody>
			</table>
			<!-- Vuln Raw Response -->
			<table class="table">
				<thead>
					<th>Raw Response</th>
				</thead>
				<tbody>
					<tr>
						<td>
							<pre style="white-space:pre-line;"><?php print htmlspecialchars($issue->RawResponse); ?></pre>
						</td>
					<tr>
				</tbody>
			</table>
		</div>
	</div>
	<hr>
	<?php endif; ?>
	<? endforeach; ?>
	
	
	<!-- Medium Vulns -->
	<?php foreach ($report->Issues->Issue as $issue): ?>
	<?php if ($issue->Severity == 2): ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><span class="badge strong medium-badge"> Medium </span> <?php print $issue->Name; ?></h3>
		</div>
		<div class="panel-body">
			<!-- Vuln Summary -->
			<table class="table">
				<thead>
					<th>Vulnerability Summary</th>
				</thead>
				<tbody>
					<tr>
						<td><?php print $issue->ReportSection->SectionText; ?></td>
					<tr>
				</tbody>
			</table>
			<!-- Vuln Implication -->
			<table class="table">
				<thead>
					<th>Vulnerability Implication</th>
				</thead>
				<tbody>
					<tr>
						<td><?php print $issue->ReportSection[2]->SectionText; ?></td>
					<tr>
				</tbody>
			</table>
			<!-- Vulnerability Fix -->
			<table class="table">
				<thead>
					<th>Vulnerability Fix</th>
				</thead>
				<tbody>
					<tr>
						<td><?php print $issue->ReportSection[3]->SectionText; ?></td>
					<tr>
				</tbody>
			</table>
			<!-- Vuln Ref Info -->
			<table class="table">
				<thead>
					<th>Reference Info</th>
				</thead>
				<tbody>
					<tr>
						<td><?php print $issue->ReportSection[4]->SectionText; ?></td>
					<tr>
				</tbody>
			</table>
			<!-- Vuln URL -->
			<table class="table">
				<thead>
					<th>Vulnerable URL</th>
				</thead>
				<tbody>
					<tr>
						<td>
							<pre><?php print htmlspecialchars($issue->URL); ?></pre>
						</td>
					<tr>
				</tbody>
			</table>
			<!-- Vuln Session -->
			<table class="table">
				<thead>
					<th>Vulnerable URL</th>
				</thead>
				<tbody>
					<tr>
						<td>
							<pre style="white-space:pre-line;"><?php print htmlspecialchars($issue->VulnerableSession); ?></pre>
						</td>
					<tr>
				</tbody>
			</table>
			<!-- Vuln Raw Response -->
			<table class="table">
				<thead>
					<th>Raw Response</th>
				</thead>
				<tbody>
					<tr>
						<td>
							<pre style="white-space:pre-line;"><?php print htmlspecialchars($issue->RawResponse); ?></pre>
						</td>
					<tr>
				</tbody>
			</table>
		</div>
	</div>
	<hr>
	<?php endif; ?>
	<? endforeach; ?>
</div>
</div>
<div id="footer">
	<div class="container">
		<p class="text-muted">Place sticky footer content here.</p>
	</div>
</div>