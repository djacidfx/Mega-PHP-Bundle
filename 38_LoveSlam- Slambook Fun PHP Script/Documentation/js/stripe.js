// JavaScript Document
jQuery(function ($) {
	
	"use strict";
	
	
    var newbase_url = location.protocol + '//' + location.host + location.pathname ;
	newbase_url = newbase_url.substring(0, newbase_url.lastIndexOf("/") + 1);
    
    
	var nstripe = function () {
		var tmp = null;
			$.ajax({
				'async': false,
				'type': "POST",
				'global': false,
				'dataType': 'html',
				'url': newbase_url+"/pk",
				'data': { 'request': "", 'target': 'arrange_url', 'method': 'method_target' },
				'success': function (data) {
					tmp = data;
				}
			});
		return tmp;
	}();
	var stripe = Stripe(nstripe);
    
	// Create an instance of elements
	var elements = stripe.elements();
	
	var style = {
		base: {
			fontWeight: 400,
			fontFamily: 'Roboto, Open Sans, Segoe UI, sans-serif',
			fontSize: '16px',
			lineHeight: '1.4',
			color: '#555',
			backgroundColor: '#fff',
			'::placeholder': {
				color: '#888',
			},
		},
		invalid: {
			color: '#eb1c26',
		}
	};

	var cardElement = elements.create('cardNumber', {
		'style': style
	});
	cardElement.mount('#card_number');
	
	var exp = elements.create('cardExpiry', {
		'style': style
	});
	exp.mount('#card_expiry');
	
	var cvc = elements.create('cardCvc', {
		'style': style
	});
	cvc.mount('#card_cvc');
	
	// Validate input of the card elements
	var resultContainer = document.getElementById('paymentResponse');
	cardElement.addEventListener('change', function(event) {
		if (event.error) {
			resultContainer.innerHTML = '<p class="text-danger errorMessage">'+event.error.message+'<button type="button" class="close float-end btn btn-grey btn-sm" aria-label="Close" ><span aria-hidden="true" id="hide">&times;</span></button></p>';
		} else {
			resultContainer.innerHTML = '';
		}
	});
	
	// Get payment form element
	var form = document.getElementById('payment_form');
	
	// Create a token when the form is submitted.
	form.addEventListener('submit', function(e) {
		e.preventDefault();
		createToken();
	});
	
	// Create single-use token to charge the user
	function createToken() {
		stripe.createToken(cardElement).then(function(result) {
			if (result.error) {
				// Inform the user if there was an error
				resultContainer.innerHTML = '<p>'+result.error.message+'</p>';
			} else {
				// Send the token to your server
				stripeTokenHandler(result.token);
			}
		});
	}
	
	// Callback to handle the response from stripe
	function stripeTokenHandler(token) {
		// Insert the token ID into the form so it gets submitted to the server
		var hiddenInput = document.createElement('input');
		hiddenInput.setAttribute('type', 'hidden');
		hiddenInput.setAttribute('name', 'tokenStripe');
		hiddenInput.setAttribute('value', token.id);
		form.appendChild(hiddenInput);
		$('#submitBtn').attr('disabled','disabled');
		// Submit the form
		form.submit();
		
	}
});