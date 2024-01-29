// JavaScript Document
jQuery(function ($) {
	
	"use strict";
	
	var base_url = location.protocol + '//' + location.host + location.pathname ;
	base_url = base_url.substring(0, base_url.lastIndexOf("/") + 1);
	
	var spinner = $('#loader');
	
  	$(document).on("click","#hide", function() {
		$(".errorMessage").hide();
	});
	
	$(document).on('keyup',"#amount", function(){
		var str = $('#amount').val();
		if(isNaN(str)) {
			alert('Please enter a number.');
			$('#amount').val('') ;
		} 
	});
	$(document).on('keyup',"#tax", function(){
		var str = $('#tax').val();
		if(isNaN(str)) {
			alert('Please enter a number.');
			$('#tax').val('') ;
		} 
	});
	 $(document).on('submit','#fetchTax', function(event){
		event.preventDefault();
		$('#action').attr('disabled','disabled');
		$("#action").html("Processing...");
		spinner.show();
		var form_data = $(this).serialize();
		$.ajax({
			url:"fetch_tax.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				
				//$('#fetchTax')[0].reset();
				spinner.hide();
				$("#action").html("Calculate");
				$('#action').attr('disabled',false);
				data = JSON.parse(data);
				if(data != null ) {
				$('.resl').show("slow");
				} else {
					$('.remove-messages').fadeIn().html('<div class="alert alert-danger">'+(data.form_message)+'</div>');
						setTimeout(function(){
							$(".remove-messages").fadeOut("slow");
						},3000);
				}
				$("#taxamount").val(data.taxAmt);
				$("#netamount").val(data.netAmt);
				
			}
		})
	});
	
});