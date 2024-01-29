// JavaScript Document
jQuery(document).ready(function($) {
	
	 "use strict";
	 var base_url = location.protocol + '//' + location.host + location.pathname ;
	 base_url = base_url.substring(0, base_url.lastIndexOf("/") + 1); 
    
	 $(document).on("click","#hide", function() {
		$(".errorMessage").hide();
	 });
    
    var manageCategoryTable = $('.managePendingReviewTable').DataTable({
		'ajax': base_url+'reviewlist',
		'order': []
	});
    
    var manageHardRejectTable = $('.manageHardRejectTable').DataTable({
		'ajax': base_url+'hardrejectlist',
		'order': []
	});
    
    var manageSoftRejectTable = $('.manageSoftRejectTable').DataTable({
		'ajax': base_url+'softrejectlist',
		'order': []
	});
    
    var manageDownloadItemTable = $('.manageDownloadItemTable').DataTable({
		'ajax': base_url+'downloaditemlist',
		'order': []
	});
    
    var managePendingItemTable = $('.managePendingItemTable').DataTable({
		'ajax': base_url+'pendinglist',
		'order': []
	});
    
    var manageActiveItemsTable = $('.manageActiveItemsTable').DataTable({
		'ajax': base_url+'activelist',
		'order': []
	});
    
    var manageUnActiveItemsTable = $('.manageUnActiveItemsTable').DataTable({
		'ajax': base_url+'pausedlist',
		'order': []
	});
    
    var manageDeletedItemsTable = $('.manageDeletedItemsTable').DataTable({
		'ajax': base_url+'deletedlist',
		'order': []
	});
    
    var manageUpdateItemsTable = $('.manageUpdateItemsTable').DataTable({
		'ajax': base_url+'updatelist',
		'order': []
	});
    
    var managePurchasesTable = $('.managePurchasesTable').DataTable({
		'ajax': base_url+'purchaselist',
		'order': []
	});
    var managePendingRefundTable = $('.managePendingRefundTable').DataTable({
		'ajax': base_url+'refundlist',
		'order': []
	});
    var manageWalletTable = $('.manageWalletTable').DataTable({
		'ajax': base_url+'wlist',
		'order': []
	});
    
    $(document).on('click','.deleteUserPausedItem', function(event){
		var id = $(this).attr("id");
        var btn_action = 'completedeleteUserPausedItem';
		if(confirm("Do you want to Delete this Item ? It cannot be undone."))
			{
				$.ajax({
					url: base_url+"controls",
					method:"POST",
					data:{id:id, btn_action:btn_action},
					success:function(data)
					{	
						$('.remove_message_pause').fadeIn().html('<div  class="alert alert-primary errorMessage">'+data+'<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                        manageUnActiveItemsTable.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
	});
    
    $(document).on('click','.cancelUpdateItemOld',function(){
        var itemId = $(this).attr('id');
        var btn_action = "cancelUpdate" ;
        if(confirm("Do you want to Cancel Item Update?"))
			{
                $.ajax({ 
                    type: 'POST',
                    url: base_url+"controls",
                    data: {itemId:itemId, btn_action:btn_action},
                    success:function(data){
                        manageUpdateItemsTable.ajax.reload();
                    }
                });
            }
			else
			{
				return false;
			}
     });
    
    $(document).on('click','.pauseItem',function(){
        var itemId = $(this).attr('id');
        var btn_action = "pauseItemSale" ;
        if(confirm("If you Pause, It will not be Temporary Available for Sale . Do you want to Pause Item ?"))
			{
                $.ajax({ 
                    type: 'POST',
                    url: base_url+"controls",
                    data: {itemId:itemId, btn_action:btn_action},
                    success:function(data){
                        $('.remove_message_pause').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
                            setTimeout(function(){
                                $(".remove_message_pause").fadeOut("slow");
                            },2000);
                        manageActiveItemsTable.ajax.reload();
                    }
                });
            }
			else
			{
				return false;
			}
     });
    
    $(document).on('click','.unpauseItem',function(){
        var itemId = $(this).attr('id');
        var btn_action = "unpauseItemSale" ;
        if(confirm("If you Unpause, It will be Available for Sale . Do you want to Unpause Item ?"))
			{
                $.ajax({ 
                    type: 'POST',
                    url: base_url+"controls",
                    data: {itemId:itemId, btn_action:btn_action},
                    success:function(data){
                        $('.remove_message_pause').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
                            setTimeout(function(){
                                $(".remove_message_pause").fadeOut("slow");
                            },2000);
                        manageUnActiveItemsTable.ajax.reload();
                    }
                });
            }
			else
			{
				return false;
			}
     });
    
    $(document).on('click','.refundRaise',function(){
        var id = $(this).attr('id');
        var btn_action = "fetchRefund" ;
        if(confirm("Are you sure, You want to Refund this Item?"))
			{
                $.ajax({ 
                    type: 'POST',
                    url: base_url+"controls",
                    data: {id:id, btn_action:btn_action},
                    success:function(data){
                        $('.refund_form')[0].reset();
                        if(data == 0) {
                            $('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage"><small>Either Transaction is Not Successful or Wrong Transaction ID.</small><button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide" class="ml-2">&times;</span></button></div>');
                        } else {
                            data = JSON.parse(data);
                            $('#refundModal').modal('show');
                            $('#itemName').val(data.itemName);
                            $('.tsnId').val(data.tsnId) ;
                        }
                    }
                });
            }
			else
			{
				return false;
			}
     });
    
    $(document).on('click','.raiseDispute',function(){
        var id = $(this).attr('id');
        var btn_action = "disputeOn" ;
        $.ajax({ 
                    type: 'POST',
                    url: base_url+"controls",
                    data: {id:id, btn_action:btn_action},
                    success:function(data){
                        $('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage"><small>Dispute Raised Successfully. Reviewer will Inform you about Refund Decision.</small><button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide" class="ml-2">&times;</span></button></div>');
                        managePurchasesTable.ajax.reload();	
                    }
          });
            
     });
    
     $(document).on('submit','.refund_form', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"controls",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
                $('#refundModal').modal('hide');
                $('.refund_form')[0].reset();
                $('.remove-messages').fadeIn().html('<div  class="alert alert-info errorMessage"><small>Your Refund has been Submitted.Now, Wait for Author Response.</small><button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide" class="ml-2">&times;</span></button></div>');
                managePurchasesTable.ajax.reload();					
			}
		});
	});
    
    $(document).on('click','.refundAction',function(){
        var id = $(this).attr('id');
        var btn_action = "fetchAuthorRefundInfo" ;
                $.ajax({ 
                    type: 'POST',
                    url: base_url+"controls",
                    data: {id:id, btn_action:btn_action},
                    success:function(data){
                        $('.author_form')[0].reset();
                        if(data == 0) {
                            $('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage"><small>Wrong Transaction ID.</small><button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide" class="ml-2">&times;</span></button></div>');
                        } else {
                            data = JSON.parse(data);
                            $('#authorModal').modal('show');
                            $('.userReason').val(decodeEntities(data.userReason));
                            $('.tsnId').val(data.tsnId) ;
                        }
                    }
                });
            
     });
	 
     $(document).on('submit','.author_form', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"controls",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
                $('#authorModal').modal('hide');
				$('.author_form')[0].reset();
                $('.remove-messages').fadeIn().html('<div  class="alert alert-info errorMessage"><small>Your Decision has been Submitted.Thanks.</small><button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide" class="ml-2">&times;</span></button></div>');
                managePendingRefundTable.ajax.reload();					
			}
		});
	});
    
    function decodeEntities(encodedString) {
	  var textArea = document.createElement('textarea');
	  textArea.innerHTML = encodedString;
	  return textArea.value;
	}
});