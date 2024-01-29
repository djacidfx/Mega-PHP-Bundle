// JavaScript Document
jQuery(document).ready(function($) {
	
	 "use strict";
    
    var newbase_url = window.location.href ;
	newbase_url = newbase_url.substring(0, newbase_url.substring(0, newbase_url.lastIndexOf("/")).lastIndexOf("/")+1) ;
    
    
	 $(document).on("click","#hide", function() {
		$(".errorMessage").hide();
	 });
    
    $(document).on('click', '.hard_reject', function(){
        $('#hardRejectModal').modal('show');
		$('.hard_reject_form')[0].reset();
		$('.modal-title').html("<i class='fa fa-times'></i> Hard Reject");
		$('#action_hard_reject').val('Hard Reject & Send Email');
		$('.btn_action').val('HardRejectItem');
	});
	 
	 $(document).on('submit','.hard_reject_form', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: newbase_url+"controller/action",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
                if(data == 1) {
                    $('#hardRejectModal').modal('hide');
                    window.location.href = newbase_url+"inreview";
                } else {
                    $('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage">Any Mandatory Field is Missing. Try Again.<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
			}
		})
	});
    
     $(document).on('click', '.soft_reject', function(){
        $('#softRejectModal').modal('show');
		$('.soft_reject_form')[0].reset();
		$('.modal-title').html("<i class='fa fa-exclamation-circle'></i> Soft Reject");
		$('#action_soft_reject').val('Soft Reject & Send Email');
		$('.btn_action').val('SoftRejectItem');
	});
    
    $(document).on('submit','.soft_reject_form', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: newbase_url+"controller/action",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
                if(data == 1) {
                    $('#softRejectModal').modal('hide');
                    window.location.href = newbase_url+"inreview";
                    $('.remove-messages').fadeIn().html('<div class="alert alert-info">Last Item was Soft Rejected Successfully & Email Sent to User.</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
                } else {
                    $('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage">Any Mandatory Field is Missing. Try Again.<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
			}
		})
	});
    
    $(document).on('click','.approve_item', function(event){
		var tempId = $(this).attr("id");
        var btn_action = 'approve_temp_item';
		if(confirm("Do you want to Approve this Item ?"))
			{
				$.ajax({
					url: newbase_url+"controller/action",
					method:"POST",
					data:{tempId:tempId, btn_action:btn_action},
					success:function(data)
					{	
                        if(data == 1){
                            $('.remove-messages').fadeIn().html('<div class="alert alert-info">Last Item has been Approved & Email Sent</div>');
                            setTimeout(function(){
                                $(".remove-messages").fadeOut("slow");
                            },2000);
                            window.location.href = newbase_url+"inreview";
                        }
					}
				})
			}
			else
			{
				return false;
			}
	});
    
    $(document).on('submit','.adminItemUpdate', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: newbase_url+"controller/action",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
                    window.location.href = newbase_url+'itemupdates' ;
            }
		});
	});
	 
});