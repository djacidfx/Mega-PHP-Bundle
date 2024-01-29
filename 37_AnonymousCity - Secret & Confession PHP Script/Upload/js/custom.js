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
       
    $(document).ready(function() {
        $('#load').fadeOut(1000);
    });
    
    $(document).on("click","#hide", function() {
		$(".errorMessage").hide();
	});
    
    $(document).on("click",".mySearch", function() {
		$('.manualSearch').modal('show');
	});
    
    $(document).on('click','.show_more_allfeatured',function(){
        var id = $(this).attr('id');
        $('.show_more_featured').hide();
        $('#loader-icon').show();
        id = id.trim() ;
        $.ajax({
            type:'GET',
			url: newbase_url+'grabmorefeatured?id='+id,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_featured'+id).remove();
                $('.jQueryLoadMoreFeatured').append(html);
            }
        });
    });
    
    $(document).on('click','.show_more_alltrending',function(){
        var id = $(this).attr('id');
        $('.show_more_trending').hide();
        $('#loader-icon').show();
        id = id.trim() ;
        $.ajax({
            type:'GET',
			url: newbase_url+'grabmoretrending?id='+id,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_trending'+id).remove();
                $('.jQueryLoadMoreTrending').append(html);
            }
        });
    });
    
    $(document).on('click','.show_more_allnew',function(){
        var id = $(this).attr('id');
        $('.show_more_new').hide();
        $('#loader-icon').show();
        id = id.trim() ;
        $.ajax({
            type:'GET',
			url: newbase_url+'grabmorenew?id='+id,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_new'+id).remove();
                $('.jQueryLoadMoreNew').append(html);
            }
        });
    });
    
    $(document).on('click', '.userLove', function(){
		var pid = $(this).attr('id');	
		var uip = $(this).data("status");
		var btn_action = 'user_love';
		 $.ajax({
            url: newbase_url+"control",
            method:"POST",
            data:{pid:pid, uip:uip ,btn_action:btn_action},
            success:function(data)
            {
				data = JSON.parse(data);
				if(data.error == 0) {
					$('.userLov'+pid).html(data.newLove);
				} else {
					$('.errorLove').modal('show');
				} 
			}
		});
	});
    
    $(document).on('click', '.shareSocial', function(){
		var pid = $(this).attr('id');	
		var btn_action = 'share_secret';
        $('.shareSecret').modal('show');
		 $.ajax({
            url: newbase_url+"control",
            method:"POST",
            data:{pid:pid, btn_action:btn_action},
            success:function(data)
            {
                $('body').tooltip({selector: '[data-bs-toggle="tooltip"]'});
				$('.secBody').html(data);				 
			}
		});
	});
    
    $(document).on('click', '.userPostLove', function(){
		var pid = $(this).attr('id');	
		var uip = $(this).data("status");
		var btn_action = 'user_love';
		 $.ajax({
            url: postbase_url+"/control",
            method:"POST",
            data:{pid:pid, uip:uip ,btn_action:btn_action},
            success:function(data)
            {
				data = JSON.parse(data);
				if(data.error == 0) {
					$('.userLov'+pid).html(data.newLove);
				} else {
					$('.errorPostLove').modal('show');
				} 
			}
		});
	});
    
    $(document).on('click', '.sharePostSocial', function(){
		var pid = $(this).attr('id');	
		var btn_action = 'share_secret';
        $('.sharePostSecret').modal('show');
		 $.ajax({
            url: postbase_url+"/control",
            method:"POST",
            data:{pid:pid, btn_action:btn_action},
            success:function(data)
            {
                $('body').tooltip({selector: '[data-bs-toggle="tooltip"]'});
				$('.secPostBody').html(data);				 
			}
		});
	});
    
    $(document).on('submit','.submitSecret', function(event){
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
					$('.remove-messages').fadeIn().html('<div  class="alert-danger errorMessage bg-dark text-danger">'+data.form_msg+'&ensp;<button type="button" class="close float-right btn btn-grey" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				}
                if(data.err == 2) {
                    grecaptcha.reset() ;
					$('#action_sb').attr('disabled',false);
					$('.remove-messages').fadeIn().html('<div  class="alert-danger errorMessage bg-dark text-danger">'+data.form_msg+'&ensp;<button type="button" class="close float-right btn btn-grey" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				}
                if(data.err == 3) {
                    grecaptcha.reset() ;
					$('#action_sb').attr('disabled',false);
					$('.remove-messages').fadeIn().html('<div  class="alert-danger errorMessage bg-dark text-danger">'+data.form_msg+'&ensp;<button type="button" class="close float-right btn btn-grey" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				}
                if(data.err == 0) {
                    window.location.href = newbase_url+"secret/"+data.pid+"/"+data.purl;
                }
			}
		});
	});
    
    $(document).on('submit','.postUserComment', function(event){
		event.preventDefault();
		$('.btnComment').attr('disabled','disabled');
		$(".btnComment").html("Posting...");
		var form_data = $(this).serialize();
		$.ajax({
			url: postbase_url+"/control",
			method:"POST",
			data:form_data,
			success:function(data)
			{
               $('.btnComment').attr('disabled',false);
               $(".btnComment").html('<i class="bi bi-chat-left-text text-primary"></i> Post Comment'); 
                if(data == 0) {
                    window.location.reload() ;
                }
                if(data == 1) {
                    grecaptcha.reset() ;
                    $('.commentmessage').fadeIn().html('<div  class="bg-dark text-danger errorMessage p-3">Comment is mandatory to Post<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 2) {
                    grecaptcha.reset() ;
                    $('.commentmessage').fadeIn().html('<div  class="bg-dark text-danger errorMessage p-3">Spammer is not allowed.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
            }
        });
	});
    
    $(document).on('click','.show_more_allcomment',function(){
        var PID = $(this).attr('id');
        $('.show_more_comment').hide();
        $('#loader-icon').show();
		var id = $(this).attr('class');
		id = id.replace("show_more_allcomment",'');
		id = id.replace("btn",'');
		id = id.replace("btn-grey",'');
		id = id.replace("btn-sm",'');
		id = id.replace("ann",'');
        PID = PID.trim();
        id = id.trim() ;
        $.ajax({
            type:'GET',
			url: postbase_url+'/grabcomments?PID='+PID+'&id='+id,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_comment'+PID).remove();
                $('.jQueryNewComment').append(html);
            }
        });
    });
    
    $(document).on('submit','.searchPost', function(event){
		event.preventDefault();
		$('#action_log').attr('disabled','disabled');
		$("#action_log").html("Searching...");
		var form_data = $(this).serialize();
		$.ajax({
			url: newbase_url+"control",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				if(data == 1) {
					$('#action_log').attr('disabled',false);
                    $("#action_log").html("Search");
					$('.search-messages').fadeIn().html('<div class="form-group alert-danger errorMessage bg-dark text-danger mt-1">Search Term cannot be empty.&ensp;<button type="button" class="close float-right btn btn-grey" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				}
                if(data == 2) {
					$('#action_log').attr('disabled',false);
                    $("#action_log").html("Search");
					$('.search-messages').fadeIn().html('<div  class="form-group alert-danger errorMessage bg-dark text-danger mt-1">Not Found Anything. Try again.&ensp;<button type="button" class="close float-right btn btn-grey" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
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
			url: newbase_url+'grabsearch?PID='+PID+'&id='+id,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_search'+PID).remove();
                $('.jQueryLoadSearch').append(html);
            }
        });
    });

});
