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
	
	var manageDraftItemsTable = $('#manageDraftItemsTable').DataTable({
		'ajax': 'fetchDraftItems.php',
		'order': []
	});
	
	var manageTopItemsTable = $('#manageTopItemsTable').DataTable({
		'ajax': 'fetchTopItems.php',
		'order': []
	});
	var manageTopLovedItemsTable = $('#manageTopLovedItemsTable').DataTable({
		'ajax': 'fetchTopLovedItems.php',
		'order': []
	});
	var managePaymentTable = $('#managePaymentTable').DataTable({
		'ajax': 'fetchPayment.php',
		'order': []
	});
	
	var manageWalletPaymentTable = $('#manageWalletPaymentTable').DataTable({
		'ajax': 'fetchWalletPayment.php',
		'order': []
	});
	
	var manageWalletPlanTable = $('#manageWalletPlanTable').DataTable({
		'ajax': 'fetchWalletPlan.php',
		'order': []
	});
	
	var manageUserTable = $('#manageUserTable').DataTable({
		'ajax': 'fetchUsers.php',
		'order': []
	});
	var manageBlockedUserTable = $('#manageBlockedUserTable').DataTable({
		'ajax': 'fetchBlockedUser.php',
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
	 mainDocument.on('click', '.changeUserStatus', function(){
			var id = $(this).attr("id");
			var status = $(this).data("status");
			var btn_action = "changeUserStatus";
			if(confirm("Are you sure you want to change User Block Status ?"))
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
						manageUserTable.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
		
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
	
	
	
	
	mainDocument.on('click', '.changeBlockedStatus', function(){
			var userId = $(this).attr("id");
			var status = $(this).data("status");
			var btn_action = "changeBlockedStatus";
			if(confirm("Are you sure you want to change Block Status of this User & Send Email ? "))
			{
				$.ajax({
					url: base_url+"change_blocked_status.php",
					method:"POST",
					data:{userId:userId, status:status, btn_action:btn_action},
					success:function(data)
					{
						$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
						manageBlockedUserTable.ajax.reload();
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
	
	
	
	mainDocument.on('click', '#add_catgory', function(){
		$('#catModal').modal('show');
		$('.cat_form')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Add Category");
		$('#action_cat').val('Save Category');
		$('#btn_action_cat').val('SaveCategory');
	});
	 
	 $(document).on('submit','#cat_form', function(event){
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
	 
	 mainDocument.on('click', '.editCategory', function(){												
		var catId = $(this).attr("id");
		var btn_action_cat = 'fetch_category';
		$('.cat_form')[0].reset();
		$.ajax({
			url:base_url+"action_add_category.php",
			method:"POST",
			data:{catId:catId, btn_action_cat:btn_action_cat},
			dataType:"json",
			success:function(data)
			{	
				$('#catModal').modal('show');
				$('.modal-title').html("<i class='fa fa-pencil-alt'></i> Edit Category");
				$('#cat').val(data.categoryName);
				$('.catId').val(data.catId);
				$('#action_cat').val('Edit Category');
				$('#btn_action_cat').val('EditCategory');
			}
		})
	});
	 
	 mainDocument.on('click', '.changeCatStatusToDeactive', function(){
			var catId = $(this).attr("id");
			var status = $(this).data("status");
			var btn_action_cat = "changeCatStatusToDeactive";
			if(confirm("Note : If Category deactive then All Item belongs to this category will also be deactivated. Are you sure ?"))
			{
				$.ajax({
					url: base_url+"action_add_category.php",
					method:"POST",
					data:{catId:catId, status:status, btn_action_cat:btn_action_cat},
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
	 
	 mainDocument.on('click', '.changeCatStatusToActive', function(){
			var catId = $(this).attr("id");
			var status = $(this).data("status");
			var btn_action_cat = "changeCatStatusToActive";
			if(confirm("Note : If Category active then All Item belongs to this category will also be Activated & Live. Are you sure ?"))
			{
				$.ajax({
					url: base_url+"action_add_category.php",
					method:"POST",
					data:{catId:catId, status:status, btn_action_cat:btn_action_cat},
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
	
	mainDocument.on('click', '.changePlanStatusToDeactive', function(){
			var planId = $(this).attr("id");
			var status = $(this).data("status");
			var btn_action_plan = "changePlanStatusToDeactive";
			if(confirm("Are you sure you want to Deactivate this Wallet Plan?"))
			{
				$.ajax({
					url: base_url+"action_add_category.php",
					method:"POST",
					data:{planId:planId, status:status, btn_action_plan:btn_action_plan},
					success:function(data)
					{
						$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
						manageWalletPlanTable.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
		
		});
	mainDocument.on('click', '.changePlanStatusToActive', function(){
			var planId = $(this).attr("id");
			var status = $(this).data("status");
			var btn_action_plan = "changePlanStatusToActive";
			if(confirm("Are you sure you want to Activate this Wallet Plan?"))
			{
				$.ajax({
					url: base_url+"action_add_category.php",
					method:"POST",
					data:{planId:planId, status:status, btn_action_plan:btn_action_plan},
					success:function(data)
					{
						$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+data+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
						manageWalletPlanTable.ajax.reload();
					}
				})
			}
			else
			{
				return false;
			}
		
		});
	
	mainDocument.on('click', '.add_wallet_plan', function(){
		$('#planModal').modal('show');
		$('.plan_form')[0].reset();
		$('.modal-title').html("<i class='fa fa-plus'></i> Add Wallet Plan");
		$('#action_plan').val('Save Plan');
		$('#btn_action_plan').val('SavePlan');
	});
	 
	 $(document).on('submit','#plan_form', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action_add_category.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{	
				$('#planModal').modal('hide');
				$('.plan_form')[0].reset();
				$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
				manageWalletPlanTable.ajax.reload();
			}
		})
	});
	 
	 mainDocument.on('click', '.editPlan', function(){												
		var planId = $(this).attr("id");
		var btn_action_plan = 'fetch_plan';
		$('.plan_form')[0].reset();
		$.ajax({
			url:base_url+"action_add_category.php",
			method:"POST",
			data:{planId:planId, btn_action_plan:btn_action_plan},
			dataType:"json",
			success:function(data)
			{	
				$('#planModal').modal('show');
				$('.modal-title').html("<i class='fa fa-pencil-alt'></i> Edit Wallet Plan");
				$('#planName').val(decodeEntities(data.planName));
				$('.planId').val(data.planId);
				$('#bonusAmt').val(data.bonusAmt);
				$('#planAmt').val(data.planAmt);
				$('#action_plan').val('Edit Plan');
				$('#btn_action_plan').val('EditPlan');
			}
		})
	});
	  
	  mainDocument.on('submit','.step1form', function(event){
		event.preventDefault();
		$('#action-item').attr('disabled','disabled'); 
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action_item.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				if(data == 1) {
					$('#action-item').attr('disabled', false); 
					$('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage">Youtube Link is wrong.<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				} 
				if(data == 2) {
					$('#action-item').attr('disabled', false); 
					$('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage">Any of the Mandatory Field is missing.<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				} 
				data = JSON.parse(data);
				if(data.error == 0){
					$('.step1form')[0].reset();
					$('#item_id').val(data.item_id);
					$('.step1').hide('slow') ;
					$('.step2').show('slow') ;
				}
			}
		})
	});
	  
	   mainDocument.on('submit','.step1formedit', function(event){
		event.preventDefault();
		$('#action-item').attr('disabled','disabled'); 
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action_item.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				if(data == 1) {
					$('#action-item').attr('disabled', false); 
					$('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage">Youtube Link is wrong.<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				} 
				if(data == 2) {
					$('#action-item').attr('disabled', false); 
					$('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage">Any of the Mandatory Field is missing.<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
				}
				data = JSON.parse(data);
				if(data.error == 0){
					$('#editModal').modal('show') ;
					$('.step1formedit')[0].reset();
					$('.item_id').val(data.item_id);
					$('.step1').hide('slow') ;
					$('.step2').show('slow') ;
				}
			}
		})
	});
	 
	
	 
	 $(document).on('change','#uploadThumbnail', function(event){
		event.preventDefault();
		$('.thumbprogress').show();
		var allowedTypes = ['jpeg', 'jpg', 'png'];
		var FileSize = (document.getElementById("uploadThumbnail").files[0].size/1024)/1024; 
        var file = $('#uploadThumbnail').val().split('\\').pop();
        var fileType = file.allowedTypes;
		var extension = file.substr( (file.lastIndexOf('.') +1) );
		var item_id = $('#item_id').val();
		var newfile = $('input[name="uploadThumbnail"]').get(0).files[0];
		var formData = new FormData();
		formData.append('newfile', newfile);
		formData.append('item_id', item_id);
		if($('#uploadThumbnail').val()) {
			if(allowedTypes.includes(extension))
			{
				if(FileSize < 10) {
					event.preventDefault();
					$('#targetLayer').hide();
					$.ajax({
						   xhr: function() {
							var xhr = new window.XMLHttpRequest();
							xhr.upload.addEventListener("progress", function(evt) {
								if (evt.lengthComputable) {
									
									var percentComplete = (evt.loaded / evt.total) * 100;
									//Do something with upload progress here
									$('.thumb-bar').animate({
										width: percentComplete + '%'
									}, {
										duration: 1000
									});
								}
						   }, false);
						   return xhr;
						},
						 url: base_url+"action_upload.php",
           				 method:"POST",
						 data: formData,
						 contentType: false,
						 processData: false,
						 cache: false,
						target: '#targetLayer',
						success:function(data){
							
							$('.remove-messagesthumbnail').fadeIn().html('<div class="alert alert-success">Thumbnail  Image Uploaded Successfully.</div>');
							$('.thmb').hide();
							$('.thumbprogress').hide();
						},
						resetForm: true
					});
				} else {
					alert("Image must not be greater than 10 MB.") ;
					$('#uploadThumbnail').val('');
					$('.thumbprogress').hide();
					return false;
				}
			} else {
				alert("Wrong File Type") ;
				$('#uploadThumbnail').val('');
				$('.thumbprogress').hide();
				return false;
			}
		} else {
			alert("Please Select an Image.") ;
			$('#uploadThumbnail').val('');
			$('.thumbprogress').hide();
			return false;
		}
		return false;
	});
	 
	 $(document).on('change','#uploadPreview', function(event){
		event.preventDefault();
		$('.previewprogress').show();
		var allowedTypes = ['jpeg', 'jpg', 'png'];
		var FileSize = (document.getElementById("uploadPreview").files[0].size/1024)/1024; 
        var file = $('#uploadPreview').val().split('\\').pop();
        var fileType = file.allowedTypes;
		var extension = file.substr( (file.lastIndexOf('.') +1) );
		var item_id = $('#item_id').val();
		var previewfile = $('input[name="uploadPreview"]').get(0).files[0];
		var formData = new FormData();
		formData.append('previewfile', previewfile);
		formData.append('item_id', item_id);
		if($('#uploadPreview').val()) {
			if(allowedTypes.includes(extension))
			{
				if(FileSize < 10) {
					event.preventDefault();
					$('#targetLayer').hide();
					$.ajax({
						   xhr: function() {
							var xhr = new window.XMLHttpRequest();
							xhr.upload.addEventListener("progress", function(evt) {
								if (evt.lengthComputable) {
									
									var percentComplete = (evt.loaded / evt.total) * 100;
									$('.preview-bar').animate({
										width: percentComplete + '%'
									}, {
										duration: 1000
									});
								}
						   }, false);
						   return xhr;
						},
						 url: base_url+"action_upload.php",
           				 method:"POST",
						 data: formData,
						 contentType: false,
						 processData: false,
						 cache: false,
						target: '#targetLayer',
						success:function(data){
							
							$('.remove-messagespreview').fadeIn().html('<div class="alert alert-success">Preview Image Uploaded Successfully.</div>');
							$('.prvw').hide();
							$('.previewprogress').hide();
						},
						resetForm: true
					});
				} else {
					alert("Image must not be greater than 10 MB.") ;
					$('#uploadPreview').val('');
					$('.previewprogress').hide();
					return false;
				}
			} else {
				alert("Wrong File Type") ;
				$('#uploadPreview').val('');
				$('.previewprogress').hide();
				return false;
			}
		} else {
			alert("Please Select an Image.") ;
			$('#uploadPreview').val('');
			$('.previewprogress').hide();
			return false;
		}
		return false;
	});
	 
	 $(document).on('change','#uploadMainFile', function(event){
		event.preventDefault();
		$('.mainfileprogress').show();
		var allowedTypes = ['zip'];
		var FileSize = (document.getElementById("uploadMainFile").files[0].size/1024)/1024; 
        var file = $('#uploadMainFile').val().split('\\').pop();
        var fileType = file.allowedTypes;
		var extension = file.substr( (file.lastIndexOf('.') +1) );
		var item_id = $('#item_id').val();
		var mainfile = $('input[name="uploadMainFile"]').get(0).files[0];
		var formData = new FormData();
		formData.append('FileSize', FileSize);
		formData.append('mainfile', mainfile);
		formData.append('item_id', item_id);
		if($('#uploadMainFile').val()) {
			if(allowedTypes.includes(extension))
			{
				if(FileSize < 256.1) {
					event.preventDefault();
					$('#targetLayer').hide();
					$.ajax({
						   xhr: function() {
							var xhr = new window.XMLHttpRequest();
							xhr.upload.addEventListener("progress", function(evt) {
								if (evt.lengthComputable) {
									
									var percentComplete = (evt.loaded / evt.total) * 100;
									//Do something with upload progress here
									$('.mainfile-bar').animate({
										width: percentComplete + '%'
									}, {
										duration: 1000
									});
								}
						   }, false);
						   return xhr;
						},
						 url: base_url+"action_upload.php",
           				 method:"POST",
						 data: formData,
						 contentType: false,
						 processData: false,
						 cache: false,
						target: '#targetLayer',
						success:function(data){
							
							$('.remove-messagesmainfile').fadeIn().html('<div class="alert alert-success">Main Zip File Uploaded Successfully.</div>');
							$('.mainfile').hide();
							$('.mainfileprogress').hide();
						},
						resetForm: true
					});
				} else {
					alert("File must not be greater than 256 MB.") ;
					$('#uploadMainFile').val('');
					$('.mainfileprogress').hide();
					return false;
				}
			} else {
				alert("Wrong File Type") ;
				$('#uploadMainFile').val('');
				$('.mainfileprogress').hide();
				return false;
			}
		} else {
			alert("Please Select a zip file.") ;
			$('#uploadMainFile').val('');
			$('.mainfileprogress').hide();
			return false;
		}
		return false;
	});
	 
	 $(document).on('change','#uploadDocumentation', function(event){
		event.preventDefault();
		$('.documentationprogress').show();
		var allowedTypes = ['zip'];
		var FileSize = (document.getElementById("uploadDocumentation").files[0].size/1024)/1024; 
        var file = $('#uploadDocumentation').val().split('\\').pop();
        var fileType = file.allowedTypes;
		var extension = file.substr( (file.lastIndexOf('.') +1) );
		var item_id = $('#item_id').val();
		var docufile = $('input[name="uploadDocumentation"]').get(0).files[0];
		var formData = new FormData();
		formData.append('docufile', docufile);
		formData.append('item_id', item_id);
		if($('#uploadDocumentation').val()) {
			if(allowedTypes.includes(extension))
			{
				if(FileSize < 128.1) {
					event.preventDefault();
					$('#targetLayer').hide();
					$.ajax({
						   xhr: function() {
							var xhr = new window.XMLHttpRequest();
							xhr.upload.addEventListener("progress", function(evt) {
								if (evt.lengthComputable) {
									
									var percentComplete = (evt.loaded / evt.total) * 100;
									//Do something with upload progress here
									$('.docufile-bar').animate({
										width: percentComplete + '%'
									}, {
										duration: 1000
									});
								}
						   }, false);
						   return xhr;
						},
						 url: base_url+"action_upload.php",
           				 method:"POST",
						 data: formData,
						 contentType: false,
						 processData: false,
						 cache: false,
						target: '#targetLayer',
						success:function(data){
							
							$('.remove-messagesdocumentation').fadeIn().html('<div class="alert alert-success">Screenshot Zip File Uploaded Successfully.</div>');
							$('.dcmntn').hide();
							$('.documentationprogress').hide();
						},
						resetForm: true
					});
				} else {
					alert("File must not be greater than 100 MB.") ;
					$('#uploadDocumentation').val('');
					$('.documentationprogress').hide();
					return false;
				}
			} else {
				alert("Wrong File Type") ;
				$('#uploadDocumentation').val('');
				$('.documentationprogress').hide();
				return false;
			}
		} else {
			alert("Please Select a zip file.") ;
			$('#uploadDocumentation').val('');
			$('.documentationprogress').hide();
			return false;
		}
		return false;
	});
	 
	  $(document).on('click','.draftitem', function(event){
		$('.step2').hide('slow') ;
		$('.step4').show('slow') ;
	});
	 $(document).on('submit','.uploadFilesNew', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		if(confirm("Update Item means Item will be active and live for Sale, Are you sure to do this ?"))
			{
				$.ajax({
					url: base_url+"action_item.php",
					method:"POST",
					data:form_data,
					success:function(data)
					{	
						$('.step2').hide('slow') ;
						$('.step3').show('slow') ;
					}
				})
			}
			else
			{
				return false;
			}
	});
	 $(document).on('click','.draftupdateitem', function(event){
		var item_id = $(this).attr("id");
		var btn_action = "changeItemStatus";
		if(confirm("Save into Draft means Item will be inactive and cannot view by User, Are you sure to do this ?"))
			{
				$.ajax({
					url: base_url+"action_item.php",
					method:"POST",
					data:{item_id:item_id, btn_action:btn_action},
					success:function(data)
					{	
						$('.step2').hide('slow') ;
						$('.step4').show('slow') ;
					}
				})
			}
			else
			{
				return false;
			}
	});
	 
	  $(document).on('click','.changeItemStatus', function(event){
		var item_id = $(this).attr("id");
		var btn_action = "changeItemStatus";
		if(confirm("Save into Draft means Item will be inactive and cannot view by User, Are you sure to do this ?"))
			{
				$.ajax({
					url: base_url+"action_item.php",
					method:"POST",
					data:{item_id:item_id, btn_action:btn_action},
					success:function(data)
					{	
						$('.remove-messages').fadeIn().html('<div class="alert alert-info">'+(data)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},2000);
						manageItemsTable.ajax.reload();
						manageFeaturedItemsTable.ajax.reload();
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
	
	mainDocument.on('submit','.stripe_settings', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action_payment_setting.php",
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
	mainDocument.on('submit','.paypal_settings', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action_payment_setting.php",
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
	
	mainDocument.on('submit','.transaction_fee_settings', function(event){
		event.preventDefault();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"action_payment_setting.php",
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
	
	
		
	function decodeEntities(encodedString) {
	  var textArea = document.createElement('textarea');
	  textArea.innerHTML = encodedString;
	  return textArea.value;
	}
});
