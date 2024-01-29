// JavaScript Document
jQuery(document).ready(function($) {
    "use strict";
     $('[data-toggle="tooltip"]').tooltip();   
    
    const words = ["Enter Youtube Link...",
  "https://www.youtube.com/watch?v=9FDuUd39NOI"
];
let i = 0;
let timer;

function typingEffect() {
  let word = words[i].split("");
  var loopTyping = function() {
    if (word.length > 0) {
      let elem = document.getElementById('typer');
      elem.setAttribute('placeholder', elem.getAttribute('placeholder') + word.shift());
    } else {
      deletingEffect();
      return false;
    };
    timer = setTimeout(loopTyping, 100);
  };
  loopTyping();
};

function deletingEffect() {
  let word = words[i].split("");
  var loopDeleting = function() {
    if (word.length > 0) {
      word.pop();
      document.getElementById('typer').setAttribute('placeholder', word.join(""));
    } else {
      if (words.length > (i + 1)) {
        i++;
      } else {
        i = 0;
      };
      typingEffect();
      return false;
    };
    timer = setTimeout(loopDeleting, 100);
  };
  loopDeleting();
};

typingEffect();
});
