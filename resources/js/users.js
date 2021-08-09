$(document).ready(function() {
    var trObj = null;

    function clearEditUserModal() {
        $('#edit-account-modal input[name=userid]').val('');
        $('#edit-account-modal input[name=username]').val('');
        $('#edit-account-modal input[name=email]').val('');
        $('#edit-account-modal select[name=role]').val('3');
        $('#edit-account-modal select[name=active]').val(0);
    }

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
                    showMessage('success', res.user.first_name + ' ' + res.user.last_name + ' was deleted successfully!');
                                    
                    // Remove tr
                    // $(trObj).remove();

                    // Change role content
                    $(trObj).find('td:nth-child(3)').removeClass('text-success');
                    $(trObj).find('td:nth-child(3)').addClass('text-danger');
                    $(trObj).find('td:nth-child(3)').text(res.user.role_name);

                    // Change active content
                    $(trObj).find('td:nth-child(4)').removeClass('text-success');
                    $(trObj).find('td:nth-child(4)').addClass('text-danger');
                    $(trObj).find('td:nth-child(4)').text(res.user.active_name);

                    // Change tr attribute
                    $(trObj).attr('data-userrole', res.user.role);
                    $(trObj).attr('data-useractive', res.user.active);

                    // Change disabled
                    $(trObj).find('button.btn-remove-user').attr('disabled', true);
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

    $('button.btn-edit-user').click(function() {
        trObj = $(this).closest('tr');

        $('#edit-account-modal input[name=userid]').val($(trObj).attr('data-id'));
        $('#edit-account-modal input[name=username]').val($(trObj).attr('data-username'));
        $('#edit-account-modal input[name=email]').val($(trObj).attr('data-email'));
        $('#edit-account-modal select[name=role]').val($(trObj).attr('data-userrole'));
        $('#edit-account-modal select[name=active]').val($(trObj).attr('data-useractive'));

        $('#edit-account-modal').modal({
            backdrop: 'static'
        });
    });

    $('button#btn-update-user').click(function() {
        var userId = $('#edit-account-modal input[name=userid]').val();
        var userRole = $('#edit-account-modal select[name=role]').val();
        var userActive = $('#edit-account-modal select[name=active]').val();
        if (userId == undefined || userId == null || userId == '') {
            // Show message
            showMessage('danger', 'Nobody selected. please select any user.');
            return false;
        }

        if (userRole == 0) {
            // Show message
            showMessage('danger', 'For deleting user, please use \'Delete\' button.');
            return false;
        }

        loader('show');

        $.ajax({
            url: "/users/update",
            type: "put",
            dataType: "json",
            data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    id: userId,
                    role: userRole,
                    active: userActive
                },
            success: function(res) {
                loader('hide');
                
                if (res.type == 'success') {
                    // Show message
                    showMessage('success', res.user.first_name + ' ' + res.user.last_name + ' was updated successfully!');
                                    
                    // Remove tr
                    // $(trObj).remove();

                    // Change role content
                    $(trObj).find('td:nth-child(3)').removeClass('text-danger');
                    $(trObj).find('td:nth-child(3)').addClass((res.user.role == '0') ? 'text-danger' : '');
                    $(trObj).find('td:nth-child(3)').text(res.user.role_name);

                    // Change active content
                    $(trObj).find('td:nth-child(4)').removeClass('text-success text-danger');
                    $(trObj).find('td:nth-child(4)').addClass(res.user.active_class);
                    $(trObj).find('td:nth-child(4)').text(res.user.active_name);

                    // Change tr attribute
                    $(trObj).attr('data-userrole', res.user.role);
                    $(trObj).attr('data-useractive', res.user.active);

                    // Change disabled delete button
                    if (res.user.role != 0) {
                        $(trObj).find('button.btn-remove-user').removeAttr('disabled');
                    }

                } else {
                    // Show message
                    showMessage('danger', 'Error, Please retry!');
                }
                               
                // Hide modal
                $('#edit-account-modal').modal('hide');
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                loader('hide');
                
                // Show message
                showMessage('danger', 'Error, Please retry!');

                // Hide modal
                $('#edit-account-modal').modal('hide');
            }
        });
    });

    $('#edit-account-modal').on('hidden.bs.modal', function (event) {
        trObj = null;
        clearEditUserModal();
    });
});