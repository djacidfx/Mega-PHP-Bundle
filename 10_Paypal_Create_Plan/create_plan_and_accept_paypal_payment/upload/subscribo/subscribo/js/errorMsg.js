// JavaScript Document
jQuery(function ($) {
	
	"use strict";
	$(document).on("click","#hide", function() {
		$(".errorMessage").hide();
	});
	$(document).on('change','.selectPlan', function(){
        var sub_id = $('.selectPlan').val();
        var btn_action = 'load_price';
        $.ajax({
            url:"action_price.php",
            method:"POST",
            data:{sub_id:sub_id, btn_action:btn_action},
            success:function(data)
            {
                $('#price').val(data);
            }
        });
    });
});