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
    
    $(document).on("click",".openUsername", function() {
        $('.UsernameForm')[0].reset();
		$('.cUsername').modal('show');
	});
    
    $(document).on("click",".openPassword", function() {
        $('.PasswordForm')[0].reset();
		$('.adPass').modal('show');
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
                    $('.cUsername').modal('hide');
                    window.location.href = base_url;
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
                    window.location.href = base_url ;
                }
            }
        });
	});
    
    $(document).on("click",".deleteTemp", function() {
		var btn_action = 'delete_temp';
		$.ajax({
			url:base_url+"control",
			method:"POST",
			data:{btn_action:btn_action},
			success:function(data)
			{	
				$('.remove-messages').fadeIn().html('<div class="alert bg-primary text-white border">'+data+'</div>');
                setTimeout(function(){
                    $(".remove-messages").fadeOut("slow");
                },2000);
			}
		});
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
    
    var manageNotesTable = $('.manageNotesTable').DataTable({
        "drawCallback": function( settings ) {
            $('[data-bs-toggle="tooltip"]').tooltip();
        },
		'ajax': base_url+'view_notes',
		'order': []
	});
    
    var manageunReadNotesTable = $('.manage_unreadNotesTable').DataTable({
        "drawCallback": function( settings ) {
            $('[data-bs-toggle="tooltip"]').tooltip();
        },
		'ajax': base_url+'notes_unread',
		'order': []
	});
    
    var manageReadNotesTable = $('.read_manageNotesTable').DataTable({
        "drawCallback": function( settings ) {
            $('[data-bs-toggle="tooltip"]').tooltip();
        },
		'ajax': base_url+'notes_read',
		'order': []
	});
    
    $(document).on('click', '.delNote', function(){
        var id = $(this).attr("id");
        var btn_action = "note_delete";
        if(confirm("Are your sure you want to delete this private note ? Press OK to proceed."))
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
                    manageNotesTable.ajax.reload();
                    manageunReadNotesTable.ajax.reload();
                    manageReadNotesTable.ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
		
    });
    
    $(document).on('click', '.delNoteBlockIp', function(){
        var id = $(this).attr("id");
        var btn_action = "note_delete_block_ip";
        if(confirm("Are your sure you want to delete this private note & block User Ip ? Press OK to proceed."))
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
                    manageNotesTable.ajax.reload();
                    manageunReadNotesTable.ajax.reload();
                    manageReadNotesTable.ajax.reload();
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
    
});