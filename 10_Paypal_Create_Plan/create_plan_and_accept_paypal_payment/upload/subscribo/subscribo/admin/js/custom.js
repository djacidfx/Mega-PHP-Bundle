// JavaScript Document
jQuery(function ($) {
	
	"use strict";
	
	var base_url = location.protocol + '//' + location.host + location.pathname ;
	base_url = base_url.substring(0, base_url.lastIndexOf("/") + 1);
	
	var manageSubscriptionTable = $('#manageSubscriptionTable').DataTable({
		'ajax': base_url+'fetchSubscription.php',
		'order': []
	});
	var manageactiveSubscriptionTable = $('#manageactiveSubscriptionTable').DataTable({
		'ajax': base_url+'fetchactiveSubscription.php',
		'order': []
	});
	var managedeactiveSubscriptionTable = $('#managedeactiveSubscriptionTable').DataTable({
		'ajax': base_url+'fetchdeactiveSubscription.php',
		'order': []
	});
	var managePaymentTable = $('#managePaymentTable').DataTable({
		'ajax': base_url+'fetchPayments.php',
		'order': []
	});
  	$(document).on("click","#hide", function() {
		$(".errorMessage").hide();
	});
	$(document).ready(function(){
		$('.order_date').datepicker({
			format: "yyyy-mm-dd",
			autoclose: true,
			orientation: "top"
		});
	});
	$(document).on('click', '#add_subscription', function(){
		$('#subscriptionModal').modal('show');
		$('#subscription_form')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Add Subscription Plan");
		$('#action_subscribe').val('Add Subscription Plan');
		$('#btn_action_subscribe').val('AddSubscription');
	});
	$(document).on('submit','#subscription_form', function(event){
		event.preventDefault();
		$('#action_subscribe').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action_subscription.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('#subscription_form')[0].reset();
				$('#subscriptionModal').modal('hide');
				$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
				$('#action_subscribe').attr('disabled', false);
				manageSubscriptionTable.ajax.reload();
				manageactiveSubscriptionTable.ajax.reload();
				managedeactiveSubscriptionTable.ajax.reload();
			}
		})
	});
	$(document).on('click', '.editSubscription', function(){
		var subscriptionId = $(this).attr("id");
		var btn_action_subscribe = 'fetch_subscription';
		$.ajax({
			url: base_url+"action_subscription.php",
			method:"POST",
			data:{subscriptionId:subscriptionId, btn_action_subscribe:btn_action_subscribe},
			dataType:"json",
			success:function(data)
			{
				$('#subscriptionModal').modal('show');
				$('#sid').val(data.sid);
				$('#sname').val(data.sname);
				$('#price').val(data.price);
				$('#sdate').val(data.sdate);
				$('.modal-title').html("<i class='fa fa-pencil-alt'></i> Edit Subscription Plan");
				$('#action_subscribe').val('Edit Subcription Plan');
				$('#btn_action_subscribe').val('EditSubscription');
			}
		})
	});
	$(document).on('click', '.changeSubscriptionStatus', function(){
			var subscriptionId = $(this).attr("id");
			var status = $(this).data("status");
			var btn_action_subscribe = "changeSubscriptionStatus";
			if(confirm("Are you sure you want to change Subscription Plan Status?"))
			{
				$.ajax({
					url: base_url+"action_subscription.php",
					method:"POST",
					data:{subscriptionId:subscriptionId, status:status, btn_action_subscribe:btn_action_subscribe},
					success:function(data)
					{
						$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
						manageSubscriptionTable.ajax.reload();
						manageactiveSubscriptionTable.ajax.reload();
						managedeactiveSubscriptionTable.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
		
		});
	$(document).on('submit','.msgForm', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action_message.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
				data = JSON.parse(data);
				$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data.form_message)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
				$('#successmsg').val(data.successmsg) ;
			}
		})
	});
	$(document).on('submit','.password_validation', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action_password_detail.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
				$('#password_validation')[0].reset();
				data = JSON.parse(data);
				$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data.form_message)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},3000);
			}
		})
	});
	
	$(document).on('submit','.email_validation', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action_email_detail.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
				$('#email_validation')[0].reset();
				data = JSON.parse(data);
				$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data.form_message)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},3000);
			}
		})
	});
	
	$(document).on('submit','.paypalemail_validation', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action_paypal_email.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
				$('#passw').val('');
				data = JSON.parse(data);
				$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data.form_message)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
				
				$('#newemail').val(data.email) ;
			}
		})
	});
	
});