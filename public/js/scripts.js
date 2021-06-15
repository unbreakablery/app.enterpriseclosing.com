/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/scripts.js ***!
  \*********************************/
$(document).ready(function () {
  $(document).on('click', 'button.btn-save-script', function () {
    var tabObj = $(this).closest('.tab-component');
    var scriptId = $(tabObj).find('input[name=script_id]').val();
    var scriptName = $(tabObj).find('input[name=script_name]').val();
    var scriptContent = $(tabObj).find('textarea[name=script_content]').val();
    loader('show');
    $.ajax({
      url: "scripts/save-script",
      dataType: "json",
      type: "post",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        id: scriptId,
        name: scriptName,
        content: scriptContent
      },
      success: function success(response) {
        loader('hide'); // Show message

        $('.toast .toast-header').removeClass('bg-danger');
        $('.toast .toast-header').addClass('bg-success');
        $('.toast .toast-body').text('Script (' + response.script.name + ') was updated successfully!');
        $('.toast').toast('show');
      },
      error: function error(XMLHttpRequest, textStatus, errorThrown) {
        loader('hide'); // Set focus to content textarea

        $(tabObj).find('textarea[name=script_content]').focus(); // Show message

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