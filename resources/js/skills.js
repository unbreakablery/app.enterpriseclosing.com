$(document).ready(function() {
    function checkAssessment(obj, pObj) {
        var value = $(obj).val();
        $(obj).removeClass('bg-black bg-info bg-yellow-dark bg-yellow bg-danger bg-success');
        $(obj).removeClass('text-white text-black');

        $(pObj).removeClass('bg-black bg-info bg-yellow-dark bg-yellow bg-danger bg-success');
        $(pObj).removeClass('text-white text-black');

        if (value == 0) {
            $(obj).addClass('bg-black text-white');
            $(pObj).addClass('bg-black text-white');
        } else if (value > 0 && value < 10) {
            $(obj).addClass('bg-info text-white');
            $(pObj).addClass('bg-info text-white');
        } else if (value >= 10 && value < 50) {
            $(obj).addClass('bg-danger text-white');
            $(pObj).addClass('bg-danger text-white');
        } else if (value >= 50 && value < 70) {
            $(obj).addClass('bg-yellow-dark text-white');
            $(pObj).addClass('bg-yellow-dark text-white');
        } else if (value >= 70 && value < 90) {
            $(obj).addClass('bg-yellow text-black');
            $(pObj).addClass('bg-yellow text-black');
        } else {
            $(obj).addClass('bg-success text-white');
            $(pObj).addClass('bg-success text-white');
        }
    }
    $('table#assessments-table input[type=number]').change(function() {
        var sId = $(this).attr('name').split('_')[1];
        var aDate = $(this).attr('name').split('_')[2];
        var aValue = $(this).val();
        var pObj = $(this).closest('td').find('.input-group-text');

        if (!sId || !aDate) {
            showMessage('danger', "Error: Can't save now!");
            return;
        }

        if (!$.isNumeric(aValue) || aValue > 100 || aValue < 0) {
            showMessage('danger', "Type: Input Error <br/>Note: It should be greater than 0 and less than 100.");
            $(this).val(0);
            checkAssessment($(this), pObj);
            $(this).focus();
            return;
        }

        // Change background color of current input
        checkAssessment(this, pObj);
        
        // Get input object for average and total average
        var curPSI = $(this).closest('td').attr('data-parent-skill-id');
        var curDate = $(this).closest('td').attr('data-date');
        var avgObj, avgPObj = null;
        var totalAvgObj = $('table#assessments-table input[name=assessment_total_avgerage_' + curDate + ']');
        var totalAvgPObj = $(totalAvgObj).closest('td').find('.input-group-text');

        var sum = 0;
        var cnt = 0;
        var average = 0;
        $('table#assessments-table input[type=number].data-cell-average').each(function() {
            if ($(this).closest('td').attr('data-skill-id') == curPSI &&
                $(this).closest('td').attr('data-date') == curDate) {
                avgObj = $(this);
                return;
            }
        });

        // Calculate average
        var avgSI = $(avgObj).closest('td').attr('data-skill-id');
        
        $('table#assessments-table input[type=number].data-cell').each(function() {
            if ($(this).closest('td').attr('data-parent-skill-id') == $(avgObj).closest('td').attr('data-skill-id') &&
                $(this).closest('td').attr('data-date') == $(avgObj).closest('td').attr('data-date')) {
                sum += parseInt($(this).val());
                cnt++;
            }
        });

        average = (cnt == 0) ? 0 : (sum / cnt);
        $(avgObj).val(average.toFixed());
        avgPObj = $(avgObj).closest('td').find('.input-group-text');

        // Change background color of average input
        checkAssessment(avgObj, avgPObj);

        // Caculate total average
        sum = 0;
        cnt = 0;
        $('table#assessments-table input[type=number].data-cell-average').each(function() {
            if ($(this).closest('td').attr('data-date') == curDate) {
                sum += parseInt($(this).val());
                cnt++;
            }
        });
        var totalAverage = (cnt == 0) ? 0 : (sum / cnt);
        $(totalAvgObj).val(totalAverage.toFixed());

        // Change background color of total average input
        checkAssessment(totalAvgObj, totalAvgPObj);

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
            success: function(response) {
                // Show message
                showMessage('success', 'Assessment (SID: ' + sId + ', Date: ' + aDate + ') was saved successfully!');
                
                // Save average
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
                    success: function(response) {
                        loader('hide');
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        loader('hide');
                        
                        // Show message
                        showMessage('danger', 'Error, Please retry!');
                    }
                });

            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                loader('hide');
                
                // Show message
                showMessage('danger', 'Error, Please retry!');
            }
        });
    });
});