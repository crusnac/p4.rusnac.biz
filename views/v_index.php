

<?php echo date ("F d Y H:i:s.", filemtime("1386105689"));?>

<ul>

	<?php foreach ($reports as $report): ?>
		<li><?php print $report['scanned_url']; ?> - <?php print $report['start_time']; ?></li>
	<? endforeach; ?>
	
	

</ul>