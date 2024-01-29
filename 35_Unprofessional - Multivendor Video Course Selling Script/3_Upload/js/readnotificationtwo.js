// JavaScript Document
jQuery(document).ready(function($) {
	
	 "use strict";
	var newbase_url = window.location.href ;
    newbase_url = newbase_url.substring(0, newbase_url.substring(0, newbase_url.lastIndexOf("/")).lastIndexOf("/")+1) ;
    
    $(".seenNotification").on("click", function() {
        var id = $(this).attr('id');
		var btn_action = "singleNotificationSeen";
        $.ajax({
            url: newbase_url+"controls",
            method:"POST",
            data:{id:id , btn_action:btn_action},
            success:function(data)
            {
                //do nothing 
            }
        }) ;
	});
    
}) ;

