// JavaScript Document
jQuery(document).ready(function($) {
    "use strict";
    
    var base_url = location.protocol + '//' + location.host + location.pathname ;
    base_url = base_url.substring(0, base_url.lastIndexOf("/") + 1);
    
    $(document).on("click","#hide", function() {
		$(".errorMessage").hide();
	});
    
    var managePostsTable = $('#managePostsTable').DataTable({
        "drawCallback": function( settings ) {
            $('[data-bs-toggle="tooltip"]').tooltip();
        },
		'ajax': base_url+'fetchallpost',
		'order': []
	});
    
    var manageUnseenPostsTable = $('#manageUnseenPostsTable').DataTable({
        "drawCallback": function( settings ) {
            $('[data-bs-toggle="tooltip"]').tooltip();
        },
		'ajax': base_url+'fetchallpostunseen',
		'order': []
	});
    
    var manageSeenPostsTable = $('#manageSeenPostsTable').DataTable({
        "drawCallback": function( settings ) {
            $('[data-bs-toggle="tooltip"]').tooltip();
        },
		'ajax': base_url+'fetchallpostseen',
		'order': []
	});
    
    var manageFeaturedPostsTable = $('#manageFeaturedPostsTable').DataTable({
        "drawCallback": function( settings ) {
            $('[data-bs-toggle="tooltip"]').tooltip();
        },
		'ajax': base_url+'fetchallpostfeatured',
		'order': []
	});
    
    var manageTrendingPostsTable = $('#manageTrendingPostsTable').DataTable({
        "drawCallback": function( settings ) {
            $('[data-bs-toggle="tooltip"]').tooltip();
        },
		'ajax': base_url+'fetchallposttrending',
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
					$('.block-messages').fadeIn().html('<div  class="bg-dark alert alert-danger errorMessage">IP is wrong. Try again.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				} 
                if(data == 2) {
					$('#action_log').attr('disabled',false);
					$("#action_log").html('Block IP');
					$('.block-messages').fadeIn().html('<div  class="bg-dark alert alert-danger errorMessage">This IP is already blocked. Try another.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
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
                    $('.remove-messages').fadeIn().html('<div class="alert bg-dark text-white customBorder">'+data+'</div>');
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
					$("#action_log").html('<i class="bi bi-shield-lock"></i> Login To Mastermind City');
					$('.remove-messages').fadeIn().html('<div  class="bg-dark alert alert-danger errorMessage">Email or Password Wrong. Try Again.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				} 
                if(data == 2) {
					$('#action_log').attr('disabled',false);
                    grecaptcha.reset() ;
					$("#action_log").html('<i class="bi bi-shield-lock"></i> Login To Mastermind City');
					$('.remove-messages').fadeIn().html('<div  class="bg-dark alert alert-danger errorMessage">Spammer is not allowed.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				} 
                if(data == 1) {
					window.location.href = base_url+"dashboard";
				}
			}
		});
	});	
    
    $(document).on('submit','.load_featured_index', function(event){
		event.preventDefault();
		$('.buttonfeaturedindex').attr('disabled','disabled');
		$(".buttonfeaturedindex").html("Saving...");
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action",
			method:"POST",
			data:form_data,
			success:function(data)
			{
               $('.buttonfeaturedindex').attr('disabled',false);
               $(".buttonfeaturedindex").html('<i class="bi bi-gear text-primary"></i> Save Setting'); 
                if(data == 0) {
                    $('.featuremessage').fadeIn().html('<div  class="bg-dark errorMessage text-danger p-3">Number of Post cannot be empty.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 1) {
                    $('.featuremessage').fadeIn().html('<div  class="bg-dark text-success errorMessage p-3">Setting Saved Successfully.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
            }
        });
	});	
    
    $(document).on('submit','.load_featured_sidebar', function(event){
		event.preventDefault();
		$('.buttonfeaturedindexside').attr('disabled','disabled');
		$(".buttonfeaturedindexside").html("Saving...");
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action",
			method:"POST",
			data:form_data,
			success:function(data)
			{
               $('.buttonfeaturedindexside').attr('disabled',false);
               $(".buttonfeaturedindexside").html('<i class="bi bi-gear text-primary"></i> Save Setting'); 
                if(data == 0) {
                    $('.featuremessageside').fadeIn().html('<div  class="bg-dark errorMessage text-danger p-3">Number of Post cannot be empty.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 1) {
                    $('.featuremessageside').fadeIn().html('<div  class="bg-dark text-success errorMessage p-3">Setting Saved Successfully.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
            }
        });
	});
    
    $(document).on('submit','.load_trending_index', function(event){
		event.preventDefault();
		$('.buttontrendingindex').attr('disabled','disabled');
		$(".buttontrendingindex").html("Saving...");
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action",
			method:"POST",
			data:form_data,
			success:function(data)
			{
               $('.buttontrendingindex').attr('disabled',false);
               $(".buttontrendingindex").html('<i class="bi bi-gear text-primary"></i> Save Setting'); 
                if(data == 0) {
                    $('.trendingmessage').fadeIn().html('<div  class="bg-dark errorMessage text-danger p-3">Number of Post cannot be empty.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 1) {
                    $('.trendingmessage').fadeIn().html('<div  class="bg-dark text-success errorMessage p-3">Setting Saved Successfully.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
            }
        });
	});
    
    $(document).on('submit','.load_trending_sidebar', function(event){
		event.preventDefault();
		$('.buttontrendingindexside').attr('disabled','disabled');
		$(".buttontrendingindexside").html("Saving...");
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action",
			method:"POST",
			data:form_data,
			success:function(data)
			{
               $('.buttontrendingindexside').attr('disabled',false);
               $(".buttontrendingindexside").html('<i class="bi bi-gear text-primary"></i> Save Setting'); 
                if(data == 0) {
                    $('.trendingmessageside').fadeIn().html('<div  class="bg-dark errorMessage text-danger p-3">Number of Post cannot be empty.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 1) {
                    $('.trendingmessageside').fadeIn().html('<div  class="bg-dark text-success errorMessage p-3">Setting Saved Successfully.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
            }
        });
	});
    
    $(document).on('submit','.load_new_index', function(event){
		event.preventDefault();
		$('.buttonnewindex').attr('disabled','disabled');
		$(".buttonnewindex").html("Saving...");
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action",
			method:"POST",
			data:form_data,
			success:function(data)
			{
               $('.buttonnewindex').attr('disabled',false);
               $(".buttonnewindex").html('<i class="bi bi-gear text-primary"></i> Save Setting'); 
                if(data == 0) {
                    $('.newmessage').fadeIn().html('<div  class="bg-dark errorMessage text-danger p-3">Number of Post cannot be empty.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 1) {
                    $('.newmessage').fadeIn().html('<div  class="bg-dark text-success errorMessage p-3">Setting Saved Successfully.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
            }
        });
	});
    
    $(document).on('submit','.load_all_featured', function(event){
		event.preventDefault();
		$('.buttonallfeatured').attr('disabled','disabled');
		$(".buttonallfeatured").html("Saving...");
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action",
			method:"POST",
			data:form_data,
			success:function(data)
			{
               $('.buttonallfeatured').attr('disabled',false);
               $(".buttonallfeatured").html('<i class="bi bi-gear text-primary"></i> Save Setting'); 
                if(data == 0) {
                    $('.allfeaturemessage').fadeIn().html('<div  class="bg-dark errorMessage text-danger p-3">Number of Post cannot be empty.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 1) {
                    $('.allfeaturemessage').fadeIn().html('<div  class="bg-dark text-success errorMessage p-3">Setting Saved Successfully.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
            }
        });
	});
    
    $(document).on('submit','.load_all_trending', function(event){
		event.preventDefault();
		$('.buttonalltrending').attr('disabled','disabled');
		$(".buttonalltrending").html("Saving...");
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action",
			method:"POST",
			data:form_data,
			success:function(data)
			{
               $('.buttonalltrending').attr('disabled',false);
               $(".buttonalltrending").html('<i class="bi bi-gear text-primary"></i> Save Setting'); 
                if(data == 0) {
                    $('.alltrendingmessage').fadeIn().html('<div  class="bg-dark errorMessage text-danger p-3">Number of Post cannot be empty.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 1) {
                    $('.alltrendingmessage').fadeIn().html('<div  class="bg-dark text-success errorMessage p-3">Setting Saved Successfully.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
            }
        });
	});
    
    $(document).on('submit','.load_all_new', function(event){
		event.preventDefault();
		$('.buttonallnew').attr('disabled','disabled');
		$(".buttonallnew").html("Saving...");
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action",
			method:"POST",
			data:form_data,
			success:function(data)
			{
               $('.buttonallnew').attr('disabled',false);
               $(".buttonallnew").html('<i class="bi bi-gear text-primary"></i> Save Setting'); 
                if(data == 0) {
                    $('.allnewmessage').fadeIn().html('<div  class="bg-dark errorMessage text-danger p-3">Number of Post cannot be empty.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 1) {
                    $('.allnewmessage').fadeIn().html('<div  class="bg-dark text-success errorMessage p-3">Setting Saved Successfully.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
            }
        });
	});
    
    $(document).on('submit','.load_all_search', function(event){
		event.preventDefault();
		$('.buttonallsearch').attr('disabled','disabled');
		$(".buttonallsearch").html("Saving...");
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action",
			method:"POST",
			data:form_data,
			success:function(data)
			{
               $('.buttonallsearch').attr('disabled',false);
               $(".buttonallsearch").html('<i class="bi bi-gear text-primary"></i> Save Setting'); 
                if(data == 0) {
                    $('.allsearchmessage').fadeIn().html('<div  class="bg-dark errorMessage text-danger p-3">Number of Post cannot be empty.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 1) {
                    $('.allsearchmessage').fadeIn().html('<div  class="bg-dark text-success errorMessage p-3">Setting Saved Successfully.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
            }
        });
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
               $(".buttonga").html('<i class="bi bi-gear text-primary"></i> Save Setting'); 
                if(data == 0) {
                    $('.gamessage').fadeIn().html('<div  class="bg-dark errorMessage text-danger p-3">Analytic Code cannot be empty.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 1) {
                    $('.gamessage').fadeIn().html('<div  class="bg-dark text-success errorMessage p-3">Setting Saved Successfully.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
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
               $(".buttonabout").html('<i class="bi bi-gear text-primary"></i> Save Setting'); 
                if(data == 0) {
                    $('.aboutmessage').fadeIn().html('<div  class="bg-dark errorMessage text-danger p-3">About Us cannot be empty.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 1) {
                    $('.aboutmessage').fadeIn().html('<div  class="bg-dark text-success errorMessage p-3">Setting Saved Successfully.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
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
               $(".buttonextra").html('<i class="bi bi-gear text-primary"></i> Save Setting'); 
                if(data == 0) {
                    $('.extramessage').fadeIn().html('<div  class="bg-dark errorMessage text-danger p-3">Both Fields are mandatory.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 1) {
                    $('.extramessage').fadeIn().html('<div  class="bg-dark text-success errorMessage p-3">Setting Saved Successfully.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
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
               $(".buttonemail").html('<i class="bi bi-gear text-primary"></i> Save Setting'); 
                if(data == 0) {
                    $('.emailmessage').fadeIn().html('<div  class="bg-dark errorMessage text-danger p-3">Password is wrong. Try again.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 1) {
                    $('.pass').val('') ;
                    $('.emailmessage').fadeIn().html('<div  class="bg-dark text-success errorMessage p-3">Email Changed Successfully.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
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
               $(".buttonpass").html('<i class="bi bi-gear text-primary"></i> Save Setting'); 
                if(data == 0) {
                    $('.passmessage').fadeIn().html('<div  class="bg-dark errorMessage text-danger p-3">Old Password is wrong. Try again.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 2) {
                    $('.passmessage').fadeIn().html('<div  class="bg-dark errorMessage text-danger p-3">New & Confirm Password is not matched. Try again.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 3) {
                    $('.passmessage').fadeIn().html('<div  class="bg-dark errorMessage text-danger p-3"><small>Password must contain minimum 8 characters, 1 Uppercase character, 1 Lowercase character & 1 number</small><button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 1) {
                    $('.passmessage').fadeIn().html('<div  class="bg-dark text-success errorMessage p-3">Password Changed Successfully.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
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
               $(".buttonheader970").html('<i class="bi bi-gear text-primary"></i> Save Ad Setting'); 
                if(data == 0) {
                    $('.header970message').fadeIn().html('<div  class="bg-dark errorMessage text-danger p-3">Ad Code is missing. Try Again.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 1) {
                    $('.header970message').fadeIn().html('<div  class="bg-dark text-success errorMessage p-3">Ad Setting Saved Successfully.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
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
               $(".buttonheader320").html('<i class="bi bi-gear text-primary"></i> Save Ad Setting'); 
                if(data == 0) {
                    $('.header320message').fadeIn().html('<div  class="bg-dark errorMessage text-danger p-3">Ad Code is missing. Try Again.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 1) {
                    $('.header320message').fadeIn().html('<div  class="bg-dark text-success errorMessage p-3">Ad Setting Saved Successfully.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
            }
        });
	});
    
    $(document).on('submit','.desktopfeatured300', function(event){
		event.preventDefault();
		$('.buttondesktopfeatured300').attr('disabled','disabled');
		$(".buttondesktopfeatured300").html("Saving...");
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action",
			method:"POST",
			data:form_data,
			success:function(data)
			{
               $('.buttondesktopfeatured300').attr('disabled',false);
               $(".buttondesktopfeatured300").html('<i class="bi bi-gear text-primary"></i> Save Ad Setting'); 
                if(data == 0) {
                    $('.desktopfeatured300message').fadeIn().html('<div  class="bg-dark errorMessage text-danger p-3">Ad Code is missing. Try Again.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 1) {
                    $('.desktopfeatured300message').fadeIn().html('<div  class="bg-dark text-success errorMessage p-3">Ad Setting Saved Successfully.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
            }
        });
	});
    
    $(document).on('submit','.mobilefeatured300', function(event){
		event.preventDefault();
		$('.buttonmobilefeatured300').attr('disabled','disabled');
		$(".buttonmobilefeatured300").html("Saving...");
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action",
			method:"POST",
			data:form_data,
			success:function(data)
			{
               $('.buttonmobilefeatured300').attr('disabled',false);
               $(".buttonmobilefeatured300").html('<i class="bi bi-gear text-primary"></i> Save Ad Setting'); 
                if(data == 0) {
                    $('.mobilefeatured300message').fadeIn().html('<div  class="bg-dark errorMessage text-danger p-3">Ad Code is missing. Try Again.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 1) {
                    $('.mobilefeatured300message').fadeIn().html('<div  class="bg-dark text-success errorMessage p-3">Ad Setting Saved Successfully.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
            }
        });
	});
    
    $(document).on('submit','.desktoptrending300', function(event){
		event.preventDefault();
		$('.buttondesktoptrending300').attr('disabled','disabled');
		$(".buttondesktoptrending300").html("Saving...");
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action",
			method:"POST",
			data:form_data,
			success:function(data)
			{
               $('.buttondesktoptrending300').attr('disabled',false);
               $(".buttondesktoptrending300").html('<i class="bi bi-gear text-primary"></i> Save Ad Setting'); 
                if(data == 0) {
                    $('.desktoptrending300message').fadeIn().html('<div  class="bg-dark errorMessage text-danger p-3">Ad Code is missing. Try Again.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 1) {
                    $('.desktoptrending300message').fadeIn().html('<div  class="bg-dark text-success errorMessage p-3">Ad Setting Saved Successfully.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
            }
        });
	});
    
    $(document).on('submit','.mobiletrending300', function(event){
		event.preventDefault();
		$('.buttonmobiletrending300').attr('disabled','disabled');
		$(".buttonmobiletrending300").html("Saving...");
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action",
			method:"POST",
			data:form_data,
			success:function(data)
			{
               $('.buttonmobiletrending300').attr('disabled',false);
               $(".buttonmobiletrending300").html('<i class="bi bi-gear text-primary"></i> Save Ad Setting'); 
                if(data == 0) {
                    $('.mobiletrending300message').fadeIn().html('<div  class="bg-dark errorMessage text-danger p-3">Ad Code is missing. Try Again.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 1) {
                    $('.mobiletrending300message').fadeIn().html('<div  class="bg-dark text-success errorMessage p-3">Ad Setting Saved Successfully.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
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
               $(".buttonsidebar600").html('<i class="bi bi-gear text-primary"></i> Save Ad Setting'); 
                if(data == 0) {
                    $('.sidebar600message').fadeIn().html('<div  class="bg-dark errorMessage text-danger p-3">Ad Code is missing. Try Again.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 1) {
                    $('.sidebar600message').fadeIn().html('<div  class="bg-dark text-success errorMessage p-3">Ad Setting Saved Successfully.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
            }
        });
	});
    
    $(document).on('submit','.sidebar300', function(event){
		event.preventDefault();
		$('.buttonsidebar300').attr('disabled','disabled');
		$(".buttonsidebar300").html("Saving...");
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action",
			method:"POST",
			data:form_data,
			success:function(data)
			{
               $('.buttonsidebar300').attr('disabled',false);
               $(".buttonsidebar300").html('<i class="bi bi-gear text-primary"></i> Save Ad Setting'); 
                if(data == 0) {
                    $('.sidebar300message').fadeIn().html('<div  class="bg-dark errorMessage text-danger p-3">Ad Code is missing. Try Again.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 1) {
                    $('.sidebar300message').fadeIn().html('<div  class="bg-dark text-success errorMessage p-3">Ad Setting Saved Successfully.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
            }
        });
	});
    
    $(document).on('submit','.commonfeatured300', function(event){
		event.preventDefault();
		$('.buttoncommonfeatured300').attr('disabled','disabled');
		$(".buttoncommonfeatured300").html("Saving...");
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action",
			method:"POST",
			data:form_data,
			success:function(data)
			{
               $('.buttoncommonfeatured300').attr('disabled',false);
               $(".buttoncommonfeatured300").html('<i class="bi bi-gear text-primary"></i> Save Ad Setting'); 
                if(data == 0) {
                    $('.commonfeatured300message').fadeIn().html('<div  class="bg-dark errorMessage text-danger p-3">Ad Code is missing. Try Again.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 1) {
                    $('.commonfeatured300message').fadeIn().html('<div  class="bg-dark text-success errorMessage p-3">Ad Setting Saved Successfully.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
            }
        });
	});
    
    $(document).on('submit','.commontrending300', function(event){
		event.preventDefault();
		$('.buttoncommontrending300').attr('disabled','disabled');
		$(".buttoncommontrending300").html("Saving...");
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action",
			method:"POST",
			data:form_data,
			success:function(data)
			{
               $('.buttoncommontrending300').attr('disabled',false);
               $(".buttoncommontrending300").html('<i class="bi bi-gear text-primary"></i> Save Ad Setting'); 
                if(data == 0) {
                    $('.commontrending300message').fadeIn().html('<div  class="bg-dark errorMessage text-danger p-3">Ad Code is missing. Try Again.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 1) {
                    $('.commontrending300message').fadeIn().html('<div  class="bg-dark text-success errorMessage p-3">Ad Setting Saved Successfully.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
            }
        });
	});
    
    $(document).on('click', '.makeOnlyUnfeatured', function(){
        var id = $(this).attr("id");
        var btn_action = "makeOnlyUnfeaturedPost";
        if(confirm("Are you sure you want to make Unfeatured ?"))
        {
            $.ajax({
                url: base_url+"action",
                method:"POST",
                data:{id:id, btn_action:btn_action},
                success:function(data)
                {
                    $('.remove-messages').fadeIn().html('<div class="alert bg-dark text-white customBorder">'+data+'</div>');
                    setTimeout(function(){
                        $(".remove-messages").fadeOut("slow");
                    },2000);
                    $('[data-bs-toggle="tooltip"]').tooltip('hide');
                    managePostsTable.ajax.reload();
                    manageUnseenPostsTable.ajax.reload();
                    manageSeenPostsTable.ajax.reload();
                    manageFeaturedPostsTable.ajax.reload();
                    manageTrendingPostsTable.ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
		
    });
    
    $(document).on('click', '.makeUnfeaturedTrending', function(){
        var id = $(this).attr("id");
        var btn_action = "makeUnfeaturedTrendingPost";
        if(confirm("Are you sure you want to change status from Featured to Trending ?"))
        {
            $.ajax({
                url: base_url+"action",
                method:"POST",
                data:{id:id, btn_action:btn_action},
                success:function(data)
                {
                    $('.remove-messages').fadeIn().html('<div class="alert bg-dark text-white customBorder">'+data+'</div>');
                    setTimeout(function(){
                        $(".remove-messages").fadeOut("slow");
                    },2000);
                    $('[data-bs-toggle="tooltip"]').tooltip('hide');
                    managePostsTable.ajax.reload();
                    manageUnseenPostsTable.ajax.reload();
                    manageSeenPostsTable.ajax.reload();
                    manageFeaturedPostsTable.ajax.reload();
                    manageTrendingPostsTable.ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
		
    });
    
    $(document).on('click', '.makeOnlyUntrending', function(){
        var id = $(this).attr("id");
        var btn_action = "makeOnlyUntrendingPost";
        if(confirm("Are you sure you want to make UnTrending ?"))
        {
            $.ajax({
                url: base_url+"action",
                method:"POST",
                data:{id:id, btn_action:btn_action},
                success:function(data)
                {
                    $('.remove-messages').fadeIn().html('<div class="alert bg-dark text-white customBorder">'+data+'</div>');
                    setTimeout(function(){
                        $(".remove-messages").fadeOut("slow");
                    },2000);
                    $('[data-bs-toggle="tooltip"]').tooltip('hide');
                    managePostsTable.ajax.reload();
                    manageUnseenPostsTable.ajax.reload();
                    manageSeenPostsTable.ajax.reload();
                    manageFeaturedPostsTable.ajax.reload();
                    manageTrendingPostsTable.ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
		
    });
    
    $(document).on('click', '.makeUnTrendingFeatured', function(){
        var id = $(this).attr("id");
        var btn_action = "makeUnTrendingFeaturedPost";
        if(confirm("Are you sure you want to change status from Trending to Featured ?"))
        {
            $.ajax({
                url: base_url+"action",
                method:"POST",
                data:{id:id, btn_action:btn_action},
                success:function(data)
                {
                    $('.remove-messages').fadeIn().html('<div class="alert bg-dark text-white customBorder">'+data+'</div>');
                    setTimeout(function(){
                        $(".remove-messages").fadeOut("slow");
                    },2000);
                    $('[data-bs-toggle="tooltip"]').tooltip('hide');
                    managePostsTable.ajax.reload();
                    manageUnseenPostsTable.ajax.reload();
                    manageSeenPostsTable.ajax.reload();
                    manageFeaturedPostsTable.ajax.reload();
                    manageTrendingPostsTable.ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
		
    });
    
    $(document).on('click', '.makeOnlyFeatured', function(){
        var id = $(this).attr("id");
        var btn_action = "makeOnlyFeaturedPost";
        if(confirm("Are you sure you want to make Featured ?"))
        {
            $.ajax({
                url: base_url+"action",
                method:"POST",
                data:{id:id, btn_action:btn_action},
                success:function(data)
                {
                    $('.remove-messages').fadeIn().html('<div class="alert bg-dark text-white customBorder">'+data+'</div>');
                    setTimeout(function(){
                        $(".remove-messages").fadeOut("slow");
                    },2000);
                    $('[data-bs-toggle="tooltip"]').tooltip('hide');
                    managePostsTable.ajax.reload();
                    manageUnseenPostsTable.ajax.reload();
                    manageSeenPostsTable.ajax.reload();
                    manageFeaturedPostsTable.ajax.reload();
                    manageTrendingPostsTable.ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
		
    });
    
    $(document).on('click', '.makeOnlyTrending', function(){
        var id = $(this).attr("id");
        var btn_action = "makeOnlyTrendingPost";
        if(confirm("Are you sure you want to make Trending ?"))
        {
            $.ajax({
                url: base_url+"action",
                method:"POST",
                data:{id:id, btn_action:btn_action},
                success:function(data)
                {
                    $('.remove-messages').fadeIn().html('<div class="alert bg-dark text-white customBorder">'+data+'</div>');
                    setTimeout(function(){
                        $(".remove-messages").fadeOut("slow");
                    },2000);
                    $('[data-bs-toggle="tooltip"]').tooltip('hide');
                    managePostsTable.ajax.reload();
                    manageUnseenPostsTable.ajax.reload();
                    manageSeenPostsTable.ajax.reload();
                    manageFeaturedPostsTable.ajax.reload();
                    manageTrendingPostsTable.ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
		
    });
    
    $(document).on('click', '.deletePost', function(){
        var id = $(this).attr("id");
        var btn_action = "deletePostComplete";
        if(confirm("Are you sure you want to delete ? It cannot be undone."))
        {
            $.ajax({
                url: base_url+"action",
                method:"POST",
                data:{id:id, btn_action:btn_action},
                success:function(data)
                {
                    $('.remove-messages').fadeIn().html('<div class="alert bg-dark text-white customBorder">'+data+'</div>');
                    setTimeout(function(){
                        $(".remove-messages").fadeOut("slow");
                    },2000);
                    $('[data-bs-toggle="tooltip"]').tooltip('hide');
                    managePostsTable.ajax.reload();
                    manageUnseenPostsTable.ajax.reload();
                    manageSeenPostsTable.ajax.reload();
                    manageFeaturedPostsTable.ajax.reload();
                    manageTrendingPostsTable.ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
		
    });
    
    $(document).on('click', '.deletePostBlock', function(){
        var id = $(this).attr("id");
        var status = $(this).data("status");
        var btn_action = "deletePostBlockComplete";
        if(confirm("Are you sure you want to Delete and Block User IP ? Post Delete cannot be undone."))
        {
            $.ajax({
                url: base_url+"action",
                method:"POST",
                data:{id:id, status:status, btn_action:btn_action},
                success:function(data)
                {
                    $('.remove-messages').fadeIn().html('<div class="alert bg-dark text-white customBorder">'+data+'</div>');
                    setTimeout(function(){
                        $(".remove-messages").fadeOut("slow");
                    },2000);
                    $('[data-bs-toggle="tooltip"]').tooltip('hide');
                    managePostsTable.ajax.reload();
                    manageUnseenPostsTable.ajax.reload();
                    manageSeenPostsTable.ajax.reload();
                    manageFeaturedPostsTable.ajax.reload();
                    manageTrendingPostsTable.ajax.reload();
                }
            })
        }
        else
        {
            return false;
        }
		
    });
    
    $(document).on('submit','.editSecret', function(event){
		event.preventDefault();
		$('.action_sb').attr('disabled','disabled');
		$(".action_sb").html("Editing...");
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action",
			method:"POST",
			data:form_data,
			success:function(data)
			{
               $('.action_sb').attr('disabled',false);
               $(".action_sb").html('<i class="bi bi-pencil-square text-primary"></i> Edit'); 
                if(data == 0) {
                    window.location.reload() ;
                }
                if(data == 1) {
                    $('.remove-messages').fadeIn().html('<div  class="bg-dark text-danger errorMessage p-3">Post Title & Description is mandatory. Try again.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 2) {
                    $('.remove-messages').fadeIn().html('<div  class="bg-dark text-danger errorMessage p-3">Post Title should be unique.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
                if(data == 3) {
                    $('.remove-messages').fadeIn().html('<div  class="bg-dark text-danger errorMessage p-3">Post ID is manipulated.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
            }
        });
	});
    
    $(document).on('submit','.commentReply', function(event){
		event.preventDefault();
        var id = $(this).attr("id");
		$('.action_sb').attr('disabled','disabled');
		$(".action_sb").html("Posting...");
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action",
			method:"POST",
			data:form_data,
			success:function(data)
			{
               $('.action_sb').attr('disabled',false);
               $(".action_sb").html('Mark Seen & Post Reply'); 
                if(data == 0) {
                    $('.showform'+id).fadeIn().html('<div class="alert bg-dark text-white p-2">Comment Seen & Admin reply has been posted.</div>');
                    setTimeout(function(){
                        $('.showform'+id).fadeOut("slow");
                    },3000);
                }
                if(data == 1) {
                    $('.remove-messages').fadeIn().html('<div  class="bg-dark text-danger errorMessage p-3">User Comment & Admin Reply is mandatory. Try again.<button type="button" class="close float-end btn btn-grey mt-n2" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
            }
        });
	});
    
    $(document).on('click','.show_more_allunseencomment',function(){
        var id = $(this).attr('id');
        $('.show_more_unseencomment').hide();
        $('#loader-icon').show();
        id = id.trim() ;
        $.ajax({
            type:'GET',
			url: base_url+'grabunseencomments?id='+id,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_unseencomment'+id).remove();
                $('.jQueryNewUnseenComment').append(html);
            }
        });
    });
    
    $(document).on('click','.show_more_allseencomment',function(){
        var id = $(this).attr('id');
        $('.show_more_seencomment').hide();
        $('#loader-icon').show();
        id = id.trim() ;
        $.ajax({
            type:'GET',
			url: base_url+'grabseencomments?id='+id,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_seencomment'+id).remove();
                $('.jQueryNewSeenComment').append(html);
            }
        });
    });
    
    $('[data-bs-toggle="tooltip"]').tooltip({
                    trigger : 'hover'
                }) ;
    $('[data-bs-toggle="tooltip"]').on('click', function () {
                  $(this).tooltip('hide');
                });
    $(document).on('click', '.markOnlySeen', function(){
        var id = $(this).attr("id");
        var btn_action = "markOnlySeenComment";
        $.ajax({
            url: base_url+"action",
            method:"POST",
            data:{id:id, btn_action:btn_action},
            success:function(data)
            {
                $('.showform'+id).fadeIn().html('<div class="alert bg-dark text-white p-2">Comment Seen & moved into Seen Comment Section.</div>');
                    setTimeout(function(){
                        $('.showform'+id).fadeOut("slow");
                    },3000);
            }
        });   
		
    });
    
    $(document).on('click', '.markOnlyUnSeen', function(){
        var id = $(this).attr("id");
        var btn_action = "markOnlyUnSeenComment";
        $.ajax({
            url: base_url+"action",
            method:"POST",
            data:{id:id, btn_action:btn_action},
            success:function(data)
            {
                $('.showform'+id).fadeIn().html('<div class="alert bg-dark text-white p-2">Comment UnSeen & moved into UnSeen Comment Section.</div>');
                    setTimeout(function(){
                        $('.showform'+id).fadeOut("slow");
                    },3000);
            }
        });   
		
    });
    
    $(document).on('click', '.deleteComment', function(){
        var id = $(this).attr("id");
        var btn_action = "deleteCommentComplete";
        $.ajax({
            url: base_url+"action",
            method:"POST",
            data:{id:id, btn_action:btn_action},
            success:function(data)
            {
                $('.showform'+id).fadeIn().html('<div class="alert bg-dark text-white p-2">Comment has been deleted.</div>');
                    setTimeout(function(){
                        $('.showform'+id).fadeOut("slow");
                    },3000);
            }
        });   
		
    });
    
    $(document).on('click', '.deleteCommentBlock', function(){
        var id = $(this).attr("id");
        var btn_action = "deleteCommentBlockUser";
        var status = $(this).data("status");
        $.ajax({
            url: base_url+"action",
            method:"POST",
            data:{id:id, status:status, btn_action:btn_action},
            success:function(data)
            {
                $('.showform'+id).fadeIn().html('<div class="alert bg-dark text-white p-2">Comment has been deleted & User IP is Blocked.</div>');
                    setTimeout(function(){
                        $('.showform'+id).fadeOut("slow");
                    },3000);
            }
        });   
		
    });
    
}) ;