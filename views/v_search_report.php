<script>

$(function () {
    var minlength = 3;

    $("#sample_search").keyup(function () {
        var that = this,
        value = $(this).val();

        if (value.length >= minlength ) {
        
        
        	var url = '/search/report_json/' + value;
        	        
        	$.getJSON(url,function(result){
        		$('#results').empty();
        	
			    $.each(result, function(i, report) {
			        // For each record in the returned array
			        $('#results').append(report.request_number+' - ');
			        $('#results').append(report.scanned_url+'<br />'); 
			    });
			  });
        
        
        
        }
    });
});







$("button").click(function(){
  
});






</script>



 <label for='name'>Search Report:</label><br>
   <input type="text" name="sample_search" id="sample_search">
    <br><br>

     <div id="results"></div> <div id="results"></div>
    
    <div id="msg"></div>



<?php //print_r($report); ?>