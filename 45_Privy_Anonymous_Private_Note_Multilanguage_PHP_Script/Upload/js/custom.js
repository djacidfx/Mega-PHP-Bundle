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
    
    $(document).on('submit','.createNote', function(event){
		event.preventDefault();
		$('.action_log').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"control",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('.createNote')[0].reset();
                for (var i = 0; i < c; i++)
                grecaptcha.reset(i);
                data = JSON.parse(data);
                
				if(data.err == 0) {
                    $('.action_log').attr('disabled',false);
                    $('.openNoteLink').modal('show');
                    $('.userlink').html(data.form_msg) ;
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
    
    $(document).on("click",".openPassNote", function() {
        $('.createNotewithPass')[0].reset();
		$('.openCreateLinkPass').modal('show');
	});
    
    $(document).on('submit','.createNotewithPass', function(event){
		event.preventDefault();
		$('.action_logpass').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"control",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('.createNotewithPass')[0].reset();
                for (var i = 0; i < c; i++)
                grecaptcha.reset(i);
                data = JSON.parse(data);
                
				if(data.err == 0) {
                    $('.action_logpass').attr('disabled',false);
                    $('.openCreateLinkPass').modal('hide');
                    $('.openNoteLink').modal('show');
                    $('.userlink').html(data.form_msg) ;
				} 
                if(data.err == 1) {
                    jQuery("html, body").animate({ scrollTop: jQuery(window).height()}, 1500);
					$('.action_logpass').attr('disabled',false);
					$('.cp-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
				} 
                if(data.err == 2) {
                    jQuery("html, body").animate({ scrollTop: jQuery(window).height()}, 1500);
					$('.action_logpass').attr('disabled',false);
					$('.cp-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
				}
                if(data.err == 3) {
                    jQuery("html, body").animate({ scrollTop: jQuery(window).height()}, 1500);
					$('.action_logpass').attr('disabled',false);
					$('.cp-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
				}
                if(data.err == 4) {
                    jQuery("html, body").animate({ scrollTop: jQuery(window).height()}, 1500);
					$('.action_logpass').attr('disabled',false);
					$('.cp-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
				}
			}
		});
	});
    
    $(document).on('submit','.pass', function(event){
		event.preventDefault();
		$('.action_logpass').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url: newbase_url+"control",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('.pass')[0].reset();
                for (var i = 0; i < c; i++)
                grecaptcha.reset(i);
                data = JSON.parse(data);
                
				if(data.err == 0) {
                    $('.sh').remove();
                    $('.showNote').html(data.form_msg) ;
				} 
                if(data.err == 1) {
                    jQuery("html, body").animate({ scrollTop: jQuery(window).height()}, 1500);
					$('.action_logpass').attr('disabled',false);
					$('.p-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
				} 
                if(data.err == 2) {
                    jQuery("html, body").animate({ scrollTop: jQuery(window).height()}, 1500);
					$('.action_logpass').attr('disabled',false);
					$('.p-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
				}
                if(data.err == 3) {
                    jQuery("html, body").animate({ scrollTop: jQuery(window).height()}, 1500);
					$('.action_logpass').attr('disabled',false);
					$('.p-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
				}
                if(data.err == 4) {
                    jQuery("html, body").animate({ scrollTop: jQuery(window).height()}, 1500);
					$('.action_logpass').attr('disabled',false);
					$('.p-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
				}
			}
		});
	});
    
    $(document).on('click', '.tk', function(){
        setTimeout(function () {
          $('.tk').html("<i class='bi bi-clipboard'></i>").fadeOut("slow");
        }, 500);
        setTimeout(function () {
          $('.tk').html("<i class='bi bi-clipboard-check'></i>").fadeIn("slow");
        }, 1000);

      });
    
});