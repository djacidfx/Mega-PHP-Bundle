jQuery(document).ready(function($) {
	
	 "use strict";
	 var base_url = location.protocol + '//' + location.host + location.pathname ;
	base_url = base_url.substring(0, base_url.lastIndexOf("/") + 1);
	
	var newbase_url = window.location.href;
	newbase_url = newbase_url.substring(0, newbase_url.substring(0, newbase_url.lastIndexOf("/")).lastIndexOf("/")+1) ;
	var mainDocument = $(document);
	
	var manageCategoryTable = $('#manageCategoryTable').DataTable({
		'ajax': 'fetchCategory.php',
		'order': []
	});
	var manageItemsTable = $('#manageItemsTable').DataTable({
		'ajax': 'fetchItems.php',
		'order': []
	});
	
	var managePagesTable = $('#managePagesTable').DataTable({
		'ajax': 'fetchPages.php',
		'order': []
	});
    
    var manageUnrepliedTable = $('#manageUnrepliedTable').DataTable({
		'ajax': 'fetchUnreplied.php',
		'order': []
	});
    var manageRepliedTable = $('#manageRepliedTable').DataTable({
		'ajax': 'fetchReplied.php',
		'order': []
	});
	
    
    
	mainDocument.on("click","#hide", function() {
		$(".errorMessage").hide();
	});
    
    $(document).on('submit','.editComment', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		
		$.ajax({
			url: base_url+"action_page.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
                if(data == 0){
                    alert("Admin Reply has been successfully posted.") ;
                    window.location.href = base_url+"unreplied.php";
                }
                if(data == 1){
                    $('.remove-messages').fadeIn().html('<div class="alert alert-info">Error : Any of the Mandatory Field is Missing. Try Again</div>');
                    setTimeout(function(){
                        $(".remove-messages").fadeOut("slow");
                    },2000);
                }
				
			}
		})
	});
    
    mainDocument.on('click', '.deleteComment', function(){
			var id = $(this).attr("id");
			var btn_action = "deleteCommentReply";
			if(confirm("Are you sure you want to Delete Comment ? It cannot be undone."))
			{
				$.ajax({
					url: base_url+"action_page.php",
					method:"POST",
					data:{id:id, btn_action:btn_action},
					success:function(data)
					{
						$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
						manageUnrepliedTable.ajax.reload();
						manageRepliedTable.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
		
		});
	
	 $(document).on('keyup','.page_slug', function(){
        var pageSlug = $('.page_slug').val();
		var newPageSlug = pageSlug.replace(/[^A-Za-z]+/g, '');
        $('.page_slug').val(newPageSlug);
		var newUrl = newbase_url + 'page/' + newPageSlug ;
		$('.page_url').val(newUrl);
    });
	
    
    mainDocument.on('submit','.saveBlog', function(event){
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
					$('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage">Blog Title already used & must be different for every blog.<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				} 
				if(data == 0) {
					$('.saveBlog')[0].reset();
					$('.saveBlog').hide('slow') ;
					$('.step3').show('slow') ;
				}
			}
		})
	});
    
    mainDocument.on('submit','.editBlog', function(event){
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
					$('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage">Blog Title already used & must be different for every blog.<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				} 
				if(data == 0) {
					$('.editBlog')[0].reset();
					$('.editBlog').hide('slow') ;
					$('.step2').show('slow') ;
				}
			}
		})
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
	
	mainDocument.on('click', '#createCategory', function(){
		$('#catModal').modal('show');
		$('.cat_form')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Category");
		$('#action_cat').val('Save Category');
		$('#btn_action').val('SaveCategory');
	});
    
    mainDocument.on('click', '.editCategory', function(){		
		var catId = $(this).attr("id");
		var btn_action = 'fetch_category';
		$('.cat_form')[0].reset();
		$.ajax({
			url:base_url+"action_add_category.php",
			method:"POST",
			data:{catId:catId, btn_action:btn_action},
			dataType:"json",
			success:function(data)
			{	
			
				$('#catModal').modal('show');
				$('.modal-title').html("<i class='fa fa-pencil-alt'></i> Edit Category");
				$('.catName').val(decodeEntities(data.categoryName));
				$('.catId').val(data.catId);
				$('#action_cat').val('Edit Category');
				$('#btn_action').val('EditCategory');
			}
		})
	});
	 
	$(document).on('submit','.cat_form', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		
		$.ajax({
			url: "action_add_category.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
				$('#catModal').modal('hide');
				$('.cat_form')[0].reset();
				$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
				manageCategoryTable.ajax.reload();
			}
		})
	});
	 
	 
	 
	 mainDocument.on('click', '.deactiveCategory', function(){
			var catId = $(this).attr("id");
			var status = $(this).data("status");
			var btn_action = "changeCatStatusToDeactive";
			if(confirm("Note : Category deactive then All Blogs belongs to this Category will also be deactivated. Are you sure ?"))
			{
				$.ajax({
					url: base_url+"action_add_category.php",
					method:"POST",
					data:{catId:catId, status:status, btn_action:btn_action},
					success:function(data)
					{
						$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
						manageCategoryTable.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
		
		});
	 
	 mainDocument.on('click', '.activeCategory', function(){
			var catId = $(this).attr("id");
			var status = $(this).data("status");
			var btn_action = "changeCatStatusToActive";
			if(confirm("Note : If Category active then All Blogs belongs to this Category will also be Activated & Live. Are you sure ?"))
			{
				$.ajax({
					url: base_url+"action_add_category.php",
					method:"POST",
					data:{catId:catId, status:status, btn_action:btn_action},
					success:function(data)
					{
						$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
						manageCategoryTable.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
		
		});
	
    
    
	
    $(document).on('submit','#categoryForm', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action_item.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
				$('#categoryForm')[0].reset();
                $('#categoryModal').modal('hide');
                 manageItemsTable.ajax.reload();
                manageOfficialTable.ajax.reload();
                manageDraftItemsTable.ajax.reload();
                 
				$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
               
			}
		})
	});
    
    
	
    $(document).on('click','.deletePost', function(event){
		var pid = $(this).attr("id");
		var btn_action = "DeletePost";
		if(confirm("Are you sure you want to Delete this Blog ? It cannot be undone."))
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
					}
				})
			}
			else
			{
				return false;
			}
	});
	 
	  $(document).on('click','.changeItemStatus', function(event){
		var pid = $(this).attr("id");
		var btn_action = "changeItemStatus";
		if(confirm("Are you sure you want to Deactivate this Blog from Users ?"))
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
		if(confirm("Are you sure you want to Activate this Blog ?"))
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
					}
				})
			}
			else
			{
				return false;
			}
	});
	  
	
	  
	 
	  
	  $(document).on('click','.changeFeaturedStatus', function(event){
		var pid = $(this).attr("id");
		var btn_action = "changeFeaturedStatus";
		if(confirm("Do you want to Make this Blog Featured ?"))
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
					}
				})
			}
			else
			{
				return false;
			}
	});
    
    $(document).on('click','.unFeaturedStatus', function(event){
		var pid = $(this).attr("id");
		var btn_action = "unFeaturedStatus";
		if(confirm("Do you want to Make this Blog Unfeatured ?"))
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
		if(confirm("Do you want to Make this Blog Trending ?"))
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
					}
				})
			}
			else
			{
				return false;
			}
	});
    
    $(document).on('click','.unTrendingStatus', function(event){
		var pid = $(this).attr("id");
		var btn_action = "unTrendingStatus";
		if(confirm("Do you want to Make this Blog Untrending ?"))
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
