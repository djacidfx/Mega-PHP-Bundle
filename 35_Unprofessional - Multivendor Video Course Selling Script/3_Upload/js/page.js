// JavaScript Document
jQuery(document).ready(function($) {
	
	 "use strict";	
	 
	var newbase_url = window.location.href;
	newbase_url = newbase_url.substring(0, newbase_url.substring(0, newbase_url.lastIndexOf("/")).lastIndexOf("/")+1) ;
    
    var base_url = location.protocol + '//' + location.host + location.pathname ;
    base_url = base_url.substring(0, base_url.lastIndexOf("/") + 1); 
    
    $(document).on('submit','.selectWalletPay', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$('.actionBtn').attr('disabled','disabled');
		$('.actionBtn').val('Proceeding...');
		$.ajax({
			url: base_url+"checkwalletpay",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				data = JSON.parse(data);
                $('.selectWalletPay')[0].reset();
                if(data.paymentMethod == '0') {
                    $('.actionBtn').attr('disabled',false);
					$('.actionBtn').val('Proceed To Checkout');
                  $('.remove_message').fadeIn().html('<div class="alert alert-danger">Cannot Manipulate Amount.</div>');
                  setTimeout(function(){
                    $(".remove_message").fadeOut("slow");
                  },1000);  
                }
				if(data.paymentMethod == '1') {
					$('.actionBtn').attr('disabled',false);
					$('.actionBtn').val('Proceed To Checkout');
                    $('.paypalPayWalletModal').modal('show');
                    $('.rechargeAmt').val(data.rechargeAmt) ;
					$('.paypalpayactionBtnWallet').val('Pay $'+data.rechargeAmt+' via Paypal') ;
				}
				if(data.paymentMethod == '2') {
					$('.actionBtn').attr('disabled',false);
					$('.actionBtn').val('Proceed To Checkout');
					$('.stripeWalletPayModal').modal('show');
					$('.rechargeAmt').val(data.rechargeAmt) ;
					$('.stripepayactionBtn').val('Pay $'+data.rechargeAmt+' via Stripe') ;
				}
			}
		});
	});
    
    $(document).on('click','.show_more_newest_item',function(){
        var ID = $(this).attr('id');
        $('.show_more_new_item').hide();
        $('#loader-icon').show();
        $.ajax({
            type:'POST',
            url: base_url+'getnewitemlist/'+ID,
            data:'id='+ID,
            success:function(html){
                $('#loader-icon').hide();
                $('#show_more_new_item'+ID).remove();
                $('.jQueryNewItem').append(html);
            }
        });
     });
    
    $(document).on('click','.show_more_allfeatured_item',function(){
        var ID = $(this).attr('id');
        $('.show_more_allfeatured_item').hide();
        $('#loader-icon').show();
        $.ajax({
            type:'POST',
            url: base_url+'getfeatureditemlist/'+ID,
            data:'id='+ID,
            success:function(html){
                $('#loader-icon').hide();
                $('#show_more_featured_item'+ID).remove();
                $('.jQueryFeaturedItem').append(html);
            }
        });
     });
    
    $(document).on('click','.show_more_alltrending_item',function(){
        var ID = $(this).attr('id');
        $('.show_more_trending_item').hide();
        $('#loader-icon').show();
        $.ajax({
            type:'POST',
            url: base_url+'gettrendingitemlist/'+ID,
            data:'id='+ID,
            success:function(html){
                $('#loader-icon').hide();
                $('#show_more_trending_item'+ID).remove();
                $('.jQueryTrendingItem').append(html);
            }
        });
     });
    
    $(document).on('click','.show_more_allbestseller_item',function(){
        var ID = $(this).attr('id');
        $('.show_more_bestseller_item').hide();
        $('#loader-icon').show();
        $.ajax({
            type:'POST',
            url: base_url+'getbestselleritemlist/'+ID,
            data:'id='+ID,
            success:function(html){
                $('#loader-icon').hide();
                $('#show_more_bestseller_item'+ID).remove();
                $('.jQueryBestSellerItem').append(html);
            }
        });
     });
    
    $(document).on('click','.show_more_all_lowtohigh_item',function(){
        var ID = $(this).attr('id');
        $('.show_more_lowtohigh_item').hide();
        $('#loader-icon').show();
        $.ajax({
            type:'POST',
            url: base_url+'getlowtohighitemlist/'+ID,
            data:'id='+ID,
            success:function(html){
                $('#loader-icon').hide();
                $('#show_more_lowtohigh_item'+ID).remove();
                $('.jQueryLowtoHighPriceItem').append(html);
            }
        });
     });
    
    $(document).on('click','.show_more_all_hightolow_item',function(){
        var ID = $(this).attr('id');
        $('.show_more_hightolow_item').hide();
        $('#loader-icon').show();
        $.ajax({
            type:'POST',
            url: base_url+'gethightolowitemlist/'+ID,
            data:'id='+ID,
            success:function(html){
                $('#loader-icon').hide();
                $('#show_more_hightolow_item'+ID).remove();
                $('.jQueryHightoLowPriceItem').append(html);
            }
        });
     });
    
    $(document).on('click','.show_more_all_fourfive_star_item',function(){
        var ID = $(this).attr('id');
        $('.show_more_fourfive_star_item').hide();
        $('#loader-icon').show();
        $.ajax({
            type:'POST',
            url: base_url+'getfourfivestaritemlist/'+ID,
            data:'id='+ID,
            success:function(html){
                $('#loader-icon').hide();
                $('#show_more_fourfive_star_item'+ID).remove();
                $('.jQueryFourFiveStarItem').append(html);
            }
        });
     });
    
    $(document).on('click','.show_more_all_four_star_item',function(){
        var ID = $(this).attr('id');
        $('.show_more_four_star_item').hide();
        $('#loader-icon').show();
        $.ajax({
            type:'POST',
            url: base_url+'getfourstaritemlist/'+ID,
            data:'id='+ID,
            success:function(html){
                $('#loader-icon').hide();
                $('#show_more_four_star_item'+ID).remove();
                $('.jQueryFourStarItem').append(html);
            }
        });
     });
    
    $(document).on('click','.show_more_all_three_star_item',function(){
        var ID = $(this).attr('id');
        $('.show_more_three_star_item').hide();
        $('#loader-icon').show();
        $.ajax({
            type:'POST',
            url: base_url+'getthreestaritemlist/'+ID,
            data:'id='+ID,
            success:function(html){
                $('#loader-icon').hide();
                $('#show_more_three_star_item'+ID).remove();
                $('.jQueryThreeStarItem').append(html);
            }
        });
     });
    
    $(document).on('click','.show_more_all_two_star_item',function(){
        var ID = $(this).attr('id');
        $('.show_more_two_star_item').hide();
        $('#loader-icon').show();
        $.ajax({
            type:'POST',
            url: base_url+'gettwostaritemlist/'+ID,
            data:'id='+ID,
            success:function(html){
                $('#loader-icon').hide();
                $('#show_more_two_star_item'+ID).remove();
                $('.jQueryTwoStarItem').append(html);
            }
        });
     });
    
    $(document).on('click','.show_more_all_one_star_item',function(){
        var ID = $(this).attr('id');
        $('.show_more_one_star_item').hide();
        $('#loader-icon').show();
        $.ajax({
            type:'POST',
            url: base_url+'getonestaritemlist/'+ID,
            data:'id='+ID,
            success:function(html){
                $('#loader-icon').hide();
                $('#show_more_one_star_item'+ID).remove();
                $('.jQueryOneStarItem').append(html);
            }
        });
     });
    
    $(document).on('click','.show_more_category_newest_item',function(){
        var id = $(this).attr('id');
        $('.show_more_category_new_item').hide();
        $('#loader-icon').show();
		var catId = $(this).attr('class');
		catId = catId.replace("show_more_category_newest_item",'');
		catId = catId.replace("btn",'');
		catId = catId.replace("btn-primary",'');
		catId = catId.replace("btn-sm",'');
		catId = catId.replace("ann",'');
        $.ajax({
            type:'GET',
			url: newbase_url+'getmorenewcategoryitems/'+id+'/'+catId,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_category_new_item'+id).remove();
                $('.jQueryNewCategoryItem').append(html);
            }
        });
    });
    
    $(document).on('click','.show_more_category_toppers_item',function(){
        var id = $(this).attr('id');
        $('.show_more_category_bestseller_item').hide();
        $('#loader-icon').show();
		var catId = $(this).attr('class');
		catId = catId.replace("show_more_category_toppers_item",'');
		catId = catId.replace("btn",'');
		catId = catId.replace("btn-primary",'');
		catId = catId.replace("btn-sm",'');
		catId = catId.replace("ann",'');
        $.ajax({
            type:'GET',
			url: newbase_url+'getbestsellercategoryitems/'+id+'/'+catId,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_category_bestseller_item'+id).remove();
                $('.jQueryNewCategoryBestSellerItem').append(html);
            }
        });
    });
    
    $(document).on('click','.show_more_category_lowestprice_item',function(){
        var id = $(this).attr('id');
        $('.show_more_category_lowprice_item').hide();
        $('#loader-icon').show();
		var catId = $(this).attr('class');
		catId = catId.replace("show_more_category_lowestprice_item",'');
		catId = catId.replace("btn",'');
		catId = catId.replace("btn-primary",'');
		catId = catId.replace("btn-sm",'');
		catId = catId.replace("ann",'');
        $.ajax({
            type:'GET',
			url: newbase_url+'getlowpricecategoryitems/'+id+'/'+catId,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_category_lowprice_item'+id).remove();
                $('.jQueryCategoryLowestPriceItem').append(html);
            }
        });
    });
    
    $(document).on('click','.show_more_category_highestprice_item',function(){
        var id = $(this).attr('id');
        $('.show_more_category_highprice_item').hide();
        $('#loader-icon').show();
		var catId = $(this).attr('class');
		catId = catId.replace("show_more_category_highestprice_item",'');
		catId = catId.replace("btn",'');
		catId = catId.replace("btn-primary",'');
		catId = catId.replace("btn-sm",'');
		catId = catId.replace("ann",'');
        $.ajax({
            type:'GET',
			url: newbase_url+'gethighpricecategoryitems/'+id+'/'+catId,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_category_highprice_item'+id).remove();
                $('.jQueryCategoryHighestPriceItem').append(html);
            }
        });
    });
    
    $(document).on('click','.show_more_category_highestrating_item',function(){
        var id = $(this).attr('id');
        $('.show_more_category_highrating_item').hide();
        $('#loader-icon').show();
		var catId = $(this).attr('class');
		catId = catId.replace("show_more_category_highestrating_item",'');
		catId = catId.replace("btn",'');
		catId = catId.replace("btn-primary",'');
		catId = catId.replace("btn-sm",'');
		catId = catId.replace("ann",'');
        $.ajax({
            type:'GET',
			url: newbase_url+'gethighratingcategoryitems/'+id+'/'+catId,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_category_highrating_item'+id).remove();
                $('.jQueryCategoryHighestRatingItem').append(html);
            }
        });
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
			url: newbase_url+'getsearchmoreitems/'+ID+'/'+searchWord,
            data:{ID:ID,searchWord:searchWord},
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_new_search'+ID).remove();
                $('.jQueryLoadSearchItem').append(html);
            }
        });
    });
    
    
    
}) ;