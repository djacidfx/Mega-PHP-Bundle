// JavaScript Document
jQuery(document).ready(function($) {
	
	 "use strict";
	 var base_url = location.protocol + '//' + location.host + location.pathname ;
	 base_url = base_url.substring(0, base_url.lastIndexOf("/") + 1); 
     
    
	 $(document).on("click","#hide", function() {
		$(".errorMessage").hide();
	 });
    
    $(document).on('submit','.catName', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"controller/action",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
                if(data == 1) {
					$('#action-item').attr('disabled', false); 
					$('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage">Category Name is Mandatory<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				} 
				data = JSON.parse(data);
				if(data.error == 0){
                    $('.catName').hide('slow');
                    $('.step2').show('slow');
                    $('.catId').val(data.catId) ; 
                    $('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data.message)+'</div>');
                            setTimeout(function(){
                                $(".remove-messages").fadeOut("slow");
                            },2000);
                }
				
			}
		});
	});
    
    $(document).on('submit','.deactivateCategory', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"controller/action",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
                    $('.step2').hide('slow'); 
                    $('.step3').show('slow'); 
                    $('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
                            setTimeout(function(){
                                $(".remove-messages").fadeOut("slow");
                            },2000);
            }
		});
	});
    
    $(document).on('submit','.activateCategory', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"controller/action",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
                    $('.step2').hide('slow'); 
                    $('.step3').show('slow'); 
                    $('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
                            setTimeout(function(){
                                $(".remove-messages").fadeOut("slow");
                            },2000);
            }
		});
	});
    
    $(document).on('change','#uploadPreview', function(event){
		event.preventDefault();
		$('.previewprogress').show();
		var allowedTypes = ['jpeg', 'jpg', 'png'];
		var FileSize = (document.getElementById("uploadPreview").files[0].size/1024)/1024; 
        var file = $('#uploadPreview').val().split('\\').pop();
        var fileType = file.allowedTypes;
		var extension = file.substr( (file.lastIndexOf('.') +1) );
		var catId = $('.catId').val();
		var previewfile = $('input[name="uploadPreview"]').get(0).files[0];
		var formData = new FormData();
		formData.append('previewfile', previewfile);
		formData.append('catId', catId);
		if($('#uploadPreview').val()) {
			if(allowedTypes.includes(extension))
			{
				if(FileSize < 10) {
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
						 url: base_url+"controller/action",
           				 method:"POST",
						 data: formData,
						 contentType: false,
						 processData: false,
						 cache: false,
						target: '#targetLayer',
						success:function(data){
							
							$('.remove-messagespreview').fadeIn().html('<div class="alert alert-success">Preview Image Uploaded Successfully.</div>');
							$('.prvw').hide();
							$('.previewprogress').hide();
						},
						resetForm: true
					});
				} else {
					alert("Image must not be greater than 10 MB.") ;
					$('#uploadPreview').val('');
					$('.previewprogress').hide();
					return false;
				}
			} else {
				alert("Wrong File Type") ;
				$('#uploadPreview').val('');
				$('.previewprogress').hide();
				return false;
			}
		} else {
			alert("Please Select an Image.") ;
			$('#uploadPreview').val('');
			$('.previewprogress').hide();
			return false;
		}
		return false;
	});
    
    $(document).on('submit','.postAuthorBadges', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"controller/action",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
                    $('.remove-authorbadgemessages').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
                            setTimeout(function(){
                                $(".remove-authorbadgemessages").fadeOut("slow");
                            },1000);
            }
		});
	});
    
    $(document).on('submit','.postAuthorUploaderBadges', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"controller/action",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
                    $('.remove-uploaderbadgemessages').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
                            setTimeout(function(){
                                $(".remove-uploaderbadgemessages").fadeOut("slow");
                            },1000);
            }
		});
	});
    
    $(document).on('submit','.postAuthorEliteBadges', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"controller/action",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
                    $('.remove-elitebadgemessages').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
                            setTimeout(function(){
                                $(".remove-elitebadgemessages").fadeOut("slow");
                            },1000);
            }
		});
	});
    
    $(document).on('submit','.postFollowerBadges', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"controller/action",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
                    $('.remove-followerbadgemessages').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
                            setTimeout(function(){
                                $(".remove-followerbadgemessages").fadeOut("slow");
                            },1000);
            }
		});
	});
    
    $(document).on('submit','.postCommunityBadges', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"controller/action",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
                    $('.remove-communitybadgemessages').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
                            setTimeout(function(){
                                $(".remove-communitybadgemessages").fadeOut("slow");
                            },1000);
            }
		});
	});
    
    $(document).on('submit','.postBuyerBadges', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"controller/action",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
                    $('.remove-buyerbadgemessages').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
                            setTimeout(function(){
                                $(".remove-buyerbadgemessages").fadeOut("slow");
                            },1000);
            }
		});
	});
    
    
    
    
	
});