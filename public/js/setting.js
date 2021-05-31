/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/setting.js ***!
  \*********************************/
$(document).ready(function () {
  function onClickStepCheckbox(obj) {
    if (obj.checked) {
      $('#sub_step').removeClass('suggest-step-deactive');
      $('#sub_step').addClass('suggest-step-active');
      $('.item-' + obj.value).removeClass('suggest-step-item-deactive');
      $('.item-' + obj.value).addClass('suggest-step-item-active');
      $('.nav-link').removeClass('active');
      $('.tab-pane').removeClass('active');
      $('#pane-' + obj.value).addClass('active');
      $('#pane-' + obj.value).addClass('show');
      $('#tab_' + obj.value).addClass('active');
    } else {
      $('#sub_step li.suggest-item.suggest-step-item-active a.nav-link.active').removeClass('active');
      $('.item-' + obj.value).removeClass('suggest-step-item-active');
      $('.item-' + obj.value).addClass('suggest-step-item-deactive');
      $('#pane-' + obj.value).removeClass('active');
      $('#sub_step li.suggest-item.suggest-step-item-active').first().addClass('suggest-step-item-active');
      $('#sub_step li.suggest-item.suggest-step-item-active').first().find('a.nav-link').addClass('active');

      if ($('#sub_step li.suggest-item.suggest-step-item-active').first().attr('id') != undefined) {
        var id = $('#sub_step li.suggest-item.suggest-step-item-active').first().attr('id').substring(5);
        $('#pane-' + id).addClass('show');
        $('#pane-' + id).addClass('active');
      } // $('#tab_' + obj.value).removeClass('active');

    }
  }

  $('.input-step').on('click', function () {
    onClickStepCheckbox(this);
  });
  $('#btn-save-settings').on('click', function () {
    var token = $('meta[name="csrf-token"]').attr('content');
    var data = $('#form_setting').serialize();
    $.ajax({
      url: "settings/store",
      type: "post",
      dataType: "json",
      data: {
        _token: token,
        data: data
      },
      success: function success(response) {
        console.log('res', response);
      },
      error: function error(XMLHttpRequest, textStatus, errorThrown) {
        console.log('error');
      }
    });
  });
  $('#select-all-actions').on('click', function () {
    var obj = this;
    $('.input-action').each(function (e) {
      $(this).prop('checked', obj.checked);
    });
  });
  $('#select-all-steps').on('click', function () {
    var obj = this;
    $('.input-step').each(function (e) {
      $(this).prop('checked', obj.checked);
      onClickStepCheckbox(this);
    });
  });
  $('.input-action').on('click', function () {
    if (!this.checked) {
      $('#select-all-actions').prop('checked', false);
    }
  });
});
/******/ })()
;