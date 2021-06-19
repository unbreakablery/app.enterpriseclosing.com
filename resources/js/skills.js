$(document).ready(function() {
    $('table#assessments-table input[type=number]').change(function() {
        var sId = $(this).attr('name').split('_')[1];
        var aDate = $(this).attr('name').split('_')[2];
        var aValue = $(this).val();

        if (!sId || !aDate) {
            alert("Error: Can't save now!");
            return;
        }

        if (aValue == undefined || aValue == null || aValue == '' || aValue > 100 || aValue < 0) {
            alert("Error: Input Error!");
            $(this).val(0);
            $(this).focus();
            return;
        }

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
                loader('hide');
                
                // Show message
                $('.toast .toast-header').removeClass('bg-danger');
                $('.toast .toast-header').addClass('bg-success');
                $('.toast .toast-body').text('Assessment (SID: ' + sId + ', Date: ' + aDate + ') was saved successfully!');
                $('.toast').toast('show');
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                loader('hide');
                
                // Show message
                $('.toast .toast-header').removeClass('bg-success');
                $('.toast .toast-header').addClass('bg-danger');
                $('.toast .toast-body').text('Error, Please retry!');
                $('.toast').toast('show');
            }
        });
    });
});