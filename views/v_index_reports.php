

<ul>

	<?php foreach ($reports as $report): ?>
		<li><?php print $report['scanned_url']; ?> - <?php print $report['start_time']; ?></li>
	<? endforeach; ?>
	

</ul>



	<!-- Previous Pagination Link -->
	<?php if ($prev >= 0): ?>
	
		<?php $current_page = $prev; ?>
		<a href="<?php print $prev; ?>"><?php print $prev +1; ?> / <?php print $total_pages +1; ?> Prev Page</a>
	
	<?php endif; ?>

	
	<!-- Nex Pagination Link -->
	<?php if ($next <= $total_pages): ?>
		<?php $current_page = $next; ?>
	
		<a href="<?php print $next; ?>"><?php print $next +1; ?> / <?php print $total_pages +1; ?> Prev Page</a>
	
	<?php endif; ?>



