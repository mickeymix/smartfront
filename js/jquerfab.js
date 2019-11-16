var width = 0;
$('.overlay-trigger').click(overlay);
$('.overlay').click(hideOverlay);
$(window).on("scroll", hideOverlay);

function overlay(event) {
  if (window.innerWidth < 992) {
    if ($('.overlay').css('display') == 'none') {
      $('.overlay').css({
        'display': 'block'
      });
      width = window.innerWidth;
    }
  }
}

function hideOverlay(event) {
  if (width < 992) {
    if ($('.overlay').css('display') == 'block') {
      $('.overlay').css({
        'display': 'none'
      });
    }
  }
}