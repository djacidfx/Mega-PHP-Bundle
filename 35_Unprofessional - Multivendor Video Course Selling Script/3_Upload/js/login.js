// JavaScript Document
jQuery(document).ready(function($) {
	
	 "use strict";
	 var base_url = location.protocol + '//' + location.host + location.pathname ;
	 base_url = base_url.substring(0, base_url.lastIndexOf("/") + 1); 
	 $(document).on("click","#hide", function() {
		$(".errorMessage").hide();
	});
	 $(document).on('submit','#userlogin_form', function(event){
		event.preventDefault();
		$('#action_log').attr('disabled','disabled');
		$("#action_log").html("Checking...");
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"verify",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('#userlogin_form')[0].reset();
				if(data == 0) {
					$('#action_log').attr('disabled',false);
                    grecaptcha.reset() ;
					$("#action_log").html('<i class="fas fa-unlock"></i> Login');
					$('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage">Email / Password is Wrong or Account Deactivated. Try Again.<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				} 
                if(data == 2) {
					$('#action_log').attr('disabled',false);
                    grecaptcha.reset() ;
					$("#action_log").html('<i class="fas fa-unlock"></i> Login');
					$('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage">Spammer is not allowed.<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				} 
                if(data == 1) {
					window.location.href = base_url ;
				}
			}
		});
	});	 
    
    $(document).on("keyup","#username", function(e) {
		var value = $('#username').val();
		var btn_action = 'fetch_username' ;
		var return_text = value.replace(/[^a-z0-9]/g,'');
    	$('#username').val(return_text);
    	if ( value.length > 3 && value != "admin") {
			
			$.ajax({
				url: base_url+"verification",
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
			$('.usernamebtn').attr('disabled','disabled');	
		}
	});
    
    $(document).on('submit','#usersignup_form', function(event){
		event.preventDefault();
		$('.usernamebtn').attr('disabled','disabled');
		$(".usernamebtn").html("Creating...");
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"verification",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('#usersignup_form')[0].reset();
				if(data == 0) {
					$('.usernamebtn').attr('disabled',false);
                    grecaptcha.reset() ;
					$(".usernamebtn").html('<i class="fas fa-user-plus"></i> Sign Up');
					$('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage">Email / Username is already exist. Try Again.<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				} 
                if(data == 2) {
					$('.usernamebtn').attr('disabled',false);
                    grecaptcha.reset() ;
					$(".usernamebtn").html('<i class="fas fa-user-plus"></i> Sign Up');
					$('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage">Spammer is not allowed.<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				} 
                if(data == 3) {
					$('.usernamebtn').attr('disabled',false);
                    grecaptcha.reset() ;
					$(".usernamebtn").html('<i class="fas fa-user-plus"></i> Sign Up');
					$('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage"><small>Password must contain 8 characters, an uppercase character, a lowercase character & atleast 1 number. Try Again</small>.<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				} 
                if(data == 1) {
					window.location.href = base_url ;
				}
			}
		});
	});
    
    $(document).on('submit','.forgot_form', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"vemail",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('.forgot_form')[0].reset();
				if(data == 0) {
                    grecaptcha.reset() ;
					$('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage">Sorry, Email is not Registered. <button type="button" class="close float-right " aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				} 
                if(data == 2) {
                    grecaptcha.reset() ;
					$('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage">Spammer is not allowed.<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				} 
                data = JSON.parse(data);
                if(data.err == 1) {
                    grecaptcha.reset() ;
					$('#forgotModal').modal('show');
					$('#forgotemail').val(data.email);
				}
			}
		})
	});
    
	$(document).on('submit','#forgot_otpform', function(event){
		event.preventDefault();
		$('#action_fp').attr('disabled','disabled');
		$("#action_fp").html("Checking...");
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"votp",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('#forgot_otpform')[0].reset();
				$('#forgotModal').modal('hide');
				$('#action_fp').attr('disabled',false);
				if(data == 0) {
                    grecaptcha.reset() ;
					$('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage">Wrong OTP Entered. Try Again.<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				} else {
                    grecaptcha.reset() ;
					$('#forgotpasswordModal').modal('show');
					$('#forgotpasswordemail').val(data) ;
				}
			}
		})
	});
    
	$(document).on('submit','#forgotpassword_otpform', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"cpass",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('#forgotpassword_otpform')[0].reset();
				$('#forgotpasswordModal').modal('hide');
				if(data == 0) {
                    grecaptcha.reset() ;
					$('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage"><small>Password must contain 8 characters, an uppercase character, a lowercase character & atleast 1 number. Try Again.</small><button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				}
				if(data == 1) {
                    grecaptcha.reset() ;
					$('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage"><small>New Password & Confirm New Password are not same. Try Again.</small><button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				}
				if(data == 2) {
                    grecaptcha.reset() ;
					$('.remove-messages').fadeIn().html('<div  class="alert alert-success errorMessage">Password changed successfully. Login Now.<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				}
			}
		})
	});
    
    
});