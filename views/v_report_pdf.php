<style>

body {
	font-family: arial;
}

.test {
	font-family: arial;
}

.title {
	font: 150px;
}

code {font-size: 12px;}

.critical .title {
	margin-top: 15px;
	padding: 10px;
	font-weight: bold;
	background-color: #b20000;
	color: #fff;
}

.high .title {
	margin-top: 15px;
	padding: 10px;
	font-weight: bold;
	background-color: #d9534f;
	color: #fff;
}

.medium .title {
	margin-top: 15px;
	padding: 10px;
	font-weight: bold;
	background-color: #ed9c28;
	color: #fff;
}


.subtitle {
	padding-top: 25px;
	font-weight: bold;
	border-bottom: #ccc 1px solid;
}

.intro {
	
	font-size: 80%;
	border: #eea236 1px solid;
	padding: 15px;
	background-color: #f0ad4e;
	color: #fff;
	margin-bottom: 50px;
	
}

.info {
	background-color: #428bca;
	border: #357ebd 1px solid;
	color: #fff;
	padding: 10px;
}

</style>

<div class="intro">
	
	<h2>Authorized Use Only</h2>
	<p>
	This is a Xerox Corporation computer system which is to be used "FOR OFFICIAL XEROX USE ONLY" by specifically authorized individuals. This system includes Xerox confidential, proprietary and privileged information and may be subject to monitoring. No expectation of privacy can be assumed by users of this system. All unauthorized attempts to upload, download or alter information on this system are strictly prohibited and may be punishable under applicable law. Individuals found performing unauthorized activities on this system are subject to disciplinary action including termination, and/or criminal or civil prosecution.

The data in this report is proprietary and confidential to Xerox Corporation and is intended only for the use of the intended recipient(s). These items may not be disclosed to third parties without the prior written permission of Xerox Corporation.
	</p>
	
	
</div>




<h3>Web Application Assessment Report | <span class="test">#<?php echo $stats[0]['request_number'];?></span></h3>

<div class="info">
	<div class="title"><strong>Scanned URL:</strong> <code><?php echo $stats[0]['scanned_url'];?></code></div>
	<div class="title"><strong>Request #:</strong> <code><?php echo $stats[0]['request_number'];?></code></div>

	<div class="title"><strong>Scan Date:</strong> <code><?php echo $stats[0]['start_time'];?></code></div>
	<div class="title"><strong>Duration:</strong> <code><?php echo $stats[0]['duration'];?></code></div>
</div>


<div class="critical">
	
	
	<!-- Critical Vulns -->
	<?php foreach ($report->Issues->Issue as $issue): ?>
	<?php if ($issue->Severity == 4): ?>
	
	
		<div class="title">[Critical] <?php print (string)$issue->Name; ?></div>
			
			<div class="subtitle">URL</div>	
			<code><?php print (string)$issue->URL; ?></code>
			
			<div class="subtitle">Summary</div>		
			<?php print filter_var($issue->ReportSection->SectionText, FILTER_SANITIZE_STRING); ?>
			
			<div class="subtitle">Fix</div>		
			<?php print filter_var($issue->ReportSection[3]->SectionText, FILTER_SANITIZE_STRING); ?>
	
	
		<?php endif; ?>
	<? endforeach; ?>

</div>

<div class="high">
	<!-- High Vulns -->
	<?php foreach ($report->Issues->Issue as $issue): ?>
	<?php if ($issue->Severity == 3): ?>
	
	
		<div class="title">[High] <?php print (string)$issue->Name; ?></div>
			
			<div class="subtitle">URL</div>	
			<code><?php print (string)$issue->URL; ?></code>
			
			<div class="subtitle">Summary</div>		
			<?php print filter_var($issue->ReportSection->SectionText, FILTER_SANITIZE_STRING); ?>
			
			<div class="subtitle">Fix</div>		
			<?php print filter_var($issue->ReportSection[3]->SectionText, FILTER_SANITIZE_STRING); ?>
	
	
		<?php endif; ?>
	<? endforeach; ?>

</div>


<div class="Medium">
	<!-- Medium Vulns -->
	<?php foreach ($report->Issues->Issue as $issue): ?>
	<?php if ($issue->Severity == 2): ?>
	
	
		<div class="title">[Medium] <?php print (string)$issue->Name; ?></div>
			
			<div class="subtitle">URL</div>	
			<code><?php print (string)$issue->URL; ?></code>
			
			<div class="subtitle">Summary</div>		
			<?php print filter_var($issue->ReportSection->SectionText, FILTER_SANITIZE_STRING); ?>
			
			<div class="subtitle">Fix</div>		
			<?php print filter_var($issue->ReportSection[3]->SectionText, FILTER_SANITIZE_STRING); ?>
	
	
		<?php endif; ?>
	<? endforeach; ?>

</div>


	
	
	




