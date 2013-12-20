<div class="row">
	<div class="col-md-9">
		<h1>Report Details  <small>/ Request #<?php print $report[0]['request_number']; ?></small></h1>
	</div>
	<div class="col-md-3">
		
		<!-- Small button group -->
		<div class="btn-group" style="padding-top: 15px;">
			<button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-cog"></i> Action <span class="caret"></span>
			</button>
			<ul class="dropdown-menu">
				<li><a href="/report/view/<?php print $report[0]['filename']; ?>" target="_blank"><i class="fa fa-list-alt"></i> View HTML Report</a></li>
				<li><a href="/report/noninteractive/<?php print $report[0]['filename']; ?>" target="_blank"><i class="fa fa-print"></i> Print Report</a></li>
				<li><a href="/report/pdf/<?php print $report[0]['filename']; ?>" target="_blank"><i class="fa fa-file"></i> Generate PDF Report</a></li>
				<li><a href="/report/csv/<?php print $report[0]['filename']; ?>"><i class="fa fa-table"></i> Download CSV Report</a></li>
				<li class="divider"></li>
				<li><a data-toggle="modal" data-target="#close-<?php print $report[0]['reportid']; ?>"><i class="fa fa-check-square-o"></i> Request Closure Notice</a></li>
				<li><a data-toggle="modal" data-target="#delete-<?php print $report[0]['reportid']; ?>"><i class="fa fa-times"></i> Delete Report</a></li>
			</ul>
		</div>
	</div>
</div>
<br />

<!-- Report Vuln Stats -->
<div class="row">
	
	<!-- Critical Vuln Panel -->
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><span class="critical">Critical Vulnerabilities</span></h3>
			</div>
			<div class="panel-body">
				<center>
					<h1><span class="label label-default critical-badge"><i class="fa fa-exclamation-triangle"></i> <?php print $report[0]['vulns_critical']; ?></span></h1>
				</center>
			</div>
		</div>
	</div>
	
	<!-- High Vuln Panel -->
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><span class="high">High Vulnerabilities</span></h3>
			</div>
			<div class="panel-body">
				<center>
					<h1><span class="label label-default high-badge"><?php print $report[0]['vulns_high']; ?></span></h1>
				</center>
			</div>
		</div>
	</div>
	
	<!-- Medium Vuln Panel -->
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><span class="medium">Medium Vulnerabilities</span></h3>
			</div>
			<div class="panel-body">
				<center>
					<h1><span class="label label-default medium-badge"><?php print $report[0]['vulns_medium']; ?></span></h1>
				</center>
			</div>
		</div>
	</div>
	
	<!-- Low Vuln Panel -->
	<div class="col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><span class="low">Low Vulnerabilities</span></h3>
			</div>
			<div class="panel-body">
				<center>
					<h1><span class="label label-default low-badge"><?php print $report[0]['vulns_low']; ?></span></h1>
				</center>
			</div>
		</div>
	</div>
</div>

<!-- Report Details -->
<div class="list-group">
	<li class="list-group-item">
		<div class="col-md-3">
			<span class="badge strong">Scanned URL</span>
		</div>
		<?php print $report[0]['scanned_url']; ?>
	</li>
	<li class="list-group-item">
		<div class="col-md-3">
			<span class="badge strong">Scanned Name</span>
		</div>
		<?php print $report[0]['scan_name']; ?>
	</li>
	<li class="list-group-item">
		<div class="col-md-3">
			<span class="badge strong">Policy</span>
		</div>
		<?php print $report[0]['policy']; ?>
	</li>
	<li class="list-group-item">
		<div class="col-md-3">
			<span class="badge strong">Start Time</span>
		</div>
		<?php print $report[0]['start_time']; ?>
	</li>
	<li class="list-group-item">
		<div class="col-md-3">
			<span class="badge strong">Duration</span>
		</div>
		<?php print $report[0]['duration']; ?>
	</li>
	<li class="list-group-item">
		<div class="col-md-3">
			<span class="badge strong">Report Name</span>
		</div>
		<?php print $report[0]['filename']; ?>
	</li>
	<li class="list-group-item">
		<div class="col-md-3">
			<span class="badge strong">Report Filesize</span>
		</div>
		<?php print formatBytes($report[0]['filesize']); ?>
	</li>
	<li class="list-group-item">
		<div class="col-md-3">
			<span class="badge strong">Report Created</span>
		</div>
		<?php echo Time::display($report[0]['file_timestamp'], 'm/d/Y g:i:s A'); ?>
	</li>
</div>

<!-- Delete Report -->
<div class="modal fade" id="delete-<?php print $report[0]['reportid']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Delete Report for Request #<?php print $report[0]['request_number']; ?></h4>
			</div>
			<div class="modal-body">
				<p><strong>Please confirm that you would like to delete the following report:</strong></p>
				<pre><?php print $report[0]['filename']; ?></pre>
			</div>
			<div class="modal-footer">
				<a href="/report/delete/<?php print $report[0]['reportid']; ?>" type="button" class="btn btn-danger">Delete Report</a>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- Closure Notice Modal -->
<div class="modal fade" id="close-<?php print $report[0]['reportid']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Closure Notice: Request #<?php print $report[0]['request_number']; ?></h4>
			</div>
			<div class="modal-body">
				<p>
					Web Application Assessment Report:
				</p>
				<pre><?php print APP_URL; ?>report/view/<?php print $report[0]['filename']; ?></pre>
				<p>The URL above contains your web application assessment vulnerability report. From a compliance perspective, all Critical, High and Medium level risks require remediation that are inline with Xerox standards and policies.</p>
				<p>Please let me know if you have any questions or need assistance regarding the findings associated with the assessment that was just performed.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary">Close Request #<?php print $report[0]['request_number']; ?></button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->