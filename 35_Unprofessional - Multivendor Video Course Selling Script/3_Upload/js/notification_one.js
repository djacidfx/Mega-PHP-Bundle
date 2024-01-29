// JavaScript Document
jQuery(document).ready(function($) {
	
	 "use strict";
	 var base_url = location.protocol + '//' + location.host + location.pathname ;
	 base_url = base_url.substring(0, base_url.lastIndexOf("/") + 1); 
    
    $(".getMyNotifications").on("click", function() {
		var btn_action = "getNotify";
        $('#loader-icon').show();
        $.ajax({
            url: base_url+"notify",
            method:"POST",
            data:{btn_action:btn_action},
            success:function(data)
            {
                $('#loader-icon').hide();
                $('.showNotifications').html(data);

            }
        }) ;
	});
    
    
    
    $(".readAll").on("click", function() {
        var id = $(this).attr('id');
		var btn_action = "allNotificationSeen";
        $.ajax({
            url: base_url+"controls",
            method:"POST",
            data:{id:id , btn_action:btn_action},
            success:function(data)
            {
                window.location.href = base_url+"notifications" ;
            }
        }) ;
	});
    
    $('#signupModal').modal('show');
    $('#reminderModal').modal('show');
    
    $(document).on('click','#action_resend', function(event){
		event.preventDefault();
		$.ajax({
			url: base_url+"resend",
			method:"POST",
			data:$('form.resend_otpform').serialize(),
			success:function(data)
			{	
				data = JSON.parse(data);
				$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data.form_message)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
			}
		})
	});
    
    $(document).on('click','#action_sign', function(event){
		event.preventDefault();
		$.ajax({
			url: base_url+"otpauth",
			method:"POST",
			data:$('form.signup_otpform').serialize(),
			success:function(data)
			{	
				data = JSON.parse(data);
				if(data.err == 1) {
					alert("You missed your chances to verify and You are Permanently Blocked.") ;
					window.location.href = base_url+"logout";
				}
				if(data.err == 0) {
					alert("You've Successfully Verified. Thanks.") ;
					$('#signupModal').modal('hide');
				}
				if(data.err == 2) {
					if(data.chance == 0) {
						alert("You missed your chances to verify and You are Permanently Blocked.") ;
						window.location.href = base_url+"logout";
					} else {
						$('#otp').val('');
						$('.remove-messages').fadeIn().html('<div class="alert alert-danger">'+(data.form_message)+'</div>');
							setTimeout(function(){
								$(".remove-messages").fadeOut("slow");
							},3000);
					}
				}
				
			}
		})
	});
    
}) ;