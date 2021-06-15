/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/emails.js ***!
  \********************************/
$(document).ready(function () {
  $(document).on('click', 'button.btn-save-email', function () {
    var tabObj = $(this).closest('.tab-component');
    var emailId = $(tabObj).find('input[name=email_id]').val();
    var emailTitle = $(tabObj).find('input[name=email_title]').val();
    var emailSubject = $(tabObj).find('input[name=email_subject]').val();
    var emailBody = $(tabObj).find('textarea[name=email_body]').val();
    loader('show');
    $.ajax({
      url: "emails/save-email",
      dataType: "json",
      type: "post",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        id: emailId,
        title: emailTitle,
        subject: emailSubject,
        body: emailBody
      },
      success: function success(response) {
        loader('hide'); // Show message

        $('.toast .toast-header').removeClass('bg-danger');
        $('.toast .toast-header').addClass('bg-success');
        $('.toast .toast-body').text('Email (' + response.email.title + ') was updated successfully!');
        $('.toast').toast('show');
      },
      error: function error(XMLHttpRequest, textStatus, errorThrown) {
        loader('hide'); // Set focus to email subject input

        $(tabObj).find('input[name=email_subject]').focus(); // Show message

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