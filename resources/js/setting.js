$(document).ready(function() {
    $.noConflict();
    
    $('.input-step').on('click', function() {
        console.log(this.value);
        if (this.checked) {
            $('#sub_step').removeClass('suggest-step-deactive');
            $('#sub_step').addClass('suggest-step-active');
            $('.item-' + this.value).removeClass('suggest-step-item-deactive');
            $('.item-' + this.value).addClass('suggest-step-item-active');
            $('.nav-link').removeClass('active');
            $('.tab-pane').removeClass('active');
            $('#pane-' + this.value).addClass('active');
            $('#pane-' + this.value).addClass('show');
            $('#tab_' + this.value).addClass('active');
        } else {
            $('#sub_step li.suggest-item.suggest-step-item-active a.nav-link.active').removeClass('active');
            
            $('.item-' + this.value).removeClass('suggest-step-item-active');
            $('.item-' + this.value).addClass('suggest-step-item-deactive');
            $('#pane-' + this.value).removeClass('active');

            $('#sub_step li.suggest-item.suggest-step-item-active').first().addClass('suggest-step-item-active');
            $('#sub_step li.suggest-item.suggest-step-item-active').first().find('a.nav-link').addClass('active');
            let id = $('#sub_step li.suggest-item.suggest-step-item-active').first().attr('id').substring(5);
            $('#pane-' + id).addClass('show');
            $('#pane-' + id).addClass('active');
            // $('#tab_' + this.value).removeClass('active');
        }
    });
    
    $('#btn-save-settings').on('click', function(){
        var token = $('meta[name="csrf-token"]').attr('content');
        var data = $('#form_setting').serialize();
        $.ajax({
            url: "settings/store",
            type: "post",
            dataType: "json",
            data: {
                    _token: token,
                    data: data,
                },
            success: function(response) {
                console.log('res', response);
              
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
              console.log('error')
            }
        })
    })
    

    
} );