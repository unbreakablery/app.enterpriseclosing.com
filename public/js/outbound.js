/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/outbound.js ***!
  \**********************************/
$(document).ready(function () {
  function clearAddTaskModal() {
    $('#add-task-modal select[name=action]').val(0);
    $('#add-task-modal select[name=step]').val(0);
    $('#add-task-modal input[name=person-account]').val('');
    $('#add-task-modal input[name=opportunity]').val('');
    $('#add-task-modal input[name=note]').val('');
    $('#add-task-modal select[name=priority]').val(0);
    $('.date').datepicker("setDate", new Date());
  }

  $('.date').datepicker({
    format: 'dd-mm-yyyy',
    todayBtn: "linked",
    todayHighlight: true,
    clearBtn: true,
    autoclose: true
  }).datepicker("setDate", new Date());
  $('#btn-show-modal').click(function () {
    //Show modal
    $('#add-account-modal').modal({
      backdrop: 'static'
    });
  });
  $('#btn-create-new-tab').click(function () {
    var tabName = $('#tab-name').val();
    $('#tab-name').val(''); // Check if account name is empty

    if (tabName === '') {
      showMessage('danger', "Type: Input Error<br/>NOTE: You must enter new account name.");
      return;
    } // Hide modal


    $('#add-account-modal').modal('hide'); // Save blank outbound

    loader('show');
    $.ajax({
      url: "outbound/save-main",
      dataType: "json",
      type: "post",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        id: 0,
        account_name: tabName
      },
      success: function success(res) {
        // Add new tab
        var tabNavElement = '';
        tabNavElement += '<li class="nav-item" role="presentation">';
        tabNavElement += '<a class="nav-link active" ';
        tabNavElement += ' data-toggle="tab" role="tab" aria-selected="true" ';
        tabNavElement += ' id="tab-' + tabIndex + '" ';
        tabNavElement += ' href="#ob-tab-' + tabIndex + '" ';
        tabNavElement += ' aria-controls="#ob-tab-' + tabIndex + '">';
        tabNavElement += tabName;
        tabNavElement += '</a></li>';
        var tabContent = '';
        tabContent += '<div class="tab-pane fade show active" role="tabpanel" ';
        tabContent += ' id="ob-tab-' + tabIndex + '" ';
        tabContent += ' data-idx="' + tabIndex + '" ';
        tabContent += ' aria-labelledby="tab-' + tabIndex + '">';
        tabContent += '</div>';
        $('#outboundTabs li.nav-item a.nav-link').removeClass('active');
        $('#outboundTabs li.nav-item a.nav-link').attr('aria-selected', false);
        $('#outboundTabsContent div.tab-pane').removeClass('show');
        $('#outboundTabsContent div.tab-pane').removeClass('active');
        $('#outboundTabs').append(tabNavElement);
        $('#outboundTabsContent').append(tabContent); // Add new table to tab

        $('#ob-tab-' + tabIndex).append($('#ob-component-empty').html()); // Add account name

        $('#ob-tab-' + tabIndex).find('input[name=account-name]').val(tabName); // Increase tab index

        tabIndex++; // Change outbound id

        $('#ob-tab-' + (tabIndex - 1)).find('input[name=o-id]').val(res.id);
        loader('hide');
      },
      error: function error(request, status, _error) {
        loader('hide');
        showMessage('danger', status);
      }
    });
  });
  $('#btn-create-new-task').click(function () {
    var action = $('#add-task-modal select[name=action]').val();
    var step = $('#add-task-modal select[name=step]').val();
    var personAccount = $('#add-task-modal input[name=person-account]').val();
    var opportunity = $('#add-task-modal input[name=opportunity]').val();
    var note = $('#add-task-modal input[name=note]').val();
    var byDate = $('#add-task-modal input[name=by-date]').val();
    var priority = $('#add-task-modal select[name=priority]').val();
    loader('show');
    $.ajax({
      url: "outbound/save-task",
      dataType: "json",
      type: "post",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        action: action,
        step: step,
        person_account: personAccount,
        opportunity: opportunity,
        note: note,
        by_date: byDate,
        priority: priority
      },
      success: function success(res) {
        loader('hide');
        $('#add-task-modal').modal('hide'); // Show meassge

        showMessage('success', 'New task (ID: ' + res.taskID + ') was added successfully!');
      },
      error: function error(request, status, _error2) {
        loader('hide');
        showMessage('danger', status);
      }
    });
  });
  $(document).on('click', '.btn-add-row', function () {
    var pTable = $(this).closest('.tab-component').find('#persons-table'); // Remove no data row

    $(pTable).find('#no-data-row').remove(); // Add new row

    $(pTable).find('tbody').append($('#tr-component-empty tbody').html());
    var trObj = $(pTable).find('tbody tr').last();
    trObj[0].scrollIntoView(true);
  });
  $(document).on('change', '.tab-component .main-info input[type=text], .tab-component .main-info textarea', function () {
    var tabComponent = $(this).closest('.tab-component');
    var oId = $(tabComponent).find('input[name=o-id]').val();
    var accountName = $(tabComponent).find('input[name=account-name]').val();
    var annualReport = $(tabComponent).find('input[name=annual-report]').val();
    var prArticles = $(tabComponent).find('input[name=pr-articles]').val();
    var orgHooks = $.trim($(tabComponent).find('textarea[name=org-hooks]').val());
    var additionalNuggets = $.trim($(tabComponent).find('textarea[name=additional-nuggets]').val());
    loader('show');
    $.ajax({
      url: "outbound/save-main",
      dataType: "json",
      type: "post",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        id: oId,
        account_name: accountName,
        annual_report: annualReport,
        pr_articles: prArticles,
        org_hooks: orgHooks,
        additional_nuggets: additionalNuggets
      },
      success: function success(res) {
        // Change outbound id
        $(tabComponent).find('input[name=o-id]').val(res.id);
        loader('hide');
      },
      error: function error(request, status, _error3) {
        loader('hide');
        showMessage('danger', status);
      }
    });
  });
  $(document).on('change', '.tab-component table#persons-table input, .tab-component table#persons-table select', function () {
    var thisObj = $(this);
    var tabComponent = $(this).closest('.tab-component');
    var rowObj = $(this).closest('tr');
    var oId = $(tabComponent).find('input[name=o-id]').val();
    var accountName = $(tabComponent).find('input[name=account-name]').val();
    var id = $(rowObj).data('id');

    if (oId == 0) {
      showMessage('danger', "Type: Input Error<br/>NOTE: Outbound didn't create yet!");
      return;
    }

    var firstName = $(rowObj).find('input[name=first-name]').val();
    var lastName = $(rowObj).find('input[name=last-name]').val();
    var title = $(rowObj).find('input[name=title]').val();
    var phone = $(rowObj).find('input[name=phone]').val();
    var mobile = $(rowObj).find('input[name=mobile]').val();
    var email = $(rowObj).find('input[name=email]').val();
    var calls = $(rowObj).find('input[name=calls]').val();
    var result = $(rowObj).find('select[name=result]').val();
    var liConnected = $(rowObj).find('select[name=linkedin-connected]').val();
    var notes = $(rowObj).find('input[name=notes]').val();
    var liAddress = $(rowObj).find('input[name=linkedin-address]').val();
    loader('show');
    $.ajax({
      url: "outbound/save-person",
      dataType: "json",
      type: "post",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        id: id,
        o_id: oId,
        first_name: firstName,
        last_name: lastName,
        title: title,
        phone: phone,
        mobile: mobile,
        email: email,
        calls: calls,
        result: result,
        li_connected: liConnected,
        notes: notes,
        li_address: liAddress
      },
      success: function success(res) {
        // Change outbound person id
        $(rowObj).data('id', res.id);
        loader('hide'); // Clear add task modal

        clearAddTaskModal(); // Check if element type is select element

        var elementName = $(thisObj).attr('name');

        if (elementName === 'result' && $(thisObj).val() === 'Send Info') {
          //Show task modal
          $('#add-task-modal input[name=person-account]').val(accountName);
          $('#add-task-modal').modal({
            backdrop: 'static'
          });
        }
      },
      error: function error(request, status, _error4) {
        loader('hide');
        showMessage('danger', status);
      }
    });
  });
  $(document).on('click', '.btn-remove-row', function () {
    var rowObj = $(this).closest('tr');
    var id = $(rowObj).data('id');

    if (id == 0) {
      // Remove row element
      $(rowObj).remove();
      return;
    }

    loader('show');
    $.ajax({
      url: "outbound/remove-person",
      dataType: "json",
      type: "post",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        id: id
      },
      success: function success(res) {
        // Remove row element
        $(rowObj).remove();
        loader('hide');
      },
      error: function error(request, status, _error5) {
        loader('hide');
        showMessage('danger', status);
      }
    });
  });
  $(document).on('click', '.a-btn-remove-account', function () {
    var tabComponent = $(this).closest('.tab-component');
    var id = $(tabComponent).find('input[name=o-id]').val();
    var accountName = $(tabComponent).find('input[name=account-name]').val();

    if (id == 0) {
      showMessage('danger', 'Type: Input Error<br/>NOTE: Not saved this account!');
      return;
    }

    loader('show');
    $.ajax({
      url: "outbound/remove-main",
      dataType: "json",
      type: "post",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        id: id
      },
      success: function success(res) {
        // Remove tab
        var idx = $(tabComponent).parent().data('idx');
        $('#outboundTabsContent #ob-tab-' + idx).remove();
        $('#outboundTabs #tab-' + idx).parent().remove(); // Active first tab

        $('#outboundTabs li a.nav-link').first().addClass('active');
        $('#outboundTabsContent .tab-pane').first().addClass('show active');
        loader('hide');
        showMessage('success', 'Account (' + accountName + ') was removed successfully!');
      },
      error: function error(request, status, _error6) {
        loader('hide');
        showMessage('danger', status);
      }
    });
  });
  $(document).on('click', '.btn-download-persons', function () {
    var id = $(this).closest('.tab-component').find('input[name=o-id]').val();

    if (id == 0 || id == '' || id == undefined) {
      showMessage('danger', "Type: Output Error<br/>NOTE: You can't download these persons data now!");
      return;
    }

    var url = '/outbound/download/' + id;
    window.location.href = url;
  });
  $(document).on('click', '#btn-upload-persons', function () {
    var idx = $('#upload-file-modal').attr('data-idx');
    var pTable = $('#ob-tab-' + idx + ' .tab-component').find('#persons-table');
    var id = $('#ob-tab-' + idx + ' .tab-component').find('input[name=o-id]').val();
    var file_data = $('#upload-file-modal input[name=upload-file]').prop('files')[0];

    if (file_data == undefined) {
      showMessage('danger', 'Type: Input Error<br />NOTE: Please choose a upload csv file!');
      return;
    }

    var form_data = new FormData();
    form_data.append('upload-file', file_data);
    form_data.append('id', id);
    form_data.append('_token', $('meta[name="csrf-token"]').attr('content'));
    loader('show');
    $.ajax({
      url: '/outbound/upload',
      dataType: 'json',
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,
      type: 'post',
      success: function success(res) {
        // Remove all rows on table
        $(pTable).find('tbody tr').remove();

        for (var i = 0; i < res.persons.length; i++) {
          var person = res.persons[i];
          var newRow = $('#tr-component-empty tbody tr').clone(); // Set values to new row

          $(newRow).attr('data-id', person.id);
          $(newRow).find('input[name=first-name]').val(person.first_name);
          $(newRow).find('input[name=last-name]').val(person.last_name);
          $(newRow).find('input[name=title]').val(person.title);
          $(newRow).find('input[name=phone]').val(person.phone);
          $(newRow).find('input[name=mobile]').val(person.mobile);
          $(newRow).find('input[name=email]').val(person.email);
          $(newRow).find('input[name=calls]').val(person.calls);
          $(newRow).find('select[name=result]').val(person.result);
          $(newRow).find('select[name=linkedin-connected]').val(person.li_connected);
          $(newRow).find('input[name=notes]').val(person.notes);
          $(newRow).find('input[name=linkedin-address]').val(person.li_address); // Add new row

          $(pTable).find('tbody').append(newRow);
        }

        $('#upload-file-modal').modal('hide');
        loader('hide');
        showMessage('success', 'File was uploaded successfully!');
      },
      error: function error(request, status, _error7) {
        loader('hide');
        showMessage('danger', status);
      }
    });
  });
  $(document).on('click', '.btn-upload-persons-modal', function () {
    var idx = $(this).closest('.tab-pane').attr('data-idx');
    $('#upload-file-modal').attr('data-idx', idx);
    $('#upload-file-modal input[name=upload-file]').val(''); //Show modal

    $('#upload-file-modal').modal({
      backdrop: 'static'
    });
  });
  $(document).on('click', '.tab-component table#persons-table .btn.btn-counter-decrease', function () {
    var rowObj = $(this).closest('tr');
    var calls = parseInt($(rowObj).find('input[name=calls]').val());
    $(rowObj).find('input[name=calls]').val(calls - 1);
    $(rowObj).find('input[name=calls]').trigger('change');
  });
  $(document).on('click', '.tab-component table#persons-table .btn.btn-counter-increase', function () {
    var rowObj = $(this).closest('tr');
    var calls = parseInt($(rowObj).find('input[name=calls]').val());
    $(rowObj).find('input[name=calls]').val(calls + 1);
    $(rowObj).find('input[name=calls]').trigger('change');
  });
});
/******/ })()
;