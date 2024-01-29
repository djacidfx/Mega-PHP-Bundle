// JavaScript Document
jQuery(document).ready(function($) {
	
	"use strict";
	
	var base_url = location.protocol + '//' + location.host + location.pathname ;
	base_url = base_url.substring(0, base_url.lastIndexOf("/") + 1);
	
	var spinner = $('#loaderCat');
	
	//*********************Change Color Here Start - Do not change anything above****************************
	
	//Currency Name Background Color
	var currencyNameBgColor = "#b6b4e0";
	//Currency Name Text Color 
	var currencyNameColor = "#000000";
	
	//1 Bitcoin = Area Background Color 
	var bitcoinValueBgColor = "#ffffff";	
	//Bitcoin Line Text Color
	var bitcoinValueColor = "#666666";
	
	//********************Change Color Here End - Do not change anything below******************************
	
	$(document).ready(function(){
		$.ajax({
			url: base_url+"onebtc.php",
			success:function(data)
			{
				var usd_price = data.slice(1,-1) ;
				usd_price = round(usd_price,2) ;
				$('.onebtc').html(usd_price) ;
			}
		});							   
	});
	$(document).on("click",".updateUsd",function(){
		spinner.show();
		$.ajax({
			url: base_url+"onebtc.php",
			success:function(data)
			{
				spinner.hide(500);
				var usd_price = data.slice(1,-1) ;
				usd_price = round(usd_price,2) ;
				$('.onebtc').html(usd_price) ;
			}
		});							   
	});
	$(document).on("click",".updateBitcoinPrice",function(){
		spinner.show();
		$('.allcurrency').remove();
		$('.allcurrencyUpdate').empty();
		$.get(base_url+"allcurrency.php", function(response) {    
			if (response != '') 
			{
				spinner.hide(500);
				var response2 = JSON.parse(response);
				$.each(response2,function(key, value){
				value = round(value,2) ;
				 $('.allcurrencyUpdate').append('<div class="col-lg-3 p-2"><div class="card"><div class="card-header" style="background:'+currencyNameBgColor+';color:'+currencyNameColor+' ;"><h4>' + key + '</h4></div><div class="card-body" style="background: '+bitcoinValueBgColor+' ; color:'+bitcoinValueColor+' ;"> 1 BTC = ' + value + '</div></div>');
				});
			 }
		});
	});
	$.get(base_url+"allcurrency.php", function(response) {    
        if (response != '') 
        {
            var response2 = JSON.parse(response);
            $.each(response2,function(key, value){
			value = round(value,2) ;
             $('.allcurrency').append('<div class="col-lg-3 p-2"><div class="card"><div class="card-header" style="background:'+currencyNameBgColor+';color:'+currencyNameColor+' ;"><h4>' + key + '</h4></div><div class="card-body" style="background: '+bitcoinValueBgColor+' ; color:'+bitcoinValueColor+' ;"> 1 BTC = ' + value + '</div></div>');
            });
         }
    });
	
	$.get(base_url+"allcurrency.php", function(response) {    
        if (response != '') 
        {
            var response2 = JSON.parse(response);
            $('.currencyName').find('option').remove(); 
            $.each(response2,function(key, value){
			value = round(value,2) ;
             $('.currencyName').append('<option value=' + key + '>' + key + '</option>');
            });
         }
    });
	
	$(document).on('submit','.submitCurrency', function(event){
		event.preventDefault();
		$('.actionSubmit').attr('disabled','disabled');
		spinner.show();
		var form_data = $(this).serialize();
		$.ajax({
			url: base_url+"getCurrencyValue.php",
			method:"POST",
			data:form_data,
			success:function(data)
			{
				spinner.hide(500);
				$('.getCurrentValue').html(data) ;
				$('.actionSubmit').attr('disabled', false);
			}
		})
	});
	
	$('.amt').keypress(function(event) {
  if ((event.which != 46 || $(this).val().indexOf('.') != -1) &&
    ((event.which < 48 || event.which > 57) &&
      (event.which != 0 && event.which != 8))) {
    event.preventDefault();
  }

  var text = $(this).val();

  if ((text.indexOf('.') != -1) &&
    (text.substring(text.indexOf('.')).length > 2) &&
    (event.which != 0 && event.which != 8) &&
    ($(this)[0].selectionStart >= text.length - 2)) {
    event.preventDefault();
  }
});
	
	function round(value, exp) {
	  if (typeof exp === 'undefined' || +exp === 0)
		return Math.round(value);
	
	  value = +value;
	  exp = +exp;
	
	  if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0))
		return NaN;
	
	  // Shift
	  value = value.toString().split('e');
	  value = Math.round(+(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp)));
	
	  // Shift back
	  value = value.toString().split('e');
	  return +(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp));
	}
}) ;