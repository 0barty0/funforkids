$(function(){
  if (location.href.search(/search\/city/g) !== -1) {
    $('a[href="http://'+location.hostname+'/search/city"]').parent().addClass('active');
  } else {
    $('a[href="'+location.href+'"]').parent().addClass('active');
  }

  $(window).on('scroll', function(){
    if ($(this).scrollTop() > 50) {
      $('nav').addClass('shrink');
    } else {
      $('nav').removeClass('shrink');
    }
  });
});
