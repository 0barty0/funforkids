var autocomplete;
function initAutocomplete() {// Google map autocomplete function
    // Create the autocomplete object, restricting the search to geographical
    // location types.
    let input = document.getElementById('place'),
        options = {types: [], placeIdOnly: true, componentRestrictions: {country: 'fr'}};

    autocomplete = new google.maps.places.Autocomplete(input,options);

    autocomplete.addListener('place_changed', getPlaceId);
  }

  function getPlaceId() {
    let place = autocomplete.getPlace();
    $('input[name=place_id]').val(place['place_id']);
    $('input[name=place_verification]').val(place['name']);
  }

  $(function() {
    //Scroll to the input field under the header
    var elements = document.querySelectorAll('input,select,textarea');
    for (var i = elements.length; i--;) {
        elements[i].addEventListener('invalid', function () {
            this.scrollIntoView(false);
        });
    }

    $('input[name=title]').on('blur', function() {
      $('input[name=title]').removeClass('is-invalid');
      $('input[name=title] ~ .invalid-feedback').html('');

      $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
      let value = $('input[name=title]').val(),
          unique = false;
      $.ajax({
        type:'POST',
        url:'/check-title',
        data:{title: value},
        success:function(data){
          if (data != 0) {
            $('input[name=title]').addClass('is-invalid');
            $('input[name=title] ~ .invalid-feedback').html('La valeur du champ titre est déjà utilisée.');
          }
          }
      });

    });

    $('.custom-file-input').on('change', function() {
      let filename = document.getElementById('file-input').files[0].name;
      $(this).next('.custom-file-label').html(filename);
    });

    // Form validation
    $('form').on('submit', function(e){
      // Reset
      $('.invalid-feedback').html('');
      $('.is-invalid').removeClass('is-invalid');

      // Verify date
      let date_start = new Date($('input[name=date_start]').val()),
          date_end = new Date($('input[name=date_end]').val()),
          date = new Date();

          date.setHours(0, 0, 0, 0);

      if (date_start < date) {
        e.preventDefault();
        e.stopPropagation();
        $('input[name=date_start]').addClass('is-invalid');
        $('input[name=date_start] ~ .invalid-feedback').html('La date de début doit être au moins aujourd\'hui');
      }

      if (date_end < date_start) {
        e.preventDefault();
        e.stopPropagation();
        $('input[name=date_end]').addClass('is-invalid');
        $('input[name=date_end] ~ .invalid-feedback').html('La date de fin doit être après la date de début');
      }

      // Verify time
      let time_start = new Date('01/01/2011 '+$('input[name=time_start]').val()),
          time_end = new Date('01/01/2011 '+$('input[name=time_end]').val());

      if (time_end < time_start) {
        e.preventDefault();
        e.stopPropagation();
        $('input[name=time_end]').addClass('is-invalid');
        $('input[name=time_end] ~ .invalid-feedback').html('L\'heure de fin doit être après l\'heure de début');
      }


      // Verify if a google place has been selected
      let place = $('input[name=place]').val(),
          place_verification = $('input[name=place_verification]').val();
      if (place !== place_verification) {
        e.preventDefault();
        e.stopPropagation();
        $('input[name=place]').addClass('is-invalid');
        $('input[name=place] ~ .invalid-feedback').html('Veuillez entrer une adresse valide');
      }
      $('.is-invalid:first').focus();
    });
  });
