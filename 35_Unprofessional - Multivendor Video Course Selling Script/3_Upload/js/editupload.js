// JavaScript Document
jQuery(document).ready(function($) {
	
	 "use strict";
	 var base_url = location.protocol + '//' + location.host + location.pathname ;
	 base_url = base_url.substring(0, base_url.lastIndexOf("/") + 1); 
     
     var newbase_url = window.location.href ;
	 newbase_url = newbase_url.substring(0, newbase_url.substring(0, newbase_url.lastIndexOf("/")).lastIndexOf("/")+1) ;
    
     var currentLocation = window.location;
    
	 $(document).on("click","#hide", function() {
		$(".errorMessage").hide();
	 });
    
    var nmaxpreview = function () {
		var tmp = null;
			$.ajax({
				'async': false,
				'type': "POST",
				'global': false,
				'dataType': 'html',
				'url': newbase_url+"maxpreview",
				'data': { 'request': "", 'target': 'arrange_url', 'method': 'method_target' },
				'success': function (data) {
					tmp = data;
				}
			});
		return tmp;
	}();
	var maxPreviewSize = nmaxpreview ;
    
    var nmaxdemo = function () {
		var tmp = null;
			$.ajax({
				'async': false,
				'type': "POST",
				'global': false,
				'dataType': 'html',
				'url': newbase_url+"maxdemo",
				'data': { 'request': "", 'target': 'arrange_url', 'method': 'method_target' },
				'success': function (data) {
					tmp = data;
				}
			});
		return tmp;
	}();
	var maxDemoSize = nmaxdemo ;
    
    var nmaxmain = function () {
		var tmp = null;
			$.ajax({
				'async': false,
				'type': "POST",
				'global': false,
				'dataType': 'html',
				'url': newbase_url+"maxmain",
				'data': { 'request': "", 'target': 'arrange_url', 'method': 'method_target' },
				'success': function (data) {
					tmp = data;
				}
			});
		return tmp;
	}();
	var maxMainSize = nmaxmain ;
    
    $(document).on('submit','.user_edit_upload', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: newbase_url+"controls",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
                
                if(data == 1) {
					$('#action_log_step1').attr('disabled', false); 
					$('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage">Any Mandaory Field is Missing.<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				} 
				data = JSON.parse(data);
				if(data.error == 0){
                    $('html, body').animate({ scrollTop: 0 }, 'slow');
                    $('.user_edit_upload').hide('slow');
                    $('.user_edit_upload_step2').show('slow');
                    $('.hiddenUpdateButton').show() ;
                    $('.itemId').val(data.itemId) ; 
                    $('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data.message)+'</div>');
                            setTimeout(function(){
                                $(".remove-messages").fadeOut("slow");
                            },2000);
                }
				
			}
		});
	});
    
     $(document).on('submit','.user_edit_upload_step2', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: newbase_url+"controls",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
                
                if(data == 1) {
					$('#action_temp_log').attr('disabled', false); 
					$('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage">Category is Missing.<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				} 
				data = JSON.parse(data);
				if(data.error == 0){
                    $('.step_3show').show('slow');
                    $('.user_edit_upload_step2').hide('slow');
                    $('.remove_message_success').fadeIn().html('<div class="alert alert-info">'+(data.message)+'</div>');
                            setTimeout(function(){
                                $(".remove_message_success").fadeOut("slow");
                            },2000);
                }
				
			}
		});
	});
    
    
    $(document).on('change','#uploadPreviewImage', function(event){
		event.preventDefault();
		$('.thumbprogress').show();
		var allowedTypes = ['jpeg', 'jpg', 'png'];
		var FileSize = (document.getElementById("uploadPreviewImage").files[0].size/1024)/1024; 
        var file = $('#uploadPreviewImage').val().split('\\').pop();
        var fileType = file.allowedTypes;
		var extension = file.substr( (file.lastIndexOf('.') +1) );
		var itemId = $('.itemId').val();
		var previewEditfile = $('input[name="uploadPreviewImage"]').get(0).files[0];
		var formData = new FormData();
		formData.append('previewEditfile', previewEditfile);
		formData.append('itemId', itemId);
		if($('#uploadPreviewImage').val()) {
			if(allowedTypes.includes(extension))
			{
				if(FileSize < maxPreviewSize) {
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
						 url: newbase_url+"controls",
           				 method:"POST",
						 data: formData,
						 contentType: false,
						 processData: false,
						 cache: false,
						target: '#targetLayer',
						success:function(data){
							
							$('.remove-messagespreview').fadeIn().html('<div class="alert alert-success">Preview Image Uploaded Successfully.</div>');
							$('.prvw').hide();
							$('.thumbprogress').hide();
						},
						resetForm: true
					});
				} else {
					alert("Image must not be greater than "+maxPreviewSize+" MB.") ;
					$('#uploadPreview').val('');
					$('.thumbprogress').hide();
					return false;
				}
			} else {
				alert("Wrong File Type") ;
				$('#uploadPreview').val('');
				$('.thumbprogress').hide();
				return false;
			}
		} else {
			alert("Please Select an Image.") ;
			$('#uploadPreview').val('');
			$('.thumbprogress').hide();
			return false;
		}
		return false;
	});
    
    $(document).on('change','#uploadDemoVideo', function(event){
		event.preventDefault();
		$('.demoprogress').show();
		var allowedTypes = ['mp4', 'mov', 'wmv', 'flv', 'avi', 'webm', 'mkv', 'mpeg', 'ogg', 'mpg', 'mpv', 'm4p', 'm4p', 'm4v', 'qt' , 'swf', 'avchd'];
		var FileSize = (document.getElementById("uploadDemoVideo").files[0].size/1024)/1024; 
        var file = $('#uploadDemoVideo').val().split('\\').pop();
        var fileType = file.allowedTypes;
		var extension = file.substr( (file.lastIndexOf('.') +1) );
		var itemId = $('.itemId').val();
		var docuEditfile = $('input[name="uploadDemoVideo"]').get(0).files[0];
		var formData = new FormData();
        formData.append('FileSize', FileSize);
		formData.append('docuEditfile', docuEditfile);
		formData.append('itemId', itemId);
		if($('#uploadDemoVideo').val()) {
			if(allowedTypes.includes(extension))
			{
				if(FileSize < maxDemoSize) {
					event.preventDefault();
					$('#targetLayer').hide();
					$.ajax({
						   xhr: function() {
							var xhr = new window.XMLHttpRequest();
							xhr.upload.addEventListener("progress", function(evt) {
								if (evt.lengthComputable) {
									
									var percentComplete = (evt.loaded / evt.total) * 100;
									//Do something with upload progress here
									$('.demo-bar').animate({
										width: percentComplete + '%'
									}, {
										duration: 1000
									});
								}
						   }, false);
						   return xhr;
						},
						 url: newbase_url+"controls",
           				 method:"POST",
						 data: formData,
						 contentType: false,
						 processData: false,
						 cache: false,
						target: '#targetLayer',
						success:function(data){
							
							$('.remove-messagesdemo').fadeIn().html('<div class="alert alert-success">Demo Video Uploaded Successfully.</div>');
							$('.demovid').hide();
							$('.demoprogress').hide();
						},
						resetForm: true
					});
				} else {
					alert("Demo Video must not be greater than "+maxDemoSize+" MB.") ;
					$('#uploadDemoVideo').val('');
					$('.demoprogress').hide();
					return false;
				}
			} else {
				alert("Wrong File Type") ;
				$('#uploadDemoVideo').val('');
				$('.demoprogress').hide();
				return false;
			}
		} else {
			alert("Please Select a video file.") ;
			$('#uploadDemoVideo').val('');
			$('.demoprogress').hide();
			return false;
		}
		return false;
	});
    
    $(document).on('change','#uploadMainFile', function(event){
		event.preventDefault();
		$('.mainprogress').show();
		var allowedTypes = ['zip'];
		var FileSize = (document.getElementById("uploadMainFile").files[0].size/1024)/1024; 
        var file = $('#uploadMainFile').val().split('\\').pop();
        var fileType = file.allowedTypes;
		var extension = file.substr( (file.lastIndexOf('.') +1) );
		var itemId = $('.itemId').val();
		var mainEditfile = $('input[name="uploadMainFile"]').get(0).files[0];
		var formData = new FormData();
        formData.append('FileSize', FileSize);
		formData.append('mainEditfile', mainEditfile);
		formData.append('itemId', itemId);
		if($('#uploadMainFile').val()) {
			if(allowedTypes.includes(extension))
			{
				if(FileSize < maxMainSize) {
					event.preventDefault();
					$('#targetLayer').hide();
					$.ajax({
						   xhr: function() {
							var xhr = new window.XMLHttpRequest();
							xhr.upload.addEventListener("progress", function(evt) {
								if (evt.lengthComputable) {
									
									var percentComplete = (evt.loaded / evt.total) * 100;
									//Do something with upload progress here
									$('.main-bar').animate({
										width: percentComplete + '%'
									}, {
										duration: 1000
									});
								}
						   }, false);
						   return xhr;
						},
						 url: newbase_url+"controls",
           				 method:"POST",
						 data: formData,
						 contentType: false,
						 processData: false,
						 cache: false,
						target: '#targetLayer',
						success:function(data){
							
							$('.remove-messagesmain').fadeIn().html('<div class="alert alert-success">Main Zip File Uploaded Successfully.</div>');
							$('.mainzip').hide();
							$('.mainprogress').hide();
						},
						resetForm: true
					});
				} else {
					alert("Main Zip File must not be greater than "+maxMainSize+" MB.") ;
					$('#uploadMainFile').val('');
					$('.mainprogress').hide();
					return false;
				}
			} else {
				alert("Wrong File Type") ;
				$('#uploadMainFile').val('');
				$('.mainprogress').hide();
				return false;
			}
		} else {
			alert("Please Select a video file.") ;
			$('#uploadMainFile').val('');
			$('.mainprogress').hide();
			return false;
		}
		return false;
	});
    
    $(document).on('click','.cancelUpdateItem',function(){
        var itemId = $(this).attr('id');
        var btn_action = "cancelUpdate" ;
        if(confirm("Do you want to Cancel Item Update?"))
			{
                $.ajax({ 
                    type: 'POST',
                    url: newbase_url+"controls",
                    data: {itemId:itemId, btn_action:btn_action},
                    success:function(data){
                        window.location.href = currentLocation ;
                    }
                });
            }
			else
			{
				return false;
			}
     });
});