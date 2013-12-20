<?php
ini_set('max_execution_time', 9000); //300 seconds = 5 minutes 
ini_set('memory_limit', '256M');
?>

<?php if(isset($content)) 
	
	include('mpdf/mpdf.php');
	
	$request = $stats[0]['request_number'];
	
	$mpdf = new mPDF('', 'A4', '', '', 20, 20, 25, 25, 18, 8);
	//$mpdf->setHTMLHeader("{PAGENO}|".$stuff);
	$mpdf->setHTMLFooter('<div align="center" style="font-size: 11px;">XEROX Confidential | <strong>{PAGENO}</strong> | Request #: ' .$request.'</div>');	
	$mpdf->WriteHTML("$content");
	$mpdf->Output();		
	exit;
?>

