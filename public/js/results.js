$(function(){
$(window).on('scroll', function() {
  if ($('body').scrollTop() > 20 || $('html').scrollTop() > 20) {
    $('#scroll-top').show();
  } else {
    $('#scroll-top').hide();
  }
});

$('#scroll-top').on('click', function() {
  $('#date-event').val('');
  $('html,body').animate({scrollTop: 0-100},'slow');
});

moment.locale('fr');
var picker = new Pikaday({
  field: document.getElementById('date-event'),
  format: 'dddd DD MMMM YYYY',
  minDate: moment().toDate(),
  defaultDate: moment(dateArray[0],'YYYY.MMMM.dddd DD').toDate(),
  disableDayFn: eventDate
  });

$('#date-event-container').on('click', function() {
  picker.show();
});

$('#date-event').on('change', function(){
  let dateId =picker.toString('YYYY-MMMM-DD');
  $('html,body').animate({scrollTop: $('#'+dateId).offset().top-100},'slow');
});
});
