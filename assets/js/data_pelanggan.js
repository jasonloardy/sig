$(document).ready(function() {
  tabel_pelanggan();
});

let token = 'pk.eyJ1IjoiamFzb25sb2FyZHkiLCJhIjoiY2ticHkwYTJzMGQyMTJva2F1ZzFubDc2cyJ9.hVSZAbuxC_SDI7sCl2tkyA';
let tokenGmaps = 'AIzaSyB1HBqMYvcjI161URlIQ96gkmiPlSYPpyc';

function tabel_pelanggan() {
  $('#tabel_pelanggan').DataTable({
    "ajax" : {
      "url" : "data_pelanggan/json_all",
      "dataSrc" : ""
    },
    "columns" : [
      { "data" : "kd_pelanggan" },
      { "data" : "nama_pelanggan",
        "render" : function (data, type, row) {
          return '<a href="#" onclick="detail(\'' + row.kd_pelanggan + '\', \'' + row.nama_pelanggan + '\', \'' + row.alamat + '\', \'' + row.no_telepon + '\', \'' + row.geolocation + '\')">' + data + '</a>';
        } },
      { "data" : "alamat" },
      { "data" : "geolocation" },
      { "data" : "no_telepon" }
    ]
  });
}

function detail(id, nama, alamat, telepon, geolocation) {
  $('#kodePelanggan').val(id);
  $('#namaPelanggan').val(nama);
  $('#noTelepon').val(telepon);
  if (alamat == 'null') {
    $('#alamat').val('');
  } else {
    $('#alamat').val(alamat);
  }
  if (geolocation == 'null') {
    $('#geolocation').val('');
  } else {
    $('#geolocation').val(geolocation);
  }
  $('#shortlink').val('');
  map_pelanggan(geolocation);
  $('#pelangganModal').modal('show');
}

function map_pelanggan(geo) {
  var geo_map, zoom;
  if (geo == 'null') {
    geo_map = '119.423790, -5.135399';
    zoom = 13;
  } else {
    geo_map = geo;
    zoom = 15
  }

  // TO MAKE THE MAP APPEAR YOU MUST
	// ADD YOUR ACCESS TOKEN FROM
	// https://account.mapbox.com
	mapboxgl.accessToken = token;
	var map = new mapboxgl.Map({
		container: 'map',
		style: 'mapbox://styles/mapbox/streets-v11',
		center: geo_map.split(','),
		zoom: zoom
	});

  var marker = new mapboxgl.Marker({ draggable: true });

  if (geo != 'null') {
    marker.setLngLat(geo_map.split(',')).addTo(map);
  }

  $('#pelangganModal').on('shown.bs.modal', function() {
    map.resize();
  });

	var geocoder = new MapboxGeocoder({ accessToken: mapboxgl.accessToken,
																			mapboxgl: mapboxgl
	});

	map.addControl(geocoder);

  var geolocation;

	geocoder.on('result', function(e) {
	  // console.log(e.result.center[0] + ', ' + e.result.center[1]);
    geolocation = e.result.center[0] + ', ' + e.result.center[1];
    get_alamat(geolocation);
    $('#geolocation').val(geolocation);

	  geocoder.clear();

	  marker.setLngLat(e.result.center).addTo(map);

	});

  function onDragEnd() {
    var lngLat = marker.getLngLat();
    // console.log(lngLat.lng + ', ' + lngLat.lat);
    geolocation = lngLat.lng + ', ' + lngLat.lat;
    get_alamat(geolocation);
    $('#geolocation').val(geolocation);
  }

  marker.on('dragend', onDragEnd);
}

function get_alamat(geolocation) {
  // API Mapbox
  // $.getJSON("https://api.mapbox.com/geocoding/v5/mapbox.places/" + geolocation + ".json?access_token=" + token, function(data){
  //   $('#alamat').val(data.features[0].properties.address);
  // });

  // API Google Maps
  var geolocation = geolocation.split(', ');
  $.getJSON("https://maps.googleapis.com/maps/api/geocode/json?latlng="+ geolocation[1] +","+ geolocation[0] + "&key=" + tokenGmaps, function(data){
    $('#alamat').val(data.results[0].formatted_address);
  });
}

function get_googleMaps() {
  var url = $('#shortlink').val()
  $.post( "data_pelanggan/redirect", { url: url })
    .done(function( data ) {
      get_alamat(data);
      map_pelanggan(data);
      $('#geolocation').val(data);
  });
}
