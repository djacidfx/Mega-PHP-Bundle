// JavaScript Document
jQuery(document).ready(function($) {
	
	 "use strict";	
	 
	var base_url = window.location.href;
	base_url = base_url.substring(0, base_url.substring(0, base_url.lastIndexOf("/")).lastIndexOf("/")+1) ;
	
	var newbase_url = location.protocol + '//' + location.host + location.pathname ;
	newbase_url = newbase_url.substring(0, newbase_url.lastIndexOf("/") + 1);
	
	$(document).on('click','.show_more_newest_item',function(){
        var ID = $(this).attr('id');
        $('.show_more_new_item').hide();
        $('#loader-icon').show();
        $.ajax({
            type:'POST',
            url: newbase_url+'getNewMusic.php?id='+ID,
            data:'id='+ID,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_new_item'+ID).remove();
				$('.ap'+ID).remove();
                $('.jQueryNewMusic').append(html);
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
			url: base_url+'getLoadSearch.php?ID='+ID+'&searchWord='+searchWord,
            data:{ID:ID,searchWord:searchWord},
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_new_search'+ID).remove();
				$('.ap'+ID).remove();
                $('.jQueryNewMusic').append(html);
            }
        });
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
            url: base_url+'getCategoryMusic.php?ID='+ID+'&subcatId='+subcatId,
            data:{ID:ID,subcatId:subcatId},
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_newfilter_item'+ID).remove();
				$('.ap'+ID).remove();
                $('.jQueryNewMusic').append(html);
            }
        });
    });
	
});