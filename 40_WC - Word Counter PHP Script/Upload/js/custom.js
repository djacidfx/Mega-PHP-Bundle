// JavaScript Document
jQuery(document).ready(function($) {
    "use strict";
    
    
    var newbase_url = location.protocol + '//' + location.host + location.pathname ;
	newbase_url = newbase_url.substring(0, newbase_url.lastIndexOf("/") + 1);
    
    $(document).on("click","#hide", function() {
		$(".errorMessage").hide();
	});
    
    $(document).on("keyup","#usertext", function(e) {
		var value = $('#usertext').val();
		var btn_action = 'fetch_counter' ;			
        $.ajax({
            url: newbase_url+"find",
            method:"POST",
            data:{value:value, btn_action:btn_action},
            success:function(data)
            {
                data = JSON.parse(data);
                if(data.err == 0) {
                    $('.showtext').fadeIn('slow').html('<div class="card p-3 "><h2><i class="bi bi-arrow-right-square-fill text-primary"></i> '+data.chars+' Characters '+data.words+' Words '+data.lines+' Lines</h2></div>') ;
                }
                if(data.err == 1) {
                    $('.showtext').fadeOut('slow');
                }
            }
        });
		
	});

});
