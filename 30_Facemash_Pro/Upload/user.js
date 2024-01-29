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
	$(document).on("click",".imgVoteOne", function() {
		var ID = $(this).attr('id');
		$.ajax({
            type:'POST',
            url: base_url+'getWinner.php?id='+ID,
            data:'id='+ID,
            success:function(html){
                $('.toastHidden').show(); 										
				$('.toast').toast('show');
				setTimeout(function(){
					$(".toastHidden").hide();
				},1000);	
				$('.winnerName').html(html) ;
			}
        });
		
	});
	
	$(document).on('click','.imgVoteOne',function(){
        var ID = $(this).attr('id');
		var oldId = $(this).data("status");
        $.ajax({
            type:'POST',
            url: base_url+'getNewSinglePost.php?id='+ID+'&oldId='+oldId,
            data:{id:ID, oldId:oldId},
            success:function(html){
                $('.pic2').html(html);
            }
        });
    });
	
	
	
	
});