// JavaScript Document
jQuery(document).ready(function($) {
	
	 "use strict";	
	 
	var base_url = window.location.href;
	base_url = base_url.substring(0, base_url.substring(0, base_url.lastIndexOf("/")).lastIndexOf("/")+1) ;
	var newbase_url = location.protocol + '//' + location.host + location.pathname ;
	newbase_url = newbase_url.substring(0, newbase_url.lastIndexOf("/") + 1);
	
	$(".getLovedItem").on("click", function() {
		var btn_action = "getLovedItem";
			$.ajax({
						url: base_url+"getLovedItem.php",
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