/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*******************************!*\
  !*** ./resources/js/tasks.js ***!
  \*******************************/
$(document).ready(function () {
  $.noConflict(); // $('#table-1 thead tr').clone(true).appendTo( '#table-1 thead' );
  // $('#table-1 thead tr:eq(1) th').each( function (i) {
  //     var title = $(this).text();
  //     var class_name = (i == 1 || i == 2 || i == 3) ? 'date' : '';
  //     $(this).html( '<input class="' + class_name + '" type="text" placeholder="Search '+title+'" />' );
  //     $( 'input', this ).on( 'keyup change', function () {
  //         if ( table1.column(i).search() !== this.value ) {
  //             table1
  //                 .column(i)
  //                 .search( this.value )
  //                 .draw();
  //         }
  //     } );
  // } );
  // var table1 = $('#table-1').DataTable( {
  //     orderCellsTop: true,
  //     fixedHeader: true,
  //     info: false,
  //     scrollY: 200,
  //     scrollCollapse: true,
  //     paging: false
  // } );

  var table2 = $('#table-2').DataTable({
    responsive: true,
    orderCellsTop: true,
    fixedHeader: true,
    info: false,
    scrollY: 311,
    scrollCollapse: false,
    paging: false,
    order: [[2, "asc"]],
    columnDefs: [{
      orderable: false,
      targets: 'no-sort'
    }, {
      type: 'date-eu',
      targets: 2
    }]
  });
  $('.date').datepicker({
    format: 'dd-mm-yyyy',
    todayBtn: "linked",
    todayHighlight: true,
    clearBtn: true
  });
  $('#table-2 tbody').on('click', 'button.btn-task-c-s', function () {
    var tr = $(this).parents('tr');
    var id = $(this).data('id');
    var status = 0;

    if ($(this).hasClass('btn-skip')) {
      status = 1;
    } else if ($(this).hasClass('btn-done')) {
      status = 2;
    } else {
      status = 0;
    }

    $.ajax({
      url: "tasks/save",
      dataType: "json",
      type: "post",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        id: id,
        status: status
      },
      success: function success(data) {
        if (data.type == 'success') {
          table2.row(tr).remove().draw();
        } else {
          alert(data.message);
        }
      }
    });
  });
  $('input#ts-1-other').change(function () {
    $('#ts-1-rg-other').val($(this).val());
  });
  $('input#ts-2-other').change(function () {
    $('#ts-2-rg-other').val($(this).val());
  });
});
/******/ })()
;