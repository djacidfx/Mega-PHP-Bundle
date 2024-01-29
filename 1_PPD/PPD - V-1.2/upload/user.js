// JavaScript Document
jQuery(document).ready(function($) {
	
	 "use strict";	
	 
	var base_url = window.location.href;
	base_url = base_url.substring(0, base_url.substring(0, base_url.lastIndexOf("/")).lastIndexOf("/")+1) ;
	
	var newbase_url = location.protocol + '//' + location.host + location.pathname ;
	newbase_url = newbase_url.substring(0, newbase_url.lastIndexOf("/") + 1);
	
	activaTab('descr');
	var spinner = $('#loaderCat');
	
	$(document).on("click","#hide", function() {
		$(".errorMessage").hide();
	});
	$(document).on('click', '.viewPreview', function(){
		$('.previewModal').modal('show');
	});
	$(document).on('click', '.selectWalletPay', function(){
		$('.previewWalletModal').modal('show');
	});
	
	$(document).on('submit','.selectPay', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$('.actionBtn').attr('disabled','disabled');
		$('.actionBtn').val('Proceeding...');
		$('#loader-icon').show();
		$.ajax({
			url: base_url+"selectPay.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				data = JSON.parse(data);
				if(data.paymentMethod == '1') {
					$('.actionBtn').attr('disabled',false);
					$('.actionBtn').val('Proceed To Checkout');
					$('.previewModal').modal('hide');
					$('#loader-icon').hide();
					$('.paypalPayModal').modal('show');
					$('.userId').val(data.userId) ;
					$('.itemNumber').val(data.itemNumber) ;
				}
				if(data.paymentMethod == '2') {
					$('.actionBtn').attr('disabled',false);
					$('.actionBtn').val('Proceed To Checkout');
					$('.previewModal').modal('hide');
					$('#loader-icon').hide();
					$('.stripePayModal').modal('show');
					$('.userId').val(data.userId) ;
					$('.itemNumber').val(data.itemNumber) ;
				}
				if(data.paymentMethod == '3') {
					$('.actionBtn').attr('disabled',false);
					$('.actionBtn').val('Proceed To Checkout');
					$('.previewModal').modal('hide');
					$('#loader-icon').hide();
					$('.walletPayModal').modal('show');
					$('.userId').val(data.userId) ;
					$('.itemNumber').val(data.itemNumber) ;
					$('.itemAmount').val(data.itemAmount) ;
				}
				if(data.paymentMethod == '4') {
					$('.actionBtn').attr('disabled',false);
					$('.actionBtn').val('Proceed To Checkout');
					$('.previewModal').modal('hide');
					$('#loader-icon').hide();
					$('.walletInsufficientModal').modal('show');
				}
				
			}
		});
	});
	
	$(document).on('submit','.wallet_validation', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$('.btnCheck').attr('disabled','disabled');
		$('.btnCheck').val('Proceeding...');
		$.ajax({
			url: base_url+"selectWalletPay.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				data = JSON.parse(data);
				if(data.choosePayment == '1') {
					$('.btnCheck').attr('disabled',false);
					$('.btnCheck').val('Proceed To Checkout');
					$('.paypalPayWalletModal').modal('show');
					$('.userId').val(data.userId) ;
					$('.planAmount').val(data.planAmount) ;
					$('.bonusAmount').val(data.bonusAmount) ;
					$('.planId').val(data.planId) ;
					$('.paypalpayactionBtnWallet').val('Pay $'+data.planAmount+' & Add Credit $'+data.totalCredit);
				}
				if(data.choosePayment == '2') {
					$('.btnCheck').attr('disabled',false);
					$('.btnCheck').val('Proceed To Checkout');
					$('.stripeWalletModal').modal('show');
					$('.userId').val(data.userId) ;
					$('.planAmount').val(data.planAmount) ;
					$('.bonusAmount').val(data.bonusAmount) ;
					$('.planId').val(data.planId) ;
					$('.stripepayactionBtnWallet').val('Pay $'+data.planAmount+' & Add Credit $'+data.totalCredit);
				}
				
				
			}
		});
	});
	
	
	$(document).on('change','.paymentMethod', function(){
        var sub_id = $('.paymentMethod').val();
		var status = $(this).data("status"); 
        var btn_action = 'load_price';
        $.ajax({
            url:base_url+"action_price.php",
            method:"POST",
            data:{sub_id:sub_id, status:status, btn_action:btn_action},
            success:function(data)
            {
				data = JSON.parse(data);
                $('.transactionFee').val(data.transactionFee);
			    $('.itemAmount').val(data.total);
				
            }
        });
    });
	
	$(document).on('change','.addWallet', function(){
        var planId = $('.addWallet').val();
		if(planId != '') {
			var btn_action = 'load_plan';
			$.ajax({
				url:base_url+"action_price.php",
				method:"POST",
				data:{planId:planId, btn_action:btn_action},
				success:function(data)
				{
					data = JSON.parse(data);
					$('.bonusAmt').val(data.bonusAmt);
					$('.planAmt').val(data.planAmt);
					$('.btnCheck').val('Proceed To Checkout $'+data.planAmt);
				}
			});
		} else {
			$('.bonusAmt').val('');
			$('.planAmt').val('');
			$('.btnCheck').val('Proceed To Checkout');
		}
    });
	
	$(document).on('click', '.openBtn', function(){
		openSearch() ;
	}) ;
	
	$(document).on('click', '.closebtn', function(){
		closeSearch() ;
	}) ;
	
	$(document).on('click', '.viewVideo', function(){
		var yid = $(this).attr("id");									
		$('.youtubeModal').modal('show');
		$('.modal-title').html('<i class="fa fa-video"></i> Youtube Video');
		$('.modal-body1').html('<div class="embed-responsive embed-responsive-16by9"><iframe  allowfullscreen="allowfullscreen" mozallowfullscreen="mozallowfullscreen"  msallowfullscreen="msallowfullscreen" oallowfullscreen="oallowfullscreen"  webkitallowfullscreen="webkitallowfullscreen" src="https://www.youtube.com/embed/'+yid+'?autoplay=1"></iframe><div>');
		});
		
		$(".youtubeModal").on("hidden.bs.modal", function(){
			$(".modal-body1").html("");
		});
	
	
	
	$(document).on('click','.show_more_newest_search',function(){
        var ID = $(this).attr('id');
        $('.show_more_new_search').hide();
        $('#loader-icon').show();
		var searchWord = $(this).attr('class');
		searchWord = searchWord.replace("show_more_newest_search",'');
		searchWord = searchWord.replace("btn",'');
		searchWord = searchWord.replace("btn-primary",'');
		searchWord = searchWord.replace("btn-sm",'');
		searchWord = searchWord.replace("ann",'');
        $.ajax({
            type:'GET',
			url: base_url+'getLoadSearch.php?ID='+ID+'&searchWord='+searchWord,
            data:{ID:ID,searchWord:searchWord},
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_new_search'+ID).remove();
                $('.jQueryLoadSearchItem').append(html);
            }
        });
    });
	
	
	 $(document).on('click', '.removeLove', function(){
			var id = $(this).attr("id");
			var status = $(this).data("status");
			var btn_action = "removeLoveStatus";
			$.ajax({
				url: base_url+"itemLove.php",
				method:"POST",
				data:{id:id, status:status, btn_action:btn_action},
				success:function(data)
				{
					$(".removeLoveSta"+id).fadeOut("slow");
					$('.oldCount').hide();
					$('.newCount').show();
					$('.newCount').html(data);
				}
			});		
		});
	
	
	$(document).on('click','.show_more_all_loved_item',function(){
        var ID = $(this).attr('id');
        $('.show_more_loved_item').hide();
        $('#loader-icon').show();
        $.ajax({
            type:'POST',
            url: base_url+'getNewLovedItems.php?id='+ID,
            data:'id='+ID,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_loved_item'+ID).remove();
                $('.jQueryNewLovedItem').append(html);
            }
        });
    });
	
	$(document).on('click','.show_more_all_purchased_item',function(){
        var ID = $(this).attr('id');
        $('.show_more_purchased_item').hide();
        $('#loader-icon').show();
        $.ajax({
            type:'POST',
            url: base_url+'getPurchasedItems.php?id='+ID,
            data:'id='+ID,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_purchased_item'+ID).remove();
                $('.jQueryPurchasedItem').append(html);
            }
        });
    });
	
	$(document).on('click','.show_more_all_wallet_item',function(){
        var ID = $(this).attr('id');
        $('.show_more_wallet_item').hide();
        $('#loader-icon').show();
        $.ajax({
            type:'POST',
            url: base_url+'getWalletItems.php?id='+ID,
            data:'id='+ID,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_wallet_item'+ID).remove();
                $('.jQueryWalletItem').append(html);
            }
        });
    });
	
	
	$(document).on('click','.show_more_newest_item',function(){
        var ID = $(this).attr('id');
        $('.show_more_new_item').hide();
        $('#loader-icon').show();
        $.ajax({
            type:'POST',
            url: base_url+'getNewItems.php?id='+ID,
            data:'id='+ID,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_new_item'+ID).remove();
                $('.jQueryNewItem').append(html);
            }
        });
    });
	
	$(document).on('click','.show_more_user_downloaded_item',function(){
        var ID = $(this).attr('id');
        $('.show_more_user_download').hide();
        $('#loader-icon').show();
        $.ajax({
            type:'POST',
            url: base_url+'getDownloadedItems.php?id='+ID,
            data:'id='+ID,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_user_download'+ID).remove();
                $('.jQueryDownloadedItem').append(html);
            }
        });
    });
	
	$(document).on('click','.show_more_category_item',function(){
        var ID = $(this).attr('id');
        $('.show_more_cat_item').hide();
        $('#loader-icon').show();
        $.ajax({
            type:'POST',
            url: base_url+'getCategoryItems.php?id='+ID,
            data:'id='+ID,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_cat_item'+ID).remove();
                $('.jQueryCategoryItem').append(html);
            }
        });
    });
	
	$(document).on('click','.itemLove',function(){
        var id = $(this).attr("id");
		var btn_action = "changeLoveStatus";
		$.ajax({
					url: base_url+"itemLove.php",
					method:"POST",
					data:{id:id, btn_action:btn_action},
					success:function(data)
					{
						$('.loveOld').remove();
						$('.oldCount').hide();
						$('.newCount').show();
						$('.newCount').html(data);
						$('.loveNew').fadeIn().html('<small class="text-muted">Loved</small><br><a href="#!" class="itemUnLove" id='+id+'><i class="fa fa-heart text-danger fa-2x"></i></a>');
					}
				}) ;
    });
	$(document).on('click','.itemUnLove',function(){
        var id = $(this).attr("id");
		var btn_action = "changeUnLoveStatus";
		$.ajax({
					url: base_url+"itemLove.php",
					method:"POST",
					data:{id:id, btn_action:btn_action},
					success:function(data)
					{
						$('.loveOld').remove();
						$('.oldCount').hide();
						$('.newCount').show();
						$('.newCount').html(data);
						$('.loveNew').fadeIn().html('<small class="text-muted">Love</small><br><a href="#!" class="itemLove" id='+id+'><i class="fa fa-heart-o text-danger fa-2x"></i></a>');
					}
				}) ;
    });
	
	
	$(document).on('click','.show_more_category_item',function(){
        var ID = $(this).attr('id');
        $('.show_more_category_item').hide();
        $('#loader-icon').show();
		var subcatId = $(this).attr('class');
		subcatId = subcatId.replace("show_more_category_item",'');
		subcatId = subcatId.replace("btn",'');
		subcatId = subcatId.replace("btn-primary",'');
		subcatId = subcatId.replace("btn-sm",'');
		subcatId = subcatId.replace("ann",'');
		subcatId = $.trim(subcatId);
        $.ajax({
            type:'GET',
			cache: false,
            url: base_url+'getCategoryItems.php?ID='+ID+'&subcatId='+subcatId,
            data:{ID:ID,subcatId:subcatId},
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_newfilter_item'+ID).remove();
                $('.jQueryCategoryItem').append(html);
            }
        });
    });
	
	
	$(document).on('change','.browsenewsubcatitems', function(){
        var subcategory_id = $('.browsenewsubcatitems').val();
        var btn_action = 'load_subcategory_item';
		spinner.show();
        $.ajax({
            url: base_url+"action_load_cat_item.php",
            method:"POST",
            data:{subcategory_id:subcategory_id, btn_action:btn_action},
            success:function(data)
            {
				spinner.hide();
				if(subcategory_id != '') {
					$('.newPro').hide() ;
					$('.fetchNewPro').html(data);
					$('.fetchNewPro').show() ;
					$('.jQueryNewItemAppend').empty();
				} 
            }
        });
    });
	
	
	
	$(document).on('change','.browsenewchildcatitems', function(){
        var childcategory_id = $('.browsenewchildcatitems').val();
        var btn_action = 'load_childcategory_item';
		spinner.show();
        $.ajax({
            url: base_url+"action_load_cat_item.php",
            method:"POST",
            data:{childcategory_id:childcategory_id, btn_action:btn_action},
            success:function(data)
            {
				spinner.hide();
				if(childcategory_id != '') {
					$('.newPro').hide() ;
					$('.fetchNewPro').html(data);
					$('.fetchNewPro').show() ;
					$('.jQueryNewItemAppend').empty();
				} 
            }
        });
    });
	
	$(document).on('click','.show_more_childcatfilter_item',function(){
        var ID = $(this).attr('id');
        $('.show_more_childcatfilter_item').hide();
        $('#loader-icon').show();
		var childcatId = $(this).attr('class');
		childcatId = childcatId.replace("show_more_childcatfilter_item",'');
		childcatId = childcatId.replace("btn",'');
		childcatId = childcatId.replace("btn-light",'');
		childcatId = childcatId.replace("btn-sm",'');
		childcatId = childcatId.replace("ann",'');
		childcatId = $.trim(childcatId);
        $.ajax({
            type:'GET',
			cache: false,
            url: base_url+'getNewFilterChildCatItems.php?ID='+ID+'&childcatId='+childcatId,
            data:{ID:ID,childcatId:childcatId},
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_childcatfilter_item'+ID).remove();
				$('.jQueryNewItemAppend').empty();
				$('.jQueryNewItemAppend').show();
                $('.jQueryNewItemAppend').append(html);
            }
        });
    });
	
	$(document).on('click','.show_more_newfeatured_item',function(){
        var ID = $(this).attr('id');
        $('.show_more_featured_item').hide();
        $('#loader-icon').show();
        $.ajax({
            type:'POST',
            url: base_url+'getFeaturedItems.php?id='+ID,
            data:'id='+ID,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_featured_item'+ID).remove();
                $('.jQueryNewItem').append(html);
				$('.jQueryNewItemAppend').hide();
            }
        });
    });
	
	$(document).on('change','.browsenewfeatureditems', function(){
        var category_id = $('.browsenewfeatureditems').val();
        var btn_action = 'load_featured_item';
		spinner.show();
        $.ajax({
            url: base_url+"action_load_cat_item.php",
            method:"POST",
            data:{category_id:category_id, btn_action:btn_action},
            success:function(data)
            {
				spinner.hide();
				if(category_id != 0) {
					$('.newPro').hide() ;
					$('.fetchNewPro').html(data);
					$('.fetchNewPro').show() ;
					$('.jQueryNewItemAppend').empty();
				} else {
					$('.fetchNewPro').hide() ;
					$('.newPro').show() ;					
					$('#loader-icon').hide();
					$('.jQueryNewItemAppend').hide();
				}
            }
        });
    });
	
	var newBaseUrl = window.location.href; 
	
	$(document).on('click','#action_resend', function(event){
		event.preventDefault();
		$.ajax({
			url: newBaseUrl+"resend_otp.php",
			method:"POST",
			data:$('form.resend_otpform').serialize(),
			success:function(data)
			{	
				data = JSON.parse(data);
				$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data.form_message)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
			}
		})
	});
	
	$('#signupModal').modal('show');
	
	$(document).on('click','#action_sign', function(event){
		event.preventDefault();
		$.ajax({
			url: newBaseUrl+"verify_registration_otp.php",
			method:"POST",
			data:$('form.signup_otpform').serialize(),
			success:function(data)
			{	
				data = JSON.parse(data);
				if(data.err == 1) {
					alert("You missed your chances to verify and You are Permanently Blocked.") ;
					window.location.href = newBaseUrl+"logout.php";
				}
				if(data.err == 0) {
					alert("You've Successfully Verified. Thanks.") ;
					$('#signupModal').modal('hide');
				}
				if(data.err == 2) {
					if(data.chance == 0) {
						alert("You missed your chances to verify and You are Permanently Blocked.") ;
						window.location.href = newBaseUrl+"logout.php";
					} else {
						$('#otp').val('');
						$('.remove-messages').fadeIn().html('<div class="alert alert-danger">'+(data.form_message)+'</div>');
							setTimeout(function(){
								$(".remove-messages").fadeOut("slow");
							},3000);
					}
				}
				
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
				$('.password_validation')[0].reset();
				data = JSON.parse(data);
				$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data.form_message)+'</div>');
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
			url: base_url+"action_email_detail.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
				$('.passw').val('');
				data = JSON.parse(data);
				$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data.form_message)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
				$('.emailChange').html(data.email) ;
			}
		})
	});
	$(document).on('submit','.name_validation', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action_name_detail.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
				$('.userPassword').val('');
				data = JSON.parse(data);
				$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data.form_message)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
				$('.nameChange').html(data.name) ;
			}
		})
	});
	
	
	
	
	function activaTab(tab){
   		$('.nav-tabs a[href="#' + tab + '"]').tab('show');
	 };
	 
	function openSearch() {
	  document.getElementById("myOverlay").style.display = "block";
	}

	function closeSearch() {
	  document.getElementById("myOverlay").style.display = "none";
	}
	
	
});