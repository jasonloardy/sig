$(document).ready(function() {
  tabel_kabupaten();
});

function tabel_kabupaten() {
  $('#tabel_kabupaten').DataTable({
    "ajax" : {
      "url" : "data_kabupaten/json_all",
      "dataSrc" : ""
    },
    "columns" : [
      { "data" : "kd_kabupaten",
        "className": 'text-center' },
      { "data" : "provinsi" },
      { "data" : "nama_kabupaten",
        "render" : function (data, type, row) {
          return '<a href="#" onclick="detail(\'' + row.kd_kabupaten + '\', \'' + row.provinsi + '\', \'' + row.nama_kabupaten + '\')">' + data + '</a>';
        } }
    ]
  });
}

function detail(id, provinsi, nama) {
  $('#kodekabupaten').val(id);
  $('#provinsi').val(provinsi);
  $('#namakabupaten').val(nama);
  $('#kabupatenModal').modal('show');
}
