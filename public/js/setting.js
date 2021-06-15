/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/setting.js ***!
  \*********************************/
$(document).ready(function () {
  function onClickStepCheckbox(obj) {
    if (obj.checked) {
      $('#settings-tab-tasks #suggest_step').removeClass('suggest-step-deactive');
      $('#settings-tab-tasks #suggest_step').addClass('suggest-step-active');
      $('#settings-tab-tasks .item-' + obj.value).removeClass('suggest-step-item-deactive');
      $('#settings-tab-tasks .item-' + obj.value).addClass('suggest-step-item-active');
      $('#settings-tab-tasks .nav-link').removeClass('active');
      $('#settings-tab-tasks .tab-pane').removeClass('active');
      $('#settings-tab-tasks #pane-' + obj.value).addClass('active');
      $('#settings-tab-tasks #pane-' + obj.value).addClass('show');
      $('#settings-tab-tasks #tab_' + obj.value).addClass('active');
    } else {
      $('#settings-tab-tasks #suggest_step li.suggest-item.suggest-step-item-active a.nav-link.active').removeClass('active');
      $('#settings-tab-tasks .item-' + obj.value).removeClass('suggest-step-item-active');
      $('#settings-tab-tasks .item-' + obj.value).addClass('suggest-step-item-deactive');
      $('#settings-tab-tasks #pane-' + obj.value).removeClass('active');
      $('#settings-tab-tasks #suggest_step li.suggest-item.suggest-step-item-active').first().addClass('suggest-step-item-active');
      $('#settings-tab-tasks #suggest_step li.suggest-item.suggest-step-item-active').first().find('a.nav-link').addClass('active');

      if ($('#settings-tab-tasks #suggest_step li.suggest-item.suggest-step-item-active').first().attr('id') != undefined) {
        var id = $('#settings-tab-tasks #suggest_step li.suggest-item.suggest-step-item-active').first().attr('id').substring(5);
        $('#settings-tab-tasks .tab-pane').removeClass('show');
        $('#settings-tab-tasks .tab-pane').removeClass('active');
        $('#settings-tab-tasks #pane-' + id).addClass('show');
        $('#settings-tab-tasks #pane-' + id).addClass('active');
      } // $('#tab_' + obj.value).removeClass('active');

    }
  }

  function clearEditScriptModal() {
    $('#edit-script-modal input#edit_script_id').val('');
    $('#edit-script-modal input#edit_script_name').val('');
    $('#edit-script-modal textarea#edit_script_content').val('');
  }

  function updateScriptTable(script) {
    $('#settings-tab-scripts table#scripts-table tbody tr').each(function () {
      if ($(this).data('id') == script.id) {
        $(this).find('td:nth-child(1)').text(script.name);
        $(this).find('td:nth-child(2)').text(script.content);
      }
    });
  }

  function clearEditEmailModal() {
    $('#edit-email-modal input#edit_email_id').val('');
    $('#edit-email-modal input#edit_email_title').val('');
    $('#edit-email-modal input#edit_email_subject').val('');
    $('#edit-email-modal textarea#edit_email_body').val('');
  }

  function updateEmailTable(email) {
    $('#settings-tab-emails table#emails-table tbody tr').each(function () {
      if ($(this).data('id') == email.id) {
        $(this).find('td:nth-child(1)').text(email.title);
        $(this).find('td:nth-child(2)').text(email.subject);
        $(this).find('td:nth-child(3)').text(email.body);
      }
    });
  }

  $('#settings-tab-tasks .input-step').on('click', function () {
    onClickStepCheckbox(this);
  });
  $('#settings-tab-tasks #check-all-actions').on('click', function () {
    $('#settings-tab-tasks .input-action').each(function (e) {
      $(this).prop('checked', true);
    });
  });
  $('#settings-tab-tasks #uncheck-all-actions').on('click', function () {
    $('#settings-tab-tasks .input-action').each(function (e) {
      $(this).prop('checked', false);
    });
  });
  $('#settings-tab-tasks #check-all-steps').on('click', function () {
    $('#settings-tab-tasks .input-step').each(function (e) {
      $(this).prop('checked', true);
      onClickStepCheckbox(this);
    });
  });
  $('#settings-tab-tasks #uncheck-all-steps').on('click', function () {
    $('#settings-tab-tasks .input-step').each(function (e) {
      $(this).prop('checked', false);
      onClickStepCheckbox(this);
    });
  });
  $('#settings-tab-scripts #btn-save-scripts-settings').on('click', function () {
    if ($('#settings-tab-scripts input#script_name').val() == undefined || $('#settings-tab-scripts input#script_name').val() == '') {
      alert('Please enter script name!');
      $('#settings-tab-scripts input#script_name').focus();
      return;
    }

    var scriptName = $('#settings-tab-scripts input#script_name').val();
    var scriptContent = $('#settings-tab-scripts textarea#script_content').val();
    loader('show');
    $.ajax({
      url: "/settings/store/script-main",
      type: "post",
      dataType: "json",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        name: scriptName,
        content: scriptContent
      },
      success: function success(response) {
        loader('hide'); // Remove no data row

        $('table#scripts-table tbody tr#no-data-row').remove(); // Add new row on table

        var innerHtml = '';
        innerHtml += '<tr data-id="' + response.script.id + '">';
        innerHtml += '<td class="text-white pl-2 pr-2">' + response.script.name + '</td>';
        innerHtml += '<td class="text-white pl-2 pr-2">' + response.script.content + '</td>';
        innerHtml += '<td class="text-center">';
        innerHtml += '<button type="button" class="btn btn-sm btn-success n-b-r btn-edit-script" title="Edit this script">';
        innerHtml += '<i class="bi bi-pencil-fill"></i>';
        innerHtml += '</button> ';
        innerHtml += '<button type="button" class="btn btn-sm btn-danger n-b-r btn-remove-script" title="Remove this script">';
        innerHtml += '<i class="bi bi-x"></i>';
        innerHtml += '</button>';
        innerHtml += '</td>';
        innerHtml += '</tr>';
        $('table#scripts-table tbody').append(innerHtml); // Initalize script name and content

        $('#settings-tab-scripts input#script_name').val('');
        $('#settings-tab-scripts textarea#script_content').val(''); // Set focus to script name input

        $('#settings-tab-scripts input#script_name').focus(); // Show message

        $('.toast .toast-header').removeClass('bg-danger');
        $('.toast .toast-header').addClass('bg-success');
        $('.toast .toast-body').text('New script (' + response.script.name + ') was saved successfully!');
        $('.toast').toast('show');
      },
      error: function error(XMLHttpRequest, textStatus, errorThrown) {
        loader('hide'); // Set focus to script name input

        $('#settings-tab-scripts input#script_name').focus(); // Show message

        $('.toast .toast-header').removeClass('bg-success');
        $('.toast .toast-header').addClass('bg-danger');
        $('.toast .toast-body').text('Error, Please retry!');
        $('.toast').toast('show');
      }
    });
  });
  $(document).on('click', '#settings-tab-scripts table#scripts-table tbody tr button.btn-edit-script', function () {
    var scriptId = $(this).closest('tr').data('id');
    var scriptName = $(this).closest('tr').find('td:nth-child(1)').text();
    var scriptContent = $(this).closest('tr').find('td:nth-child(2)').text(); // Clear modal inputs

    clearEditScriptModal(); // Set modal inputs

    $('#edit-script-modal input#edit_script_id').val(scriptId);
    $('#edit-script-modal input#edit_script_name').val(scriptName);
    $('#edit-script-modal textarea#edit_script_content').val(scriptContent); // Show Edit Script Modal

    $('#edit-script-modal').modal({
      backdrop: 'static'
    });
  });
  $(document).on('click', '#settings-tab-scripts table#scripts-table tbody tr button.btn-remove-script', function () {
    var rowObj = $(this).closest('tr');
    var scriptId = $(rowObj).data('id');
    var scriptName = $(rowObj).find('td:nth-child(1)').text();
    loader('show');
    $.ajax({
      url: "/scripts/remove/script-main/" + scriptId,
      type: "delete",
      dataType: "json",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content')
      },
      success: function success(response) {
        loader('hide'); // Remove row on table

        $(rowObj).remove(); // Add no data row

        if ($('table#scripts-table tbody > tr').length == 0) {
          var innerHtml = '<tr id="no-data-row">';
          innerHtml += '<td class="text-center text-white pt-3" colspan="3">No Scripts</td>';
          innerHtml += '</tr>';
          $('table#scripts-table tbody').append(innerHtml);
        } // Show message


        $('.toast .toast-header').removeClass('bg-danger');
        $('.toast .toast-header').addClass('bg-success');
        $('.toast .toast-body').text('Script (' + scriptName + ') was removed successfully!');
        $('.toast').toast('show');
      },
      error: function error(XMLHttpRequest, textStatus, errorThrown) {
        loader('hide'); // Show message

        $('.toast .toast-header').removeClass('bg-success');
        $('.toast .toast-header').addClass('bg-danger');
        $('.toast .toast-body').text('Error, Please retry!');
        $('.toast').toast('show');
      }
    });
  });
  $('#edit-script-modal #btn-update-script').on('click', function () {
    if ($('#edit-script-modal input#edit_script_name').val() == undefined || $('#edit-script-modal input#edit_script_name').val() == '') {
      alert('Please enter script name!');
      $('#edit-script-modal input#edit_script_name').focus();
      return;
    }

    var scriptId = $('#edit-script-modal input#edit_script_id').val();
    var scriptName = $('#edit-script-modal input#edit_script_name').val();
    var scriptContent = $('#edit-script-modal textarea#edit_script_content').val();
    loader('show');
    $.ajax({
      url: "/settings/store/script-main",
      type: "post",
      dataType: "json",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        id: scriptId,
        name: scriptName,
        content: scriptContent
      },
      success: function success(response) {
        loader('hide'); // Clear modal inputs

        clearEditScriptModal(); // Add new row on table

        updateScriptTable(response.script); // Hide Edit Script Modal

        $('#edit-script-modal').modal('hide'); // Show message

        $('.toast .toast-header').removeClass('bg-danger');
        $('.toast .toast-header').addClass('bg-success');
        $('.toast .toast-body').text('Script (' + response.script.name + ') was saved successfully!');
        $('.toast').toast('show');
      },
      error: function error(XMLHttpRequest, textStatus, errorThrown) {
        loader('hide'); // Clear modal inputs

        clearEditScriptModal(); // Hide Edit Script Modal

        $('#edit-script-modal').modal('hide'); // Show message

        $('.toast .toast-header').removeClass('bg-success');
        $('.toast .toast-header').addClass('bg-danger');
        $('.toast .toast-body').text('Error, Please retry!');
        $('.toast').toast('show');
      }
    });
  });
  $('#settings-tab-emails #btn-save-emails-settings').on('click', function () {
    if ($('#settings-tab-emails input#title').val() == undefined || $('#settings-tab-emails input#title').val() == '') {
      alert('Please enter title!');
      $('#settings-tab-emails input#title').focus();
      return;
    }

    var emailTitle = $('#settings-tab-emails input#title').val();
    var emailSubject = $('#settings-tab-emails input#subject').val();
    var emailBody = $('#settings-tab-emails textarea#body').val();
    loader('show');
    $.ajax({
      url: "/settings/store/email-main",
      type: "post",
      dataType: "json",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        title: emailTitle,
        subject: emailSubject,
        body: emailBody
      },
      success: function success(response) {
        loader('hide'); // Remove no data row

        $('table#emails-table tbody tr#no-data-row').remove(); // Add new row on table

        var innerHtml = '';
        innerHtml += '<tr data-id="' + response.email.id + '">';
        innerHtml += '<td class="text-white pl-2 pr-2">' + response.email.title + '</td>';
        innerHtml += '<td class="text-white pl-2 pr-2">' + response.email.subject + '</td>';
        innerHtml += '<td class="text-white pl-2 pr-2">' + response.email.body + '</td>';
        innerHtml += '<td class="text-center">';
        innerHtml += '<button type="button" class="btn btn-sm btn-success n-b-r btn-edit-email" title="Edit this email">';
        innerHtml += '<i class="bi bi-pencil-fill"></i>';
        innerHtml += '</button> ';
        innerHtml += '<button type="button" class="btn btn-sm btn-danger n-b-r btn-remove-email" title="Remove this email">';
        innerHtml += '<i class="bi bi-x"></i>';
        innerHtml += '</button>';
        innerHtml += '</td>';
        innerHtml += '</tr>';
        $('table#emails-table tbody').append(innerHtml); // Initalize email title, subject and body

        $('#settings-tab-emails input#title').val('');
        $('#settings-tab-emails input#subject').val('');
        $('#settings-tab-emails textarea#body').val(''); // Set focus to email title input

        $('#settings-tab-emails input#title').focus(); // Show message

        $('.toast .toast-header').removeClass('bg-danger');
        $('.toast .toast-header').addClass('bg-success');
        $('.toast .toast-body').text('New email (' + response.email.title + ') was saved successfully!');
        $('.toast').toast('show');
      },
      error: function error(XMLHttpRequest, textStatus, errorThrown) {
        loader('hide'); // Set focus to email title input

        $('#settings-tab-emails input#title').focus(); // Show message

        $('.toast .toast-header').removeClass('bg-success');
        $('.toast .toast-header').addClass('bg-danger');
        $('.toast .toast-body').text('Error, Please retry!');
        $('.toast').toast('show');
      }
    });
  });
  $(document).on('click', '#settings-tab-emails table#emails-table tbody tr button.btn-edit-email', function () {
    var emailId = $(this).closest('tr').data('id');
    var emailTitle = $(this).closest('tr').find('td:nth-child(1)').text();
    var emailSubject = $(this).closest('tr').find('td:nth-child(2)').text();
    var emailBody = $(this).closest('tr').find('td:nth-child(3)').text(); // Clear modal inputs

    clearEditEmailModal(); // Set modal inputs

    $('#edit-email-modal input#edit_email_id').val(emailId);
    $('#edit-email-modal input#edit_email_title').val(emailTitle);
    $('#edit-email-modal input#edit_email_subject').val(emailSubject);
    $('#edit-email-modal textarea#edit_email_body').val(emailBody); // Show Edit Email Modal

    $('#edit-email-modal').modal({
      backdrop: 'static'
    });
  });
  $(document).on('click', '#settings-tab-emails table#emails-table tbody tr button.btn-remove-email', function () {
    var rowObj = $(this).closest('tr');
    var emailId = $(rowObj).data('id');
    var emailTitle = $(rowObj).find('td:nth-child(1)').text();
    loader('show');
    $.ajax({
      url: "/emails/remove/email-main/" + emailId,
      type: "delete",
      dataType: "json",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content')
      },
      success: function success(response) {
        loader('hide'); // Remove row on table

        $(rowObj).remove(); // Add no data row

        if ($('table#emails-table tbody > tr').length == 0) {
          var innerHtml = '<tr id="no-data-row">';
          innerHtml += '<td class="text-center text-white pt-3" colspan="4">No Emails</td>';
          innerHtml += '</tr>';
          $('table#emails-table tbody').append(innerHtml);
        } // Show message


        $('.toast .toast-header').removeClass('bg-danger');
        $('.toast .toast-header').addClass('bg-success');
        $('.toast .toast-body').text('Email (' + emailTitle + ') was removed successfully!');
        $('.toast').toast('show');
      },
      error: function error(XMLHttpRequest, textStatus, errorThrown) {
        loader('hide'); // Show message

        $('.toast .toast-header').removeClass('bg-success');
        $('.toast .toast-header').addClass('bg-danger');
        $('.toast .toast-body').text('Error, Please retry!');
        $('.toast').toast('show');
      }
    });
  });
  $('#edit-email-modal #btn-update-email').on('click', function () {
    if ($('#edit-email-modal input#edit_email_title').val() == undefined || $('#edit-email-modal input#edit_email_title').val() == '') {
      alert('Please enter email title!');
      $('#edit-email-modal input#edit_email_title').focus();
      return;
    }

    var emailId = $('#edit-email-modal input#edit_email_id').val();
    var emailTitle = $('#edit-email-modal input#edit_email_title').val();
    var emailSubject = $('#edit-email-modal input#edit_email_subject').val();
    var emailBody = $('#edit-email-modal textarea#edit_email_body').val();
    loader('show');
    $.ajax({
      url: "/settings/store/email-main",
      type: "post",
      dataType: "json",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        id: emailId,
        title: emailTitle,
        subject: emailSubject,
        body: emailBody
      },
      success: function success(response) {
        loader('hide'); // Clear modal inputs

        clearEditEmailModal(); // Add new row on table

        updateEmailTable(response.email); // Hide Edit Email Modal

        $('#edit-email-modal').modal('hide'); // Show message

        $('.toast .toast-header').removeClass('bg-danger');
        $('.toast .toast-header').addClass('bg-success');
        $('.toast .toast-body').text('Email (' + response.email.title + ') was saved successfully!');
        $('.toast').toast('show');
      },
      error: function error(XMLHttpRequest, textStatus, errorThrown) {
        loader('hide'); // Clear modal inputs

        clearEditEmailModal(); // Hide Edit Email Modal

        $('#edit-email-modal').modal('hide'); // Show message

        $('.toast .toast-header').removeClass('bg-success');
        $('.toast .toast-header').addClass('bg-danger');
        $('.toast .toast-body').text('Error, Please retry!');
        $('.toast').toast('show');
      }
    });
  });
});
/******/ })()
;