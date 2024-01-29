// JavaScript Document
jQuery(document).ready(function($) {
	
	 "use strict";
	 var base_url = location.protocol + '//' + location.host + location.pathname ;
	 base_url = base_url.substring(0, base_url.lastIndexOf("/") + 1); 
        
	 $(document).on("click","#hide", function() {
		$(".errorMessage").hide();
	 });
    
    var manageCategoryTable = $('.manageCategoryTable').DataTable({
		'ajax': base_url+'categorylist',
		'order': []
	});
    
    var manageInReviewTable = $('.manageInReviewTable').DataTable({
		'ajax': base_url+'reviewlist',
		'order': []
	});
    
    var manageSoftReviewTable = $('.manageSoftReviewTable').DataTable({
		'ajax': base_url+'softreviewlist',
		'order': []
	});
    
    var managePendingReviewTable = $('.managePendingReviewTable').DataTable({
		'ajax': base_url+'pendinglist',
		'order': []
	});
    
    var manageItemUpdateReviewTable = $('.manageItemUpdateReviewTable').DataTable({
		'ajax': base_url+'updatelist',
		'order': []
	});
    
    $(document).on('click','.deletePendingItem', function(event){
		var tempId = $(this).attr("id");
        var btn_action = 'delete_pending_item';
        $.ajax({
            url: base_url+"controller/action",
            method:"POST",
            data:{tempId:tempId, btn_action:btn_action},
            success:function(data)
            {	
                managePendingReviewTable.ajax.reload();
            }
        });
			
	});
	 
});