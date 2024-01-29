// JavaScript Document
jQuery(document).ready(function($) {
	
	 "use strict";
	 var base_url = location.protocol + '//' + location.host + location.pathname ;
	 base_url = base_url.substring(0, base_url.lastIndexOf("/") + 1); 
     
     var newbase_url = window.location.href ;
	 newbase_url = newbase_url.substring(0, newbase_url.substring(0, newbase_url.lastIndexOf("/")).lastIndexOf("/")+1) ;
    
    var vars = location.protocol + '//' + location.host + location.pathname ;    
    var arrVars = vars.split("/");
    arrVars.splice(-3,3)
    var topicbase_url = arrVars.join("/");
    
    var currentLocation = window.location;
     
	 $(document).on("click","#hide", function() {
		$(".errorMessage").hide();
	 });
    
    
    
      $(document).on('change','#uploadProfileImage', function(event){
		event.preventDefault();
		$('.thumbprogress').show();
		var allowedTypes = ['jpeg', 'jpg', 'png'];
		var FileSize = (document.getElementById("uploadProfileImage").files[0].size/1024)/1024; 
        var file = $('#uploadProfileImage').val().split('\\').pop();
        var fileType = file.allowedTypes;
		var extension = file.substr( (file.lastIndexOf('.') +1) );
		var profilefile = $('input[name="uploadProfileImage"]').get(0).files[0];
		var formData = new FormData();
		formData.append('profilefile', profilefile);
		if($('#uploadProfileImage').val()) {
			if(allowedTypes.includes(extension))
			{
				if(FileSize < 0.5) {
					event.preventDefault();
					$('#targetLayer').hide();
					$.ajax({
						   xhr: function() {
							var xhr = new window.XMLHttpRequest();
							xhr.upload.addEventListener("progress", function(evt) {
								if (evt.lengthComputable) {
									
									var percentComplete = (evt.loaded / evt.total) * 100;
									$('.preview-bar').animate({
										width: percentComplete + '%'
									}, {
										duration: 1000
									});
								}
						   }, false);
						   return xhr;
						},
						 url: base_url+"controls",
           				 method:"POST",
						 data: formData,
						 contentType: false,
						 processData: false,
						 cache: false,
						target: '#targetLayer',
						success:function(data){
							
							$('.remove-messagesprofile').fadeIn().html('<div class="alert alert-success">Profile Image Uploaded Successfully.</div>');
							$('.prvw').hide();
							$('.thumbprogress').hide();
                            window.location.href = base_url+'editprofile' ;
						},
						resetForm: true
					});
				} else {
					alert("Image must not be greater than 500 KB.") ;
					$('#uploadProfileImage').val('');
					$('.thumbprogress').hide();
					return false;
				}
			} else {
				alert("Wrong File Type") ;
				$('#uploadProfileImage').val('');
				$('.thumbprogress').hide();
				return false;
			}
		} else {
			alert("Please Select an Image.") ;
			$('#uploadProfileImage').val('');
			$('.thumbprogress').hide();
			return false;
		}
		return false;
	});
    
    $(document).on('submit','.postForum', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"controls",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
				data = JSON.parse(data);
					if(data.error == 0) {
						window.location.href = base_url+'topic/'+data.topicId+'/'+data.topicUrlTitle ;
					} 
					if(data.error == 1) {
						$('.forumMessage').fadeIn('slow').html('<div  class="alert alert-danger errorMessage">Any Mandatory Field is Missing. Try Again.<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');	
					}
			}
		})
	});
    
    $(document).on('submit','.topicReplySubmit', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: topicbase_url+"/controls",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
				$('.topicReplySubmit')[0].reset();
                $('.userAnswer').fadeIn('slow').html(data);						
			}
		});
	});
    
    $(document).on('click','.markSolution',function(){
        var id = $(this).attr('id');
        var btn_action = "markedSolution" ;
        if(confirm("You cannot change Later. Do you want to Mark this Answer to Solution ?"))
			{
                $.ajax({
                    url: topicbase_url+"/controls",
                    method:"POST",
                    data: {id:id, btn_action:btn_action},
                    success:function(data)
                    {	
                        window.location.href = currentLocation ;					
                    }
                });
                
            }
        else {
            return false;
        }
    });
    
    $(document).on('click','.turnOnAll',function(){
        var btn_action = "turnOn" ;
        $.ajax({
            type:'POST',
            url: base_url+'controls',
            data:{btn_action:btn_action},
            success:function(data){
                window.location.href = base_url+'settings' ;
            }
        });
     });
    
    $(document).on('submit','.userEmailSetting', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"controls",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
				$('.remove-messages').fadeIn().html('<div class="alert alert-success">'+(data)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},1000);
			}
		})
	});
    
    $(document).on('submit','.userPayoutEmail', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"controls",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
				$('.remove-payoutmessages').fadeIn().html('<div class="alert alert-success">'+(data)+'</div>');
						setTimeout(function(){
							$(".remove-payoutmessages").fadeOut("slow");
						},1000);
			}
		})
	});
    
    $(document).on('submit','.changeUserPassword', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"controls",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
                $('.changeUserPassword')[0].reset();
                data = JSON.parse(data);
				$('.remove-passwordmessages').fadeIn().html('<div class="alert alert-success">'+(data.form_message)+'</div>');
						setTimeout(function(){
							$(".remove-passwordmessages").fadeOut("slow");
						},2000);
			}
		})
	});
    
    $(document).on('click','.show_moreall_topic_reply',function(){
        var id = $(this).attr('id');
        $('.show_more_topic_reply').hide();
        $('#loader-icon').show();
        var topicId = $(this).attr('class');
		topicId = topicId.replace("show_moreall_topic_reply",'');
		topicId = topicId.replace("btn",'');
		topicId = topicId.replace("btn-primary",'');
		topicId = topicId.replace("btn-sm",'');
		topicId = topicId.replace("ann",'');
        topicId = topicId.trim() ;
        $.ajax({
            type:'GET',
			url: topicbase_url+'/moretopicreply/'+id+'/'+topicId,
            success:function(html){
                $('body').tooltip({selector: '[data-toggle="tooltip"]'});
				$('#loader-icon').hide();
                $('#show_more_topic_reply'+id).remove();
                $('.jQueryMoreTopicReplies').append(html);
            }
        });
    });
    
    $(document).on('click','.show_moreall_forumcategory_topic',function(){
        var id = $(this).attr('id');
        $('.show_more_forumcategory_topic').hide();
        $('#loader-icon').show();
        var catId = $(this).attr('class');
		catId = catId.replace("show_moreall_forumcategory_topic",'');
		catId = catId.replace("btn",'');
		catId = catId.replace("btn-primary",'');
		catId = catId.replace("btn-sm",'');
		catId = catId.replace("ann",'');
        catId = catId.trim() ;
        $.ajax({
            type:'GET',
			url: newbase_url+'moreforumcategorytopic/'+id+'/'+catId,
            success:function(html){
                $('body').tooltip({selector: '[data-toggle="tooltip"]'});
				$('#loader-icon').hide();
                $('#show_more_forumcategory_topic'+id).remove();
                $('.jQueryMoreForumCategoryTopic').append(html);
            }
        });
    });
    
    $(document).on('click','.show_moreall_search_topic',function(){
        var id = $(this).attr('id');
        $('.show_more_search_topic').hide();
        $('#loader-icon').show();
        var searchWord = $(this).attr('class');
		searchWord = searchWord.replace("show_moreall_search_topic",'');
		searchWord = searchWord.replace("btn",'');
		searchWord = searchWord.replace("btn-primary",'');
		searchWord = searchWord.replace("btn-sm",'');
		searchWord = searchWord.replace("ann",'');
        searchWord = searchWord.trim() ;
        $.ajax({
            type:'GET',
			url: newbase_url+'getsearchmoretopics/'+id+'/'+searchWord,
            success:function(html){
                $('body').tooltip({selector: '[data-toggle="tooltip"]'});
				$('#loader-icon').hide();
                $('#show_more_search_topic'+id).remove();
                $('.jQueryLoadTopicSearchItem').append(html);
            }
        });
    });
    
    
    $(document).on('submit','.saveUserInfo', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"controls",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
				$('.remove-messagesUserInfo').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
						setTimeout(function(){
							$(".remove-messagesUserInfo").fadeOut("slow");
						},1000);
			}
		})
	});
    
    $(document).on('submit','.saveSocialNetwork', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"controls",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
				$('.remove-messagesSocialNetwork').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
						setTimeout(function(){
							$(".remove-messagesSocialNetwork").fadeOut("slow");
						},1000);
			}
		})
	});
    
    $(document).on("keyup","#username", function(e) {
		var value = $('#username').val();
		var btn_action = 'fetch_username' ;
		var return_text = value.replace(/[^a-z0-9]/g,'');
    	$('#username').val(return_text);
    	if ( value.length > 3 && value != "admin") {
			
			$.ajax({
				url: base_url+"controls",
				method:"POST",
				data:{value:value, btn_action:btn_action},
				success:function(data)
				{
					data = JSON.parse(data);
					if(data.err == 0) {
						$('.usernamebtn').attr('disabled',false);
						$('.username-messagess').fadeIn('slow').html('<div  class="alert alert-success errorMessage">'+data.form_msg+'<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');	
					} 
					if(data.err == 1) {
						$('.usernamebtn').attr('disabled','disabled');
						$('.username-messagess').fadeIn('slow').html('<div  class="alert alert-danger errorMessage">'+data.form_msg+'<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');	
					}
				}
			});
		} else {
			$('.username-messagess').hide('slow');
			$('.usernamebtn').attr('disabled','disabled');	
		}
	});
    
    $(document).on('submit','.saveUsername', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"controls",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
				window.location.href = base_url+'editprofile' ;
			}
		})
	});
    
    $(document).on('submit','.saveUserFullname', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"controls",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
				$('.userfullname-messagess').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
						setTimeout(function(){
							$(".userfullname-messagess").fadeOut("slow");
						},1000);
			}
		})
	});
    
    $(document).on('submit','.changeUserEmail', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"controls",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				if(data == 0) {
					$('.useremail-messagess').fadeIn().html('<div  class="alert alert-danger errorMessage"><small>Sorry, Email is already Registered. Try Again.<small><button type="button" class="close float-right mt-n4" aria-label="Close" > <span aria-hidden="true" id="hide" class="ml-2">&times;</span></button></div>');
				} else {
					$('#newEmailModal').modal('show');
					$('#newemail').val(data);
                    $('#otp').val('') ;
				}
			}
		})
	});
    
    $(document).on('submit','.newemail_otpform', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"controls",
			method:"POST",
			data:form_data,
			success:function(data)
			{
                $('#newEmailModal').modal('hide');
				if(data == 0) {
					$('.useremail-messagess').fadeIn().html('<div  class="alert alert-danger errorMessage"><small>Sorry, Wrong OTP Entered.<small><button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide" class="ml-2">&times;</span></button></div>');                    
				} else {
					$('.useremail-messagess').fadeIn().html('<div  class="alert alert-success errorMessage"><small>Email changed successfully.<small><button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide" class="ml-2">&times;</span></button></div>');
					$('#newemail').val(data);
				}
			}
		})
	});
    
    $(document).on('click','.followUser',function(){
        var userId = $(this).attr('id');
        var btn_action = "followUserAction" ;
        $.ajax({ 
            type: 'POST',
            url: newbase_url+"controls",
            data: {userId:userId, btn_action:btn_action},
            success:function(data){
                data = JSON.parse(data);
                if(data.err == 0){
                    $('.unfollowResult'+userId).hide();
                    $('.followResult'+userId).show();
                    $('.followResult'+userId).html('<button class="btn btn-sm btn-light unfollowUser" id="'+data.parentId+'">Unfollow</button>') ;
                    $('.newFollower').html(data.newFollower) ;
                }
            }
        });
     });
    
    $(document).on('click','.unfollowUser',function(){
        var userId = $(this).attr('id');
        var btn_action = "unfollowUserAction" ;
        $.ajax({ 
            type: 'POST',
            url: newbase_url+"controls",
            data: {userId:userId, btn_action:btn_action},
            success:function(data){
                data = JSON.parse(data);
                if(data.err == 0){
                    $('.followResult'+userId).hide();
                    $('.unfollowResult'+userId).show() ;
                    $('.unfollowResult'+userId).html('<button class="btn btn-sm btn-primary followUser" id="'+data.parentId+'">Follow</button>') ;
                    $('.newFollower').html(data.newFollower) ;
                }
            }
        });
     });
    
    $(document).on('click','.show_more_all_follower',function(){
        var id = $(this).attr('id');
        $('.show_more_new_follower').hide();
        $('#loader-icon').show();
		var username = $(this).attr('class');
		username = username.replace("show_more_all_follower",'');
		username = username.replace("btn",'');
		username = username.replace("btn-primary",'');
		username = username.replace("btn-sm",'');
		username = username.replace("ann",'');
        username = username.trim() ;
        $.ajax({
            type:'GET',
			url: newbase_url+'morefollower/'+id+'/'+username,
            success:function(html){
                $('body').tooltip({selector: '[data-toggle="tooltip"]'});
				$('#loader-icon').hide();
                $('#show_more_new_follower'+id).remove();
                $('.jQueryMoreFollower').append(html);
            }
        });
    });
    
    $(document).on('click','.show_more_all_following',function(){
        var id = $(this).attr('id');
        $('.show_more_new_following').hide();
        $('#loader-icon').show();
		var username = $(this).attr('class');
		username = username.replace("show_more_all_following",'');
		username = username.replace("btn",'');
		username = username.replace("btn-primary",'');
		username = username.replace("btn-sm",'');
		username = username.replace("ann",'');
        username = username.trim() ;
        $.ajax({
            type:'GET',
			url: newbase_url+'morefollowing/'+id+'/'+username,
            success:function(html){
                $('body').tooltip({selector: '[data-toggle="tooltip"]'});
				$('#loader-icon').hide();
                $('#show_more_new_following'+id).remove();
                $('.jQueryMoreFollowing').append(html);
            }
        });
    });
    
    $(document).on('click','.show_more_alluserloved_item',function(){
        var id = $(this).attr('id');
        $('.show_more_userloved_item').hide();
        $('#loader-icon').show();
		var username = $(this).attr('class');
		username = username.replace("show_more_alluserloved_item",'');
		username = username.replace("btn",'');
		username = username.replace("btn-primary",'');
		username = username.replace("btn-sm",'');
		username = username.replace("ann",'');
        username = username.trim() ;
        $.ajax({
            type:'GET',
			url: newbase_url+'moreloves/'+id+'/'+username,
            success:function(html){
                $('body').tooltip({selector: '[data-toggle="tooltip"]'});
				$('#loader-icon').hide();
                $('#show_more_userloved_item'+id).remove();
                $('.jQueryMoreLovesItems').append(html);
            }
        });
    });
    
    $(document).on('click','.show_more_uservideo_newest_item',function(){
        var id = $(this).attr('id');
        $('.show_more_uservideo_new_item').hide();
        $('#loader-icon').show();
		var username = $(this).attr('class');
		username = username.replace("show_more_uservideo_newest_item",'');
		username = username.replace("btn",'');
		username = username.replace("btn-primary",'');
		username = username.replace("btn-sm",'');
		username = username.replace("ann",'');
        username = username.trim() ;
        $.ajax({
            type:'GET',
			url: newbase_url+'morevideos/'+id+'/'+username,
            success:function(html){
                $('body').tooltip({selector: '[data-toggle="tooltip"]'});
				$('#loader-icon').hide();
                $('#show_more_uservideo_new_item'+id).remove();
                $('.jQueryMoreUserVideos').append(html);
            }
        });
    });
    
    $(document).on('click','.show_moreall_uservideo_bestseller_item',function(){
        var id = $(this).attr('id');
        $('.show_more_uservideo_bestseller_item').hide();
        $('#loader-icon').show();
		var username = $(this).attr('class');
		username = username.replace("show_moreall_uservideo_bestseller_item",'');
		username = username.replace("btn",'');
		username = username.replace("btn-primary",'');
		username = username.replace("btn-sm",'');
		username = username.replace("ann",'');
        username = username.trim() ;
        $.ajax({
            type:'GET',
			url: newbase_url+'morebestsellervideos/'+id+'/'+username,
            success:function(html){
                $('body').tooltip({selector: '[data-toggle="tooltip"]'});
				$('#loader-icon').hide();
                $('#show_more_uservideo_bestseller_item'+id).remove();
                $('.jQueryMoreUserBestSellerVideos').append(html);
            }
        });
    });
    
    $(document).on('click','.show_moreall_uservideo_lowestprice_item',function(){
        var id = $(this).attr('id');
        $('.show_more_uservideo_lowestprice_item').hide();
        $('#loader-icon').show();
		var username = $(this).attr('class');
		username = username.replace("show_moreall_uservideo_lowestprice_item",'');
		username = username.replace("btn",'');
		username = username.replace("btn-primary",'');
		username = username.replace("btn-sm",'');
		username = username.replace("ann",'');
        username = username.trim() ;
        $.ajax({
            type:'GET',
			url: newbase_url+'morelowestpricevideos/'+id+'/'+username,
            success:function(html){
                $('body').tooltip({selector: '[data-toggle="tooltip"]'});
				$('#loader-icon').hide();
                $('#show_more_uservideo_lowestprice_item'+id).remove();
                $('.jQueryMoreUserLowestPriceItem').append(html);
            }
        });
    });
    
    $(document).on('click','.show_moreall_uservideo_highestprice_item',function(){
        var id = $(this).attr('id');
        $('.show_more_uservideo_highestprice_item').hide();
        $('#loader-icon').show();
		var username = $(this).attr('class');
		username = username.replace("show_moreall_uservideo_highestprice_item",'');
		username = username.replace("btn",'');
		username = username.replace("btn-primary",'');
		username = username.replace("btn-sm",'');
		username = username.replace("ann",'');
        username = username.trim() ;
        $.ajax({
            type:'GET',
			url: newbase_url+'morehighestpricevideos/'+id+'/'+username,
            success:function(html){
                $('body').tooltip({selector: '[data-toggle="tooltip"]'});
				$('#loader-icon').hide();
                $('#show_more_uservideo_highestprice_item'+id).remove();
                $('.jQueryMoreUserHighestPriceItem').append(html);
            }
        });
    });
    
    $(document).on('click','.show_moreall_uservideo_toprating_item',function(){
        var id = $(this).attr('id');
        $('.show_more_uservideo_toprating_item').hide();
        $('#loader-icon').show();
		var username = $(this).attr('class');
		username = username.replace("show_moreall_uservideo_toprating_item",'');
		username = username.replace("btn",'');
		username = username.replace("btn-primary",'');
		username = username.replace("btn-sm",'');
		username = username.replace("ann",'');
        username = username.trim() ;
        $.ajax({
            type:'GET',
			url: newbase_url+'moretopratedvideos/'+id+'/'+username,
            success:function(html){
                $('body').tooltip({selector: '[data-toggle="tooltip"]'});
				$('#loader-icon').hide();
                $('#show_more_uservideo_toprating_item'+id).remove();
                $('.jQueryMoreUserHighestRatingItem').append(html);
            }
        });
    });
    
}) ;