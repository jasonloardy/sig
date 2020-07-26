$(document).ready(function() {
  periode();
});

function getUrlParameter(name) {
  name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
  var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
  var results = regex.exec(location.search);
  return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
};

function periode() {
  var from = getUrlParameter("from");
  if (from == '') {
    from = moment().format('YYYY/MM/DD');
  }
  var to = getUrlParameter("to");
  if (to == '') {
    to = moment().format('YYYY/MM/DD');
  }

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
        window.location = 'peta_penjualan?from=' + start.format('YYYY/MM/DD') + '&to=' + end.format('YYYY/MM/DD');
  });
}
