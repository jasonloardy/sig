$(document).ready(function() {
  tabel_pelanggan();
});

let token = 'pk.eyJ1IjoiamFzb25sb2FyZHkiLCJhIjoiY2ticHkwYTJzMGQyMTJva2F1ZzFubDc2cyJ9.hVSZAbuxC_SDI7sCl2tkyA';

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

  if (geo != 'null') {
    var marker = new mapboxgl.Marker({ draggable: true })
    .setLngLat(geo_map.split(','))
    .addTo(map);
  }

  $('#pelangganModal').on('shown.bs.modal', function() {
    map.resize();
  });

	var geocoder = new MapboxGeocoder({ accessToken: mapboxgl.accessToken,
																			mapboxgl: mapboxgl
	});

	map.addControl(geocoder);

  let geolocation;

	geocoder.on('result', function(e) {
	  // console.log(e.result.center[0] + ', ' + e.result.center[1]);
    geolocation = e.result.center[0] + ', ' + e.result.center[1];
    get_alamat(geolocation);
    $('#geolocation').val(geolocation);

	  geocoder.clear();

	  marker.setLngLat(e.result.center).addTo(map);

		function onDragEnd() {
			var lngLat = marker.getLngLat();
			// console.log(lngLat.lng + ', ' + lngLat.lat);
      geolocation = lngLat.lng + ', ' + lngLat.lat;
      get_alamat(geolocation);
      $('#geolocation').val(geolocation);
		}

		marker.on('dragend', onDragEnd);
	});
}

function get_alamat(geolocation) {

  $.getJSON("https://api.mapbox.com/geocoding/v5/mapbox.places/" + geolocation + ".json?access_token=" + token, function(data){
    // console.log(data.features[0].properties.address);
    $('#alamat').val(data.features[0].properties.address);
  });

}
