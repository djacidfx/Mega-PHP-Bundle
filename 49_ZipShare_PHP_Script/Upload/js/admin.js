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
    
    $(document).on('submit','.AdForm', function(event){
		event.preventDefault();
		$('#action_log').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"control",
			method:"POST",
			data:form_data,
			success:function(data)
			{
                data = JSON.parse(data);
				if(data.err == 0) {
                    $('#action_log').attr('disabled',false);
					$('.adcode-messages').fadeIn().html('<div  class="alert bg-success errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
				} 
                if(data.err == 1) {
					$('#action_log').attr('disabled',false);
					$('.adcode-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
				} 
			}
		});
	});
    
    $(document).on('submit','.AnalyticForm', function(event){
		event.preventDefault();
		$('#action_log').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"control",
			method:"POST",
			data:form_data,
			success:function(data)
			{
                data = JSON.parse(data);
				if(data.err == 0) {
                    $('#action_log').attr('disabled',false);
					$('.analytic-messages').fadeIn().html('<div  class="alert bg-success errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
				} 
                if(data.err == 1) {
					$('#action_log').attr('disabled',false);
					$('.analytic-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
				} 
			}
		});
	});
    
    $(document).on('submit','.SettingForm', function(event){
		event.preventDefault();
		$('#action_log').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"control",
			method:"POST",
			data:form_data,
			success:function(data)
			{
                data = JSON.parse(data);
				if(data.err == 0) {
                    $('#action_log').attr('disabled',false);
					$('.setting-messages').fadeIn().html('<div  class="alert bg-success errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
				} 
                if(data.err == 1) {
					$('#action_log').attr('disabled',false);
					$('.setting-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
				} 
			}
		});
	});
    
    $(document).on('submit','.UsernameForm', function(event){
		event.preventDefault();
		$('#action_log').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"control",
			method:"POST",
			data:form_data,
			success:function(data)
			{
                data = JSON.parse(data);
				$('.UsernameForm')[0].reset();
				if(data.err == 0) {
                    alert(data.form_msg) ;
                    window.location.href = base_url+"username";
				} 
                if(data.err == 1) {
					$('#action_log').attr('disabled',false);
					$('.ad-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
				} 
                if(data.err == 2) {
					$('#action_log').attr('disabled',false);
					$('.ad-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
				} 
			}
		});
	});	
    
    $(document).on('submit','.PasswordForm', function(event){
		event.preventDefault();
		$('.action_log').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"control",
			method:"POST",
			data:form_data,
			success:function(data)
			{
                data = JSON.parse(data);
               $('.PasswordForm')[0].reset();
               $('.action_log').attr('disabled',false); 
                if(data.err == 0) {
                    $('.adpass-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
                }
                if(data.err == 2) {
                    $('.adpass-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
                }
                if(data.err == 3) {
                    $('.adpass-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start"><small>'+data.form_msg+'</small><button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
                }
                if(data.err == 4) {
                    $('.adpass-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start"><small>'+data.form_msg+'</small><button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
                }
                if(data.err == 1) {
                    alert(data.form_msg) ;
                    window.location.href = base_url+"password";
                }
            }
        });
	});
    
    $(document).on('submit','.createPage', function(event){
		event.preventDefault();
		$('.action_log').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"control",
			method:"POST",
			data:form_data,
			success:function(data)
			{
                data = JSON.parse(data);
               $('.createPage')[0].reset();
               $('.action_log').attr('disabled',false); 
                if(data.err == 0) {
                    jQuery("html, body").animate({ scrollTop: jQuery(window).height()}, 1500);
                    $('.remove-messages').fadeIn().html('<div  class="alert bg-success errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
                }
                if(data.err == 1) {
                    jQuery("html, body").animate({ scrollTop: jQuery(window).height()}, 1500);
                    $('.remove-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
                }
                if(data.err == 2) {
                    jQuery("html, body").animate({ scrollTop: jQuery(window).height()}, 1500);
                    $('.remove-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start"><small>'+data.form_msg+'</small><button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
                }
            }
        });
	});
    
    $(document).on('submit','.editPage', function(event){
		event.preventDefault();
		$('.action_log').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url: newbase_url+"control",
			method:"POST",
			data:form_data,
			success:function(data)
			{
                data = JSON.parse(data);
               $('.action_log').attr('disabled',false); 
                if(data.err == 0) {
                    jQuery("html, body").animate({ scrollTop: jQuery(window).height()}, 1500);
                    $('.remove-messages').fadeIn().html('<div  class="alert bg-success errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
                }
                if(data.err == 1) {
                    jQuery("html, body").animate({ scrollTop: jQuery(window).height()}, 1500);
                    $('.remove-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
                }
                if(data.err == 2) {
                    jQuery("html, body").animate({ scrollTop: jQuery(window).height()}, 1500);
                    $('.remove-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start"><small>'+data.form_msg+'</small><button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
                }
            }
        });
	});
    
    $(document).on('submit','#uploadEditImage', function(event){
		event.preventDefault();
		$('#action_pic').attr('disabled','disabled');
        if($('#uploadFile').val()) {
		var allowedTypes = ['png' , 'jpg' , 'jpeg'];
		var FileSize = (document.getElementById("uploadFile").files[0].size/1024)/1024; 
        var file = $('#uploadFile').val().split('\\').pop();
        var fileType = file.allowedTypes;
		var extension = file.substr( (file.lastIndexOf('.') +1) );
		
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
                            data = JSON.parse(data);
                            if(data.err == 0) {
                                //$('.blogCreate')[0].reset();
                                jQuery("html, body").animate({ scrollTop: jQuery(window).height()}, 1500);
                                $('.remove-messages').fadeIn().html('<div  class="alert bg-success errorMessage text-white text-start">'+data.form_msg+'</div>');
                                setTimeout(function(){
                                    $(".remove-messages").fadeOut("slow");
                                },2000);
                                $('#action_pic').attr('disabled',false); 
                            }
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
							
						},
						resetForm: true
					});
				
		} else {
			var form_data = $(this).serialize();
            $.ajax({
                url: newbase_url+"b_edit",
                method:"POST",
                data:form_data,
                success:function(data)
                {
                    data = JSON.parse(data);
                    jQuery("html, body").animate({ scrollTop: jQuery(window).height()}, 1500);
                    $('.remove-messages').fadeIn().html('<div  class="alert bg-success errorMessage text-white text-start">'+data.form_msg+'</div>');
                    setTimeout(function(){
                        $(".remove-messages").fadeOut("slow");
                    },2000);
                    $('#action_pic').attr('disabled',false); 

                }
            });
		}
		return false;
	});
    
    
    $(document).on('submit','#uploadImage', function(event){
		event.preventDefault();
		$('#action_pic').attr('disabled','disabled');
		var allowedTypes = ['png' , 'jpg' , 'jpeg'];
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
                            if(data.err == 0) {
                                $('.blogCreate')[0].reset();
                                jQuery("html, body").animate({ scrollTop: jQuery(window).height()}, 1500);
                                $('.remove-messages').fadeIn().html('<div  class="alert bg-success errorMessage text-white text-start">'+data.form_msg+'</div>');
                                setTimeout(function(){
                                    $(".remove-messages").fadeOut("slow");
                                },2000);
                                $('#action_pic').attr('disabled',false); 
                            }
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
							
						},
						resetForm: true
					});
				
		} else {
			alert("Please Select Image File.") ;
			$('#uploadFile').val('');
			$('#action_pic').attr('disabled',false);
			return false;
		}
		return false;
	});
    
    $(document).on("click",".viewNote", function() {
        var id = $(this).attr("id");
		var btn_action = 'fetch_description';
		$.ajax({
			url:base_url+"control",
			method:"POST",
			data:{id:id, btn_action:btn_action},
			dataType:"json",
			success:function(data)
			{	
			
				$('.openNote').modal('show');
				$('.showDescription').html(data.noteDescription);
			}
		});
	});
    
    var manageZipTable = $('.manageZipTable').DataTable({
        "drawCallback": function( settings ) {
            $('[data-bs-toggle="tooltip"]').tooltip();
        },
		'ajax': base_url+'fetch_all_zip',
		'order': []
	});
    
    var manage_activeZipTable = $('.manage_activeZipTable').DataTable({
        "drawCallback": function( settings ) {
            $('[data-bs-toggle="tooltip"]').tooltip();
        },
		'ajax': base_url+'fetch_active_zip',
		'order': []
	});
    
    var manage_pending_ZipTable = $('.manage_pending_ZipTable').DataTable({
        "drawCallback": function( settings ) {
            $('[data-bs-toggle="tooltip"]').tooltip();
        },
		'ajax': base_url+'fetch_pending_zip',
		'order': []
	});
    
    var manage_featured_Zip_Table = $('.manage_featured_Zip_Table').DataTable({
        "drawCallback": function( settings ) {
            $('[data-bs-toggle="tooltip"]').tooltip();
        },
		'ajax': base_url+'fetch_featured_zip',
		'order': []
	});
    
    var manage_popularZip_Table = $('.manage_popularZip_Table').DataTable({
        "drawCallback": function( settings ) {
            $('[data-bs-toggle="tooltip"]').tooltip();
        },
		'ajax': base_url+'fetch_popular_zip',
		'order': []
	});
    
    $(document).on('click', '.approveZip', function(){
        var id = $(this).attr("id");
        var btn_action = "approve_zip";
        if(confirm("Are your sure you want to approve this zip file ? Press OK to proceed."))
        {
            $.ajax({
                url: base_url+"control",
                method:"POST",
                data:{id:id, btn_action:btn_action},
                success:function(data)
                {
                    $('.remove-messages').fadeIn().html('<div class="alert bg-primary text-white border">'+data+'</div>');
                    setTimeout(function(){
                        $(".remove-messages").fadeOut("slow");
                    },2000);
                    $('[data-bs-toggle="tooltip"]').tooltip('hide');
                    manageZipTable.ajax.reload();
                    manage_activeZipTable.ajax.reload();
                    manage_pending_ZipTable.ajax.reload();
                    manage_featured_Zip_Table.ajax.reload();
                    manage_popularZip_Table.ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
		
    });
    
    $(document).on('click', '.makePopular', function(){
        var id = $(this).attr("id");
        var btn_action = "make_popular";
        if(confirm("Are your sure you want to make popular and unfeatured this zip file ? Press OK to proceed."))
        {
            $.ajax({
                url: base_url+"control",
                method:"POST",
                data:{id:id, btn_action:btn_action},
                success:function(data)
                {
                    $('.remove-messages').fadeIn().html('<div class="alert bg-primary text-white border">'+data+'</div>');
                    setTimeout(function(){
                        $(".remove-messages").fadeOut("slow");
                    },2000);
                    $('[data-bs-toggle="tooltip"]').tooltip('hide');
                    manageZipTable.ajax.reload();
                    manage_activeZipTable.ajax.reload();
                    manage_pending_ZipTable.ajax.reload();
                    manage_featured_Zip_Table.ajax.reload();
                    manage_popularZip_Table.ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
		
    });
    
    $(document).on('click', '.makeUnpopular', function(){
        var id = $(this).attr("id");
        var btn_action = "make_unpopular";
        if(confirm("Are your sure you want to make Unpopular this zip file ? Press OK to proceed."))
        {
            $.ajax({
                url: base_url+"control",
                method:"POST",
                data:{id:id, btn_action:btn_action},
                success:function(data)
                {
                    $('.remove-messages').fadeIn().html('<div class="alert bg-primary text-white border">'+data+'</div>');
                    setTimeout(function(){
                        $(".remove-messages").fadeOut("slow");
                    },2000);
                    $('[data-bs-toggle="tooltip"]').tooltip('hide');
                    manageZipTable.ajax.reload();
                    manage_activeZipTable.ajax.reload();
                    manage_pending_ZipTable.ajax.reload();
                    manage_featured_Zip_Table.ajax.reload();
                    manage_popularZip_Table.ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
		
    });
    
    $(document).on('click', '.makeFeatured', function(){
        var id = $(this).attr("id");
        var btn_action = "make_featured";
        if(confirm("Are your sure you want to make featured and unpopular this zip file ? Press OK to proceed."))
        {
            $.ajax({
                url: base_url+"control",
                method:"POST",
                data:{id:id, btn_action:btn_action},
                success:function(data)
                {
                    $('.remove-messages').fadeIn().html('<div class="alert bg-primary text-white border">'+data+'</div>');
                    setTimeout(function(){
                        $(".remove-messages").fadeOut("slow");
                    },2000);
                    $('[data-bs-toggle="tooltip"]').tooltip('hide');
                    manageZipTable.ajax.reload();
                    manage_activeZipTable.ajax.reload();
                    manage_pending_ZipTable.ajax.reload();
                    manage_featured_Zip_Table.ajax.reload();
                    manage_popularZip_Table.ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
		
    });
    
    $(document).on('click', '.makeUnfeatured', function(){
        var id = $(this).attr("id");
        var btn_action = "make_unfeatured";
        if(confirm("Are your sure you want to make unfeatured this zip file ? Press OK to proceed."))
        {
            $.ajax({
                url: base_url+"control",
                method:"POST",
                data:{id:id, btn_action:btn_action},
                success:function(data)
                {
                    $('.remove-messages').fadeIn().html('<div class="alert bg-primary text-white border">'+data+'</div>');
                    setTimeout(function(){
                        $(".remove-messages").fadeOut("slow");
                    },2000);
                    $('[data-bs-toggle="tooltip"]').tooltip('hide');
                    manageZipTable.ajax.reload();
                    manage_activeZipTable.ajax.reload();
                    manage_pending_ZipTable.ajax.reload();
                    manage_featured_Zip_Table.ajax.reload();
                    manage_popularZip_Table.ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
		
    });
    
    $(document).on('click', '.delZip', function(){
        var id = $(this).attr("id");
        var btn_action = "zip_delete";
        if(confirm("Are your sure you want to delete this zip file ? Press OK to proceed."))
        {
            $.ajax({
                url: base_url+"control",
                method:"POST",
                data:{id:id, btn_action:btn_action},
                success:function(data)
                {
                    $('.remove-messages').fadeIn().html('<div class="alert bg-primary text-white border">'+data+'</div>');
                    setTimeout(function(){
                        $(".remove-messages").fadeOut("slow");
                    },2000);
                    $('[data-bs-toggle="tooltip"]').tooltip('hide');
                    manageZipTable.ajax.reload();
                    manage_activeZipTable.ajax.reload();
                    manage_pending_ZipTable.ajax.reload();
                    manage_featured_Zip_Table.ajax.reload();
                    manage_popularZip_Table.ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
		
    });
    
    $(document).on('click', '.delZipBlockIp', function(){
        var id = $(this).attr("id");
        var btn_action = "zip_delete_block_ip";
        if(confirm("Are your sure you want to delete this zip file & block User Ip ? Press OK to proceed."))
        {
            $.ajax({
                url: base_url+"control",
                method:"POST",
                data:{id:id, btn_action:btn_action},
                success:function(data)
                {
                    $('.remove-messages').fadeIn().html('<div class="alert bg-primary text-white border">'+data+'</div>');
                    setTimeout(function(){
                        $(".remove-messages").fadeOut("slow");
                    },2000);
                    $('[data-bs-toggle="tooltip"]').tooltip('hide');
                    manageZipTable.ajax.reload();
                    manage_activeZipTable.ajax.reload();
                    manage_pending_ZipTable.ajax.reload();
                    manage_featured_Zip_Table.ajax.reload();
                    manage_popularZip_Table.ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
		
    });
    
    var manageBlockedTable = $('.manageBlockedTable').DataTable({
        "drawCallback": function( settings ) {
            $('[data-bs-toggle="tooltip"]').tooltip();
        },
		'ajax': base_url+'ipblock',
		'order': []
	});
    
    $(document).on('click', '.unBlockIp', function(){
        var id = $(this).attr("id");
        var btn_action = "un_block_ip";
        if(confirm("Are your sure you want to unblock User Ip & delete from blacklist? Press OK to proceed."))
        {
            $.ajax({
                url: base_url+"control",
                method:"POST",
                data:{id:id, btn_action:btn_action},
                success:function(data)
                {
                    $('.remove-messages').fadeIn().html('<div class="alert bg-primary text-white border">'+data+'</div>');
                    setTimeout(function(){
                        $(".remove-messages").fadeOut("slow");
                    },2000);
                    $('[data-bs-toggle="tooltip"]').tooltip('hide');
                    manageBlockedTable.ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
		
    });
    
    var manage_CatTable = $('.manage_CatTable').DataTable({
        "drawCallback": function( settings ) {
            $('[data-bs-toggle="tooltip"]').tooltip();
        },
		'ajax': base_url+'fetch_cat',
		'order': []
	});
    
    var manageactive_CatTable = $('.manageactive_CatTable').DataTable({
        "drawCallback": function( settings ) {
            $('[data-bs-toggle="tooltip"]').tooltip();
        },
		'ajax': base_url+'fetch_activecat',
		'order': []
	});
    
    var manage_deactive_CatTable = $('.manage_deactive_CatTable').DataTable({
        "drawCallback": function( settings ) {
            $('[data-bs-toggle="tooltip"]').tooltip();
        },
		'ajax': base_url+'fetch_deactive_cat',
		'order': []
	});
    
    $(document).on("click",".addCategory", function() {
        $('.add_category')[0].reset();
		$('.openAddCategory').modal('show');
	});
    
    $(document).on('submit','.add_category', function(event){
		event.preventDefault();
		$('.action_log').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"control",
			method:"POST",
			data:form_data,
			success:function(data)
			{
                data = JSON.parse(data);
               $('.add_category')[0].reset();
               $('.action_log').attr('disabled',false); 
                if(data.err == 1) {
                    $('.addc-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
                }
                if(data.err == 2) {
                    $('.addc-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
                }
                if(data.err == 0) {
                    $('.openAddCategory').modal('hide');
                    manage_CatTable.ajax.reload();
                    manageactive_CatTable.ajax.reload();
                    manage_deactive_CatTable.ajax.reload();
                }
            }
        });
	});
    
    $(document).on("click",".editCategory", function() {
        var id = $(this).attr("id");
		var btn_action = 'fetch_category';
		$.ajax({
			url:base_url+"control",
			method:"POST",
			data:{id:id, btn_action:btn_action},
			dataType:"json",
			success:function(data)
			{	
			    $('.edit_category_form')[0].reset();
				$('.openEditCategory').modal('show');
				$('.cid').val(data.cid);
				$('.catName').val(data.catName);
			}
		});
	});
    
    $(document).on('submit','.edit_category_form', function(event){
		event.preventDefault();
		$('.action_log').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"control",
			method:"POST",
			data:form_data,
			success:function(data)
			{
                data = JSON.parse(data);               
               $('.action_log').attr('disabled',false); 
                if(data.err == 1) {
                    $('.editc-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
                }
                if(data.err == 2) {
                    $('.editc-messages').fadeIn().html('<div  class="alert bg-danger errorMessage text-white text-start">'+data.form_msg+'<button type="button" class="btn-close float-end hide" aria-label="Close"></button></div>');
                }
                if(data.err == 0) {
                    $('.edit_category_form')[0].reset();
                    $('.openEditCategory').modal('hide');
                    manage_CatTable.ajax.reload();
                    manageactive_CatTable.ajax.reload();
                    manage_deactive_CatTable.ajax.reload();
                }
            }
        });
	});
    
    $(document).on('click', '.disableCategory', function(){
        var id = $(this).attr("id");
        var btn_action = "disable_category";
        if(confirm("Are your sure you want to deactivate this category ? Note : All ZIP files belongs to this category will also be deactivated. Press OK to proceed."))
        {
            $.ajax({
                url: base_url+"control",
                method:"POST",
                data:{id:id, btn_action:btn_action},
                success:function(data)
                {
                    $('.remove-messages').fadeIn().html('<div class="alert bg-primary text-white border">'+data+'</div>');
                    setTimeout(function(){
                        $(".remove-messages").fadeOut("slow");
                    },2000);
                    $('[data-bs-toggle="tooltip"]').tooltip('hide');
                    manage_CatTable.ajax.reload();
                    manageactive_CatTable.ajax.reload();
                    manage_deactive_CatTable.ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
		
    });
    
    $(document).on('click', '.enableCategory', function(){
        var id = $(this).attr("id");
        var btn_action = "enable_category";
        if(confirm("Are your sure you want to activate this category ? Note : All ZIP files belongs to this category will also be activated. Press OK to proceed."))
        {
            $.ajax({
                url: base_url+"control",
                method:"POST",
                data:{id:id, btn_action:btn_action},
                success:function(data)
                {
                    $('.remove-messages').fadeIn().html('<div class="alert bg-primary text-white border">'+data+'</div>');
                    setTimeout(function(){
                        $(".remove-messages").fadeOut("slow");
                    },2000);
                    $('[data-bs-toggle="tooltip"]').tooltip('hide');
                    manage_CatTable.ajax.reload();
                    manageactive_CatTable.ajax.reload();
                    manage_deactive_CatTable.ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
		
    });
    
    $(document).on('click', '.delCategory', function(){
        var id = $(this).attr("id");
        var btn_action = "category_delete";
        if(confirm("Are your sure you want to delete this category ? Note : All zip files belongs to this category will also be deleted. Press OK to proceed."))
        {
            $.ajax({
                url: base_url+"control",
                method:"POST",
                data:{id:id, btn_action:btn_action},
                success:function(data)
                {
                    $('.remove-messages').fadeIn().html('<div class="alert bg-primary text-white border">'+data+'</div>');
                    setTimeout(function(){
                        $(".remove-messages").fadeOut("slow");
                    },2000);
                    $('[data-bs-toggle="tooltip"]').tooltip('hide');
                    manage_CatTable.ajax.reload();
                    manageactive_CatTable.ajax.reload();
                    manage_deactive_CatTable.ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
		
    });
    
    var manage_active_blog_table = $('.manage_active_blog_table').DataTable({
        "drawCallback": function( settings ) {
            $('[data-bs-toggle="tooltip"]').tooltip();
        },
		'ajax': base_url+'fetch_blog_active',
		'order': []
	});
    
    var manage_deactiveblog_table = $('.manage_deactiveblog_table').DataTable({
        "drawCallback": function( settings ) {
            $('[data-bs-toggle="tooltip"]').tooltip();
        },
		'ajax': base_url+'fetchblog_deactive',
		'order': []
	});
    
    $(document).on('click', '.enableBlog', function(){
        var id = $(this).attr("id");
        var btn_action = "enable_blog";
        if(confirm("Are your sure you want to activate this Blog ? Press OK to proceed."))
        {
            $.ajax({
                url: base_url+"control",
                method:"POST",
                data:{id:id, btn_action:btn_action},
                success:function(data)
                {
                    $('.remove-messages').fadeIn().html('<div class="alert bg-primary text-white border">'+data+'</div>');
                    setTimeout(function(){
                        $(".remove-messages").fadeOut("slow");
                    },2000);
                    $('[data-bs-toggle="tooltip"]').tooltip('hide');
                    manage_active_blog_table.ajax.reload();
                    manage_deactiveblog_table.ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
		
    });
    
    $(document).on('click', '.disableBlog', function(){
        var id = $(this).attr("id");
        var btn_action = "disable_blog";
        if(confirm("Are your sure you want to deactivate this Blog ? Press OK to proceed."))
        {
            $.ajax({
                url: base_url+"control",
                method:"POST",
                data:{id:id, btn_action:btn_action},
                success:function(data)
                {
                    $('.remove-messages').fadeIn().html('<div class="alert bg-primary text-white border">'+data+'</div>');
                    setTimeout(function(){
                        $(".remove-messages").fadeOut("slow");
                    },2000);
                    $('[data-bs-toggle="tooltip"]').tooltip('hide');
                    manage_active_blog_table.ajax.reload();
                    manage_deactiveblog_table.ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
		
    });
    
    $(document).on('click', '.delBlog', function(){
        var id = $(this).attr("id");
        var btn_action = "blog_delete";
        if(confirm("Are your sure you want to delete this blog ? It cannot be undone. Press OK to proceed."))
        {
            $.ajax({
                url: base_url+"control",
                method:"POST",
                data:{id:id, btn_action:btn_action},
                success:function(data)
                {
                    $('.remove-messages').fadeIn().html('<div class="alert bg-primary text-white border">'+data+'</div>');
                    setTimeout(function(){
                        $(".remove-messages").fadeOut("slow");
                    },2000);
                    $('[data-bs-toggle="tooltip"]').tooltip('hide');
                    manage_active_blog_table.ajax.reload();
                    manage_deactiveblog_table.ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
		
    });
    
    var manage_active_pagetable = $('.manage_active_pagetable').DataTable({
        "drawCallback": function( settings ) {
            $('[data-bs-toggle="tooltip"]').tooltip();
        },
		'ajax': base_url+'fetch_page_active',
		'order': []
	});
    
    var manage_deactive_page_table = $('.manage_deactive_page_table').DataTable({
        "drawCallback": function( settings ) {
            $('[data-bs-toggle="tooltip"]').tooltip();
        },
		'ajax': base_url+'fetch_page_deactive',
		'order': []
	});
    
    $(document).on('click', '.disablePage', function(){
        var id = $(this).attr("id");
        var btn_action = "disable_page";
        if(confirm("Are your sure you want to deactivate this Page ? Press OK to proceed."))
        {
            $.ajax({
                url: base_url+"control",
                method:"POST",
                data:{id:id, btn_action:btn_action},
                success:function(data)
                {
                    $('.remove-messages').fadeIn().html('<div class="alert bg-primary text-white border">'+data+'</div>');
                    setTimeout(function(){
                        $(".remove-messages").fadeOut("slow");
                    },2000);
                    $('[data-bs-toggle="tooltip"]').tooltip('hide');
                    manage_active_pagetable.ajax.reload();
                    manage_deactive_page_table.ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
		
    });
    
    $(document).on('click', '.enablePage', function(){
        var id = $(this).attr("id");
        var btn_action = "enable_page";
        if(confirm("Are your sure you want to activate this Page ? Press OK to proceed."))
        {
            $.ajax({
                url: base_url+"control",
                method:"POST",
                data:{id:id, btn_action:btn_action},
                success:function(data)
                {
                    $('.remove-messages').fadeIn().html('<div class="alert bg-primary text-white border">'+data+'</div>');
                    setTimeout(function(){
                        $(".remove-messages").fadeOut("slow");
                    },2000);
                    $('[data-bs-toggle="tooltip"]').tooltip('hide');
                    manage_active_pagetable.ajax.reload();
                    manage_deactive_page_table.ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
		
    });
    
    $(document).on('click', '.delPage', function(){
        var id = $(this).attr("id");
        var btn_action = "page_delete";
        if(confirm("Are your sure you want to delete this page ? It cannot be undone. Press OK to proceed."))
        {
            $.ajax({
                url: base_url+"control",
                method:"POST",
                data:{id:id, btn_action:btn_action},
                success:function(data)
                {
                    $('.remove-messages').fadeIn().html('<div class="alert bg-primary text-white border">'+data+'</div>');
                    setTimeout(function(){
                        $(".remove-messages").fadeOut("slow");
                    },2000);
                    $('[data-bs-toggle="tooltip"]').tooltip('hide');
                    manage_active_pagetable.ajax.reload();
                    manage_deactive_page_table.ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
		
    });
    
});