$(document).ready(function() {
    var trObj = null;

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
        trObj = $(this).closest('tr');

        $('#delete-account-modal').modal({
            backdrop: 'static'
        });
    });

    $('button#btn-delete-account').click(function() {
        if (trObj == undefined || trObj == null) {
            // Show message
            showMessage('danger', 'Nobody selected. please select any user!');
            return;
        }

        var userId = $(trObj).data('id');

        loader('show');

        $.ajax({
            url: "/users/remove",
            type: "put",
            dataType: "json",
            data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: userId
                },
            success: function(res) {
                loader('hide');
                
                if (res.type == 'success') {
                    // Show message
                    showMessage('success', res.user.first_name + ' ' + res.user.last_name + ' was remove successfully!');
                                    
                    // Remove tr
                    $(trObj).remove();
                } else {
                    // Show message
                    showMessage('danger', 'Error, Please retry!');
                }
                               
                // Hide modal
                $('#delete-account-modal').modal('hide');
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                loader('hide');
                
                // Show message
                showMessage('danger', 'Error, Please retry!');

                // Hide modal
                $('#delete-account-modal').modal('hide');
            }
        });
    });

    $('#delete-account-modal').on('hidden.bs.modal', function (event) {
        trObj = null;
    });
});