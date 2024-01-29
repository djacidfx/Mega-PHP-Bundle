// JavaScript Document
jQuery(document).ready(function($) {
    "use strict";


  var newbase_url = location.protocol + '//' + location.host + location.pathname ;
	newbase_url = newbase_url.substring(0, newbase_url.lastIndexOf("/") + 1);


  $(document).on("click","#hide", function() {
		$(".errorMessage").hide();
	});




  $(document).on('submit','.shortMyLink', function(event){
  event.preventDefault();
  $('.shortBtn').attr('disabled','disabled');
  $(".shortBtn").html("Shortening...");
  var form_data = $(this).serialize();
    $.ajax({
              url: newbase_url+"find",
              method:"POST",
              data:form_data,
              success:function(data)
              {
                 data = JSON.parse(data);
                 $('.shortMyLink')[0].reset();
                 $('.shortBtn').attr('disabled',false);
                 $(".shortBtn").html(data.buttonName);
                  if(data.err == 0) {
                    $('.shortLink').html('<div class="input-group"><input type="text" id="txt" class="form-control bg-dark text-white" readonly="readonly" value="'+data.newlink+'"><button class="btn btn-primary tk" id="tk" type="button" data-clipboard-target="#txt"><i class="bi bi-clipboard"></i></button></div>').fadeIn("slow");
                  }
                  if(data.err == 1) {
                    alert(data.wrong) ;
                  }
              }
        });
  });

  $(document).on('click', '.tk', function(){
    setTimeout(function () {
      $('.tk').html("<i class='bi bi-clipboard'></i>").fadeOut("slow");
    }, 500);
    setTimeout(function () {
      $('.tk').html("<i class='bi bi-clipboard-check'></i>").fadeIn("slow");
    }, 1000);

  });

});
