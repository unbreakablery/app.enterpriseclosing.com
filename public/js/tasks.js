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

  var taskTable = $('#task-table').DataTable({
    responsive: true,
    orderCellsTop: true,
    fixedHeader: true,
    info: false,
    scrollY: 187,
    scrollCollapse: false,
    paging: false,
    order: [[3, "asc"]],
    columnDefs: [{
      orderable: false,
      targets: 'no-sort'
    }, {
      type: 'date-eu',
      targets: 3
    }],
    language: {
      emptyTable: 'There is no tasks for you to complete.'
    }
  });
  $('.date').datepicker({
    format: 'dd-mm-yyyy',
    todayBtn: "linked",
    todayHighlight: true,
    clearBtn: true,
    autoclose: true
  }); //implement skip and done

  $('#task-table tbody').on('click', 'button.btn-task-c-s', function () {
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
          taskTable.row(tr).remove().draw();
        } else {
          alert(data.message);
        }
      }
    });
  }); // $('input#action-other-name').change(function() {
  //     $('#action-other').val($(this).val());
  // });
  // $('input#step-other-name').change(function() {
  //     $('#step-other').val($(this).val());
  // });
  //validate form and submit

  $('button#btn-create-task').click(function () {
    var isActionChecked = false;
    var isStepChecked = false;
    $('input[type=radio][name=action]').each(function (idx, element) {
      if ($(element).is(':checked')) {
        isActionChecked = true;
      }
    });
    $('input[type=radio][name=step]').each(function (idx, element) {
      if ($(element).is(':checked')) {
        isStepChecked = true;
      }
    });

    if (!isActionChecked) {
      $('#action-label').tooltip('show');
      return;
    } else {
      $('#action-label').tooltip('hide');
    }

    if (!isStepChecked) {
      $('#step-label').tooltip('show');
      return;
    } else {
      $('#step-label').tooltip('hide');
    } //check from/to/account && opportunity


    if ($('input#ts-3-person-account').val() == '' && $('input#ts-6-opportunity').val() == '') {
      $('h3#ts-3-person-account-label').tooltip('show');
      $('h3#ts-6-opportunity-label').tooltip('show');
      $('input#ts-3-person-account').focus();
      return;
    } else {
      $('h3#ts-3-person-account-label').tooltip('hide');
      $('h3#ts-6-opportunity-label').tooltip('hide');
    } //check by_date


    if ($('input#ts-4-by-date').val() == '') {
      $('h3#ts-4-by-date-label').tooltip('show');
      $('input#ts-4-by-date').focus();
      return;
    } else {
      $('h3#ts-4-by-date-label').tooltip('hide');
    } //check priority


    var isPriorityChecked = false;
    $('input[type=radio][name=priority]').each(function (idx, element) {
      if ($(element).is(':checked')) {
        isPriorityChecked = true;
      }
    });

    if (!isPriorityChecked) {
      $('#priority-label').tooltip('show');
      return;
    } else {
      $('#priority-label').tooltip('hide');
    }

    $("form#tasks-form").submit();
  });
  $('input#ts-3-person-account').change(function () {
    $('input#ts-6-opportunity').val('');
  });
  $('input#ts-6-opportunity').change(function () {
    $('input#ts-3-person-account').val('');
  }); //suggest setting save

  $('.btn-suggest-save').on('click', function () {
    var id = $(this).data('id');
    var suggestAction = $('#suggest-action-' + id).val();
    var suggestStep = $('#suggest-step-' + id).val();
    var suggestPersonAccount = $('#suggest-person-account-' + id).val();
    var suggestOpportunity = $('#suggest-opportunity-' + id).val();
    var suggestNote = $('#suggest-note-' + id).val();
    var suggestDate = $('#suggest-by-' + id).val();
    var suggestPriority = $('#suggest-priority-' + id).val();
    $.ajax({
      url: "tasks/add",
      dataType: "json",
      type: "post",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        suggest_action: suggestAction,
        suggest_step: suggestStep,
        suggest_person_account: suggestPersonAccount,
        suggest_opportunity: suggestOpportunity,
        suggest_note: suggestNote,
        suggest_date: suggestDate,
        suggest_priority: suggestPriority
      },
      success: function success(res) {
        var className = '';
        var priorityName = '';

        if (suggestPriority == 1) {
          className = 'bg-danger text-white';
          priorityName = 'High';
        } else if (suggestPriority == 2) {
          className = 'bg-warning';
          priorityName = 'Medium';
        } else if (suggestPriority == 3) {
          className = 'bg-light';
          priorityName = 'Normal';
        } else {
          className = 'bg-light';
          priorityName = '';
        }

        var innerHtml = '';
        innerHtml += '<tr class="' + className + '">';
        innerHtml += '<td>' + res.action_name + ' ' + res.step_name + '</td>';
        innerHtml += '<td class="text-center">' + suggestPersonAccount + suggestOpportunity + '</td>';
        innerHtml += '<td>' + suggestNote + '</td>';
        innerHtml += '<td class="text-center">' + suggestDate + '</td>';
        innerHtml += '<td class="text-center">' + priorityName + '</td>';
        innerHtml += '<td class="text-center">';
        innerHtml += '<button type="button" class="btn btn-sm btn-task-c-s btn-dark btn-skip" data-id="' + res.task_id + '">Skip</button> ';
        innerHtml += '<button type="button" class="btn btn-sm btn-task-c-s btn-success btn-done" data-id="' + res.task_id + '">Done</button>';
        innerHtml += '</td>';
        innerHtml += '</tr>';
        taskTable.row.add($(innerHtml)).draw();
        $('.additional-task-item-' + id + ' *').prop('disabled', true);
      }
    });
  }); //show modal

  if (user_action == 'add-task') {
    $('#task-add-modal').modal({
      backdrop: 'static'
    });
  }
});
/******/ })()
;