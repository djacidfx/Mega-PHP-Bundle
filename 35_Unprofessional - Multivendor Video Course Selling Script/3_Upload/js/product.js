// JavaScript Document
jQuery(document).ready(function($) {
	
	 "use strict";
    var vars = location.protocol + '//' + location.host + location.pathname ;    
    var arrVars = vars.split("/");
    arrVars.splice(-3,3)
    var base_url = arrVars.join("/");
    
    $(document).on('click', '.viewPreview', function(){
		$('.previewModal').modal('show');
	});
    
    $(document).on('submit','.selectPay', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$('.actionBtn').attr('disabled','disabled');
		$('.actionBtn').val('Proceeding...');
		$.ajax({
			url: base_url+"/selectPayment",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				data = JSON.parse(data);
                if(data.paymentMethod == '0') {
                    $('.actionBtn').attr('disabled',false);
					$('.actionBtn').val('Proceed To Checkout');
                    $('.remove-message').fadeIn('slow').html('<div  class="alert alert-danger errorMessage">Insufficient Fund in Your Wallet. Add Credit & then Purchase.<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
                }
				if(data.paymentMethod == '1') {
					$('.actionBtn').attr('disabled',false);
					$('.actionBtn').val('Proceed To Checkout');
					$('.previewModal').modal('hide');
					$('.paypalPayModal').modal('show');
					$('.userId').val(data.userId) ;
					$('.itemNumber').val(data.itemNumber) ;
				}
				if(data.paymentMethod == '2') {
					$('.actionBtn').attr('disabled',false);
					$('.actionBtn').val('Proceed To Checkout');
					$('.previewModal').modal('hide');
					$('.stripePayModal').modal('show');
					$('.userId').val(data.userId) ;
					$('.itemNumber').val(data.itemNumber) ;
				}
                if(data.paymentMethod == '3') {
					$('.actionBtn').attr('disabled',false);
					$('.actionBtn').val('Proceed To Checkout');
					$('.previewModal').modal('hide');
					$('.wPayModal').modal('show');
					$('.itemNumber').val(data.itemNumber) ;
				}
			}
		});
	});
    
    $(document).on('click','.lovedItem',function(){
        var itemId = $(this).attr('id');
        var btn_action = "lovedNewItem" ;
        $.ajax({ 
            type: 'POST',
            url: base_url+"/controls",
            data: {itemId:itemId, btn_action:btn_action},
            success:function(data){
                data = JSON.parse(data);
                if(data.err == 0){
                    $('.lovedItem').hide();
                    $('.showlovedItem').show();
                    $('.showlovedItem').html('<a href="#!" class="unlovedItem" id="'+data.itemId+'"><div class="card-header"><h5 class="text-muted align-text-bottom"><i class="fas fa-heart fa-lg text-danger"></i> '+data.newItemLove+' Love</h5></div></a>') ;
                    
                }
            }
        });
     });
    
    $(document).on('click','.unlovedItem',function(){
        var itemId = $(this).attr('id');
        var btn_action = "unlovedNewItem" ;
        $.ajax({ 
            type: 'POST',
            url: base_url+"/controls",
            data: {itemId:itemId, btn_action:btn_action},
            success:function(data){
                data = JSON.parse(data);
                if(data.err == 0){
                    $('.unlovedItem').hide();
                    $('.showunlovedItem').show();
                    $('.showunlovedItem').html('<a href="#!" class="lovedItem" id="'+data.itemId+'"><div class="card-header"><h5 class="text-muted align-text-bottom"><i class="fas fa-heart fa-lg faNewColor"></i> '+data.newItemLove+' Love</h5></div></a>') ;
                    
                }
            }
        });
     });
    
    $(document).on('submit','.postComment', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"/controls",
			method:"POST",
			data:form_data,
			success:function(data)
			{
                $('.postComment')[0].reset();
                $('body').tooltip({selector: '[data-toggle="tooltip"]'});
				$('.jQueryGrabAllComments').prepend(data) ;
			}
		})
	});
    
    $(document).on('submit','.postReply', function(event){
		event.preventDefault();
        var newcommentId = $(this).attr('id');
        newcommentId = newcommentId.replace('postReplyId','');
        newcommentId = newcommentId.trim();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"/controls",
			method:"POST",
			data:form_data,
			success:function(data)
			{
                $('#postReplyId'+newcommentId)[0].reset();
                $('body').tooltip({selector: '[data-toggle="tooltip"]'});
                $('.changeReply'+newcommentId).show() ;
                $('.showSingle'+newcommentId).append(data) ;                
                $(".showReply"+newcommentId).toggle('slow');
				$('.jQueryGrabAllReply'+newcommentId).append(data) ;
			}
		})
	});
    
    $(document).on('click','.viewReplies',function(){
        var commentId = $(this).attr('id');
        $('.changeReply'+commentId).hide() ;
        $(".showReply"+commentId).toggle('slow');
        
     });
    
     $(document).on('click','.show_moreall_item_comments',function(){
        var id = $(this).attr('id');
        $('.show_more_item_comments').hide();
        $('#loader-icon').show();
		var itemId = $(this).attr('class');
		itemId = itemId.replace("show_moreall_item_comments",'');
		itemId = itemId.replace("btn",'');
		itemId = itemId.replace("btn-primary",'');
		itemId = itemId.replace("btn-sm",'');
		itemId = itemId.replace("ann",'');
        itemId = itemId.trim() ;
        $.ajax({
            type:'GET',
			url: base_url+'/moreitemcomments/'+id+'/'+itemId,
            success:function(html){
                $('body').tooltip({selector: '[data-toggle="tooltip"]'});
				$('#loader-icon').hide();
                $('#show_more_item_comments'+id).remove();
                $('.jQueryMoreItemComments').append(html);
            }
        });
    });
    
    $(document).on('click','.reportComment',function(){
        var commentId = $(this).attr('id');
        var btn_action = "reportItemComment" ;
        $.ajax({ 
            type: 'POST',
            url: base_url+"/controls",
            data: {commentId:commentId, btn_action:btn_action},
            success:function(data){
                $('.oldComment'+commentId).html('<div class="row "><div class="col-lg-4 mt-1 text-center"><div class="col-lg-12"><img src="'+base_url+'/img/profile.png" class="img-fluid w-50 rounded-circle"></div></div><div class="col-lg-8 mt-1 text-center mt-5"><h4 class="text-danger"><i class="fas fa-exclamation-circle fa-lg text-danger"></i>&ensp;This Comment is Reported & Under Review</h4></div></div>') ;
            }
        });
     });
    
    $(document).on('click','.reportReply',function(){
        var commentReplyId = $(this).attr('id');
        var btn_action = "reportItemCommentReply" ;
        $.ajax({ 
            type: 'POST',
            url: base_url+"/controls",
            data: {commentReplyId:commentReplyId, btn_action:btn_action},
            success:function(data){
                $('.oldReply'+commentReplyId).html('<div class="col-lg-4 mt-1 text-center"><div class="col-lg-12"><img src="'+base_url+'/img/profile.png" class="img-fluid w-25 rounded-circle"></div></div><div class="col-lg-8  text-center mt-3"><h4 class="text-danger"><i class="fas fa-exclamation-circle fa-lg text-danger"></i>&ensp;This Reply is Reported & Under Review</h4></div><span class="commentDivider border-top "></span>') ;
            }
        });
     });
    
    $(document).on('submit','.postAuthorReply', function(event){
		event.preventDefault();
        var ratingId = $(this).attr('id');
        ratingId = ratingId.replace('postAuthorReplyId','');
        ratingId = ratingId.trim();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"/controls",
			method:"POST",
			data:form_data,
			success:function(data)
			{
                $('#postAuthorReplyId'+ratingId).hide();
                $('body').tooltip({selector: '[data-toggle="tooltip"]'});
				$('.jQueryAuthorReply'+ratingId).html(data) ;
			}
		});
	});
    
    $(document).on('click','.reportRating',function(){
        var ratingId = $(this).attr('id');
        var btn_action = "reportItemRating" ;
        $.ajax({ 
            type: 'POST',
            url: base_url+"/controls",
            data: {ratingId:ratingId, btn_action:btn_action},
            success:function(data){
                $('.showUserRating'+ratingId).html('<div class="row"><div class="col-lg-4 mt-1 text-center"><div class="col-lg-12"><img src="'+base_url+'/img/profile.png" class="img-fluid w-25 rounded-circle"></div></div><div class="col-lg-8 mt-3"><h4 class="text-danger"><i class="fas fa-exclamation-circle fa-lg text-danger"></i>&ensp;This Rating is Reported & Under Review</h4></div></div>') ;
            }
        });
     });
    
    $(document).on('click','.show_moreall_ratings',function(){
        var id = $(this).attr('id');
        $('.show_more_ratings').hide();
        $('#loader-icon').show();
		var itemId = $(this).attr('class');
		itemId = itemId.replace("show_moreall_ratings",'');
		itemId = itemId.replace("btn",'');
		itemId = itemId.replace("btn-primary",'');
		itemId = itemId.replace("btn-sm",'');
		itemId = itemId.replace("ann",'');
        itemId = itemId.trim() ;
        $.ajax({
            type:'GET',
			url: base_url+'/moreitemratings/'+id+'/'+itemId,
            success:function(html){
                $('body').tooltip({selector: '[data-toggle="tooltip"]'});
				$('#loader-icon').hide();
                $('#show_more_ratings'+id).remove();
                $('.jQueryMoreItemRatings').append(html);
            }
        });
    });
    
});