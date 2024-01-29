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
    
    $(document).on('submit','#uploadImage', function(event){
		event.preventDefault();
		$('.action_pic').attr('disabled','disabled');
		var allowedTypes = ['zip'];
		var FileSize = (document.getElementById("uploadFile").files[0].size/1024)/1024; 
        var file = $('#uploadFile').val().split('\\').pop();
        var fileType = file.allowedTypes;
		var extension = file.substr( (file.lastIndexOf('.') +1) );
		if($('#uploadFile').val()) {
					event.preventDefault();
					$('#targetLayer').hide();
					$(this).ajaxSubmit({
						target: '#targetLayer',
						beforeSubmit:function(){
							$('.progress').show();
							$('.progress-bar').width('50%');
						},
						uploadProgress: function(event, position, total, percentageComplete)
						{
							$('.progress-bar').animate({
								width: percentageComplete + '%'
							}, {
								duration: 500
							});
						},
						success:function(data){
                            for (var i = 0; i < c; i++)
                            grecaptcha.reset(i);
                            data = JSON.parse(data);
                            if(data.err == 1) {
                                jQuery("html, body").animate({ scrollTop: jQuery(window).height()}, 1500);
                                $('.c-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'</div>');
                                setTimeout(function(){
                                    $(".c-messages").fadeOut("slow");
                                },3000);
                                $('.action_log').attr('disabled',false);
                            }
                            if(data.err == 2) {
                                jQuery("html, body").animate({ scrollTop: jQuery(window).height()}, 1500);
                                $('.c-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'</div>');
                                setTimeout(function(){
                                    $(".c-messages").fadeOut("slow");
                                },3000);
                                $('.action_log').attr('disabled',false);
                            } 
                            if(data.err == 3) {
                                jQuery("html, body").animate({ scrollTop: jQuery(window).height()}, 1500);
                                $('.c-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'</div>');
                                setTimeout(function(){
                                    $(".c-messages").fadeOut("slow");
                                },3000);
                                $('.action_log').attr('disabled',false);
                            }
                            if(data.err == 0) {
                                $('.action_log').attr('disabled',false);
                                $('.openNoteLink').modal('show');
                                $('.userlink').html(data.form_msg) ;
                            }
							
						},
						resetForm: true
					});
				
		} else {
			alert("Please Select Zip File.") ;
			$('#uploadFile').val('');
			$('.action_pic').attr('disabled',false);
			return false;
		}
		return false;
	});
    
    $(document).on('submit','#uploadImagePass', function(event){
		event.preventDefault();
		$('.action_logpass').attr('disabled','disabled');
		var allowedTypes = ['zip'];
		var FileSize = (document.getElementById("uploadFilePass").files[0].size/1024)/1024; 
        var file = $('#uploadFilePass').val().split('\\').pop();
        var fileType = file.allowedTypes;
		var extension = file.substr( (file.lastIndexOf('.') +1) );
		if($('#uploadFilePass').val()) {
					event.preventDefault();
					$('#targetLayer').hide();
					$(this).ajaxSubmit({
						target: '#targetLayer',
						beforeSubmit:function(){
							$('.progress').show();
							$('.progress-bar').width('50%');
						},
						uploadProgress: function(event, position, total, percentageComplete)
						{
							$('.progress-bar').animate({
								width: percentageComplete + '%'
							}, {
								duration: 500
							});
						},
						success:function(data){
                            for (var i = 0; i < c; i++)
                            grecaptcha.reset(i);
                            data = JSON.parse(data);
                            if(data.err == 1) {
                                $('.cp-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'</div>');
                                setTimeout(function(){
                                    $(".cp-messages").fadeOut("slow");
                                },3000);
                                $('.action_logpass').attr('disabled',false);
                            }
                            if(data.err == 2) {
                                $('.cp-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'</div>');
                                setTimeout(function(){
                                    $(".cp-messages").fadeOut("slow");
                                },3000);
                                $('.action_logpass').attr('disabled',false);
                            } 
                            if(data.err == 3) {
                                $('.cp-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'</div>');
                                setTimeout(function(){
                                    $(".cp-messages").fadeOut("slow");
                                },3000);
                                $('.action_logpass').attr('disabled',false);
                            }
                            if(data.err == 4) {
                                $('.cp-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'</div>');
                                setTimeout(function(){
                                    $(".cp-messages").fadeOut("slow");
                                },3000);
                                $('.action_logpass').attr('disabled',false);
                            }
                            if(data.err == 0) {
                                $('.action_logpass').attr('disabled',false);
                                $('.openCreateLinkPass').modal('hide');
                                $('.openNoteLink').modal('show');
                                $('.userlink').html(data.form_msg) ;
                            }
							
						},
						resetForm: true
					});
				
		} else {
			alert("Please Select Zip File.") ;
			$('#uploadFilePass').val('');
			$('.action_logpass').attr('disabled',false);
			return false;
		}
		return false;
	});
    
    
    $(document).on("click",".openPassNote", function() {
        $('.createNotewithPass')[0].reset();
		$('.openCreateLinkPass').modal('show');
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