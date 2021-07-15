$(document).ready(function() {
    $('button.btn-active-user').click(function() {
        var trObj = $(this).closest('tr');
        var userId = $(trObj).data('id');

        loader('show');

        $.ajax({
            url: "/users/active",
            type: "put",
            dataType: "json",
            data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: userId,
                    active: 1
                },
            success: function(response) {
                loader('hide');

                // Show message
                showMessage('success', response.user.first_name + ' ' + response.user.last_name + ' was active successfully!');
                
                // Change disabled
                $(trObj).find('button.btn-inactive-user').removeAttr('disabled');
                $(trObj).find('button.btn-active-user').attr('disabled', true);

                // Change active content
                $(trObj).find('td:nth-child(4)').removeClass('text-danger');
                $(trObj).find('td:nth-child(4)').addClass('text-success');
                $(trObj).find('td:nth-child(4)').text('Active');
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                loader('hide');
                
                // Show message
                showMessage('danger', 'Error, Please retry!');
            }
        });
    });

    $('button.btn-inactive-user').click(function() {
        var trObj = $(this).closest('tr');
        var userId = $(trObj).data('id');

        loader('show');

        $.ajax({
            url: "/users/active",
            type: "put",
            dataType: "json",
            data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: userId,
                    active: 0
                },
            success: function(response) {
                loader('hide');

                // Show message
                showMessage('success', response.user.first_name + ' ' + response.user.last_name + ' was inactive successfully!');
                
                // Change disabled
                $(trObj).find('button.btn-active-user').removeAttr('disabled');
                $(trObj).find('button.btn-inactive-user').attr('disabled', true);

                // Change active content
                $(trObj).find('td:nth-child(4)').removeClass('text-success');
                $(trObj).find('td:nth-child(4)').addClass('text-danger');
                $(trObj).find('td:nth-child(4)').text('Inactive');
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                loader('hide');
                
                // Show message
                showMessage('danger', 'Error, Please retry!');
            }
        });
    });

    $('button.btn-remove-user').click(function() {
        var trObj = $(this).closest('tr');
        var userId = $(trObj).data('id');

        loader('show');

        $.ajax({
            url: "/users/remove",
            type: "delete",
            dataType: "json",
            data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: userId
                },
            success: function(response) {
                loader('hide');

                // Show message
                showMessage('success', $(trObj).find('td:nth-child(1)').text() + ' was remove successfully!');
                
                // Remove tr
                $(trObj).remove();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                loader('hide');
                
                // Show message
                showMessage('danger', 'Error, Please retry!');
            }
        });
    });
});