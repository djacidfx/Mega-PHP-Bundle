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
		if(confirm("Are you sure you want to Deactivate this Image from Users ?"))
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
		if(confirm("Are you sure you want to Activate this Image ?"))
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
				if(data == 2) {
					$('#action-item').attr('disabled', false); 
					$('.remove-messages').fadeIn().html('<div  class="alert alert-danger errorMessage">Image Title is missing.<button type="button" class="close float-right" aria-label="Close" > <span aria-hidden="true" id="hide">&times;</span></button></div>');
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
	 
	 $(document).on('change','#uploadMainFile', function(event){
		event.preventDefault();
		$('.mainfileprogress').show();
		var allowedTypes = ['png', 'jpg', 'jpeg'];
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
				if(FileSize < 5.1) {
					event.preventDefault();
					$('#targetLayer').hide();
					$.ajax({
						   xhr: function() {
							var xhr = new window.XMLHttpRequest();
							xhr.upload.addEventListener("progress", function(evt) {
								if (evt.lengthComputable) {
									
									var percentComplete = (evt.loaded / evt.total) * 100;
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
							
							$('.remove-messagesmainfile').fadeIn().html('<div class="alert alert-success">Image Uploaded Successfully.</div>');
							$('.mainfile').hide();
							$('.mainfileprogress').hide();
						},
						resetForm: true
					});
				} else {
					alert("File must not be greater than 5 MB.") ;
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
			alert("Please Select a png, jpg or jpeg file.") ;
			$('#uploadMainFile').val('');
			$('.mainfileprogress').hide();
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
		if(confirm("This Image will be Live for Users, Are you sure you want to do this ?"))
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
		var pid = $(this).attr("id");
		var btn_action = "changeItemStatus";
		if(confirm("Save into Draft means Image will be inactive and cannot view by User, Are you sure to do this ?"))
			{
				$.ajax({
					url: base_url+"action_item.php",
					method:"POST",
					data:{pid:pid, btn_action:btn_action},
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
		
	function decodeEntities(encodedString) {
	  var textArea = document.createElement('textarea');
	  textArea.innerHTML = encodedString;
	  return textArea.value;
	}
});
