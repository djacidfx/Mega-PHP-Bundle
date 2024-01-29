// JavaScript Document
jQuery(document).ready(function($) {
	
	 "use strict";
	 var base_url = location.protocol + '//' + location.host + location.pathname ;
	 base_url = base_url.substring(0, base_url.lastIndexOf("/") + 1); 
    
    
    $(".seenNotificationOne").on("click", function() {
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
    
    
    $(document).on('click','.show_more_allnotifications',function(){
        var ID = $(this).attr('id');
        $('.show_more_notifications').hide();
        $('#loader-icon').show();
        $.ajax({
            type:'POST',
            url: base_url+'getnewnotification/'+ID,
            data:'id='+ID,
            success:function(html){
                $('#loader-icon').hide();
                $('#show_more_notifications'+ID).remove();
                $('.jQueryNewNotifications').append(html);
            }
        });
     });
    
    
}) ;