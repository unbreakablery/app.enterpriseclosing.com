$(document).ready(function() {
    $.noConflict();
    
    // $('#table-1 thead tr').clone(true).appendTo( '#table-1 thead' );
    // $('#table-1 thead tr:eq(1) th').each( function (i) {
    //     var title = $(this).text();
    //     var class_name = (i == 1 || i == 2 || i == 3) ? 'date' : '';

    //     $(this).html( '<input class="' + class_name + '" type="text" placeholder="Search '+title+'" />' );

    //     $( 'input', this ).on( 'keyup change', function () {
    //         if ( table1.column(i).search() !== this.value ) {
    //             table1
    //                 .column(i)
    //                 .search( this.value )
    //                 .draw();
    //         }
    //     } );
    // } );

    // var table1 = $('#table-1').DataTable( {
    //     orderCellsTop: true,
    //     fixedHeader: true,
    //     info: false,
    //     scrollY: 200,
    //     scrollCollapse: true,
    //     paging: false
    // } );
    var table2 = $('#table-2').DataTable( {
        responsive: true,
        orderCellsTop: true,
        fixedHeader: true,
        info: false,
        scrollY: 187,
        scrollCollapse: false,
        paging: false,
        order: [[ 2, "asc" ]],
        columnDefs: [ { orderable: false, targets: 'no-sort' }, { type: 'date-eu', targets: 2 } ],
        language: {
            emptyTable: 'There is no tasks for you to complete.'
        }
    } );

    $('.date').datepicker({
        format: 'dd-mm-yyyy',
        todayBtn: "linked",
        todayHighlight: true,
        clearBtn: true
    });

    $('#table-2 tbody').on( 'click', 'button.btn-task-c-s', function () {
        var tr = $(this).parents('tr');
        var id = $(this).data('id');
        var status = 0;

        if ($(this).hasClass('btn-skip')) {
            status = 1;
        } else if ($(this).hasClass('btn-done')) {
            status = 2;
        } else {
            status = 0;
        }

        $.ajax({
            url:        "tasks/save",
            dataType:   "json",
            type:       "post",
            data:       {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            id: id,
                            status: status
                        },
            success: function( data ) {
                if (data.type == 'success') {
                    table2
                        .row(tr)
                        .remove()
                        .draw();
                } else {
                    alert(data.message);
                }
            }
        });
    } );

    $('input#ts-1-other').change(function() {
        $('#ts-1-rg-other').val($(this).val());
    });

    $('input#ts-2-other').change(function() {
        $('#ts-2-rg-other').val($(this).val());
    });
    // $(function () {
    //     $('[data-toggle="tooltip"]').tooltip();
    // });
    $('button#btn-create-task').click(function() {
        var isActionChecked = false;
        var isStepChecked = false;
        $('input[type=radio][name=action]').each(function(idx, element) {
            if ($(element).is(':checked')) {
                isActionChecked = true;
            }
        });
        $('input[type=radio][name=step]').each(function(idx, element) {
            if ($(element).is(':checked')) {
                isStepChecked = true;
            }
        });

        if (!isActionChecked) {
            $('#action-label').tooltip('show');
            return;
        } else {
            $('#action-label').tooltip('hide');
        }

        if (!isStepChecked) {
            $('#step-label').tooltip('show');
            return;
        } else {
            $('#step-label').tooltip('hide');
        }

        //check from/to/account && opportunity
        if ($('input#ts-3-from-to').val() == '' && $('input#ts-6-opportunity').val() == '') {
            $('h3#ts-3-from-to-label').tooltip('show');
            $('h3#ts-6-opportunity-label').tooltip('show');
            return;
        } else {
            $('h3#ts-3-from-to-label').tooltip('hide');
            $('h3#ts-6-opportunity-label').tooltip('hide');
        }

        //check by_date
        if ($('input#ts-4-by-date').val() == '') {
            $('h3#ts-4-by-date-label').tooltip('show');
            return;
        } else {
            $('h3#ts-4-by-date-label').tooltip('hide');
        }

        //check priority
        var isPriorityChecked = false;
        $('input[type=radio][name=priority]').each(function(idx, element) {
            if ($(element).is(':checked')) {
                isPriorityChecked = true;
            }
        });
        
        if (!isPriorityChecked) {
            $('#priority-label').tooltip('show');
            return;
        } else {
            $('#priority-label').tooltip('hide');
        }

        $("form#tasks-form").submit();
    });

    $('input#ts-3-from-to').change(function() {
        $('input#ts-6-opportunity').val('');
    });

    $('input#ts-6-opportunity').change(function() {
        $('input#ts-3-from-to').val('');
    });
} );