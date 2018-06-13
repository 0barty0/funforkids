var autocomplete;
function initAutocomplete() {
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
    $('.custom-file-input').on('change', function() {
      let filename = document.getElementById('file-input').files[0].name;
      $(this).next('.custom-file-label').html(filename);
    });

    // Form validation
    $('form').on('submit', function(e){
      // Verify if a google place has been selected
      let place = $('input[name=place]').val(),
          place_verification = $('input[name=place_verification]').val();
      if (place !== place_verification) {
        e.preventDefault();
        e.stopPropagation();
        $('input[name=place]').addClass('is-invalid');
        $('input[name=place]').parent().append('<div class="invalid-feedback">Veuillez entrer une adresse valide</div>')
      }
    });
  });
