// JavaScript Document
jQuery(document).ready(function($) {
	
	 "use strict";	
	 
	var base_url = window.location.href;
	base_url = base_url.substring(0, base_url.substring(0, base_url.lastIndexOf("/")).lastIndexOf("/")+1) ;
	
	var newbase_url = location.protocol + '//' + location.host + location.pathname ;
	newbase_url = newbase_url.substring(0, newbase_url.lastIndexOf("/") + 1);
	
	$(document).on("click","#hide", function() {
		$(".errorMessage").hide();
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
			url: newbase_url+'getLoadSearch.php?ID='+ID+'&searchWord='+searchWord,
            data:{ID:ID,searchWord:searchWord},
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_new_search'+ID).remove();
				$('.ap'+ID).remove();
                $('.jQueryNewPost').append(html);
            }
        });
    });
	
	
	$(document).on('click', '.subscribe', function(){
		var btn_action_sb = 'add_code';
		 $.ajax({
            url: newbase_url+"add_code.php",
            method:"POST",
            data:{btn_action_sb:btn_action_sb},
            success:function(data)
            {
				data = JSON.parse(data);
				$('#subscribeModal').modal('show');
				$('.postDescription').attr('maxlength', data.descriptionMax);
				$('.postDescription').attr('placeholder', 'Post Description* [ '+data.descriptionMax+' Character Maximum ]');
				$('.postTitle').attr('maxlength', data.titleMax);
				$('.postTitle').attr('placeholder', 'Post Title* [ '+data.titleMax+' Character Maximum ]');
				$('.subscribe_form')[0].reset();
				$('#action_sb').val('Post Now');
			}
		});
	});
	
	$(document).on('submit','.subscribe_form', function(event){
		event.preventDefault();
		$('#action_sb').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url: newbase_url+"add_code.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				data = JSON.parse(data);
				if(data.err == 0) {
					$('#action_sb').attr('disabled',false);
					$('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage bg-dark text-danger">'+data.form_msg+'<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				} 
				if(data.err == 3) {
					$('#action_sb').attr('disabled',false);
					$('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage bg-dark text-danger">'+data.form_msg+'<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				}
				if(data.err == 2) {
					$('.subscribe_form')[0].reset();
					$('#subscribeModal').modal('hide');
					$('#action_sb').attr('disabled',false);
					$('#errorApprove').modal('show');
				} 
				if(data.err == 1) {
					$('.subscribe_form')[0].reset();
					$('#subscribeModal').modal('hide');
					$('#action_sb').attr('disabled', false);
					$('.postDesign').html(data.postDesign).fadeIn() ;
				}
			}
		})
	});
	
	$(document).on('click', '.userLike', function(){
		var pid = $(this).attr('id');	
		var uip = $(this).data("status");
		var btn_action_sb = 'user_like';
		 $.ajax({
            url: newbase_url+"add_code.php",
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
            url: newbase_url+"add_code.php",
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
	
});