function initAutocomplete() {
  var lat=$('#lat').val();
  var lng=$('#lng').val();
  var latLng = new google.maps.LatLng(lat, lng);
  var map = new google.maps.Map(document.getElementById('map'), {
    center: latLng,
    zoom: 13,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  var marker = new google.maps.Marker({
    position: latLng,
    title: 'Point A',
    map: map,
    draggable: true
  });
  google.maps.event.addListener(marker, 'dragstart', function() {
    updateMarkerAddress('Dragging...');
  });
   google.maps.event.addListener(marker, 'drag', function() {
    updateMarkerStatus('Dragging...');
    updateMarkerPosition(marker.getPosition());
  });
   google.maps.event.addListener(marker, 'dragend', function() {
    updateMarkerStatus('Drag ended');
    geocodePosition(marker.getPosition());
  });


  var input = document.getElementById('pac-input');
  var searchBox = new google.maps.places.SearchBox(input);
  map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
  map.addListener('bounds_changed', function() {
    searchBox.setBounds(map.getBounds());
  });
  searchBox.addListener('places_changed', function() {
    var places = searchBox.getPlaces();

    if (places.length == 0) {
      return;
    }
    marker.setMap(null);

    var bounds = new google.maps.LatLngBounds();
    places.forEach(function(place) {
      marker = new google.maps.Marker({
      position: place.geometry.location,
      title:place.name,
      map: map,
      draggable: true
    });
       geocodePosition(place.geometry.location);
       updateMarkerPosition(place.geometry.location);

         google.maps.event.addListener(marker, 'dragstart', function() {
    updateMarkerAddress('Dragging...');
  });
         google.maps.event.addListener(marker, 'drag', function() {
          updateMarkerStatus('Dragging...');
          updateMarkerPosition(marker.getPosition());
        });
         google.maps.event.addListener(marker, 'dragend', function() {
          updateMarkerStatus('Drag ended');
          geocodePosition(marker.getPosition());
        });

      if (place.geometry.viewport) {
        bounds.union(place.geometry.viewport);
      } else {
        bounds.extend(place.geometry.location);
      }
    });
    map.fitBounds(bounds);
  });
}
function geocodePosition(pos) {
  var geocoder = new google.maps.Geocoder();
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      updateMarkerAddress(responses[0].formatted_address);
    } else {
      updateMarkerAddress('Cannot determine address at this location.');
    }
  });
}
function updateMarkerStatus(str) {
  document.getElementById('markerStatus').innerHTML = str;
}
function updateMarkerPosition(latLng) {
  var lat=latLng.lat();
  var lng=latLng.lng();
  $('#lat').val(lat);
  $('#lng').val(lng);
}
function updateMarkerAddress(str) {
  /*document.getElementById('address').innerHTML = str;*/
  $('#address').val(str);
}
google.maps.event.addDomListener(window, 'load', initAutocomplete);