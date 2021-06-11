const { parse } = require("postcss");

$(document).ready(function() {
    $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
        var table = $.fn.dataTable.tables( {visible: true, api: true} );
        table.columns.adjust();
        table.columns().iterator('column', function (ctx, idx) {
            if ($(table.column(idx).header()).find('.task-table-header').find('span.sort-icon').length == 0) {
                $(table.column(idx).header()).find('.task-table-header').append('<span class="sort-icon"/>');
            }
        });
    } );

    var taskTable = $('.task-table').DataTable({
        responsive: true,
        orderCellsTop: true,
        fixedHeader: true,
        info: false,
        scrollY: 187,
        scrollCollapse: false,
        paging: false,
        order: [[ 4, "asc" ]],
        columnDefs: [
            { orderable: false, targets: 'no-sort' },
            { type: 'date-eu', targets: 4 },
            { width: "30%", targets: 3 },
            { width: "80px", targets: 4 },
            { width: "80px", targets: 5 },
            { width: "90px", targets: 6 }
        ],
        language: {
            emptyTable: 'There is no tasks for you to complete.'
        }
    });

    $.fn.dataTable.tables( {visible: true, api: true} ).columns().iterator('column', function (ctx, idx) {
        $($.fn.dataTable.tables( {visible: true, api: true} ).column(idx).header()).find('.task-table-header').append('<span class="sort-icon"/>');
    });
    
    $('.date').datepicker({
        format: 'dd-mm-yyyy',
        todayBtn: "linked",
        todayHighlight: true,
        clearBtn: true,
        autoclose: true
    });
    $('#btn-show-modal').click(function() {
        //Show modal
        $('#add-opportunity-modal').modal({
            backdrop: 'static'
        });
    });
    $('#btn-create-new-tab').click(function() {
        let tabName = $('#tab-name').val();

        $('#tab-name').val('');
        
        // Check if opportunity name is empty
        if (tabName === '') {
            alert("You must enter new opportunity name to create new tab.");
            return;
        }

        // Hide modal
        $('#add-opportunity-modal').modal('hide');

        // Save blank outbound
        loader('show');
        $.ajax({
            url:        "opportunities/save-main",
            dataType:   "json",
            type:       "post",
            data:       {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            'opp-id': 0,
                            'opportunity-name': tabName
                        },
            success: function( res ) {console.log(res);
                // Add new tab
                let tabNavElement = '';
                tabNavElement += '<li class="nav-item" role="presentation">';
                tabNavElement += '<a class="nav-link active" ';
                tabNavElement += ' data-toggle="tab" role="tab" aria-selected="true" ';
                tabNavElement += ' id="tab-' + tabIndex + '" ';
                tabNavElement += ' href="#opp-tab-' + tabIndex + '" ';
                tabNavElement += ' aria-controls="#opp-tab-' + tabIndex + '">';
                tabNavElement += tabName;
                tabNavElement += '</a></li>';

                let tabContent = '';
                tabContent += '<div class="tab-pane fade show active" role="tabpanel" ';
                tabContent += ' id="opp-tab-' + tabIndex + '" ';
                tabContent += ' data-idx="' + tabIndex + '" ';
                tabContent += ' aria-labelledby="tab-' +  tabIndex + '">';
                tabContent += '</div>';

                $('#oppTabs li.nav-item a.nav-link').removeClass('active');
                $('#oppTabs li.nav-item a.nav-link').attr('aria-selected', false);
                $('#oppTabsContent div.tab-pane').removeClass('show');
                $('#oppTabsContent div.tab-pane').removeClass('active');
                
                $('#oppTabs').append(tabNavElement);
                $('#oppTabsContent').append(tabContent);

                // Add new component to tab
                $('#opp-tab-' + tabIndex).append($('#opp-component-empty').html());

                $('#opp-tab-' + tabIndex).find('.task-table-wrapper').remove();
                $('#opp-tab-' + tabIndex).find('.opportunity-tasks-title').remove();
                                
                // Add opportunity name
                $('#opp-tab-' + tabIndex).find('input[name=opportunity-name]').val(tabName);

                //Set some ids
                // $('#opp-tab-' + tabIndex).find('.task-table').attr('id', 'task-table-' + res.id);
                $('#opp-tab-' + tabIndex).find('.accordion-section').attr('id', 'accordion-' + res.id);
                $('#opp-tab-' + tabIndex).find('.card .card-header').attr('id', 'headingMeddpicc-' + res.id);
                $('#opp-tab-' + tabIndex).find('.card .card-header a.btn-link').attr('data-target', '#collapseMeddpicc-' + res.id);
                $('#opp-tab-' + tabIndex).find('.card .card-header a.btn-link').attr('aria-controls', '#collapseMeddpicc-' + res.id);
                $('#opp-tab-' + tabIndex).find('.collapse-section').attr('id', 'collapseMeddpicc-' + res.id);
                $('#opp-tab-' + tabIndex).find('.collapse-section').attr('aria-labelledby', 'headingMeddpicc-' + res.id);
                $('#opp-tab-' + tabIndex).find('.collapse-section').attr('data-parent', '#accordion-' + res.id);
                
                // Increase tab index
                tabIndex++;

                // Change opportunity id
                $('#opp-tab-' + (tabIndex - 1)).find('input[name=opp-id]').val(res.id);
                loader('hide');
            },
            error: function (request, status, error) {
                loader('hide');
                alert(request.responseText);
            }
        });
    });
    
    //implement skip and done
    $('.task-table tbody').on( 'click', 'button.btn-task-c-s', function () {
        var tr = $(this).parents('tr');
        var id = $(this).data('id');
        var tableId = $(this).attr('data-table-id');
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
                    var taskTable = $('table#task-table-' + tableId).DataTable();
                    taskTable
                        .row(tr)
                        .remove()
                        .draw();
                } else {
                    alert(data.message);
                }
            }
        });
    } );

    $('.collapse-section').on('show.bs.collapse', function () {
        $(this).closest('.card').find('.card-header i.collapse-icon').removeClass('bi-chevron-right');
        $(this).closest('.card').find('.card-header i.collapse-icon').addClass('bi-chevron-down');
    });
    $('.collapse-section').on('hide.bs.collapse', function () {
        $(this).closest('.card').find('.card-header i.collapse-icon').removeClass('bi-chevron-down');
        $(this).closest('.card').find('.card-header i.collapse-icon').addClass('bi-chevron-right');
    });

    //calculate meddpicc value
    $(document).on('change', '.collapse-section select.form-control', function() {
        var meddpiccTab = $(this).closest('.collapse-section');
        var metricsScore = $(meddpiccTab).find('select[name=metrics_score]').val();
        var economicBuyerScore = $(meddpiccTab).find('select[name=economic_buyer_score]').val();
        var decisionCriteriaScore = $(meddpiccTab).find('select[name=decision_criteria_score]').val();
        var decisionProcessScore = $(meddpiccTab).find('select[name=decision_process_score]').val();
        var paperProcessScore = $(meddpiccTab).find('select[name=paper_process_score]').val();
        var identifiedPainScore = $(meddpiccTab).find('select[name=identified_pain_score]').val();
        var championCoachScore = $(meddpiccTab).find('select[name=champion_coach_score]').val();
        var competitionScore = $(meddpiccTab).find('select[name=competition_score]').val();

        var meddpiccScore = parseInt(metricsScore) + parseInt(economicBuyerScore) +
                            parseInt(decisionCriteriaScore) + parseInt(decisionProcessScore) +
                            parseInt(paperProcessScore) + parseInt(identifiedPainScore) +
                            parseInt(championCoachScore) + parseInt(competitionScore);

        $(meddpiccTab).find('input[name=meddpicc_score]').val(meddpiccScore);
    });
});