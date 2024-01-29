// JavaScript Document
jQuery(document).ready(function($) {
	
	 "use strict";	
	 
	var base_url = window.location.href;
	base_url = base_url.substring(0, base_url.substring(0, base_url.lastIndexOf("/")).lastIndexOf("/")+1) ;
	
	var newbase_url = location.protocol + '//' + location.host + location.pathname ;
	newbase_url = newbase_url.substring(0, newbase_url.lastIndexOf("/") + 1);
    
    
	$(document).on("click","#hide", function() {
		$(".errorMessage").hide();
	});
	
	$(document).on('click','.show_more_newest_item',function(){
        var ID = $(this).attr('id');
        $('.show_more_new_item').hide();
        $('#loader-icon').show();
        $.ajax({
            type:'POST',
            url: newbase_url+'getNewPost.php?id='+ID,
            data:'id='+ID,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_new_item'+ID).remove();
				$('.ap'+ID).remove();
                $('.jQueryNewPost').append(html);
            }
        });
    });
    
    $(document).on('click','.show_more_allofficial_item',function(){
        var ID = $(this).attr('id');
        $('.show_more_official_item').hide();
        $('#loader-icon').show();
        $.ajax({
            type:'POST',
            url: newbase_url+'getOfficialPost.php?id='+ID,
            data:'id='+ID,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_official_item'+ID).remove();
				$('.ap'+ID).remove();
                $('.jQueryOfficialPost').append(html);
            }
        });
    });
    
    $(document).on('click','.show_more_allfeatured_item',function(){
        var ID = $(this).attr('id');
        $('.show_more_featured_item').hide();
        $('#loader-icon').show();
        $.ajax({
            type:'POST',
            url: newbase_url+'getFeaturedPost.php?id='+ID,
            data:'id='+ID,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_featured_item'+ID).remove();
				$('.ap'+ID).remove();
                $('.jQueryFeaturedPost').append(html);
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
		searchWord = searchWord.replace("btn-dark",'');
		searchWord = searchWord.replace("btn-sm",'');
		searchWord = searchWord.replace("ann",'');
        searchWord = searchWord.trim();
        $.ajax({
            type:'GET',
			url: newbase_url+'getLoadSearch.php?ID='+ID+'&searchWord='+searchWord,
            data:{ID:ID,searchWord:searchWord},
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_new_search'+ID).remove();
				$('.ap'+ID).remove();
                $('.jQueryNewPost').append(html);
            }
        });
    });
    
    $(document).on('click','.show_more_allcategory_item',function(){
        var ID = $(this).attr('id');
        $('.show_more_category_item').hide();
        $('#loader-icon').show();
		var catId = $(this).attr('class');
		catId = catId.replace("show_more_allcategory_item",'');
		catId = catId.replace("btn",'');
		catId = catId.replace("btn-dark",'');
		catId = catId.replace("btn-sm",'');
		catId = catId.replace("ann",'');
        catId = catId.trim();
        $.ajax({
            type:'GET',
			url: base_url+'getLoadCategory.php?id='+ID+'&catId='+catId,
            data:{id:ID,catId:catId},
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_category_item'+ID).remove();
				$('.ap'+ID).remove();
                $('.jQueryCategoryPost').append(html);
            }
        });
    });
	
	
	
	$(document).on('click', '.userLike', function(){
		var pid = $(this).attr('id');	
		var uip = $(this).data("status");
		var btn_action_sb = 'user_like';
		 $.ajax({
            url: newbase_url+"add_code.php",
            method:"POST",
            data:{pid:pid, uip:uip ,btn_action_sb:btn_action_sb},
            success:function(data)
            {
				data = JSON.parse(data);
				if(data.error == 0) {
					$('.userLi'+pid).html(data.newLike);
				} else {
					$('.errorLike').modal('show');
				} 
			}
		});
	});
	
	$(document).on('click', '.userLove', function(){
		var pid = $(this).attr('id');	
		var uip = $(this).data("status");
		var btn_action_sb = 'user_love';
		 $.ajax({
            url: newbase_url+"add_code.php",
            method:"POST",
            data:{pid:pid, uip:uip ,btn_action_sb:btn_action_sb},
            success:function(data)
            {
				data = JSON.parse(data);
				if(data.error == 0) {
					$('.userLov'+pid).html(data.newLove);
				} else {
					$('.errorLove').modal('show');
				} 
			}
		});
	});
	
});