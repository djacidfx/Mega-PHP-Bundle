jQuery(document).ready(function($) {
    "use strict";
    
    var base_url = location.protocol + '//' + location.host + location.pathname ;
    base_url = base_url.substring(0, base_url.lastIndexOf("/") + 1); 
    
    var newbase_url = window.location.href;
	newbase_url = newbase_url.substring(0, newbase_url.substring(0, newbase_url.lastIndexOf("/")).lastIndexOf("/")+1) ;
    
    var c = $('.g-recaptcha').length;
    
    $(document).on("click",".hide", function() {
		$(".errorMessage").hide();
	});
    
    $(document).on('submit','.adminLogin', function(event){
		event.preventDefault();
		$('.action_log').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"login",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('.adminLogin')[0].reset();
                for (var i = 0; i < c; i++)
                grecaptcha.reset(i);
                data = JSON.parse(data);
                
				if(data.err == 0) {
                    window.location.href = base_url+'dashboard' ;
				} 
                if(data.err == 1) {
                    jQuery("html, body").animate({ scrollTop: jQuery(window).height()}, 1500);
					$('.action_log').attr('disabled',false);
					$('.c-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
				} 
                if(data.err == 2) {
                    jQuery("html, body").animate({ scrollTop: jQuery(window).height()}, 1500);
					$('.action_log').attr('disabled',false);
					$('.c-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
				}
                if(data.err == 3) {
                    jQuery("html, body").animate({ scrollTop: jQuery(window).height()}, 1500);
					$('.action_log').attr('disabled',false);
					$('.c-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
				}
			}
		});
	});
    
});