jQuery(document).ready(function($) {
	
	 "use strict";
	 var base_url = location.protocol + '//' + location.host + location.pathname ;
	base_url = base_url.substring(0, base_url.lastIndexOf("/") + 1);
	
	var newbase_url = window.location.href;
	newbase_url = newbase_url.substring(0, newbase_url.substring(0, newbase_url.lastIndexOf("/")).lastIndexOf("/")+1) ;
	var mainDocument = $(document);
	
	var manageItemsTable = $('#manageItemsTable').DataTable({
		'ajax': 'fetchItems.php',
		'order': []
	});
	
	var manageDraftItemsTable = $('#manageDraftItemsTable').DataTable({
		'ajax': 'fetchDraftItems.php',
		'order': []
	});
    
    var manageFeaturedTable = $('#manageFeaturedTable').DataTable({
		'ajax': 'fetchFeatured.php',
		'order': []
	});
    
    var manageTrendingTable = $('#manageTrendingTable').DataTable({
		'ajax': 'fetchTrending.php',
		'order': []
	});
    
    var managePopularTable = $('#managePopularTable').DataTable({
		'ajax': 'fetchPopular.php',
		'order': []
	});
	
	var managePagesTable = $('#managePagesTable').DataTable({
		'ajax': 'fetchPages.php',
		'order': []
	});
	
	mainDocument.on("click","#hide", function() {
		$(".errorMessage").hide();
	});
	
	 $(document).on('keyup','.page_slug', function(){
        var pageSlug = $('.page_slug').val();
		var newPageSlug = pageSlug.replace(/[^A-Za-z]+/g, '');
        $('.page_slug').val(newPageSlug);
		var newUrl = newbase_url + 'page/' + newPageSlug ;
		$('.page_url').val(newUrl);
    });
	
	
	mainDocument.on('submit','.savePage', function(event){
		event.preventDefault();
		$('#action_page').attr('disabled','disabled'); 
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action_page.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				
				if(data == 1) {
					$('#action_page').attr('disabled', false); 
					$('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage">Any of the Mandatory Field is missing.<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				} 
				if(data == 2) {
					$('#action_page').attr('disabled', false); 
					$('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage">Page Slug already used & must be different for every page.<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				} 
				if(data == 0) {
					$('.savePage')[0].reset();
					$('.savePage').hide('slow') ;
					$('.step3').show('slow') ;
				}
			}
		})
	});
	
	mainDocument.on('submit','.editPage', function(event){
		event.preventDefault();
		$('#action_page').attr('disabled','disabled'); 
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action_page.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				
				if(data == 1) {
					$('#action_page').attr('disabled', false); 
					$('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage">Any of the Mandatory Field is missing.<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				} 
				if(data == 2) {
					$('#action_page').attr('disabled', false); 
					$('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage">Page Slug already used & must be different for every page.<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				} 
				if(data == 0) {
					$('.editPage')[0].reset();
					$('.editPage').hide('slow') ;
					$('.step2').show('slow') ;
				}
			}
		})
	});
	
	mainDocument.on('click', '.changePageStatus', function(){
			var id = $(this).attr("id");
			var status = $(this).data("status");
			var btn_action = "changePageStatus";
			if(confirm("Are you sure you want to change Page Status ?"))
			{
				$.ajax({
					url: base_url+"action_page.php",
					method:"POST",
					data:{id:id, status:status, btn_action:btn_action},
					success:function(data)
					{
						$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
						managePagesTable.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
		
		});
	
	mainDocument.ready(function(){
		$('.announce_date ,.comment_date ,.order_date').datepicker({
			format: "yyyy-mm-dd",
			autoclose: true,
			orientation: "top",
			endDate: "today"
		});
	});
	
	  $(document).on('click','.changeItemStatus', function(event){
		var pid = $(this).attr("id");
		var btn_action = "changeItemStatus";
		if(confirm("Are you sure you want to Deactivate this Post from Users ?"))
			{
				$.ajax({
					url: base_url+"action_item.php",
					method:"POST",
					data:{pid:pid, btn_action:btn_action},
					success:function(data)
					{	
						$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
						manageItemsTable.ajax.reload();
						manageFeaturedTable.ajax.reload();
                        managePopularTable.ajax.reload();
                        manageTrendingTable.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
	});
	  
	  $(document).on('click','.changePostStatus', function(event){
		var pid = $(this).attr("id");
		var btn_action = "changePostStatus";
		if(confirm("Are you sure you want to Activate this Post ?"))
			{
				$.ajax({
					url: base_url+"action_item.php",
					method:"POST",
					data:{pid:pid, btn_action:btn_action},
					success:function(data)
					{	
						$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
						manageDraftItemsTable.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
	});
	  
	  mainDocument.on('click', '.editPost', function(){		
		var pId = $(this).attr("id");
		var btn_action = 'fetch_post';
		$('.post_form')[0].reset();
		$.ajax({
			url:base_url+"action_item.php",
			method:"POST",
			data:{pId:pId, btn_action:btn_action},
			dataType:"json",
			success:function(data)
			{	
			
				$('#postModal').modal('show');
				$('.modal-title').html("<i class='fa fa-pencil-alt'></i> Edit Post");
				$('.postTitle').val(decodeEntities(data.postTitle));
				$('.postId').val(data.postId);
				$('.postDescription').val(decodeEntities(data.postDescription));
				$('#action_post').val('Edit Post');
				$('#btn_action').val('EditPost');
			}
		})
	});
	  
	   $(document).on('submit','.post_form', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		
		$.ajax({
			url: "action_item.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
				$('#postModal').modal('hide');
				$('.post_form')[0].reset();
				$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
				manageItemsTable.ajax.reload();
                manageFeaturedTable.ajax.reload();
                managePopularTable.ajax.reload();
                manageTrendingTable.ajax.reload();
				manageDraftItemsTable.ajax.reload();
			}
		})
	});
	  
	  $(document).on('click','.changeFeaturedStatus', function(event){
		var pid = $(this).attr("id");
		var btn_action = "changeFeaturedStatus";
		if(confirm("Do you want to make this Post Featured ?"))
			{
				$.ajax({
					url: base_url+"action_item.php",
					method:"POST",
					data:{pid:pid, btn_action:btn_action},
					success:function(data)
					{	
						$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
						manageItemsTable.ajax.reload();
						manageFeaturedTable.ajax.reload();
                        managePopularTable.ajax.reload();
                        manageTrendingTable.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
	});
    
    $(document).on('click','.changeUnFeaturedStatus', function(event){
		var pid = $(this).attr("id");
		var btn_action = "changeUnFeaturedStatus";
		if(confirm("Do you want to make this Post Unfeatured ?"))
			{
				$.ajax({
					url: base_url+"action_item.php",
					method:"POST",
					data:{pid:pid, btn_action:btn_action},
					success:function(data)
					{	
						$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
						manageItemsTable.ajax.reload();
						manageFeaturedTable.ajax.reload();
                        managePopularTable.ajax.reload();
                        manageTrendingTable.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
	});
    
    $(document).on('click','.changeTrendingStatus', function(event){
		var pid = $(this).attr("id");
		var btn_action = "changeTrendingStatus";
		if(confirm("Do you want to make this Post Trending ?"))
			{
				$.ajax({
					url: base_url+"action_item.php",
					method:"POST",
					data:{pid:pid, btn_action:btn_action},
					success:function(data)
					{	
						$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
						manageItemsTable.ajax.reload();
						manageFeaturedTable.ajax.reload();
                        managePopularTable.ajax.reload();
                        manageTrendingTable.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
	});
    
    $(document).on('click','.changePopularStatus', function(event){
		var pid = $(this).attr("id");
		var btn_action = "changePopularStatus";
		if(confirm("Do you want to make this Post Popular ?"))
			{
				$.ajax({
					url: base_url+"action_item.php",
					method:"POST",
					data:{pid:pid, btn_action:btn_action},
					success:function(data)
					{	
						$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
						manageItemsTable.ajax.reload();
						manageFeaturedTable.ajax.reload();
                        managePopularTable.ajax.reload();
                        manageTrendingTable.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
	});
    
    $(document).on('click','.changeUnPopularStatus', function(event){
		var pid = $(this).attr("id");
		var btn_action = "changeUnPopularStatus";
		if(confirm("Do you want to make this Post UnPopular ?"))
			{
				$.ajax({
					url: base_url+"action_item.php",
					method:"POST",
					data:{pid:pid, btn_action:btn_action},
					success:function(data)
					{	
						$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
						manageItemsTable.ajax.reload();
						manageFeaturedTable.ajax.reload();
                        managePopularTable.ajax.reload();
                        manageTrendingTable.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
	});
    
    $(document).on('click','.changeUnTrendingStatus', function(event){
		var pid = $(this).attr("id");
		var btn_action = "changeUnTrendingStatus";
		if(confirm("Do you want to make this Post Untrending ?"))
			{
				$.ajax({
					url: base_url+"action_item.php",
					method:"POST",
					data:{pid:pid, btn_action:btn_action},
					success:function(data)
					{	
						$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
						manageItemsTable.ajax.reload();
						manageFeaturedTable.ajax.reload();
                        managePopularTable.ajax.reload();
                        manageTrendingTable.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
	});
	 
	 $(document).on('submit','.password_validation', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: "action_password_detail.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
				$('#password_validation')[0].reset();
				data = JSON.parse(data);
				$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data.form_message)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},3000);
			}
		})
	});
	
	$(document).on('submit','.email_validation', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: "action_email_detail.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
				$('#email_validation')[0].reset();
				data = JSON.parse(data);
				$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data.form_message)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},3000);
			}
		})
	});
	
	mainDocument.on('submit','.admin_settings', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action_setting.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
				data = JSON.parse(data);
				$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data.form_message)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},3000);
			}
		})
	});
	
	
	
	mainDocument.on('submit','.social_settings', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action_setting.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
				data = JSON.parse(data);
				$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data.form_message)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
			}
		})
	});
	
	mainDocument.on('submit','.google_settings', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action_setting.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
				data = JSON.parse(data);
				$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data.form_message)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
			}
		})
	});
	
	
	mainDocument.on('submit','.ad_settings', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action_setting.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
				data = JSON.parse(data);
				$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data.form_message)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
			}
		})
	});
	
	mainDocument.on('submit','.msg_settings', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action_setting.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
				data = JSON.parse(data);
				$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data.form_message)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
			}
		})
	});
	
	mainDocument.on('submit','.post_settings', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action_setting.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
				data = JSON.parse(data);
				$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data.form_message)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
			}
		})
	});
	
		
	function decodeEntities(encodedString) {
	  var textArea = document.createElement('textarea');
	  textArea.innerHTML = encodedString;
	  return textArea.value;
	}
});
