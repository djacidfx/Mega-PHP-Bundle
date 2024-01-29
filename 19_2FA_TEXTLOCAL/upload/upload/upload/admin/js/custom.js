jQuery(document).ready(function($) {
	
	 "use strict";
	 var base_url = location.protocol + '//' + location.host + location.pathname ;
	 base_url = base_url.substring(0, base_url.lastIndexOf("/") + 1);
	 
	  $(document).on("click","#hide", function() {
		$(".errorMessage").hide();
	});
	 $(document).on('submit','#adminlogin_form', function(event){
		event.preventDefault();
		$('#action_log').attr('disabled','disabled');
		$("#action_log").html("Checking...");
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"verify_adminlogin.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('#adminlogin_form')[0].reset();
				if(data == 0) {
					$('#action_log').attr('disabled',false);
					$("#action_log").html('<i class="fas fa-sign-in"></i> Sign in');
					$('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage">Email or Password Wrong. Try Again.<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				} else {
					window.location.href = base_url+"dashboard.php";
				}
			}
		})
	});
	 
});