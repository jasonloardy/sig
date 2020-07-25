$(document).ready(function() {
  tabel_barang();
});

function tabel_barang() {
  $('#tabel_barang').DataTable({
    "ajax" : {
      "url" : "data_barang/json_all",
      "dataSrc" : ""
    },
    "columns" : [
      { "data" : "kd_barang",
        "className": 'text-center' },
      { "data" : "nama_barang",
        "render" : function (data, type, row) {
          return '<a href="#" onclick="detail(\'' + row.kd_barang + '\', \'' + row.nama_barang + '\')">' + data + '</a>';
        } }
    ]
  });
}

function detail(id, nama) {
  $('#kodebarang').val(id);
  $('#namabarang').val(nama);
  $('#barangModal').modal('show');
}
