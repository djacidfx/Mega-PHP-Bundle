// JavaScript Document
jQuery(document).ready(function($) {
    "use strict";
    
    
    var newbase_url = location.protocol + '//' + location.host + location.pathname ;
	newbase_url = newbase_url.substring(0, newbase_url.lastIndexOf("/") + 1);
    
    $(document).on("click","#hide", function() {
		$(".errorMessage").hide();
	});
    
    $(document).on('submit','.donationForm', function(event){
		event.preventDefault();
		$('#action_sb').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url: newbase_url+"control",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				data = JSON.parse(data);
				if(data.err == 1) {
                    grecaptcha.reset() ;
					$('#action_sb').attr('disabled',false);
					$('.remove-messages').fadeIn().html('<div  class="alert-danger errorMessage bg-dark text-danger">'+data.form_msg+'&ensp;<button type="button" class="close float-right btn btn-grey" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				}
                if(data.err == 2) {
                    grecaptcha.reset() ;
					$('#action_sb').attr('disabled',false);
					$('.remove-messages').fadeIn().html('<div  class="alert-danger errorMessage bg-dark text-danger">'+data.form_msg+'&ensp;<button type="button" class="close float-right btn btn-grey" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				}
                if(data.err == 3) {
                    grecaptcha.reset() ;
					$('#action_sb').attr('disabled',false);
					$('.remove-messages').fadeIn().html('<div  class="alert-danger errorMessage bg-dark text-danger">'+data.form_msg+'&ensp;<button type="button" class="close float-right btn btn-grey" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				}
                if(data.err == 0) {
                    $('.stripePayModal').modal('show');
					$('.uname').val(data.uname) ;
					$('.uemail').val(data.uemail) ;
					$('.amount').val(data.amount) ;
                }
			}
		});
	});

});
