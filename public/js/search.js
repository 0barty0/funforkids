$.addTemplateFormatter("dateFormat", function(value, template) {
  let date = new Date(value.date);
  return date.getDate()+'/'+(date.getMonth()+1)+'/'+date.getFullYear();
});

$.addTemplateFormatter("timeFormat", function(value, template) {
  return value.substring(0,5);
});

$.addTemplateFormatter("linkFormat", function(value, template) {
  return "/event/" + value;
});

function searchDate() {
  $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
  var date = $('#date').val();
  $.ajax({
    type:'POST',
    url:'/search/date',
    data:'date='+date,
    success:function(data){
      showEvents(data.events);
      }
  });
}

function showEvents(events) {
  $('#results').loadTemplate("/templates/date.html", events);
}
