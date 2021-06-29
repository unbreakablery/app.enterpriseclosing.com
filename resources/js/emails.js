$(document).ready(function() {
    $(document).on('click', 'button.btn-save-email', function() {
        var tabObj = $(this).closest('.tab-component');
        var emailId = $(tabObj).find('input[name=email_id]').val();
        var emailTitle = $(tabObj).find('input[name=email_title]').val();
        var emailSubject = $(tabObj).find('input[name=email_subject]').val();
        var emailBody = $(tabObj).find('textarea[name=email_body]').val();

        loader('show');

        $.ajax({
            url:        "emails/save-email",
            dataType:   "json",
            type:       "post",
            data:       {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            id: emailId,
                            title: emailTitle,
                            subject: emailSubject,
                            body: emailBody
                        },
            success: function( response ) {
                loader('hide');

                // Show message
                showMessage('success', 'Email (' + response.email.title + ') was updated successfully!');
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                loader('hide');
                
                // Set focus to email subject input
                $(tabObj).find('input[name=email_subject]').focus();

                // Show message
                showMessage('danger', 'Error, Please retry!');
            }
        });
    });
});