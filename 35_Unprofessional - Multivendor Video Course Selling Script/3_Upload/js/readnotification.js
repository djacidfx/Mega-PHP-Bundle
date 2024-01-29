// JavaScript Document
jQuery(document).ready(function($) {
	
	 "use strict";
	 var base_url = location.protocol + '//' + location.host + location.pathname ;
	 base_url = base_url.substring(0, base_url.lastIndexOf("/") + 1); 
    
    
    $(".seenNotification").on("click", function() {
        var id = $(this).attr('id');
		var btn_action = "singleNotificationSeen";
        $.ajax({
            url: base_url+"controls",
            method:"POST",
            data:{id:id , btn_action:btn_action},
            success:function(data)
            {
                //do nothing 
            }
        }) ;
	});
    
    
    
}) ;