// JavaScript Document
jQuery(document).ready(function($) {
	
	 "use strict";
	 var vars = location.protocol + '//' + location.host + location.pathname ;    
    var arrVars = vars.split("/");
    arrVars.splice(-3,3)
    var base_url = arrVars.join("/"); 
    
    
    
    $(".seenNotification").on("click", function() {
        var id = $(this).attr('id');
		var btn_action = "singleNotificationSeen";
        $.ajax({
            url: base_url+"/controls",
            method:"POST",
            data:{id:id , btn_action:btn_action},
            success:function(data)
            {
                //do nothing 
            }
        }) ;
	});
    
    
    
}) ;