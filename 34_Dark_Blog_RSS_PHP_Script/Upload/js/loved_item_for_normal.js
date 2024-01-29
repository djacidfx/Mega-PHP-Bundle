// JavaScript Document
jQuery(document).ready(function($) {
	
	 "use strict";	
	 
	var newbase_url = location.protocol + '//' + location.host + location.pathname ;
	newbase_url = newbase_url.substring(0, newbase_url.lastIndexOf("/") + 1);
	
	$(".getLovedItem").on("click", function() {
		var btn_action = "getLovedItem";
			$.ajax({
						url: newbase_url+"getLovedItem.php",
						method:"POST",
						data:{btn_action:btn_action},
						success:function(data)
						{
							$('.showLovedItems').show();
							$('.showLovedItems').html(data);
							
						}
					}) ;
	});
});