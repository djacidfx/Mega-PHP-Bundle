// JavaScript Document
jQuery(document).ready(function($) {
    "use strict";
    
    var base_url = window.location.href;
	base_url = base_url.substring(0, base_url.substring(0, base_url.lastIndexOf("/")).lastIndexOf("/")+1) ;
	
	var newbase_url = location.protocol + '//' + location.host + location.pathname ;
	newbase_url = newbase_url.substring(0, newbase_url.lastIndexOf("/") + 1);
    
    var vars = location.protocol + '//' + location.host + location.pathname ;    
    var arrVars = vars.split("/");
    arrVars.splice(-3,3)
    var postbase_url = arrVars.join("/");
    
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
    
    var currentLocation = window.location;
       
    
    
    $(document).on("click","#hide", function() {
		$(".errorMessage").hide();
	});
    
    $(document).on('submit','.fillSlambook', function(event){
		event.preventDefault();
		$('#action_sb').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url: newbase_url+"control",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				data = JSON.parse(data);
				if(data.err == 1) {
                    grecaptcha.reset() ;
					$('#action_sb').attr('disabled',false);
					$('.remove-messages').fadeIn().html('<div  class="p-3 alert-danger errorMessage bg-white  text-danger">'+data.form_msg+'&ensp;<button type="button" class="close float-right btn btn-danger btn-sm" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				}
                if(data.err == 2) {
                    grecaptcha.reset() ;
					$('#action_sb').attr('disabled',false);
					$('.remove-messages').fadeIn().html('<div  class="p-3 alert-danger errorMessage bg-white text-danger">'+data.form_msg+'&ensp;<button type="button" class="close float-right btn btn-danger btn-sm" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				}
                if(data.err == 0) {
                    window.location.href = newbase_url+"slam/"+data.id+"/"+data.username;
                }
			}
		});
	});
    
    $(document).on('submit','.fillSlambookAnswers', function(event){
		event.preventDefault();
		$('#action_sb').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url: postbase_url+"/control",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				data = JSON.parse(data);
				if(data.err == 1) {
                    grecaptcha.reset() ;
					$('#action_sb').attr('disabled',false);
					$('.remove-messages').fadeIn().html('<div  class="p-3 alert-danger errorMessage bg-white  text-danger">'+data.form_msg+'&ensp;<button type="button" class="close float-right btn btn-danger btn-sm" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				}
                if(data.err == 2) {
                    grecaptcha.reset() ;
					$('#action_sb').attr('disabled',false);
					$('.remove-messages').fadeIn().html('<div  class="p-3 alert-danger errorMessage bg-white text-danger">'+data.form_msg+'&ensp;<button type="button" class="close float-right btn btn-danger btn-sm" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				}
                if(data.err == 0) {
                    
                   window.location.href = postbase_url+"/answer/"+data.id+"/"+data.username;
                }
			}
		});
	});

});
