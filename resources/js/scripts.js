$(document).ready(function() {
    $(document).on('click', 'button.btn-save-script', function() {
        var tabObj = $(this).closest('.tab-component');
        var scriptId = $(tabObj).find('input[name=script_id]').val();
        var scriptName = $(tabObj).find('input[name=script_name]').val();
        var scriptContent = $(tabObj).find('textarea[name=script_content]').val();

        loader('show');

        $.ajax({
            url:        "scripts/save-script",
            dataType:   "json",
            type:       "post",
            data:       {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            id: scriptId,
                            name: scriptName,
                            content: scriptContent
                        },
            success: function( response ) {
                loader('hide');

                // Show message
                showMessage('success', 'Script (' + response.script.name + ') was updated successfully!');
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                loader('hide');
                
                // Set focus to content textarea
                $(tabObj).find('textarea[name=script_content]').focus();

                // Show message
                showMessage('danger', 'Error, Please retry!');
            }
        });
    });
});