// JavaScript Document
jQuery(document).ready(function($) {
	
	 "use strict";
	 var base_url = location.protocol + '//' + location.host + location.pathname ;
	 base_url = base_url.substring(0, base_url.lastIndexOf("/") + 1); 
    
    var newbase_url = window.location.href ;
	newbase_url = newbase_url.substring(0, newbase_url.substring(0, newbase_url.lastIndexOf("/")).lastIndexOf("/")+1) ;
    
    var currentLocation = window.location;
        
    var manageHrTitleTable = $('.manageHrTitleTable').DataTable({
		'ajax': base_url+'hrtitle',
		'order': []
	});
    
    var manageHrReasonTable = $('.manageHrReasonTable').DataTable({
		'ajax': base_url+'hrsubject',
		'order': []
	});
    
    var manageForumCategoryTable = $('.manageForumCategoryTable').DataTable({
		'ajax': base_url+'forumcategorylist',
		'order': []
	});
    
    var manageForumTopicTable = $('.manageForumTopicTable').DataTable({
		'ajax': base_url+'forumunreadtopiclist',
		'order': []
	});
    
    var manageForumSeenTopicTable = $('.manageForumSeenTopicTable').DataTable({
		'ajax': base_url+'forumseentopiclist',
		'order': []
	});
    
    var managePendingDisputeTable = $('.managePendingDisputeTable').DataTable({
		'ajax': base_url+'disputelist',
		'order': []
	});
    
    var manageSolvedDisputeTable = $('.manageSolvedDisputeTable').DataTable({
		'ajax': base_url+'solveddisputelist',
		'order': []
	});
    
    var managePagesTable = $('.managePagesTable').DataTable({
		'ajax': base_url+'pagelist',
		'order': []
	});
    
    var nonFeaturedItemTable = $('.nonFeaturedItemTable').DataTable({
		'ajax': base_url+'nonfeaturedlist',
		'order': []
	});
    
    var FeaturedItemTable = $('.FeaturedItemTable').DataTable({
		'ajax': base_url+'featuredlist',
		'order': []
	});
    
    var SendPayoutTable = $('.SendPayoutTable').DataTable({
		'ajax': base_url+'payoutlist',
		'order': []
	});
    
    var PaidPayoutTable = $('.PaidPayoutTable').DataTable({
		'ajax': base_url+'paidlist',
		'order': []
	});
    
    var ItemPaymentTable = $('.ItemPaymentTable').DataTable({
		'ajax': base_url+'itempaylist',
		'order': []
	});
    
    var WalletPaymentTable = $('.WalletPaymentTable').DataTable({
		'ajax': base_url+'walletpaylist',
		'order': []
	});
    
    var manageCommentReportTable = $('.manageCommentReportTable').DataTable({
		'ajax': base_url+'reportcommentlist',
		'order': []
	});
    
    var manageCommentReplyReportTable = $('.manageCommentReplyReportTable').DataTable({
		'ajax': base_url+'reportreplylist',
		'order': []
	});
    
    var manageRatingReportTable = $('.manageRatingReportTable').DataTable({
		'ajax': base_url+'reportratinglist',
		'order': []
	});
    
    var activeItemTable = $('.activeItemTable').DataTable({
		'ajax': base_url+'activelist',
		'order': []
	});
    
    var disableItemTable = $('.disableItemTable').DataTable({
		'ajax': base_url+'disabledlist',
		'order': []
	});
    
    var pausedItemTables = $('.pausedItemTables').DataTable({
		'ajax': base_url+'pausedlist',
		'order': []
	});
    
    var activeUsersTable = $('.activeUsersTable').DataTable({
		'ajax': base_url+'actuserlist',
		'order': []
	});
    
    var blockedUsersTable = $('.blockedUsersTable').DataTable({
		'ajax': base_url+'blkuserlist',
		'order': []
	});
    
	 $(document).on("click","#hide", function() {
		$(".errorMessage").hide();
	 });
    
     $(document).on('click','.addCredit', function(event){
		var id = $(this).attr("id");
        var btn_action = 'fetchUserDetails';
        $.ajax({
            url: base_url+"controller/action",
            method:"POST",
            data:{id:id, btn_action:btn_action},
            dataType:"json",
            success:function(data)
            {	
                $('.addcredit_form')[0].reset();
                $('.addcreditModal').modal('show');
                $('.fullname').val(data.fullname) ;
                $('.username').val(data.username) ;
                $('.walletbalance').val(data.walletbalance) ;
                $('.userId').val(data.userId) ;
            }
        });
			
	});
    
    $(document).on('submit','.addcredit_form', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"controller/action",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
                $('.addcreditModal').modal('hide');
                $('.remove-messages').fadeIn().html('<div  class="alert alert-primary errorMessage"><small>'+data+'</small><button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide" class="ml-2">&times;</span></button></div>');			
                activeUsersTable.ajax.reload();
			}
		});
	});
    
    $(document).on('click','.blockUser', function(event){
		var id = $(this).attr("id");
        var btn_action = 'blockActiveUser';
		if(confirm("Do you want to Block this User ? You can unblock anytime."))
			{
				$.ajax({
					url: base_url+"controller/action",
					method:"POST",
					data:{id:id, btn_action:btn_action},
					success:function(data)
					{	
						$('.remove-messages').fadeIn().html('<div  class="alert alert-primary errorMessage">'+data+'<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                        activeUsersTable.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
	});
    
    $(document).on('click','.unblockUser', function(event){
		var id = $(this).attr("id");
        var btn_action = 'unblockVerifiedUser';
		if(confirm("Do you want to Unblock this User ? You can block anytime."))
			{
				$.ajax({
					url: base_url+"controller/action",
					method:"POST",
					data:{id:id, btn_action:btn_action},
					success:function(data)
					{	
						$('.remove-messages').fadeIn().html('<div  class="alert alert-primary errorMessage">'+data+'<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                        blockedUsersTable.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
	});
    
    $(document).on('click','.deleteDisabledItem', function(event){
		var id = $(this).attr("id");
        var btn_action = 'completedeleteDisabledItem';
		if(confirm("Do you want to Delete this Item ? It cannot be undone."))
			{
				$.ajax({
					url: base_url+"controller/action",
					method:"POST",
					data:{id:id, btn_action:btn_action},
					success:function(data)
					{	
						$('.remove-messages').fadeIn().html('<div  class="alert alert-primary errorMessage">'+data+'<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                        disableItemTable.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
	});
    
    $(document).on('click','.enableItem', function(event){
		var id = $(this).attr("id");
        var btn_action = 'enableDisabledItem';
		if(confirm("Do you want to Enable this Item ? User can Purchase or Download."))
			{
				$.ajax({
					url: base_url+"controller/action",
					method:"POST",
					data:{id:id, btn_action:btn_action},
					success:function(data)
					{	
						$('.remove-messages').fadeIn().html('<div  class="alert alert-primary errorMessage">'+data+'<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                        disableItemTable.ajax.reload();
                        pausedItemTables.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
	});
    
    $(document).on('click','.disableItem', function(event){
		var id = $(this).attr("id");
        var btn_action = 'disableActiveItem';
		if(confirm("Do you want to Disable this Item ? User cannot Purchase or Download."))
			{
				$.ajax({
					url: base_url+"controller/action",
					method:"POST",
					data:{id:id, btn_action:btn_action},
					success:function(data)
					{	
						$('.remove-messages').fadeIn().html('<div  class="alert alert-primary errorMessage">'+data+'<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                        activeItemTable.ajax.reload();
                        pausedItemTables.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
	});
    
    $(document).on('click','.deleteRatingRep', function(event){
		var id = $(this).attr("id");
        var btn_action = 'deleteReportedRating';
		if(confirm("Do you want to Delete Rating ? It cannot be undone."))
			{
				$.ajax({
					url: base_url+"controller/action",
					method:"POST",
					data:{id:id, btn_action:btn_action},
					success:function(data)
					{	
						$('.remove-messages').fadeIn().html('<div  class="alert alert-primary errorMessage">'+data+'<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                        manageRatingReportTable.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
	});
    
    $(document).on('click','.denyDeleteRatingRep', function(event){
		var id = $(this).attr("id");
        var btn_action = 'denyReportedRating';
        $.ajax({
            url: base_url+"controller/action",
            method:"POST",
            data:{id:id, btn_action:btn_action},
            success:function(data)
            {	
                $('.remove-messages').fadeIn().html('<div  class="alert alert-primary errorMessage">'+data+'<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                manageRatingReportTable.ajax.reload();
            }
        });			
	});
    
    $(document).on('click','.deleteComment', function(event){
		var id = $(this).attr("id");
        var btn_action = 'deleteReportedComment';
		if(confirm("Do you want to Delete Comment & Comment Replies ? It cannot be undone."))
			{
				$.ajax({
					url: base_url+"controller/action",
					method:"POST",
					data:{id:id, btn_action:btn_action},
					success:function(data)
					{	
						$('.remove-messages').fadeIn().html('<div  class="alert alert-primary errorMessage">'+data+'<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                        manageCommentReportTable.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
	});
    
    $(document).on('click','.denyDelete', function(event){
		var id = $(this).attr("id");
        var btn_action = 'denyReportedComment';
        $.ajax({
            url: base_url+"controller/action",
            method:"POST",
            data:{id:id, btn_action:btn_action},
            success:function(data)
            {	
                $('.remove-messages').fadeIn().html('<div  class="alert alert-primary errorMessage">'+data+'<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                manageCommentReportTable.ajax.reload();
            }
        });			
	});
    
    $(document).on('click','.deleteCommentReply', function(event){
		var id = $(this).attr("id");
        var btn_action = 'deleteReportedReply';
		if(confirm("Do you want to Delete Comment Reply ? It cannot be undone."))
			{
				$.ajax({
					url: base_url+"controller/action",
					method:"POST",
					data:{id:id, btn_action:btn_action},
					success:function(data)
					{	
						$('.remove-messages').fadeIn().html('<div  class="alert alert-primary errorMessage">'+data+'<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                       manageCommentReplyReportTable.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
	});
    
    $(document).on('click','.denyDeleteReply', function(event){
		var id = $(this).attr("id");
        var btn_action = 'denyReportedReply';
        $.ajax({
            url: base_url+"controller/action",
            method:"POST",
            data:{id:id, btn_action:btn_action},
            success:function(data)
            {	
                $('.remove-messages').fadeIn().html('<div  class="alert alert-primary errorMessage">'+data+'<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                manageCommentReplyReportTable.ajax.reload();
            }
        });			
	});
    
    $(document).on('click','.saleReversal', function(event){
		var id = $(this).attr("id");
        var btn_action = 'itemsaleReversal';
		if(confirm("Do you want to Reverse the Sale ? It cannot be undone and Buyer will be blocked & their Downloads will be Blocked."))
			{
				$.ajax({
					url: base_url+"controller/action",
					method:"POST",
					data:{id:id, btn_action:btn_action},
					success:function(data)
					{	
						$('.remove-messages').fadeIn().html('<div  class="alert alert-primary errorMessage">'+data+'<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                        ItemPaymentTable.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
	});
    
     $(document).on('click','.viewBreakup', function(event){
		var id = $(this).attr("id");
        var status = $(this).data("status");
        var btn_action = 'wantBreakUpModal';
        $.ajax({
            url: base_url+"controller/action",
            method:"POST",
            data:{id:id, status:status, btn_action:btn_action},
            success:function(data)
            {	
                $('.unpaidBreakupModal').modal('show');
                $('.viewPayoutBreakups').html(data) ;
            }
        });
			
	});
    
    $(document).on('click','.authorSendPayout', function(event){
		var id = $(this).attr("id");
        var status = $(this).data("status");
        var btn_action = 'fetchAuthorPayout';
        $.ajax({
            url: base_url+"controller/action",
            method:"POST",
            data:{id:id, status:status, btn_action:btn_action},
            dataType:"json",
            success:function(data)
            {	
                $('.spayout_form')[0].reset();
                $('.spayoutModal').modal('show');
                $('.authorId').val(data.authorId) ;
                $('.payoutEmail').val(data.payoutEmail) ;
                $('.payoutAmt').val(data.payoutAmt) ;
            }
        });
			
	});
    
    $(document).on('submit','.spayout_form', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"controller/action",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
                $('.spayoutModal').modal('hide');
                $('.remove-messages').fadeIn().html('<div  class="alert alert-primary errorMessage"><small>'+data+'</small><button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide" class="ml-2">&times;</span></button></div>');			
                SendPayoutTable.ajax.reload();
			}
		});
	});
    
    $(document).on('click','.makeFeatured', function(event){
		var id = $(this).attr("id");
        var btn_action = 'makeItemFeatured';
		if(confirm("Do you want to Make this Item Featured ? It cannot be undone."))
			{
				$.ajax({
					url: base_url+"controller/action",
					method:"POST",
					data:{id:id, btn_action:btn_action},
					success:function(data)
					{	
						$('.remove-messages').fadeIn().html('<div  class="alert alert-success errorMessage">'+data+'<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                        nonFeaturedItemTable.ajax.reload();
                        FeaturedItemTable.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
	});
    
    $(document).on('click','.makeFeaturedAgain', function(event){
		var id = $(this).attr("id");
        var btn_action = 'makeItemFeaturedAgain';
		if(confirm("Confirm : Featured Again means This Item will be showed as First(New) Featured Item on User Homepage."))
			{
				$.ajax({
					url: base_url+"controller/action",
					method:"POST",
					data:{id:id, btn_action:btn_action},
					success:function(data)
					{	
						$('.remove-messages').fadeIn().html('<div  class="alert alert-success errorMessage">'+data+'<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                        FeaturedItemTable.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
	});
    
    $(document).on('submit','.savePage', function(event){
		event.preventDefault();
		$('#action_page').attr('disabled','disabled'); 
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"controller/action",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				
				if(data == 1) {
					$('#action_page').attr('disabled', false); 
					$('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage">Any of the Mandatory Field is missing.<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				} 
				if(data == 2) {
					$('#action_page').attr('disabled', false); 
					$('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage">Page Slug already used & must be different for every page.<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				} 
				if(data == 0) {
					$('.savePage')[0].reset();
					$('.savePage').hide('slow') ;
					$('.step3').show('slow') ;
				}
			}
		})
	});
    
    $(document).on('submit','.editPage', function(event){
		event.preventDefault();
		$('#action_page').attr('disabled','disabled'); 
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"controller/action",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				
				if(data == 1) {
					$('#action_page').attr('disabled', false); 
					$('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage">Any of the Mandatory Field is missing.<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				} 
				if(data == 2) {
					$('#action_page').attr('disabled', false); 
					$('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage">Page Slug already used & must be different for every page.<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				} 
				if(data == 0) {
					$('.editPage')[0].reset();
					$('.editPage').hide('slow') ;
					$('.step2').show('slow') ;
				}
			}
		})
	});
    
     $(document).on('click', '.changePageStatus', function(){
			var id = $(this).attr("id");
			var status = $(this).data("status");
			var btn_action = "changePageStatus";
			if(confirm("Are you sure you want to change Page Status ?"))
			{
				$.ajax({
					url: base_url+"controller/action",
					method:"POST",
					data:{id:id, status:status, btn_action:btn_action},
					success:function(data)
					{
						$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
						managePagesTable.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
		
		});
    
    $(document).on('keyup','.page_slug', function(){
        var pageSlug = $('.page_slug').val();
		var newPageSlug = pageSlug.replace(/[^A-Za-z]+/g, '');
        $('.page_slug').val(newPageSlug);
		var newUrl = newbase_url + 'page/' + newPageSlug ;
		$('.page_url').val(newUrl);
    });
    
    $(document).on('submit','.admin_settings', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"controller/action",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
                $('.remove-messages').fadeIn().html('<div  class="alert alert-info errorMessage"><small>Main Settings Saved Successfully.</small><button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide" class="ml-2">&times;</span></button></div>');					
			}
		});
	});
    
    $(document).on('submit','.social_settings', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"controller/action",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
                $('.remove-messages').fadeIn().html('<div  class="alert alert-info errorMessage"><small>Social Settings Saved Successfully.</small><button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide" class="ml-2">&times;</span></button></div>');					
			}
		});
	});
    
     $(document).on('submit','.ga_settings', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"controller/action",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
                $('.remove-messages').fadeIn().html('<div  class="alert alert-info errorMessage"><small>Analytic Settings Saved Successfully.</small><button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide" class="ml-2">&times;</span></button></div>');					
			}
		});
	});
    
    $(document).on('click','.adminRefundAction',function(){
        var id = $(this).attr('id');
        var btn_action = "fetchAdminRefundInfo" ;
                $.ajax({ 
                    type: 'POST',
                    url: base_url+"controller/action",
                    data: {id:id, btn_action:btn_action},
                    success:function(data){
                        $('.dispute_form')[0].reset();
                        if(data == 0) {
                            $('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage"><small>Wrong Transaction ID.</small><button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide" class="ml-2">&times;</span></button></div>');
                        } else {
                            data = JSON.parse(data);
                            $('#adminDisputeModal').modal('show');
                            $('.userReason').val(decodeEntities(data.userReason));
                            $('.authorReason').val(decodeEntities(data.authorReason));
                            $('.tsnId').val(data.tsnId) ;
                        }
                    }
                });
            
     });
    
    $(document).on('submit','.dispute_form', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"controller/action",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
                $('#adminDisputeModal').modal('hide');
				$('.dispute_form')[0].reset();
                $('.remove-messages').fadeIn().html('<div  class="alert alert-info errorMessage"><small>Admin Decision has been Processed Successfully.Thanks.</small><button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide" class="ml-2">&times;</span></button></div>');
                managePendingDisputeTable.ajax.reload();					
			}
		});
	});
    
    $(document).on('click','.deleteTopic', function(event){
		var topicId = $(this).attr("id");
        var btn_action = 'delete_forum_topic';
		if(confirm("Do you want to Delete this Topic ? It cannot be undone and All answers will also be deleted."))
			{
				$.ajax({
					url: newbase_url+"controller/action",
					method:"POST",
					data:{topicId:topicId, btn_action:btn_action},
					success:function(data)
					{	
						window.location.href = newbase_url+"unreadtopic";
					}
				})
			}
			else
			{
				return false;
			}
	});
    
    $(document).on('click','.deleteAnswer', function(event){
		var answerId = $(this).attr("id");
        var btn_action = 'delete_forum_topic_answer';
		if(confirm("Do you want to Delete this Answer ? It cannot be undone."))
			{
				$.ajax({
					url: newbase_url+"controller/action",
					method:"POST",
					data:{answerId:answerId, btn_action:btn_action},
					success:function(data)
					{	
						window.location.href = currentLocation;
					}
				})
			}
			else
			{
				return false;
			}
	});
    
     $(document).on('click', '#hr_title', function(){
		$('#hrModal').modal('show');
		$('.hr_form')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Add Hard Reject Title");
		$('#action_hr').val('Save Title');
		$('#btn_action').val('SaveHrTitle');
	});
	 
	 $(document).on('submit','.hr_form', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"controller/action",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
				$('#hrModal').modal('hide');
				$('.hr_form')[0].reset();
				$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
				manageHrTitleTable.ajax.reload();
			}
		})
	});
	 
	 $(document).on('click', '.editHrTitle', function(){												
		var hrId = $(this).attr("id");
		var btn_action = 'fetch_hr_title';
		$('.hr_form')[0].reset();
		$.ajax({
			url:base_url+"controller/action",
			method:"POST",
			data:{hrId:hrId, btn_action:btn_action},
			dataType:"json",
			success:function(data)
			{	
				$('#hrModal').modal('show');
				$('.modal-title').html("<i class='fa fa-pencil-alt'></i> Edit Hard Reject Title");
				$('#hr').val(decodeEntities(data.hrName));
				$('.hrId').val(data.hrId);
				$('#action_hr').val('Edit Title');
				$('#btn_action').val('EditHrTitle');
			}
		})
	});
    
    $(document).on('click','.deactivateHrTitle', function(event){
		var hrId = $(this).attr("id");
        var btn_action = 'deactivate_hr_title';
		if(confirm("Do you want to Deactivate Hard Reject Title ?"))
			{
				$.ajax({
					url: base_url+"controller/action",
					method:"POST",
					data:{hrId:hrId, btn_action:btn_action},
					success:function(data)
					{	
						$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
						manageHrTitleTable.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
	});
    
    $(document).on('click','.activateHrTitle', function(event){
		var hrId = $(this).attr("id");
        var btn_action = 'activate_hr_title';
		if(confirm("Do you want to Activate Hard Reject Title ?"))
			{
				$.ajax({
					url: base_url+"controller/action",
					method:"POST",
					data:{hrId:hrId, btn_action:btn_action},
					success:function(data)
					{	
						$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
						manageHrTitleTable.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
	});
    
    $(document).on('click', '#hr_sub_title', function(){
		$('#hrSubModal').modal('show');
		$('.hr_sub_form')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Add Hard Reject Reason");
		$('#action_hr_sub').val('Save Reason');
		$('#btn_action').val('SaveHrReason');
	});
    
    $(document).on('submit','.hr_sub_form', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"controller/action",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
				$('#hrSubModal').modal('hide');
				$('.hr_sub_form')[0].reset();
				$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
				manageHrReasonTable.ajax.reload();
			}
		})
	});
    
    $(document).on('click', '.editHrSubTitle', function(){												
		var hrSubId = $(this).attr("id");
		var btn_action = 'fetch_hr_sub_title';
		$('.hr_sub_form')[0].reset();
		$.ajax({
			url:base_url+"controller/action",
			method:"POST",
			data:{hrSubId:hrSubId, btn_action:btn_action},
			dataType:"json",
			success:function(data)
			{	
				$('#hrSubModal').modal('show');
				$('.modal-title').html("<i class='fa fa-pencil-alt'></i> Edit Hard Reject Reason");
				$('#hr_reason').val(decodeEntities(data.hr_reason));
				$('.hrSubId').val(data.hrSubId);
				$('#action_hr_sub').val('Edit Reason');
				$('#btn_action').val('EditHrSubTitle');
			}
		})
	});
    
    $(document).on('click','.deactivateHrSubTitle', function(event){
		var hrSubId = $(this).attr("id");
        var btn_action = 'deactivate_hr_sub_title';
		if(confirm("Do you want to Deactivate Hard Reject Reason ?"))
			{
				$.ajax({
					url: base_url+"controller/action",
					method:"POST",
					data:{hrSubId:hrSubId, btn_action:btn_action},
					success:function(data)
					{	
						$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
						manageHrReasonTable.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
	});
    
    $(document).on('click','.activateHrSubTitle', function(event){
		var hrSubId = $(this).attr("id");
        var btn_action = 'activate_hr_sub_title';
		if(confirm("Do you want to Activate Hard Reject Reason ?"))
			{
				$.ajax({
					url: base_url+"controller/action",
					method:"POST",
					data:{hrSubId:hrSubId, btn_action:btn_action},
					success:function(data)
					{	
						$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
						manageHrReasonTable.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
	});
    
    $(document).on('click', '.openForumCategory', function(){
		$('#catModal').modal('show');
		$('.cat_form')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Add Forum Category");
		$('#action_cat').val('Save Category');
		$('#btn_action').val('SaveForumCategory');
	});
    
    $(document).on('submit','.cat_form', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"controller/action",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
				$('#catModal').modal('hide');
				$('.cat_form')[0].reset();
				$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
				manageForumCategoryTable.ajax.reload();
			}
		})
	});
    
    $(document).on('click', '.editForumCategory', function(){												
		var catId = $(this).attr("id");
		var btn_action = 'fetch_forumcategory_title';
		$('.cat_form')[0].reset();
		$.ajax({
			url:base_url+"controller/action",
			method:"POST",
			data:{catId:catId, btn_action:btn_action},
			dataType:"json",
			success:function(data)
			{	
				$('#catModal').modal('show');
				$('.modal-title').html("<i class='fa fa-pencil-alt'></i> Edit Forum Category");
				$('#cat').val(decodeEntities(data.cat));
				$('.catId').val(data.catId);
				$('#action_cat').val('Edit Category Name');
				$('#btn_action').val('EditForumCategory');
			}
		})
	});
    
    $(document).on('click','.changeForumCatStatusToDeactive', function(event){
		var catId = $(this).attr("id");
        var btn_action = 'deactivate_forum_category';
		if(confirm("Do you want to Deactivate Forum Category ? All Previous User Posts will be hidden."))
			{
				$.ajax({
					url: base_url+"controller/action",
					method:"POST",
					data:{catId:catId, btn_action:btn_action},
					success:function(data)
					{	
						$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
						manageForumCategoryTable.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
	});
    
    $(document).on('click','.changeForumCatStatusToActive', function(event){
		var catId = $(this).attr("id");
        var btn_action = 'activate_forum_category';
		if(confirm("Do you want to Activate Forum Category ? All Previous User Posts will be live."))
			{
				$.ajax({
					url: base_url+"controller/action",
					method:"POST",
					data:{catId:catId, btn_action:btn_action},
					success:function(data)
					{	
						$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
						manageForumCategoryTable.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
	});
    
    $(document).on('submit','.password_validation', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"controller/action",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
				$('#password_validation')[0].reset();
				data = JSON.parse(data);
				$('.remove-messages').fadeIn().html('<div class="alert alert-primary">'+(data.form_message)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
			}
		})
	});
    
    $(document).on('submit','.email_validation', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"controller/action",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
				$('#email_validation')[0].reset();
				data = JSON.parse(data);
				$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data.form_message)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
			}
		})
	});
    
    function decodeEntities(encodedString) {
	  var textArea = document.createElement('textarea');
	  textArea.innerHTML = encodedString;
	  return textArea.value;
	}
}) ;