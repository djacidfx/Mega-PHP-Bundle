// JavaScript Document
jQuery(document).ready(function($) {
	
	 "use strict";	
	 
	var base_url = window.location.href;
	base_url = base_url.substring(0, base_url.substring(0, base_url.lastIndexOf("/")).lastIndexOf("/")+1) ;
	
	var newbase_url = location.protocol + '//' + location.host + location.pathname ;
	newbase_url = newbase_url.substring(0, newbase_url.lastIndexOf("/") + 1);
	
    var currentLocation = window.location;
    
	$(document).on("click","#hide", function() {
		$(".errorMessage").hide();
	});
    
    $(document).on("click",".pComment", function() {
		$('#cModal').modal('show');
		$('.c_form')[0].reset();
        grecaptcha.reset() ;
	});
    
    $(document).on('submit','.c_form', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		
		$.ajax({
			url: base_url+"add_code.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
                data = JSON.parse(data);
                if(data.err == 0){
                    $('#cModal').modal('hide');
                    $('.c_form')[0].reset();
                    window.location.href = currentLocation;
                } else {
                    grecaptcha.reset() ;
					$('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage"><small>'+data.form_msg+'</small><button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
				
			}
		})
	});
	
	$(document).on('click','.show_more_newest_item',function(){
        var ID = $(this).attr('id');
        $('.show_more_new_item').hide();
        $('#loader-icon').show();
        $.ajax({
            type:'POST',
            url: newbase_url+'getNewPost.php?id='+ID,
            data:'id='+ID,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_new_item'+ID).remove();
				$('.ap'+ID).remove();
                $('.jQueryNewPost').append(html);
            }
        });
    });
	$(document).on('click','.show_more_newest_search',function(){
        var ID = $(this).attr('id');
        $('.show_more_new_search').hide();
        $('#loader-icon').show();
		var searchWord = $(this).attr('class');
		searchWord = searchWord.replace("show_more_newest_search",'');
		searchWord = searchWord.replace("btn",'');
		searchWord = searchWord.replace("btn-dark",'');
		searchWord = searchWord.replace("btn-sm",'');
		searchWord = searchWord.replace("ann",'');
        $.ajax({
            type:'GET',
			url: base_url+'getLoadSearch.php?ID='+ID+'&searchWord='+searchWord,
            data:{ID:ID,searchWord:searchWord},
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_new_search'+ID).remove();
				$('.ap'+ID).remove();
                $('.jQueryNewPost').append(html);
            }
        });
    });
	
	
	
	
	$(document).on('click', '.userLike', function(){
		var pid = $(this).attr('id');	
		var uip = $(this).data("status");
		var btn_action_sb = 'user_like';
		 $.ajax({
            url: base_url+"add_code.php",
            method:"POST",
            data:{pid:pid, uip:uip ,btn_action_sb:btn_action_sb},
            success:function(data)
            {
				data = JSON.parse(data);
				if(data.error == 0) {
					$('.userLi'+pid).html(data.newLike);
				} else {
					$('.errorLike').modal('show');
				} 
			}
		});
	});
	
	$(document).on('click', '.userLove', function(){
		var pid = $(this).attr('id');	
		var uip = $(this).data("status");
		var btn_action_sb = 'user_love';
		 $.ajax({
            url: base_url+"add_code.php",
            method:"POST",
            data:{pid:pid, uip:uip ,btn_action_sb:btn_action_sb},
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
    
    $(document).on('click','.show_more_allcomment',function(){
        var PID = $(this).attr('id');
        $('.show_more_comment').hide();
        $('#loader-icon').show();
		var id = $(this).attr('class');
		id = id.replace("show_more_allcomment",'');
		id = id.replace("btn",'');
		id = id.replace("btn-dark",'');
		id = id.replace("btn-sm",'');
		id = id.replace("ann",'');
        $.ajax({
            type:'GET',
			url: base_url+'getLoadComment.php?PID='+PID+'&id='+id,
            data:{PID:PID,id:id},
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_comment'+PID).remove();
                $('.jQueryNewComment').append(html);
            }
        });
    });
	
});