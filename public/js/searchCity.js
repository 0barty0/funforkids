var autocomplete;
function initAutocomplete() {// Google map autocomplete function
    // Create the autocomplete object, restricting the search to geographical
    // location types.
    let input = document.getElementById('place'),
        options = {types: ['(cities)'], placeIdOnly: true, componentRestrictions: {country: 'fr'}};

    autocomplete = new google.maps.places.Autocomplete(input,options);

    autocomplete.addListener('place_changed', getPlaceVerification);
  }

  function getPlaceVerification() {
    let place = autocomplete.getPlace();
    $('input[name=place_verification]').val(place['name']);
  }

  $(function() {
    $('form').on('submit', function(e) {
      // Reset
      $('.invalid-feedback').html('');
      $('.is-invalid').removeClass('is-invalid');

      // Verify if a google place has been selected
      let place = $('input[name=place]').val(),
          place_verification = $('input[name=place_verification]').val();
      if (place !== place_verification) {
        e.preventDefault();
        e.stopPropagation();
        $('input[name=place]').addClass('is-invalid');
        $('input[name=place] ~ .invalid-feedback').html('Veuillez choisir une ville');
      }
    });
  });
