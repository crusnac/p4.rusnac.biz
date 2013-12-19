<?php if(isset($_GET['no-report'])): ?>
<div class="alert alert-danger fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong><i class="fa fa-exclamation-triangle"></i> <strong>The specified report does not exist!</strong>
</div>
<?php endif; ?>

<?php if(isset($_GET['no-reports'])): ?>
<div class="alert alert-warning fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong><i class="fa fa-exclamation-triangle"></i> <strong>There are currently no reports available to process</strong>
</div>
<?php endif; ?>

<?php if(isset($_GET['report-deleted'])): ?>
<div class="alert alert-success fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong><i class="fa fa-exclamation-triangle"></i> Your report has been deleted</strong>
</div>
<?php endif; ?>

<?php if(isset($_GET['processed'])): ?>
<div class="alert alert-success fade in">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <strong><i class="fa fa-exclamation-triangle"></i> Your report has been processed!</strong>
</div>
<?php endif; ?>



<h1>Reports</h1>
<table class="table table-hover">

	<thead>
		<tr>
			<th>Request #</th>
			<th>Scanned URL</th>
			<th>Scan Start Time</th>
					<th></th>
	
			<th>Critical</th>
			<th>High</th>
			<th>Medium</th>
		</tr>
	</thead>
	
	<tbody>

	<?php foreach ($reports as $report): ?>
		<tr>
			<td class="request-number"><span class="badge low-badge"><?php print $report['request_number']; ?></span></td>
			<td class="scanned-url">
			
			<a href="/index/report/<?php print $report['reportid']; ?>">
			
			<?php if (mb_strlen($report['scanned_url']) <= 50): ?>
				
					<?php print $report['scanned_url']; ?>
				<?php else: ?>
					<?php print substr($report['scanned_url'], 0, 50).'<span class="truncated">...[trunctated]</span>'; ?>
			
			<?php endif; ?>
			
			</a>
			
			</td>
			<td class="start-time" ><?php print $report['start_time']; ?></td>
			
			<td>
				
				<!-- Small button group -->
				<div class="btn-group">
					<button class="btn btn-default btn-xs dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-cog"></i> Action <span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu">
				    <li><a href="/report/view/<?php print $report['filename']; ?>" target="_blank"><i class="fa fa-list-alt"></i> View HTML Report</a></li>
					<li><a href="/report/noninteractive/<?php print $report['filename']; ?>" target="_blank"><i class="fa fa-print"></i> Print Report</a></li>
					<li><a href="/report/pdf/<?php print $report['filename']; ?>" target="_blank"><i class="fa fa-file"></i> Generate PDF Report</a></li>
					<li><a href="/report/csv/<?php print $report['filename']; ?>"><i class="fa fa-table"></i> Download CSV Report</a></li>

					<li class="divider"></li>
					
					<li><a data-toggle="modal" data-target="#close-<?php print $report['reportid']; ?>"><i class="fa fa-check-square-o"></i> Request Closure Notice</a></li>
					<li><a data-toggle="modal" data-target="#delete-<?php print $report['reportid']; ?>"><i class="fa fa-times"></i> Delete Report</a></li>

				  </ul>
				</div>
				
				
				
			</td>	
			
			
			<td class="vulns"><span class="badge critical-badge"><i class="fa fa-exclamation-triangle"></i> <?php print $report['vulns_critical']; ?></span></td>			
			<td class="vulns"><span class="badge high-badge"><?php print $report['vulns_high']; ?></span></td>			
			<td class="vulns"><span class="badge medium-badge"><?php print $report['vulns_medium']; ?></span></td>

		</tr>
		
		
			<!-- Delete Report -->
			<div class="modal fade" id="delete-<?php print $report['reportid']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="myModalLabel">Delete Report for Request #<?php print $report['request_number']; ?></h4>
			      </div>
			      <div class="modal-body">
			        <p><strong>Please confirm that you would like to delete the following report:</strong></p>
			        <pre><?php print $report['filename']; ?></pre>
			        
			        
			        
			      </div>
			      <div class="modal-footer">
			        <a href="/report/delete/<?php print $report['reportid']; ?>" type="button" class="btn btn-danger">Delete Report</a>
			        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			      </div>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
			
			
			
			<!-- Closure Notice Modal -->
			<div class="modal fade" id="close-<?php print $report['reportid']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			  <div class="modal-dialog">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			        <h4 class="modal-title" id="myModalLabel">Closure Notice: Request #<?php print $report['request_number']; ?></h4>
			      </div>
			      <div class="modal-body">        
			        <p>
			        Web Application Assessment Report:
			        </p>
			        
			        <pre><?php print APP_URL; ?>report/view/<?php print $report['filename']; ?></pre>
			        
			        <p>The URL above contains your web application assessment vulnerability report. From a compliance perspective, all Critical, High and Medium level risks require remediation that are inline with Xerox standards and policies.</p>
			        
			        <p>Please let me know if you have any questions or need assistance regarding the findings associated with the assessment that was just performed.</p>
			        
			      </div>
			      <div class="modal-footer">
					  <button type="button" class="btn btn-primary">Close Request #<?php print $report['request_number']; ?></button>
					  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      </div>
			    </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
	<? endforeach; ?>
	</tbody>

</table>


<ul class="pagination">
	<!-- Previous Pagination Link -->
	<?php if ($prev >= 0): ?>
	
		<?php $current_page = $prev; ?>
		<li><a href="<?php print $prev; ?>"><i class="fa fa-angle-left"></i> <strong>Page</strong> <?php print $prev +1; ?> of <?php print $total_pages +1; ?></a></li>
	
	<?php endif; ?>

	
	<!-- Next Pagination Link -->
	<?php if ($next <= $total_pages): ?>
		<?php $current_page = $next; ?>
	
		<li><a href="<?php print $next; ?>"><strong>Page</strong> <?php print $next +1; ?> of <?php print $total_pages +1; ?> <i class="fa fa-angle-right"></i></a></li>
	
	<?php endif; ?>
</ul>



