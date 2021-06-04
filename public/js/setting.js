/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*********************************!*\
  !*** ./resources/js/setting.js ***!
  \*********************************/
$(document).ready(function () {
  function onClickStepCheckbox(obj) {
    if (obj.checked) {
      $('#settings-tab-tasks #sub_step').removeClass('suggest-step-deactive');
      $('#settings-tab-tasks #sub_step').addClass('suggest-step-active');
      $('#settings-tab-tasks .item-' + obj.value).removeClass('suggest-step-item-deactive');
      $('#settings-tab-tasks .item-' + obj.value).addClass('suggest-step-item-active');
      $('#settings-tab-tasks .nav-link').removeClass('active');
      $('#settings-tab-tasks .tab-pane').removeClass('active');
      $('#settings-tab-tasks #pane-' + obj.value).addClass('active');
      $('#settings-tab-tasks #pane-' + obj.value).addClass('show');
      $('#settings-tab-tasks #tab_' + obj.value).addClass('active');
    } else {
      $('#settings-tab-tasks #sub_step li.suggest-item.suggest-step-item-active a.nav-link.active').removeClass('active');
      $('#settings-tab-tasks .item-' + obj.value).removeClass('suggest-step-item-active');
      $('#settings-tab-tasks .item-' + obj.value).addClass('suggest-step-item-deactive');
      $('#settings-tab-tasks #pane-' + obj.value).removeClass('active');
      $('#settings-tab-tasks #sub_step li.suggest-item.suggest-step-item-active').first().addClass('suggest-step-item-active');
      $('#settings-tab-tasks #sub_step li.suggest-item.suggest-step-item-active').first().find('a.nav-link').addClass('active');

      if ($('#settings-tab-tasks #sub_step li.suggest-item.suggest-step-item-active').first().attr('id') != undefined) {
        var id = $('#settings-tab-tasks #sub_step li.suggest-item.suggest-step-item-active').first().attr('id').substring(5);
        $('#settings-tab-tasks #pane-' + id).addClass('show');
        $('#settings-tab-tasks #pane-' + id).addClass('active');
      } // $('#tab_' + obj.value).removeClass('active');

    }
  }

  $('#settings-tab-tasks .input-step').on('click', function () {
    onClickStepCheckbox(this);
  });
  $('#settings-tab-tasks #btn-save-settings').on('click', function () {
    var token = $('meta[name="csrf-token"]').attr('content');
    var data = $('#settings-tab-tasks #form_setting').serialize();
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
  $('#settings-tab-tasks #select-all-actions').on('click', function () {
    var obj = this;

    if ($(obj).attr('data-checked') == undefined || $(obj).attr('data-checked') == '0') {
      $('#settings-tab-tasks .input-action').each(function (e) {
        $(this).prop('checked', true);
      });
      $(obj).attr('data-checked', '1');
      $(obj).text('Deselect All');
    } else {
      $('#settings-tab-tasks .input-action').each(function (e) {
        $(this).prop('checked', false);
      });
      $(obj).attr('data-checked', '0');
      $(obj).text('Select All');
    }
  });
  $('#settings-tab-tasks #select-all-steps').on('click', function () {
    var obj = this;

    if ($(obj).attr('data-checked') == undefined || $(obj).attr('data-checked') == '0') {
      $('#settings-tab-tasks .input-step').each(function (e) {
        $(this).prop('checked', true);
        onClickStepCheckbox(this);
      });
      $(obj).attr('data-checked', '1');
      $(obj).text('Deselect All');
    } else {
      $('#settings-tab-tasks .input-step').each(function (e) {
        $(this).prop('checked', false);
        onClickStepCheckbox(this);
      });
      $(obj).attr('data-checked', '0');
      $(obj).text('Select All');
    }
  });
  $('#settings-tab-tasks .input-action').on('click', function () {
    if (!this.checked) {
      $('#settings-tab-tasks #select-all-actions').prop('checked', false);
    }
  });
});
/******/ })()
;