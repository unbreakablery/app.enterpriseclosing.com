$(document).ready(function() {
    function clearAddTaskModal() {
        $('#add-task-modal select[name=action]').selectpicker('val', $("#add-task-modal select[name=action] option:first").val());
        $('#add-task-modal select[name=step]').selectpicker('val', $("#add-task-modal select[name=step] option:first").val());
        $('#add-task-modal input[name=note]').val('');
        $('#add-task-modal input[name=by-date]').val('');
        $('#add-task-modal select[name=priority]').selectpicker('val', $("#add-task-modal select[name=priority] option:first").val());
    }

    var currentTable = null;

    $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
        var table = $.fn.dataTable.tables( {visible: true, api: true} );
        table.columns.adjust();
        table.columns().iterator('column', function (ctx, idx) {
            if ($(table.column(idx).header()).find('.task-table-header').find('span.sort-icon').length == 0) {
                $(table.column(idx).header()).find('.task-table-header').append('<span class="sort-icon"/>');
            }
        });
    } );

    var taskTable = $('.opportunities-wrapper .task-table').DataTable({
        responsive: true,
        orderCellsTop: true,
        fixedHeader: true,
        info: false,
        scrollY: 150,
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
            showMessage('danger', "Type: Input Error <br/>NOTE: You must enter new opportunity name.");
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
            success: function( res ) {
                // Add new tab
                let tabNavElement = '';
                tabNavElement += '<li class="nav-item" role="presentation">';
                tabNavElement += '<a class="nav-link active" ';
                tabNavElement += ' data-toggle="tab" role="tab" aria-selected="true" ';
                tabNavElement += ' id="tab-' + tabIndex + '" ';
                tabNavElement += ' href="#opp-tab-' + tabIndex + '" ';
                tabNavElement += ' aria-controls="#opp-tab-' + tabIndex + '">';
                tabNavElement += tabName;
                tabNavElement += " <strong></strong>";
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
                $('#opp-tab-' + tabIndex).append($('#opp-component-empty .tab-component').clone(true));
                $('#opp-tab-' + tabIndex + ' .task-table').attr('id', 'task-table-' + res.id);
                $('#opp-tab-' + tabIndex + ' .task-table').DataTable({
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
                var table = $.fn.dataTable.tables( {visible: true, api: true} );
                table.columns.adjust();
                table.columns().iterator('column', function (ctx, idx) {
                    if ($(table.column(idx).header()).find('.task-table-header').find('span.sort-icon').length == 0) {
                        $(table.column(idx).header()).find('.task-table-header').append('<span class="sort-icon"/>');
                    }
                });

                // Add opportunity id and name
                $('#opp-tab-' + tabIndex).find('input[name=opp-id]').val(res.id);
                $('#opp-tab-' + tabIndex).find('input[name=opportunity-name]').val(tabName);

                //Set some ids
                $('#opp-tab-' + tabIndex).find('.accordion-section').attr('id', 'accordion-' + res.id);
                $('#opp-tab-' + tabIndex).find('.card .card-header').attr('id', 'headingMeddpicc-' + res.id);
                $('#opp-tab-' + tabIndex).find('.card .card-header a.btn-link').attr('data-target', '#collapseMeddpicc-' + res.id);
                $('#opp-tab-' + tabIndex).find('.card .card-header a.btn-link').attr('aria-controls', '#collapseMeddpicc-' + res.id);
                $('#opp-tab-' + tabIndex).find('.collapse-section').attr('id', 'collapseMeddpicc-' + res.id);
                $('#opp-tab-' + tabIndex).find('.collapse-section').attr('aria-labelledby', 'headingMeddpicc-' + res.id);
                $('#opp-tab-' + tabIndex).find('.collapse-section').attr('data-parent', '#accordion-' + res.id);
                
                // Increase tab index
                tabIndex++;

                loader('hide');
            },
            error: function (request, status, error) {
                loader('hide');
                showMessage('danger', 'Type: AJAX Error<br/>NOTE: ' + status);
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

        loader('show');

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
                loader('hide');

                if (data.type == 'success') {
                    var taskTable = $('table#task-table-' + tableId).DataTable();
                    taskTable
                        .row(tr)
                        .remove()
                        .draw();

                    // Remove * sign from tab name
                    if (taskTable.rows().count() == 0) {
                        var idx = $('table.task-table').index($('table#task-table-' + tableId)) / 2 - 1;

                        $('#oppTabs a#tab-' + idx).find('strong').text('');
                    }

                    showMessage('success', data.message);
                } else {
                    showMessage('danger', data.message);
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
    $(document).on('click', '.collapse-section input[type=radio].form-check-input', function() {
        var meddpiccTab = $(this).closest('.collapse-section');
        var metricsScore = $(meddpiccTab).find('input[type=radio][name=metrics_score]:checked').val();
        var economicBuyerScore = $(meddpiccTab).find('input[type=radio][name=economic_buyer_score]:checked').val();
        var decisionCriteriaScore = $(meddpiccTab).find('input[type=radio][name=decision_criteria_score]:checked').val();
        var decisionProcessScore = $(meddpiccTab).find('input[type=radio][name=decision_process_score]:checked').val();
        var paperProcessScore = $(meddpiccTab).find('input[type=radio][name=paper_process_score]:checked').val();
        var identifiedPainScore = $(meddpiccTab).find('input[type=radio][name=identified_pain_score]:checked').val();
        var championCoachScore = $(meddpiccTab).find('input[type=radio][name=champion_coach_score]:checked').val();
        var competitionScore = $(meddpiccTab).find('input[type=radio][name=competition_score]:checked').val();

        var meddpiccScore = parseInt(metricsScore) + parseInt(economicBuyerScore) +
                            parseInt(decisionCriteriaScore) + parseInt(decisionProcessScore) +
                            parseInt(paperProcessScore) + parseInt(identifiedPainScore) +
                            parseInt(championCoachScore) + parseInt(competitionScore);

        $(meddpiccTab).find('input[name=meddpicc_score]').val(meddpiccScore);
    });

    $(document).on('click', 'button.btn-show-task-modal', function() {
        var oppId = $(this).closest('.tab-component').find('input[name=opp-id]').val();
        var oppName = $(this).closest('.tab-component').find('input[name=opportunity-name]').val();
        $('#add-task-modal input[name=opportunity]').val(oppName);
        $('#add-task-modal input[name=opportunity-id]').val(oppId);

        // get datatable obj
        currentTable = $(this).closest('.tab-component').find('.task-table').DataTable();

        //Show task modal
        $('#add-task-modal').modal({
            backdrop: 'static'
        });
    });

    $('#add-task-modal button#btn-create-new-task').click(function() {
        var byDate = $('#add-task-modal input[name=by-date]').val();
        if (byDate == undefined || byDate == null || byDate == '') {
            showMessage('danger', 'Type: Input Error<br/>NOTE: You must enter By Date!');
            $('#add-task-modal input[name=by-date]').focus();
            return;
        }

        var action = $('#add-task-modal select[name=action]').val();
        var actionName = $('#add-task-modal select[name=action] option:selected').text();
        var step = $('#add-task-modal select[name=step]').val();
        var stepName = $('#add-task-modal select[name=step] option:selected').text();
        var person = $('#add-task-modal input[name=person-account]').val();
        var oppId = $('#add-task-modal input[name=opportunity-id]').val();
        var oppName = $('#add-task-modal input[name=opportunity]').val();
        var note = $('#add-task-modal input[name=note]').val();
        var priority = $('#add-task-modal select[name=priority]').val();

        loader('show');

        $.ajax({
            url:        "outbound/save-task",
            dataType:   "json",
            type:       "post",
            data:       {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            action:             action,
                            step:               step,
                            person_account:     person,
                            opportunity:        oppId,
                            note:               note,
                            by_date:            byDate,
                            priority:           priority
                        },
            success: function( res ) {
                loader('hide');

                // Clear Modal and hide
                clearAddTaskModal();
                $('#add-task-modal').modal('hide');
                
                // Show meassge
                showMessage('success', 'New task (ID: ' + res.taskID + ') was added successfully!');

                // Add new row
                let className = '';
                let priorityName = '';
                
                if (priority == 1) {
                    className = 'bg-danger text-white';
                    priorityName = 'High';
                } else if (priority == 2) {
                    className = 'bg-warning text-dark';
                    priorityName = 'Medium';
                } else if (priority == 3) {
                    className = 'bg-light text-dark';
                    priorityName = 'Normal';
                } else {
                    className = 'bg-light text-dark';
                    priorityName = '';
                }

                let innerHtml = '';
                innerHtml += '<tr class="' + className + '">';
                innerHtml += '<td>' + actionName + ' ' + stepName + '</td>';
                innerHtml += '<td>' + person + '</td>';
                innerHtml += '<td>' + oppName + '</td>';
                innerHtml += '<td>' + note + '</td>';
                innerHtml += '<td>' + byDate + '</td>';
                innerHtml += '<td>' + priorityName + '</td>';
                innerHtml += '<td>';
                innerHtml += '<button type="button" class="btn btn-sm btn-task-c-s btn-dark btn-skip" data-id="' + res.taskID + '" data-table-id="' + oppId + '">Skip</button> ';
                innerHtml += '<button type="button" class="btn btn-sm btn-task-c-s btn-success btn-done" data-id="' + res.taskID + '" data-table-id="' + oppId + '">Done</button>';
                innerHtml += '</td>';
                innerHtml += '</tr>';
                
                currentTable.row.add($(innerHtml)).draw();

                // Add * sign to tab name
                var idx = $('table.task-table').index($('table#task-table-' + oppId)) / 2 - 1;
                $('#oppTabs a#tab-' + idx).find('strong').text('*');
            },
            error: function (request, status, error) {
                loader('hide');
                showMessage('danger', status);
            }
        });
    });
});