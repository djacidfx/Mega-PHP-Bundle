$(function(){

  var audio;

	var base_url = window.location.href;
	base_url = base_url.substring(0, base_url.substring(0, base_url.lastIndexOf("/")).lastIndexOf("/")+1) ;
  // AUDIO INITIALIZER

  function initAudio(element){

    audio = new Audio(base_url+'media/' + element.attr('file'));

    $("#song-title").empty();
    $("#song-artist").empty();
    $("#song-album").empty();

    $("#song-title").html(element.attr('song'));
    $("#song-artist").html(element.attr('artist'));
    $("#song-album").html(element.attr('album'));
    $("#cover").attr("src", "imgs/" + element.attr('cover'));

    element.addClass('active');
    showDuration();
  }


  // TIME DURATION UPDATE [PROGRESS BAR AND TIME INFOS]

  function showDuration(){

    $(audio).bind('timeupdate', function(){

      var s1 = parseInt(audio.currentTime % 60);
      var m1 = parseInt((audio.currentTime / 60) % 60);
      var s0 = parseInt((audio.duration - audio.currentTime) % 60);
      var m0 = parseInt(((audio.currentTime - audio.duration) / 60) % 60);

      if (s1 < 10) { s1 = '0' + s1; }
      if (s0 < 10) { s0 = '0' + s0; }
		if(isNaN(m0) && isNaN(s0)){
	  		m0 = "0";
			s0 = "00";
	  	}
      $('#time-start').html(m1 + ':' + s1);
      $('#time-end'  ).html(m0 + ':' + s0);

      var value = 0;

      if (audio.currentTime > 0) {
        value = Math.floor((100 / audio.duration) * audio.currentTime);
      }

      $('.audio-player-progress-bar').css('width', value + '%');

      // autoplay next song
      if (audio.currentTime >= (audio.duration)){
        $('#forward').trigger('click');
      }
    });
  }


  // PLAY-PAUSE BUTTON
  $(document).on('click', '#playpause' ,function (e) {
    if($("#playpause").hasClass("fa-play")){
      $("#playpause").removeClass("fa-play").addClass("fa-pause");
      audio.play();
      showDuration();
    } else if ($("#playpause").hasClass("fa-pause")){
      $("#playpause").removeClass("fa-pause").addClass("fa-play");
      audio.pause();
    }
  });


  // MOVE TO NEXT TRACK [CLICK ON NEXT BUTTON]
  $(document).on('click', '#forward' ,function (e) {
    audio.pause();
    var next = $('#playlist li.active').next('li');
    $('#playlist li.active').removeClass("active");
	if (next.length == 0) {
	  next = $('#playlist li').first().addClass("active");
    }
	if($(".playpause").hasClass("fa-play")){
      $(".playpause").removeClass("fa-play").addClass("fa-pause");
    }
    initAudio(next);
    audio.play();
    showDuration();
  });


  // MOVE TO PREVIOUS TRACK [CLICK ON PREVIOUS BUTTON]
  $(document).on('click', '#backward' ,function (e) {
    audio.pause();
    var prev = $('#playlist li.active').prev('li');
    $('#playlist li.active').removeClass("active");
    if (prev.length == 0) {
      prev = $('#playlist li').last().addClass("active");
    }
    if($("#playpause").hasClass("fa-play")){
      $("#playpause").removeClass("fa-play").addClass("fa-pause");
    }
    initAudio(prev);
    audio.play();
    showDuration();
  });


  // RANDOM SORT OF PLAYLIST TRACKS [CLICK ON RANDOM BUTTON]
  $(document).on('click', '#random' ,function (e) {
    var parent = $("#playlist");
    var divs = parent.children();
    while (divs.length) {
        parent.append(divs.splice(Math.floor(Math.random() * divs.length), 1)[0]);
    }
  });


  // SHOW-HIDE PLAYLIST [CLICK ON PLAYLIST BUTTON]

  $('#show-playlist').click(function(){
    $("#playlist").slideToggle();
  });


  // CHANGE TRACK [CLICK ON TRACK IN THE PLAYLIST]
  $(document).on('click', '.playlist li' ,function (e) {
    audio.pause();
    $('.playlist li.active').removeClass("active");
    initAudio($(this));
    audio.play();
    showDuration();
	 if($(".playpause").hasClass("fa-play")){
      $(".playpause").removeClass("fa-play").addClass("fa-pause");
    }
  });


  // MOVE ON TRACK [CLICK ON DURATION BAR]

  $('.audio-player-progress').on('click', function(e) {
    var percent = Math.floor(100 * e.offsetX / $('.audio-player-progress').width());
    audio.currentTime = percent * audio.duration / 100;
  });


  // SHOW-HIDE AUDIO BUTTONS [HOVER ON CURRENT SONG INFOS]

  $('#controler').hover(function() {
    $('#audio-control').show();
    $('#infos-song').show();
  },
  function() {
    $('#audio-control').show();
    $('#infos-song').show();
  });


  // SHOW-HIDE AUDIO BUTTONS [HOVER ON ALBUM COVER]

  $('#audio-image').hover(function() {
    $('#audio-control').show();
    $('#infos-song').show();
  },
  function() {
    $('#audio-control').show();
    $('#infos-song').show();
  });


  // SHOW-HIDE AUDIO BUTTONS [HOVER ON HEADER]

  $('.header').hover(function() {
    $('#audio-control').show();
    $('#infos-song').show();
  },
  function() {
    $('#audio-control').show();
    $('#infos-song').show();
  });


  // ON PAGE REFRESH -> PLAY FIRST SONG

  initAudio($('#playlist li:first-child'));
  audio.play();
  $('#playpause').trigger('click');
  $('#playpause').trigger('click');
});
