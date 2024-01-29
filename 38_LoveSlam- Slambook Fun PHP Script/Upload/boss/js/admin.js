// JavaScript Document
jQuery(document).ready(function($) {
    "use strict";
    
    var base_url = location.protocol + '//' + location.host + location.pathname ;
    base_url = base_url.substring(0, base_url.lastIndexOf("/") + 1);
    
    $(document).on("click","#hide", function() {
		$(".errorMessage").hide();
	});
    
    var manageQuestionsTable = $('#manageQuestionsTable').DataTable({
        "drawCallback": function( settings ) {
            $('[data-bs-toggle="tooltip"]').tooltip();
        },
		'ajax': base_url+'fetchallquestion',
		'order': []
	});
    
    var manageSlamsTable = $('#manageSlamsTable').DataTable({
        "drawCallback": function( settings ) {
            $('[data-bs-toggle="tooltip"]').tooltip();
        },
		'ajax': base_url+'fetchallslams',
		'order': []
	});
    
    var manageSlamsAnswersTable = $('#manageSlamsAnswersTable').DataTable({
        "drawCallback": function( settings ) {
            $('[data-bs-toggle="tooltip"]').tooltip();
        },
		'ajax': base_url+'fetchallanswers',
		'order': []
	});
    
    var manageBlockedTable = $('#manageBlockedTable').DataTable({
        "drawCallback": function( settings ) {
            $('[data-bs-toggle="tooltip"]').tooltip();
        },
		'ajax': base_url+'fetchallblocked',
		'order': []
	});
    
    $(document).on("click",".openManualBlock", function() {
        $('.blockManualIp')[0].reset();
		$('.manualBlock').modal('show');
	});
    
    $(document).on('submit','.blockManualIp', function(event){
		event.preventDefault();
		$('#action_log').attr('disabled','disabled');
		$("#action_log").html("Blocking...");
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				$('.blockManualIp')[0].reset();
				if(data == 0) {
                    $('#action_log').attr('disabled',false);
					$("#action_log").html('Block IP');
                    $('.manualBlock').modal('hide'); 
                    manageBlockedTable.ajax.reload();
				} 
                if(data == 1) {
					$('#action_log').attr('disabled',false);
					$("#action_log").html('Block IP');
					$('.block-messages').fadeIn().html('<div  class="bg-white alert alert-primary errorMessage">IP is wrong. Try again.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				} 
                if(data == 2) {
					$('#action_log').attr('disabled',false);
					$("#action_log").html('Block IP');
					$('.block-messages').fadeIn().html('<div  class="bg-white alert alert-primary errorMessage">This IP is already blocked. Try another.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				} 
			}
		});
	});	
    
    $(document).on('click', '.unblockManualBlock', function(){
        var status = $(this).data("status");
        var btn_action = "deleteBlacklist";
        if(confirm("Are you sure you want to Unblock User IP & Delete from Blacklist ?"))
        {
            $.ajax({
                url: base_url+"action",
                method:"POST",
                data:{status:status, btn_action:btn_action},
                success:function(data)
                {
                    $('.remove-messages').fadeIn().html('<div class="alert bg-white text-primary customBorder">'+data+'</div>');
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
    
    $(document).on("click",".openManualQuest", function() {
        $('.saveQuest')[0].reset();
		$('.manualQuest').modal('show');
        $('.modal-title').html('<i class="bi bi-plus-circle text-danger"></i> Add Question');
        $('.action_log').val('Add');
        $('.btn_action').val('AddQuest');
	});
    
    $(document).on('submit','#adminlogin_form', function(event){
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
				$('#adminlogin_form')[0].reset();
				if(data == 0) {
                    grecaptcha.reset() ;
					$('#action_log').attr('disabled',false);
					$("#action_log").html('<i class="bi bi-shield-lock"></i> Login');
					$('.remove-messages').fadeIn().html('<div  class="bg-light alert alert-danger errorMessage">Email or Password Wrong. Try Again.<button type="button" class="close float-end btn btn-danger mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				} 
                if(data == 2) {
					$('#action_log').attr('disabled',false);
                    grecaptcha.reset() ;
					$("#action_log").html('<i class="bi bi-shield-lock"></i> Login');
					$('.remove-messages').fadeIn().html('<div  class="bg-light alert alert-danger errorMessage">Spammer is not allowed.<button type="button" class="close float-end btn btn-danger mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				} 
                if(data == 1) {
					window.location.href = base_url+"dashboard";
				}
			}
		});
        
    });
        
    $(document).on('submit','.saveQuest', function(event){
		event.preventDefault();
		$('#action_log').attr('disabled','disabled');
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action",
			method:"POST",
			data:form_data,
			success:function(data)
			{
                
				
				if(data == 0) {
					$('#action_log').attr('disabled',false);
					$('.quest-messages').fadeIn().html('<div class="alert bg-white text-primary customBorder">Question cannot be empty. Try again.</div>');
                    setTimeout(function(){
                        $(".quest-messages").fadeOut("slow");
                    },2000);
                    $('[data-bs-toggle="tooltip"]').tooltip('hide');
                    manageQuestionsTable.ajax.reload();
                    
				} else {
                    $('.saveQuest')[0].reset();
                    $('.manualQuest').modal('hide');
                    $('#action_log').attr('disabled',false);
					$('.remove-messages').fadeIn().html('<div class="alert bg-white text-primary customBorder">'+data+'</div>');
                    setTimeout(function(){
                        $(".remove-messages").fadeOut("slow");
                    },2000);
                    $('[data-bs-toggle="tooltip"]').tooltip('hide');
                    manageQuestionsTable.ajax.reload();
				}
			}
		});
        
	});	
    
    $(document).on('click', '.editQuest', function(){		
		var pId = $(this).attr("id");
		var btn_action = 'fetch_quest';
		$.ajax({
			url:base_url+"action",
			method:"POST",
			data:{pId:pId, btn_action:btn_action},
			dataType:"json",
			success:function(data)
			{	
			
                $('.saveQuest')[0].reset();
                $('.manualQuest').modal('show');
                $('.modal-title').html('<i class="bi bi-pencil-square text-danger"></i> Edit Question');
                $('.action_log').val('Edit');
                $('.btn_action').val('EditQuest');
				$('.question').val(decodeEntities(data.question));
				$('.pId').val(data.pId);
			}
		})
	});
    
    $(document).on('click', '.deleteQuest', function(){
        var id = $(this).attr("id");
        var btn_action = "deleteQuestion";
        if(confirm("Are you sure you want to delete question ? It cannot be undone."))
        {
            $.ajax({
                url: base_url+"action",
                method:"POST",
                data:{id:id, btn_action:btn_action},
                success:function(data)
                {
                    $('.remove-messages').fadeIn().html('<div class="alert bg-white text-primary customBorder">'+data+'</div>');
                    setTimeout(function(){
                        $(".remove-messages").fadeOut("slow");
                    },2000);
                    $('[data-bs-toggle="tooltip"]').tooltip('hide');
                    manageQuestionsTable.ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
		
    });
    
    $(document).on('click', '.deleteSlam', function(){
        var id = $(this).attr("id");
        var btn_action = "deleteSlambook";
        if(confirm("Are you sure you want to delete Slam ? Their all answers will also be deleted."))
        {
            $.ajax({
                url: base_url+"action",
                method:"POST",
                data:{id:id, btn_action:btn_action},
                success:function(data)
                {
                    $('.remove-messages').fadeIn().html('<div class="alert bg-white text-primary customBorder">'+data+'</div>');
                    setTimeout(function(){
                        $(".remove-messages").fadeOut("slow");
                    },2000);
                    $('[data-bs-toggle="tooltip"]').tooltip('hide');
                    manageSlamsTable.ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
		
    });
    
    $(document).on('click', '.blockIp', function(){
        var id = $(this).attr("id");
        var btn_action = "blockUserIp";
        if(confirm("Are you sure you want to Block User IP ? You can unblock anytime."))
        {
            $.ajax({
                url: base_url+"action",
                method:"POST",
                data:{id:id, btn_action:btn_action},
                success:function(data)
                {
                    $('.remove-messages').fadeIn().html('<div class="alert bg-white text-primary customBorder">'+data+'</div>');
                    setTimeout(function(){
                        $(".remove-messages").fadeOut("slow");
                    },2000);
                    $('[data-bs-toggle="tooltip"]').tooltip('hide');
                    manageSlamsTable.ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
		
    });
    
    $(document).on('submit','.gaCode', function(event){
		event.preventDefault();
		$('.buttonga').attr('disabled','disabled');
		$(".buttonga").html("Saving...");
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action",
			method:"POST",
			data:form_data,
			success:function(data)
			{
               $('.buttonga').attr('disabled',false);
               $(".buttonga").html('<i class="bi bi-gear text-white"></i> Save Setting'); 
                if(data == 0) {
                    $('.gamessage').fadeIn().html('<div  class="errorMessage text-danger p-3">Analytic Code cannot be empty.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 1) {
                    $('.gamessage').fadeIn().html('<div  class="text-success errorMessage p-3">Setting Saved Successfully.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
            }
        });
	});
    
    $(document).on('submit','.aboutUsInfo', function(event){
		event.preventDefault();
		$('.buttonabout').attr('disabled','disabled');
		$(".buttonabout").html("Saving...");
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action",
			method:"POST",
			data:form_data,
			success:function(data)
			{
               $('.buttonabout').attr('disabled',false);
               $(".buttonabout").html('<i class="bi bi-gear text-white"></i> Save Setting'); 
                if(data == 0) {
                    $('.aboutmessage').fadeIn().html('<div  class=" errorMessage text-danger p-3">About Us cannot be empty.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 1) {
                    $('.aboutmessage').fadeIn().html('<div  class=" text-success errorMessage p-3">Setting Saved Successfully.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
            }
        });
	});
    
    $(document).on('submit','.extraInfo', function(event){
		event.preventDefault();
		$('.buttonextra').attr('disabled','disabled');
		$(".buttonextra").html("Saving...");
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action",
			method:"POST",
			data:form_data,
			success:function(data)
			{
               $('.buttonextra').attr('disabled',false);
               $(".buttonextra").html('<i class="bi bi-gear text-white"></i> Save Setting'); 
                if(data == 0) {
                    $('.extramessage').fadeIn().html('<div  class=" errorMessage text-danger p-3">Both Fields are mandatory.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 1) {
                    $('.extramessage').fadeIn().html('<div  class=" text-success errorMessage p-3">Setting Saved Successfully.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
            }
        });
	});
    
    $(document).on('submit','.changeEmail', function(event){
		event.preventDefault();
		$('.buttonemail').attr('disabled','disabled');
		$(".buttonemail").html("Saving...");
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action",
			method:"POST",
			data:form_data,
			success:function(data)
			{
               $('.buttonemail').attr('disabled',false);
               $(".buttonemail").html('<i class="bi bi-gear text-white"></i> Save Setting'); 
                if(data == 0) {
                    $('.emailmessage').fadeIn().html('<div  class=" errorMessage text-danger p-3">Password is wrong. Try again.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 1) {
                    $('.pass').val('') ;
                    $('.emailmessage').fadeIn().html('<div  class=" text-success errorMessage p-3">Email Changed Successfully.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
            }
        });
	});
    
    $(document).on('submit','.changePassword', function(event){
		event.preventDefault();
		$('.buttonpass').attr('disabled','disabled');
		$(".buttonpass").html("Saving...");
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action",
			method:"POST",
			data:form_data,
			success:function(data)
			{
               $('.changePassword')[0].reset();
               $('.buttonpass').attr('disabled',false);
               $(".buttonpass").html('<i class="bi bi-gear text-white"></i> Save Setting'); 
                if(data == 0) {
                    $('.passmessage').fadeIn().html('<div  class=" errorMessage text-danger p-3">Old Password is wrong. Try again.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 2) {
                    $('.passmessage').fadeIn().html('<div  class=" errorMessage text-danger p-3">New & Confirm Password is not matched. Try again.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 3) {
                    $('.passmessage').fadeIn().html('<div  class=" errorMessage text-danger p-3"><small>Password must contain minimum 8 characters, 1 Uppercase character, 1 Lowercase character & 1 number</small><button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 1) {
                    $('.passmessage').fadeIn().html('<div  class=" text-success errorMessage p-3">Password Changed Successfully.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
            }
        });
	});
    
    $(document).on('submit','.header970', function(event){
		event.preventDefault();
		$('.buttonheader970').attr('disabled','disabled');
		$(".buttonheader970").html("Saving...");
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action",
			method:"POST",
			data:form_data,
			success:function(data)
			{
               $('.buttonheader970').attr('disabled',false);
               $(".buttonheader970").html('<i class="bi bi-gear text-white"></i> Save Ad Setting'); 
                if(data == 0) {
                    $('.header970message').fadeIn().html('<div  class="errorMessage text-danger p-3">Ad Code is missing. Try Again.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 1) {
                    $('.header970message').fadeIn().html('<div  class="text-success errorMessage p-3">Ad Setting Saved Successfully.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
            }
        });
	});
    
    
    $(document).on('submit','.header320', function(event){
		event.preventDefault();
		$('.buttonheader320').attr('disabled','disabled');
		$(".buttonheader320").html("Saving...");
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action",
			method:"POST",
			data:form_data,
			success:function(data)
			{
               $('.buttonheader320').attr('disabled',false);
               $(".buttonheader320").html('<i class="bi bi-gear text-white"></i> Save Ad Setting'); 
                if(data == 0) {
                    $('.header320message').fadeIn().html('<div  class=" errorMessage text-danger p-3">Ad Code is missing. Try Again.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 1) {
                    $('.header320message').fadeIn().html('<div  class=" text-success errorMessage p-3">Ad Setting Saved Successfully.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
            }
        });
	});
    
     $(document).on('submit','.sidebar600', function(event){
		event.preventDefault();
		$('.buttonsidebar600').attr('disabled','disabled');
		$(".buttonsidebar600").html("Saving...");
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action",
			method:"POST",
			data:form_data,
			success:function(data)
			{
               $('.buttonsidebar600').attr('disabled',false);
               $(".buttonsidebar600").html('<i class="bi bi-gear text-white"></i> Save Ad Setting'); 
                if(data == 0) {
                    $('.sidebar600message').fadeIn().html('<div  class=" errorMessage text-danger p-3">Ad Code is missing. Try Again.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 1) {
                    $('.sidebar600message').fadeIn().html('<div  class=" text-success errorMessage p-3">Ad Setting Saved Successfully.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
            }
        });
	});
    
    $(document).on('submit','.sidebar600left', function(event){
		event.preventDefault();
		$('.buttonsidebar600left').attr('disabled','disabled');
		$(".buttonsidebar600left").html("Saving...");
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action",
			method:"POST",
			data:form_data,
			success:function(data)
			{
               $('.buttonsidebar600left').attr('disabled',false);
               $(".buttonsidebar600left").html('<i class="bi bi-gear text-white"></i> Save Ad Setting'); 
                if(data == 0) {
                    $('.sidebar600leftmessage').fadeIn().html('<div  class=" errorMessage text-danger p-3">Ad Code is missing. Try Again.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 1) {
                    $('.sidebar600leftmessage').fadeIn().html('<div  class=" text-success errorMessage p-3">Ad Setting Saved Successfully.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
            }
        });
	});
    
    function decodeEntities(encodedString) {
	  var textArea = document.createElement('textarea');
	  textArea.innerHTML = encodedString;
	  return textArea.value;
	}
    
}) ;