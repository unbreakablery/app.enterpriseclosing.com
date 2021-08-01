/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/opportunities.js ***!
  \***************************************/
$(document).ready(function () {
  function clearAddTaskModal() {
    // $('#add-task-modal select[name=action]').selectpicker('val', $("#add-task-modal select[name=action] option:first").val());
    // $('#add-task-modal select[name=step]').selectpicker('val', $("#add-task-modal select[name=step] option:first").val());
    $('#add-task-modal input[name=note]').val('');
    $('#add-task-modal input[name=by-date]').val(''); // $('#add-task-modal select[name=priority]').selectpicker('val', $("#add-task-modal select[name=priority] option:first").val());
  }

  function drawSuggestTaskModal(suggest) {
    var innerHtml = '';
    $('#suggest-task-modal .modal-body .additional-tasks').html('');

    if (suggest != undefined && suggest != null) {
      suggest.steps.forEach(function (step, idx) {
        innerHtml += '<div class="form-row pt-1 pb-1 additional-task-item-' + idx + ' col-12">';
        innerHtml += '<div class="col-2">'; // innerHtml += '<select name="suggest-action-' + idx + '" id="suggest-action-' + idx + '" class="selectpicker col-12 pl-0 pr-0 n-b-r">';

        innerHtml += '<select name="suggest-action-' + idx + '" id="suggest-action-' + idx + '" class="col-12 pl-0 pr-0 n-b-r">';
        suggest.actions.forEach(function (action) {
          innerHtml += '<option value="' + action.id + '" ' + (action.id == suggest.old_action ? 'selected' : '') + '>' + action.name + '</option>';
        });
        innerHtml += '</select>';
        innerHtml += '</div>';
        innerHtml += '<div class="col-2">';
        innerHtml += '<input type="hidden" value="' + step.id + '" id="suggest-step-' + idx + '" name="suggest-step-' + idx + '"/>';
        innerHtml += '<input type="text" class="form-control n-b-r h-default-input" value="' + step.name + '" id="suggest-step-name-' + idx + '" name="suggest-step-name-' + idx + '" readonly />';
        innerHtml += '</div>';
        innerHtml += '<div class="col-1">';
        innerHtml += '<input type="text" class="form-control n-b-r h-default-input" value="' + suggest.person_account + '" id="suggest-person-account-' + idx + '" name="suggest-person-account-' + idx + '" readonly/>';
        innerHtml += '</div>';
        innerHtml += '<div class="col-2">'; // innerHtml += '<select class="selectpicker col-12 pl-0 pr-0 n-b-r" id="suggest-opportunity-' + idx + '" name="suggest-opportunity-' + idx + '" readonly>';

        innerHtml += '<select class="col-12 pl-0 pr-0 n-b-r" id="suggest-opportunity-' + idx + '" name="suggest-opportunity-' + idx + '" readonly>';
        suggest.opportunities.forEach(function (opp) {
          innerHtml += '<option value="' + opp.id + '" ' + (opp.id == suggest.old_opportunity ? 'selected' : 'disabled') + '>' + opp.opportunity + '</option>';
        });
        innerHtml += '</select>';
        innerHtml += '</div>';
        innerHtml += '<div class="col-1">';
        innerHtml += '<input type="text" class="form-control n-b-r h-default-input" id="suggest-note-' + idx + '" name="suggest-note-' + idx + '" placeholder="Note..." />';
        innerHtml += '</div>';
        innerHtml += '<div class="col-2">';
        innerHtml += '<input type="text" class="form-control date n-b-r h-default-input" value="' + suggest.by_date + '" id="suggest-by-' + idx + '" name="suggest-by-' + idx + '" placeholder="dd-mm-yyyy" />';
        innerHtml += '</div>';
        innerHtml += '<div class="col-1">'; // innerHtml += '<select name="suggest-priority-' + idx + '" id="suggest-priority-' + idx + '" class="selectpicker col-12 pl-0 pr-0 n-b-r">';

        innerHtml += '<select name="suggest-priority-' + idx + '" id="suggest-priority-' + idx + '" class="col-12 pl-0 pr-0 n-b-r">';
        innerHtml += '<option value="3">Normal</option>';
        innerHtml += '<option value="2">Medium</option>';
        innerHtml += '<option value="1">High</option>';
        innerHtml += '</select>';
        innerHtml += '</div>';
        innerHtml += '<div class="col-1 btn-suggest-save-wrapper">';
        innerHtml += '<button type="button" class="btn btn-success btn-suggest-save n-b-r" data-id="' + idx + '">Save</button>';
        innerHtml += '</div>';
        innerHtml += '</div>';
      });
    } else {
      innerHtml += '<p class="text-center w-100">';
      innerHtml += 'No suggested additional tasks!';
      innerHtml += '</p>';
    }

    $('#suggest-task-modal .modal-body .additional-tasks').append(innerHtml); // $('#suggest-task-modal .modal-body .additional-tasks select').selectpicker({noneSelectedText: '', container: 'body'});

    $('#suggest-task-modal .modal-body .additional-tasks .date').datepicker({
      format: 'dd-mm-yyyy',
      todayBtn: "linked",
      todayHighlight: true,
      clearBtn: true,
      autoclose: true
    });
  }

  var currentTable = null;
  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    var table = $.fn.dataTable.tables({
      visible: true,
      api: true
    });
    table.columns.adjust();
    table.columns().iterator('column', function (ctx, idx) {
      if ($(table.column(idx).header()).find('.task-table-header').find('span.sort-icon').length == 0) {
        $(table.column(idx).header()).find('.task-table-header').append('<span class="sort-icon"/>');
      }
    });
  });
  var taskTable = $('.opportunities-wrapper .task-table').DataTable({
    responsive: true,
    orderCellsTop: true,
    fixedHeader: true,
    info: false,
    scrollY: 123,
    scrollCollapse: false,
    paging: false,
    order: [[4, "asc"]],
    columnDefs: [{
      orderable: false,
      targets: 'no-sort'
    }, {
      type: 'date-eu',
      targets: 4
    }, {
      width: "30%",
      targets: 3
    }, {
      width: "80px",
      targets: 4
    }, {
      width: "80px",
      targets: 5
    }, {
      width: "90px",
      targets: 6
    }],
    language: {
      emptyTable: 'There is no tasks for you to complete.'
    }
  });
  $.fn.dataTable.tables({
    visible: true,
    api: true
  }).columns().iterator('column', function (ctx, idx) {
    $($.fn.dataTable.tables({
      visible: true,
      api: true
    }).column(idx).header()).find('.task-table-header').append('<span class="sort-icon"/>');
  });
  $('.date').datepicker({
    format: 'dd-mm-yyyy',
    todayBtn: "linked",
    todayHighlight: true,
    clearBtn: true,
    autoclose: true
  });
  $('#btn-show-modal').click(function () {
    //Show modal
    $('#add-opportunity-modal').modal({
      backdrop: 'static'
    });
  });
  $('#btn-create-new-tab').click(function () {
    var tabName = $('#tab-name').val();
    $('#tab-name').val(''); // Check if opportunity name is empty

    if (tabName === '') {
      showMessage('danger', "Type: Input Error <br/>NOTE: You must enter new opportunity name.");
      return;
    } // Hide modal


    $('#add-opportunity-modal').modal('hide'); // Save blank opportunity

    loader('show');
    $.ajax({
      url: "opportunities/save-main",
      dataType: "json",
      type: "post",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        'opp-id': 0,
        'opportunity-name': tabName
      },
      success: function success(res) {
        // Add new tab
        var tabNavElement = '';
        tabNavElement += '<li class="nav-item" role="presentation">';
        tabNavElement += '<a class="nav-link active" ';
        tabNavElement += ' data-toggle="tab" role="tab" aria-selected="true" ';
        tabNavElement += ' id="tab-' + tabIndex + '" ';
        tabNavElement += ' href="#opp-tab-' + tabIndex + '" ';
        tabNavElement += ' aria-controls="#opp-tab-' + tabIndex + '">';
        tabNavElement += tabName;
        tabNavElement += " <strong></strong>";
        tabNavElement += '</a></li>';
        var tabContent = '';
        tabContent += '<div class="tab-pane fade show active" role="tabpanel" ';
        tabContent += ' id="opp-tab-' + tabIndex + '" ';
        tabContent += ' data-idx="' + tabIndex + '" ';
        tabContent += ' aria-labelledby="tab-' + tabIndex + '">';
        tabContent += '</div>';
        $('#oppTabs li.nav-item a.nav-link').removeClass('active');
        $('#oppTabs li.nav-item a.nav-link').attr('aria-selected', false);
        $('#oppTabsContent div.tab-pane').removeClass('show');
        $('#oppTabsContent div.tab-pane').removeClass('active');
        $('#oppTabs').append(tabNavElement);
        $('#oppTabsContent').append(tabContent); // Add new component to tab

        $('#opp-tab-' + tabIndex).append($('#opp-component-empty .tab-component').clone(false));
        $('#opp-tab-' + tabIndex + ' .task-table').attr('id', 'task-table-' + res.id);
        $('#opp-tab-' + tabIndex + ' .task-table').DataTable({
          responsive: true,
          orderCellsTop: true,
          fixedHeader: true,
          info: false,
          scrollY: 123,
          scrollCollapse: false,
          paging: false,
          order: [[4, "asc"]],
          columnDefs: [{
            orderable: false,
            targets: 'no-sort'
          }, {
            type: 'date-eu',
            targets: 4
          }, {
            width: "30%",
            targets: 3
          }, {
            width: "80px",
            targets: 4
          }, {
            width: "80px",
            targets: 5
          }, {
            width: "90px",
            targets: 6
          }],
          language: {
            emptyTable: 'There is no tasks for you to complete.'
          }
        });
        var table = $.fn.dataTable.tables({
          visible: true,
          api: true
        });
        table.columns.adjust();
        table.columns().iterator('column', function (ctx, idx) {
          if ($(table.column(idx).header()).find('.task-table-header').find('span.sort-icon').length == 0) {
            $(table.column(idx).header()).find('.task-table-header').append('<span class="sort-icon"/>');
          }
        });
        $('.date').datepicker({
          format: 'dd-mm-yyyy',
          todayBtn: "linked",
          todayHighlight: true,
          clearBtn: true,
          autoclose: true
        }); // Add opportunity id and name

        $('#opp-tab-' + tabIndex).find('input[name=opp-id]').val(res.id);
        $('#opp-tab-' + tabIndex).find('input[name=opportunity-name]').val(tabName);
        $('#opp-tab-' + tabIndex).find('input[name=opportunity]').val(tabName); //Set some ids

        $('#opp-tab-' + tabIndex).find('.accordion-section').attr('id', 'accordion-' + res.id);
        $('#opp-tab-' + tabIndex).find('.card .card-header').attr('id', 'headingMeddpicc-' + res.id);
        $('#opp-tab-' + tabIndex).find('.card .card-header a.btn-link').attr('data-target', '#collapseMeddpicc-' + res.id);
        $('#opp-tab-' + tabIndex).find('.card .card-header a.btn-link').attr('aria-controls', '#collapseMeddpicc-' + res.id);
        $('#opp-tab-' + tabIndex).find('.collapse-section').attr('id', 'collapseMeddpicc-' + res.id);
        $('#opp-tab-' + tabIndex).find('.collapse-section').attr('aria-labelledby', 'headingMeddpicc-' + res.id);
        $('#opp-tab-' + tabIndex).find('.collapse-section').attr('data-parent', '#accordion-' + res.id); // Increase tab index

        tabIndex++;
        loader('hide');
      },
      error: function error(request, status, _error) {
        loader('hide');
        showMessage('danger', 'Type: AJAX Error<br/>NOTE: ' + status);
      }
    });
  }); //implement skip and done

  $('.task-table tbody').on('click', 'button.btn-task-c-s', function () {
    var tr = $(this).parents('tr');
    var id = $(this).data('id');
    var tableId = $(this).attr('data-table-id');
    var status = 0;

    if ($(this).hasClass('btn-skip')) {
      status = 1;
    } else if ($(this).hasClass('btn-done')) {
      status = 2;
    } else {
      status = 0;
    }

    loader('show');
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
        loader('hide');

        if (data.type == 'success') {
          var taskTable = $('table#task-table-' + tableId).DataTable();
          taskTable.row(tr).remove().draw(); // Remove * sign from tab name

          if (taskTable.rows().count() == 0) {
            var idx = $('table.task-table').index($('table#task-table-' + tableId)) / 2 - 1;
            $('#oppTabs a#tab-' + idx).find('strong').text('');
          }

          showMessage('success', data.message);
        } else {
          showMessage('danger', data.message);
        }
      }
    });
  });
  $(document).on('click', '.collapse-section input[type=radio].form-check-input', function () {
    var meddpiccTab = $(this).closest('.collapse-section');
    var metricsScore = $(meddpiccTab).find('input[type=radio][name=m_metrics_score]:checked').val();
    var economicBuyerScore = $(meddpiccTab).find('input[type=radio][name=m_economic_buyer_score]:checked').val();
    var decisionCriteriaScore = $(meddpiccTab).find('input[type=radio][name=m_decision_criteria_score]:checked').val();
    var decisionProcessScore = $(meddpiccTab).find('input[type=radio][name=m_decision_process_score]:checked').val();
    var paperProcessScore = $(meddpiccTab).find('input[type=radio][name=m_paper_process_score]:checked').val();
    var identifiedPainScore = $(meddpiccTab).find('input[type=radio][name=m_identified_pain_score]:checked').val();
    var championCoachScore = $(meddpiccTab).find('input[type=radio][name=m_champion_coach_score]:checked').val();
    var competitionScore = $(meddpiccTab).find('input[type=radio][name=m_competition_score]:checked').val();
    var meddpiccScore = parseInt(metricsScore) + parseInt(economicBuyerScore) + parseInt(decisionCriteriaScore) + parseInt(decisionProcessScore) + parseInt(paperProcessScore) + parseInt(identifiedPainScore) + parseInt(championCoachScore) + parseInt(competitionScore);
    $(this).closest('.accordion-section').find('input[name=m_meddpicc_score]').val(meddpiccScore);
    $(this).closest('.accordion-section').find('span#meddpicc-score').text(meddpiccScore);
  });
  $(document).on('click', 'button.btn-show-task-modal', function () {
    var oppId = $(this).closest('.tab-component').find('input[name=opp-id]').val();
    var oppName = $(this).closest('.tab-component').find('input[name=opportunity-name]').val();
    $('#add-task-modal input[name=opportunity]').val(oppName);
    $('#add-task-modal input[name=opportunity-id]').val(oppId); // get datatable obj

    currentTable = $(this).closest('.tab-component').find('.task-table').DataTable(); //Show task modal

    $('#add-task-modal').modal({
      backdrop: 'static'
    });
  });
  $('#add-task-modal button#btn-create-new-task').click(function () {
    var byDate = $('#add-task-modal input[name=by-date]').val();

    if (byDate == undefined || byDate == null || byDate == '') {
      showMessage('danger', 'Type: Input Error<br/>NOTE: You must enter By Date!');
      $('#add-task-modal input[name=by-date]').focus();
      return;
    }

    var action = $('#add-task-modal select[name=action]').val();
    var actionName = $('#add-task-modal select[name=action] option:selected').text();
    var step = $('#add-task-modal select[name=step]').val();
    var stepName = $('#add-task-modal select[name=step] option:selected').text();
    var person = $('#add-task-modal input[name=person-account]').val();
    var oppId = $('#add-task-modal input[name=opportunity-id]').val();
    var oppName = $('#add-task-modal input[name=opportunity]').val();
    var note = $('#add-task-modal input[name=note]').val();
    var priority = $('#add-task-modal select[name=priority]').val();
    loader('show');
    $.ajax({
      url: "opportunities/save-task",
      dataType: "json",
      type: "post",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        action: action,
        step: step,
        person_account: person,
        opportunity: oppId,
        note: note,
        by_date: byDate,
        priority: priority
      },
      success: function success(res) {
        loader('hide'); // Clear Modal and hide

        clearAddTaskModal();
        $('#add-task-modal').modal('hide'); // Show meassge

        showMessage('success', 'New task (ID: ' + res.taskID + ') was added successfully!'); // Add new row

        var className = '';
        var priorityName = '';

        if (priority == 1) {
          className = 'bg-danger text-white';
          priorityName = 'High';
        } else if (priority == 2) {
          className = 'bg-warning text-dark';
          priorityName = 'Medium';
        } else if (priority == 3) {
          className = 'bg-light text-dark';
          priorityName = 'Normal';
        } else {
          className = 'bg-light text-dark';
          priorityName = '';
        }

        var innerHtml = '';
        innerHtml += '<tr class="' + className + '">';
        innerHtml += '<td>' + actionName + ' ' + stepName + '</td>';
        innerHtml += '<td>' + person + '</td>';
        innerHtml += '<td>' + oppName + '</td>';
        innerHtml += '<td>' + note + '</td>';
        innerHtml += '<td>' + byDate + '</td>';
        innerHtml += '<td>' + priorityName + '</td>';
        innerHtml += '<td>';
        innerHtml += '<button type="button" class="btn btn-sm btn-task-c-s btn-dark btn-skip" data-id="' + res.taskID + '" data-table-id="' + oppId + '">Skip</button> ';
        innerHtml += '<button type="button" class="btn btn-sm btn-task-c-s btn-success btn-done" data-id="' + res.taskID + '" data-table-id="' + oppId + '">Done</button>';
        innerHtml += '</td>';
        innerHtml += '</tr>';
        currentTable.row.add($(innerHtml)).draw(); // Add * sign to tab name

        var idx = $('table.task-table').index($('table#task-table-' + oppId)) / 2 - 1;
        $('#oppTabs a#tab-' + idx).find('strong').text('*'); // Show suggest task modal

        $('#suggest-task-modal').modal({
          backdrop: 'static'
        }); // Draw suggest task modal

        var suggest = res.suggest;
        drawSuggestTaskModal(suggest);
      },
      error: function error(request, status, _error2) {
        loader('hide');
        showMessage('danger', status);
      }
    });
  }); //suggest task save

  $(document).on('click', '.btn-suggest-save', function () {
    var id = $(this).data('id');
    var suggestAction = $('#suggest-action-' + id).val();
    var suggestStep = $('#suggest-step-' + id).val();
    var suggestPersonAccount = $('#suggest-person-account-' + id).val();
    var suggestOpportunity = $('#suggest-opportunity-' + id).val();
    var suggestOpportunityText = $('#suggest-opportunity-' + id + ' option:selected').text();
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
        // Show meassge
        showMessage('success', 'New task (ID: ' + res.task_id + ') was added successfully!'); // Add new row

        var className = '';
        var priorityName = '';

        if (suggestPriority == 1) {
          className = 'bg-danger text-white';
          priorityName = 'High';
        } else if (suggestPriority == 2) {
          className = 'bg-warning text-dark';
          priorityName = 'Medium';
        } else if (suggestPriority == 3) {
          className = 'bg-light text-dark';
          priorityName = 'Normal';
        } else {
          className = 'bg-light text-dark';
          priorityName = '';
        }

        var innerHtml = '';
        innerHtml += '<tr class="' + className + '">';
        innerHtml += '<td>' + res.action_name + ' ' + res.step_name + '</td>';
        innerHtml += '<td>' + suggestPersonAccount + '</td>';
        innerHtml += '<td>' + suggestOpportunityText + '</td>';
        innerHtml += '<td>' + suggestNote + '</td>';
        innerHtml += '<td>' + suggestDate + '</td>';
        innerHtml += '<td>' + priorityName + '</td>';
        innerHtml += '<td>';
        innerHtml += '<button type="button" class="btn btn-sm btn-task-c-s btn-dark btn-skip" data-id="' + res.task_id + '">Skip</button> ';
        innerHtml += '<button type="button" class="btn btn-sm btn-task-c-s btn-success btn-done" data-id="' + res.task_id + '">Done</button>';
        innerHtml += '</td>';
        innerHtml += '</tr>';
        currentTable.row.add($(innerHtml)).draw();
        $('.additional-task-item-' + id + ' *').prop('disabled', true);
      }
    });
  }); // When click label for radio

  $(document).on('click', '.radio-group label', function () {
    $(this).closest('.form-check').find('input[type=radio]').prop("checked", true);
  });
});
/******/ })()
;