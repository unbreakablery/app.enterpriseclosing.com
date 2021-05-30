/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!**********************************!*\
  !*** ./resources/js/outbound.js ***!
  \**********************************/
$(document).ready(function () {
  $.noConflict();
  $('#btn-show-modal').click(function () {
    // Initialize account name input
    $('#account-name').val(''); //Show modal

    $('#add-account-modal').modal({
      backdrop: 'static'
    });
  });
  $('#btn-create-new-tab').click(function () {
    var tabName = $('#tab-name').val();
    $('#tab-name').val(''); // Check if account name is empty

    if (tabName == '') {
      alert("You must enter new account name to create new tab.");
      return;
    } // Hide modal


    $('#add-account-modal').modal('hide'); // Add new tab

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

    $('#ob-tab-' + tabIndex).append($('#ob-component-empty').html()); // $('#ob-tab-' + tabIndex + ' input[name=first-name]').attr('name', 'first-name-' + tabIndex);
    // $('#ob-tab-' + tabIndex + ' input[name=last-name]').attr('name', 'last-name-' + tabIndex);
    // $('#ob-tab-' + tabIndex + ' input[name=title]').attr('name', 'title-' + tabIndex);
    // $('#ob-tab-' + tabIndex + ' input[name=phone]').attr('name', 'phone-' + tabIndex);
    // $('#ob-tab-' + tabIndex + ' input[name=mobile]').attr('name', 'mobile-' + tabIndex);
    // $('#ob-tab-' + tabIndex + ' input[name=email]').attr('name', 'email-' + tabIndex);
    // $('#ob-tab-' + tabIndex + ' input[name=calls]').attr('name', 'calls-' + tabIndex);
    // $('#ob-tab-' + tabIndex + ' input[name=result]').attr('name', 'result-' + tabIndex);
    // $('#ob-tab-' + tabIndex + ' input[name=linkedin-connected]').attr('name', 'linkedin-connected-' + tabIndex);
    // $('#ob-tab-' + tabIndex + ' input[name=linkedin-address]').attr('name', 'linkedin-address-' + tabIndex);
    // Add account name

    $('#ob-tab-' + tabIndex).find('input[name=account-name]').val(tabName); // Increase tab index

    tabIndex++; // Save blank outbound

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
        // Change outbound id
        $('#ob-tab-' + (tabIndex - 1)).find('input[name=o-id]').val(res.id);
      }
    });
  });
  $(document).on('click', '.btn-add-row', function () {
    var pTable = $(this).parent().parent().find('#persons-table'); // Remove no data row

    $(pTable).find('#no-data-row').remove(); // Add new row

    $(pTable).find('tbody').append($('#tr-component-empty tbody').html());
  });
  $(document).on('change', '.tab-component .main-info input[type=text], .tab-component .main-info textarea', function () {
    var tabComponent = $(this).closest('.tab-component');
    var oId = $(tabComponent).find('input[name=o-id]').val();
    var accountName = $(tabComponent).find('input[name=account-name]').val();
    var annualReport = $(tabComponent).find('input[name=annual-report]').val();
    var prArticles = $(tabComponent).find('input[name=pr-articles]').val();
    var orgHooks = $.trim($(tabComponent).find('textarea[name=org-hooks]').val());
    var additionalNuggets = $.trim($(tabComponent).find('textarea[name=additional-nuggets]').val());
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
        $(tabComponent).find('input[name=o-id]').val(res.id); // console.log("Outbound(" + res.id + ") Main Saved!");
      }
    });
  });
  $(document).on('change', '.tab-component table#persons-table input[type=text]', function () {
    var tabComponent = $(this).closest('.tab-component');
    var rowObj = $(this).closest('tr');
    var oId = $(tabComponent).find('input[name=o-id]').val();
    var id = $(rowObj).data('id');

    if (oId == 0) {
      alert("Outbound didn't create yet!");
      return;
    }

    var firstName = $(rowObj).find('input[name=first-name]').val();
    var lastName = $(rowObj).find('input[name=last-name]').val();
    var title = $(rowObj).find('input[name=title]').val();
    var phone = $(rowObj).find('input[name=phone]').val();
    var mobile = $(rowObj).find('input[name=mobile]').val();
    var email = $(rowObj).find('input[name=email]').val();
    var calls = $(rowObj).find('input[name=calls]').val();
    var result = $(rowObj).find('input[name=result]').val();
    var liConnected = $(rowObj).find('input[name=linkedin-connected]').val();
    var liAddress = $(rowObj).find('input[name=linkedin-address]').val();
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
        li_address: liAddress
      },
      success: function success(res) {
        // Change outbound person id
        $(rowObj).data('id', res.id);
      }
    });
  });
  $(document).on('click', '.btn-remove-row', function () {
    var rowObj = $(this).closest('tr');
    var id = $(rowObj).data('id');

    if (id == 0) {
      alert("Not saved this person!");
      return;
    }

    $.ajax({
      url: "outbound/remove-person",
      dataType: "json",
      type: "post",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        id: id
      },
      success: function success(res) {
        // Change outbound person id
        $(rowObj).remove();
      }
    });
  });
  $(document).on('click', '.btn-remove-account', function () {
    var tabComponent = $(this).closest('.tab-component');
    var id = $(tabComponent).find('input[name=o-id]').val();

    if (id == 0) {
      alert("Not saved this account!");
      return;
    }

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
        $('#outboundTabs #tab-' + idx).parent().remove();
        $('#outboundTabs li a.nav-link').first().addClass('active');
        $('#outboundTabsContent .tab-pane').first().addClass('show active');
      }
    });
  });
});
/******/ })()
;