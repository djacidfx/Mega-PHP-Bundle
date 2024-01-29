// JavaScript Document
jQuery(document).ready(function($) {
    "use strict";
    /*$('body').tooltip({selector: '[data-bs-toggle="tooltip"]'});*/
    $('[data-bs-toggle="tooltip"]').tooltip({
                    trigger : 'hover'
                }) ;
    $('[data-bs-toggle="tooltip"]').on('click', function () {
                  $(this).tooltip('hide');
                });
}) ;