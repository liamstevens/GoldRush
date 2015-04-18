//to browser size on load
$(function() {
  var h = window.innerHeight;
  $(".toWindowSize").css("height", h);
});
    
//to browser size on resize
$(window).resize(function() {
  var h = window.innerHeight;
  $(".toWindowSize").css("height", h);
});