jQuery(document).ready(function($) {
    "use strict";
    
    var base_url = location.protocol + '//' + location.host + location.pathname ;
    base_url = base_url.substring(0, base_url.lastIndexOf("/") + 1); 
    
    var vars = location.protocol + '//' + location.host + location.pathname ;    
    var arrVars = vars.split("/");
    arrVars.splice(-3,3)
    var postbase_url = arrVars.join("/");
    
    var c = $('.g-recaptcha').length;
    
	 $(document).on("click",".hide", function() {
		$(".errorMessage").hide();
	});
    
    $(document).on("click",".addWebsite", function() {
        $('.addWebsiteForm')[0].reset();
        $('.openWebModal').modal('show');
        grecaptcha.reset() ;
    });
		
    $(document).on('submit','.addWebsiteForm', function(event){
		event.preventDefault();
		$('#action_log').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"control",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('.addWebsiteForm')[0].reset();
                for (var i = 0; i < c; i++)
                grecaptcha.reset(i);
                data = JSON.parse(data);
				if(data.err == 0) {
                    window.location.href = data.form_msg ;
				} 
                if(data.err == 1) {
					$('#action_log').attr('disabled',false);
					$('.c-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
				} 
                if(data.err == 2) {
					$('#action_log').attr('disabled',false);
					$('.c-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
				}
                if(data.err == 3) {
					$('#action_log').attr('disabled',false);
					$('.c-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
				}
			}
		});
	});	
    
    $(document).on("click",".delWeb", function() {
        $('.deleteWebsiteForm')[0].reset();
        $('.delWebModal').modal('show');
        grecaptcha.reset() ;
    });
    
    $(document).on('submit','.deleteWebsiteForm', function(event){
		event.preventDefault();
		$('#action_log').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url: postbase_url+"/control",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('.deleteWebsiteForm')[0].reset();
                grecaptcha.reset() ;
                data = JSON.parse(data);
				if(data.err == 0) {
                    alert("Website Deleted.") ;
                    window.location.href = postbase_url ;
				} 
                if(data.err == 1) {
					$('#action_log').attr('disabled',false);
					$('.c-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
				} 
                if(data.err == 2) {
					$('#action_log').attr('disabled',false);
					$('.c-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
				}
                if(data.err == 3) {
					$('#action_log').attr('disabled',false);
					$('.c-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
				}
                if(data.err == 4) {
				    window.location.href = postbase_url ;
				}
			}
		});
	});
    
    $(document).on("click",".delWebIn", function() {
        $('.deleteWebsiteFormIn')[0].reset();
        $('.delWebModalIn').modal('show');
        var sid = $(this).data("status"); 
        $('.sid').val(sid) ;
        grecaptcha.reset() ;
    });
    
    $(document).on('submit','.deleteWebsiteFormIn', function(event){
		event.preventDefault();
		$('#action_log').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"control",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('.deleteWebsiteFormIn')[0].reset();
                
                for (var i = 0; i < c; i++)
                    grecaptcha.reset(i);
                data = JSON.parse(data);
				if(data.err == 0) {
                    alert("Website Deleted.") ;
                    window.location.href = base_url ;
				} 
                if(data.err == 1) {
					$('#action_log').attr('disabled',false);
					$('.cr-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
				} 
                if(data.err == 2) {
					$('#action_log').attr('disabled',false);
					$('.cr-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
				}
                if(data.err == 3) {
					$('#action_log').attr('disabled',false);
					$('.cr-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
				}
                if(data.err == 4) {
				    window.location.href = base_url ;
				}
			}
		});
	});
    
    $(document).on('click','.show_more_allsite',function(){
        var id = $(this).attr('id');
        $('.show_more_site').hide();
        $('#loader-icon').show();
        id = id.trim() ;
        $.ajax({
            type:'GET',
			url: base_url+'grabmore?id='+id,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_site'+id).remove();
                $('.jQueryLoadMoreSite').append(html);
            }
        });
    });
    
    $(document).on("click",".mySearch", function() {
        $('.searchPost')[0].reset();
		$('.manualSearch').modal('show');        
	});
    
    $(document).on('submit','.searchPost', function(event){
		event.preventDefault();
		$('#action_log').attr('disabled','disabled');
		$("#action_log").html("Searching...");
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"control",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				if(data == 1) {
					$('#action_log').attr('disabled',false);
                    $("#action_log").html("Search");
					$('.search-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">Search Term cannot be empty.<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
				}
                if(data == 2) {
					$('#action_log').attr('disabled',false);
                    $("#action_log").html("Search");
					$('.search-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">Not Found Anything. Try again.<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
				} else {
                    window.location.href = data ;
                } 
			}
		});
	});
    
    $(document).on('click','.show_more_allsearch',function(){
        var PID = $(this).attr('id');
        $('.show_more_search').hide();
        $('#loader-icon').show();
		var id = $(this).attr('class');
		id = id.replace("show_more_allsearch",'');
		id = id.replace("btn",'');
		id = id.replace("btn-grey",'');
		id = id.replace("btn-sm",'');
		id = id.replace("ann",'');
        PID = PID.trim();
        id = id.trim() ;
        $.ajax({
            type:'GET',
			url: base_url+'grabsearch?PID='+PID+'&id='+id,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_search'+PID).remove();
                $('.jQueryLoadSearch').append(html);
            }
        });
    });
    
});