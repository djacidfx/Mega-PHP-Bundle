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
        
		$('#action_pic').attr('disabled','disabled');
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
                                $('.remove-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'</div>');
                                setTimeout(function(){
                                    $(".remove-messages").fadeOut("slow");
                                },2000);
                                $('#action_pic').attr('disabled',false); 
                            }
                            if(data.err == 2) {
                                jQuery("html, body").animate({ scrollTop: jQuery(window).height()}, 1500);
                                $('.remove-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'</div>');
                                setTimeout(function(){
                                    $(".remove-messages").fadeOut("slow");
                                },2000);
                                $('#action_pic').attr('disabled',false);
                            } 
                            if(data.err == 3) {
                                jQuery("html, body").animate({ scrollTop: jQuery(window).height()}, 1500);
                                $('.remove-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'</div>');
                                setTimeout(function(){
                                    $(".remove-messages").fadeOut("slow");
                                },2000);
                                $('#action_pic').attr('disabled',false);
                            }
                            if(data.err == 4) {
                                jQuery("html, body").animate({ scrollTop: jQuery(window).height()}, 1500);
                                $('.remove-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'</div>');
                                setTimeout(function(){
                                    $(".remove-messages").fadeOut("slow");
                                },2000);
                                $('#action_pic').attr('disabled',false);
                            }
                            if(data.err == 5) {
                                jQuery("html, body").animate({ scrollTop: jQuery(window).height()}, 1500);
                                $('#uploadFile').val('');
                                $('.remove-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'</div>');
                                setTimeout(function(){
                                    $(".remove-messages").fadeOut("slow");
                                },2000);
                                $('#action_pic').attr('disabled',false);
                            }
                            if(data.err == 6) {
                                jQuery("html, body").animate({ scrollTop: jQuery(window).height()}, 1500);
                                $('#uploadFile').val('');
                                $('.remove-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'</div>');
                                setTimeout(function(){
                                    $(".remove-messages").fadeOut("slow");
                                },2000);
                                $('#action_pic').attr('disabled',false);
                            }
                            if(data.err == 0) {
                               window.location.href = base_url+'zip/'+data.form_msg ;
                            }
							
						},
						resetForm: true
					});
				
		} else {
			alert("Please Select Zip File.") ;
			$('#uploadFile').val('');
			$('#action_pic').attr('disabled',false);
			return false;
		}
		return false;
	});
    
    $(document).on('click','.show_more_allrssfile',function(){
        var id = $(this).attr('id');
        $('.show_more_rss_file').hide();
        $('#loader-icon').show();
        $.ajax({
            type:'GET',
			url: base_url+'fetch_rss?id='+id,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_rss_file'+id).remove();
                $('.jQueryLoadMoreBlogFiles').append(html);
            }
        });
    });
    
    $(document).on('click','.show_more_allcatfile',function(){
        var id = $(this).attr('id');
        $('.show_more_cat_file').hide();
        $('#loader-icon').show();
        var cid = $(this).attr('class');
		cid = cid.replace("show_more_allcatfile",'');
		cid = cid.replace("btn",'');
		cid = cid.replace("btn-secondary",'');
		cid = cid.replace("btn-sm",'');
		cid = cid.replace("ann",'');
        cid = cid.trim();
        id = id.trim() ;
        $.ajax({
            type:'GET',
			url: newbase_url+'grabcategoryfiles?cid='+cid+'&id='+id,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_cat_file'+id).remove();
                $('.jQueryLoadMoreCategoryFiles').append(html);
            }
        });
    });
    
    $(document).on('click','.show_more_allindexfile',function(){
        var id = $(this).attr('id');
        $('.show_more_index_file').hide();
        $('#loader-icon').show();
        var cid = $(this).attr('class');
		cid = cid.replace("show_more_allindexfile",'');
		cid = cid.replace("btn",'');
		cid = cid.replace("btn-secondary",'');
		cid = cid.replace("btn-sm",'');
		cid = cid.replace("ann",'');
        cid = cid.trim();
        id = id.trim() ;
        $.ajax({
            type:'GET',
			url: base_url+'indexfiles?cid='+cid+'&id='+id,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_index_file'+id).remove();
                $('.jQueryLoadMoreIndexFiles').append(html);
            }
        });
    });
    
    $(document).on('click','.show_more_allsearchfile',function(){
        var id = $(this).attr('id');
        $('.show_more_search_file').hide();
        $('#loader-icon').show();
        var search = $(this).attr('class');
		search = search.replace("show_more_allsearchfile",'');
		search = search.replace("btn",'');
		search = search.replace("btn-secondary",'');
		search = search.replace("btn-sm",'');
		search = search.replace("ann",'');
        search = search.trim();
        id = id.trim() ;
        $.ajax({
            type:'GET',
			url: base_url+'u_search?search='+search+'&id='+id,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_search_file'+id).remove();
                $('.jQueryLoadMoreSearchFiles').append(html);
            }
        });
    });
    
    $(document).on('click','.show_more_allfeaturedfile',function(){
        var id = $(this).attr('id');
        $('.show_more_featured_file').hide();
        $('#loader-icon').show();
        var cid = $(this).attr('class');
		cid = cid.replace("show_more_allfeaturedfile",'');
		cid = cid.replace("btn",'');
		cid = cid.replace("btn-secondary",'');
		cid = cid.replace("btn-sm",'');
		cid = cid.replace("ann",'');
        cid = cid.trim();
        id = id.trim() ;
        $.ajax({
            type:'GET',
			url: base_url+'more_featured?cid='+cid+'&id='+id,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_featured_file'+id).remove();
                $('.jQueryLoadMoreFeaturedFiles').append(html);
            }
        });
    });
    
    $(document).on('click','.show_more_allpopularfile',function(){
        var id = $(this).attr('id');
        $('.show_more_popular_file').hide();
        $('#loader-icon').show();
        var cid = $(this).attr('class');
		cid = cid.replace("show_more_allpopularfile",'');
		cid = cid.replace("btn",'');
		cid = cid.replace("btn-secondary",'');
		cid = cid.replace("btn-sm",'');
		cid = cid.replace("ann",'');
        cid = cid.trim();
        id = id.trim() ;
        $.ajax({
            type:'GET',
			url: base_url+'fetch_popular?cid='+cid+'&id='+id,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_popular_file'+id).remove();
                $('.jQueryLoadMorePopularFiles').append(html);
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