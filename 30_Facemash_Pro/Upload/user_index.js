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
	
	$(document).on("click",".imgVote", function() {
		var ID = $(this).attr('id');
		$.ajax({
            type:'POST',
            url: newbase_url+'getWinner.php?id='+ID,
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
	
	$(document).on('click','.imgVote',function(){
        var ID = $(this).attr('id');
        $.ajax({
            type:'POST',
            url: newbase_url+'getNewPost.php?id='+ID,
            data:'id='+ID,
            success:function(html){
                $('.pic1').html(html);
            }
        });
    });
	
	$(document).on('click','.show_more_won_img',function(){
        var ID = $(this).attr('id');
        $('.show_more_winner_img').hide();
        $('#loader-icon').show();
        $.ajax({
            type:'POST',
            url: base_url+'getNewWinners.php?id='+ID,
            data:'id='+ID,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_winner_img'+ID).remove();
				$('.ap'+ID).remove();
                $('.jQueryNewImg').append(html);
            }
        });
    });
	
	$(document).on('click','.show_more_top_img',function(){
        var ID = $(this).attr('id');
        $('.show_more_topper_img').hide();
        $('#loader-icon').show();
        $.ajax({
            type:'POST',
            url: base_url+'getNewToppers.php?id='+ID,
            data:'id='+ID,
            success:function(html){
				$('#loader-icon').hide();
                $('#show_more_topper_img'+ID).remove();
				$('.ap'+ID).remove();
                $('.jQueryNewImg').append(html);
            }
        });
    });
	
	
	
});