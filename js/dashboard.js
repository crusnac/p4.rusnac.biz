
//Search Function to display JSON results.
$(document).ready(function () {

	//Set min lenght to start searching.
    var minlength = 0;

	//Wired to the Search ID
    $("#search").keyup(function () {
        var that = this,
        value = $(this).val();

        if (value.length >= minlength ) {
        
        	//Get JSON data from report_json function + value passed from the URL paramater.   
        	var url = '/search/report_json/' + value;
        	        
        	$.getJSON(url,function(result){
        	
        		//Reset list with each request.
        		$('#report').empty();
        		//Reset Notice with each new request
		        $('#system-error').empty();
        	
        	
				//Check to make sure there are results.
				if (result == undefined || result == null || result.length == 0){
						 $("#system-error").html('<div class="alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>Hmm.. I can\'t seem to find that request number.  Please enter in a valid request #.</div>');
						 }else {
						 
						 $.each(result, function(i, report) {
			        // For each record in the returned array
			        $('#report').append('<li class="list-group-item"><span class="badge low-badge">'+report.request_number+'</span><strong><a href="/index/report/'+report.reportid+'">'+report.scanned_url+'</a></strong></li>');
			    });
			    
			    }
					
					
				
		        			
				
			    
			    
			    
			    
			  });
                
        }
    });
    
    
    
    
});


