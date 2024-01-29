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
    
    $(document).on('click','.show_more_allofficial_item',function(){
        var ID = $(this).attr('id');
        $('.show_more_official_item').hide();
        $('#loader-icon').show();
        $.ajax({
            type:'POST',
            url: newbase_url+'getOfficialPost.php?id='+ID,
            data:'id='+ID,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_official_item'+ID).remove();
				$('.ap'+ID).remove();
                $('.jQueryOfficialPost').append(html);
            }
        });
    });
    
    $(document).on('click','.show_more_allfeatured_item',function(){
        var ID = $(this).attr('id');
        $('.show_more_featured_item').hide();
        $('#loader-icon').show();
        $.ajax({
            type:'POST',
            url: newbase_url+'getFeaturedPost.php?id='+ID,
            data:'id='+ID,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_featured_item'+ID).remove();
				$('.ap'+ID).remove();
                $('.jQueryFeaturedPost').append(html);
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
        searchWord = searchWord.trim();
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
    
    $(document).on('click','.show_more_allcategory_item',function(){
        var ID = $(this).attr('id');
        $('.show_more_category_item').hide();
        $('#loader-icon').show();
		var catId = $(this).attr('class');
		catId = catId.replace("show_more_allcategory_item",'');
		catId = catId.replace("btn",'');
		catId = catId.replace("btn-dark",'');
		catId = catId.replace("btn-sm",'');
		catId = catId.replace("ann",'');
        catId = catId.trim();
        $.ajax({
            type:'GET',
			url: base_url+'getLoadCategory.php?id='+ID+'&catId='+catId,
            data:{id:ID,catId:catId},
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_category_item'+ID).remove();
				$('.ap'+ID).remove();
                $('.jQueryCategoryPost').append(html);
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
                $('.progress').hide();
				$('#subscribeModal').modal('show');
				$('.subscribe_form')[0].reset();
				$('#action_pic').val('Post Now');
			}
		});
	});
	
	
    
    $(document).on('submit','#uploadImage', function(event){
		event.preventDefault();
		$('#action_pic').attr('disabled','disabled');
		var allowedTypes = ['jpeg', 'jpg', 'png'];
		var FileSize = (document.getElementById("uploadFile").files[0].size/1024)/1024; 
        var file = $('#uploadFile').val().split('\\').pop();
        var fileType = file.allowedTypes;
		var extension = file.substr( (file.lastIndexOf('.') +1) );
		if($('#uploadFile').val()) {
			if(allowedTypes.includes(extension))
			{
				if(FileSize < 5) {
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
                            if(data == 2) {
                                $('.progress').hide();
                                $('#action_pic').attr('disabled',false);
                                $('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage bg-dark text-danger">Spam is not allowed. Please Prove You are Human.<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                            }
                            if(data == 0) {
                                $('.progress').hide();
                                $('#action_pic').attr('disabled',false);
                                $('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage bg-dark text-danger">Duplicate Post Title. Try Again.<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                            }
                            if(data == 3){
                                $('.subscribe_form')[0].reset();
                                $('#subscribeModal').modal('hide');
                                $('#action_pic').attr('disabled',false);
                                $('#errorApprove').modal('show');
                            }
                            data = JSON.parse(data);
                            if(data.err == 1){
                                $('.subscribe_form')[0].reset();
                                $('#subscribeModal').modal('hide');
                                $('#action_pic').attr('disabled',false);
                                window.location.href = newbase_url+'post/'+data.postId ;
                            }
						},
						resetForm: true
					});
				} else {
					alert("Image must not be greater than 5 MB.") ;
					$('#uploadFile').val('');
					$('#action_pic').attr('disabled',false);
					return false;
				}
			} else {
				alert("Wrong File Type") ;
				$('#uploadFile').val('');
				$('#action_pic').attr('disabled',false);
				return false;
			}
		} else {
			alert("Please Select an Image.") ;
			$('#uploadFile').val('');
			$('#action_pic').attr('disabled',false);
			return false;
		}
		return false;
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