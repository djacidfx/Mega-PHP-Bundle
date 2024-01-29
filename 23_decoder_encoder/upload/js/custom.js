// JavaScript Document
jQuery(function ($) {
	
	"use strict";
	
	var base_url = location.protocol + '//' + location.host + location.pathname ;
	base_url = base_url.substring(0, base_url.lastIndexOf("/") + 1);
	
	
  	$(document).on("click","#hide", function() {
		$(".errorMessage").hide();
	});
	
	 $(document).on('submit','#fetchText', function(event){
		event.preventDefault();
		$('#action').attr('disabled','disabled');
		$("#action").html("Converting...");
		var form_data = $(this).serialize();
		$.ajax({
			url:base_url+"fetch_text.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				
				$("#action").html("Convert");
				$('#action').attr('disabled',false);
				data = JSON.parse(data);
				if(data != null ) {
				$('.res').show("slow");
				$("#newText").val(data.newText);
				} else {
					$('.remove-messages').fadeIn().html('<div class="alert alert-danger">'+(data.form_message)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},3000);
				}
				
				
			}
		})
	});
	 
	$(document).on('click','#resetBtn', function(event){
		$('#fetchText')[0].reset();
		$('.res').hide("slow");
	});
	$(function(){
		var select_all = function(control){
			$(control).focus().select();
			var copy = $(control).val();
			if(confirm("Click OK to Copy."))
			{
				copy = document.execCommand("copy");
			}
			else
			{
				return false;
			}
		}
		$(document).on('click','#newText', function(event){
			select_all(this);
		})
	})
	
});