$(document).ready(function() {
  tabel_penjualan();
});

function getUrlParameter(name) {
  name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
  var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
  var results = regex.exec(location.search);
  return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
};

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

function addPeriod(nStr) {
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + '.' + '$2');
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

function tabel_penjualan(json) {

  var from = getUrlParameter("from");
  if (from == '') {
    from = moment().format('YYYY/MM/DD');
  }
  var to = getUrlParameter("to");
  if (to == '') {
    to = moment().format('YYYY/MM/DD');
  }

  var table = $('#tabel_penjualan').DataTable({
      "ajax" : {
        "url" : "data_penjualan/json_all?from="+from+"&to="+to,
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
      ],
      "footerCallback": function ( row, data, start, end, display ) {
        var api = this.api(), data;

        // Remove the formatting to get integer data for summation
        var intVal = function ( i ) {
          return typeof i === 'string' ?
              i.replace(/[\$,]/g, '')*1 :
              typeof i === 'number' ?
                  i : 0;
        };

        // Total over all pages
        total = api
          .column( 5 )
          .data()
          .reduce( function (a, b) {
              return intVal(a) + intVal(b);
          }, 0 );

        // Total over this page
        pageTotal = api
          .column( 5, { page: 'current'} )
          .data()
          .reduce( function (a, b) {
              return intVal(a) + intVal(b);
          }, 0 );

        // Update footer
        $( api.column( 5 ).footer() ).html(
          'Rp. '+ addPeriod(pageTotal) +' (Rp. '+ addPeriod(total) +')'
        );
      }
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

  $('#periode').daterangepicker({
    "showDropdowns": true,
    "locale": {
       "format": "YYYY/MM/DD"
     },
    ranges: {
      'Semua Data': ['1970/01/01', moment()],
      'Hari ini': [moment(), moment()],
      'Kemarin': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      '7 Hari Terakhir': [moment().subtract(6, 'days'), moment()],
      '30 Hari Terakhir': [moment().subtract(29, 'days'), moment()],
      'Bulan Ini': [moment().startOf('month'), moment().endOf('month')],
      'Bulan Lalu': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
    },
      "startDate": from,
      "endDate": to
    }, function(start, end, label) {
        window.location = 'data_penjualan?from=' + start.format('YYYY/MM/DD') + '&to=' + end.format('YYYY/MM/DD');
  });
}
