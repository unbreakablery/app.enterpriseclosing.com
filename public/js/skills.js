/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!********************************!*\
  !*** ./resources/js/skills.js ***!
  \********************************/
$(document).ready(function () {
  function checkAssessment(obj) {
    var value = $(obj).val();
    $(obj).removeClass('bg-light bg-info bg-yellow-dark bg-yellow bg-danger bg-success');
    $(obj).removeClass('text-white');

    if (value == 0) {
      $(obj).addClass('bg-light');
    } else if (value > 0 && value < 10) {
      $(obj).addClass('bg-info text-white');
    } else if (value >= 10 && value < 50) {
      $(obj).addClass('bg-danger text-white');
    } else if (value >= 50 && value < 70) {
      $(obj).addClass('bg-yellow-dark');
    } else if (value >= 70 && value < 90) {
      $(obj).addClass('bg-yellow');
    } else {
      $(obj).addClass('bg-success text-white');
    }
  }

  $('table#assessments-table input[type=number]').change(function () {
    var sId = $(this).attr('name').split('_')[1];
    var aDate = $(this).attr('name').split('_')[2];
    var aValue = $(this).val();

    if (!sId || !aDate) {
      alert("Error: Can't save now!");
      return;
    }

    if (!$.isNumeric(aValue) || aValue > 100 || aValue < 0) {
      alert("Error: Input Error! (NOTE: it should be greater than 0 and less than 100.)");
      $(this).val(0);
      checkAssessment($(this));
      $(this).focus();
      return;
    } // Change background color of current input


    checkAssessment(this); // Get input object for average and total average

    var curPSI = $(this).closest('td').attr('data-parent-skill-id');
    var curDate = $(this).closest('td').attr('data-date');
    var avgObj = null;
    var totalAvgObj = $('table#assessments-table input[name=assessment_total_avgerage_' + curDate + ']');
    var sum = 0;
    var cnt = 0;
    var average = 0;
    $('table#assessments-table input[type=number].data-cell-average').each(function () {
      if ($(this).closest('td').attr('data-skill-id') == curPSI && $(this).closest('td').attr('data-date') == curDate) {
        avgObj = $(this);
        return;
      }
    }); // Calculate average

    var avgSI = $(avgObj).closest('td').attr('data-skill-id');
    $('table#assessments-table input[type=number].data-cell').each(function () {
      if ($(this).closest('td').attr('data-parent-skill-id') == $(avgObj).closest('td').attr('data-skill-id') && $(this).closest('td').attr('data-date') == $(avgObj).closest('td').attr('data-date')) {
        sum += parseInt($(this).val());
        cnt++;
      }
    });
    average = cnt == 0 ? 0 : sum / cnt;
    $(avgObj).val(average.toFixed()); // Change background color of average input

    checkAssessment(avgObj); // Caculate total average

    sum = 0;
    cnt = 0;
    $('table#assessments-table input[type=number].data-cell-average').each(function () {
      if ($(this).closest('td').attr('data-date') == curDate) {
        sum += parseInt($(this).val());
        cnt++;
      }
    });
    var totalAverage = cnt == 0 ? 0 : sum / cnt;
    $(totalAvgObj).val(totalAverage.toFixed()); // Change background color of total average input

    checkAssessment(totalAvgObj);
    loader('show');
    $.ajax({
      url: "/skills/save-assessment",
      type: "post",
      dataType: "json",
      data: {
        _token: $('meta[name="csrf-token"]').attr('content'),
        s_id: sId,
        a_date: aDate,
        a_value: aValue
      },
      success: function success(response) {
        // Show message
        $('.toast .toast-header').removeClass('bg-danger');
        $('.toast .toast-header').addClass('bg-success');
        $('.toast .toast-body').text('Assessment (SID: ' + sId + ', Date: ' + aDate + ') was saved successfully!');
        $('.toast').toast('show'); // Save average

        $.ajax({
          url: "/skills/save-assessment",
          type: "post",
          dataType: "json",
          data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            s_id: avgSI,
            a_date: curDate,
            a_value: average
          },
          success: function success(response) {
            loader('hide');
          },
          error: function error(XMLHttpRequest, textStatus, errorThrown) {
            loader('hide'); // Show message

            $('.toast .toast-header').removeClass('bg-success');
            $('.toast .toast-header').addClass('bg-danger');
            $('.toast .toast-body').text('Error, Please retry!');
            $('.toast').toast('show');
          }
        });
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
});
/******/ })()
;