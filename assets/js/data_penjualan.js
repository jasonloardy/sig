$(document).ready(function() {
  tabel_penjualan();
});

function addCommas(nStr) {
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}

function format (d) {
  var detailJual = '';
  $.each(d.detail, function(i, item) {
    detailJual += '<tr>'+
                      '<td class="text-center">'+item.kd_barang+'</td>'+
                      '<td>'+item.nama_barang+'</td>'+
                      '<td class="text-center">'+addCommas(item.qty)+'</td>'+
                      '<td class="text-center">'+addCommas(item.harga)+'</td>'+
                      '<td class="text-right">'+addCommas(item.jumlah)+'</td>'+
                  '</tr>';
    console.log(detailJual);
  });
  return '<table class="table table-bordered">'+
            // '<tr>'+
            //     '<td colspan="2" class="text-center"><b>Pelanggan : '+d.Nama_Plg+'</b></td>'+
            //     '<td colspan="2" class="text-center"><b>User : '+d.User+'</b></td>'+
            // '</tr>'+
            '<tr style="font-weight:bold;background-color:#9b9bff;color:#fff" class="text-center">'+
                '<td width="20%">Kode Barang</td>'+
                '<td width="35%">Nama Barang</td>'+
                '<td width="10%">Qty</td>'+
                '<td width="15%">Harga</td>'+
                '<td width="20%">Jumlah</td>'+
            '</tr>'+detailJual+
            '<tr class="text-right font-weight-bold">'+
                '<td colspan="3"></td>'+
                '<td style="background-color:#f8f8ff">Sub Total :</td>'+
                '<td style="background-color:#f8f8ff">'+addCommas(d.sub_total)+'</td>'+
            '</tr>'+
            '<tr class="text-right font-weight-bold">'+
                '<td colspan="3"></td>'+
                '<td style="background-color:#f8f8ff">Diskon ('+d.diskon+'%) :</td>'+
                '<td style="background-color:#f8f8ff">'+addCommas(d.jumlah_diskon)+'</td>'+
            '</tr>'+
            '<tr class="text-right font-weight-bold">'+
                '<td colspan="3"></td>'+
                '<td style="background-color:#f8f8ff">PPN (10%) :</td>'+
                '<td style="background-color:#f8f8ff">'+addCommas(d.ppn_10_persen)+'</td>'+
            '</tr>'+
            '<tr class="text-right font-weight-bold">'+
                '<td colspan="3"></td>'+
                '<td style="background-color:#f8f8ff">Total Faktur :</td>'+
                '<td style="background-color:#f8f8ff">'+addCommas(d.total_faktur)+'</td>'+
            '</tr>'+
          '</table>';
}

function tabel_penjualan() {
  var table = $('#tabel_penjualan').DataTable({
      "ajax" : {
        "url" : "data_penjualan/json_all",
        "dataSrc" : ""
      },
      "columns" : [
        { "className" : 'details-control',
          "orderable" : false,
          "data" : null,
          "defaultContent": ''
          },
        { "data" : "kd_invoice",
          "className": 'text-center'
          },
        { "data" : "tanggal",
          "className": 'text-center'
          },
        { "data" : "pelanggan" },
        { "data" : "diskon",
          "className": 'text-center'
          },
        { "data" : "total_faktur",
          "className": 'text-right',
          "render": function (data, type, row) {
            return addCommas(data);
          } }
      ]
  });

  // Add event listener for opening and closing details
  $('#tabel_penjualan tbody').on('click', 'td.details-control', function () {
    var tr = $(this).closest('tr');
    var row = table.row( tr );

    if ( row.child.isShown() ) {
        // This row is already open - close it
        row.child.hide();
        tr.removeClass('shown');
    }
    else {
        // Open this row
        row.child( format(row.data()) ).show();
        tr.addClass('shown');
    }
  });
}
