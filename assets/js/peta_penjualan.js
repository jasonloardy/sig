$(document).ready(function() {
  map();
});

function map() {
  mapboxgl.accessToken = 'pk.eyJ1IjoiamFzb25sb2FyZHkiLCJhIjoiY2ticHkwYTJzMGQyMTJva2F1ZzFubDc2cyJ9.hVSZAbuxC_SDI7sCl2tkyA';
  var map = new mapboxgl.Map({
      container: 'map',
      style: 'mapbox://styles/mapbox/streets-v11',
      center: [121.229594, -2.058725],
      zoom: 5.75
  });

  map.on('load', function() {
    map.addLayer({
        'id': 'states-layer',
        'type': 'fill',
        'source': {
            'type': 'geojson',
            'data': 'data_kabupaten/geojson'
        },
        'paint': {
            'fill-color': {
                type: 'identity',
                property: 'color',
            },
            'fill-opacity': 0.65,
            'fill-outline-color': 'rgba(200, 100, 240, 1)'
        }
    });

    // When a click event occurs on a feature in the states layer, open a popup at the
    // location of the click, with description HTML from its properties.
    map.on('click', 'states-layer', function(e) {
      new mapboxgl.Popup()
      .setLngLat(e.lngLat)
      .setHTML(e.features[0].properties.Kabupaten_ + '<br>' + e.features[0].properties.total_faktur)
      .addTo(map);
      // alert(e.features[0].properties.Kabupaten_);
    });

    // Change the cursor to a pointer when the mouse is over the states layer.
    map.on('mouseenter', 'states-layer', function() {
      map.getCanvas().style.cursor = 'pointer';
    });

    // Change it back to a pointer when it leaves.
    map.on('mouseleave', 'states-layer', function() {
      map.getCanvas().style.cursor = '';
    });
  });
}
