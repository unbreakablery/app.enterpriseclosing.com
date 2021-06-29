$(document).ready(function() {
    function clearAddTaskModal() {
        $('#add-task-modal select[name=action]').val(0);
        $('#add-task-modal select[name=step]').val(0);
        $('#add-task-modal input[name=person-account]').val('');
        $('#add-task-modal input[name=opportunity]').val('');
        $('#add-task-modal input[name=note]').val('');
        $('#add-task-modal select[name=priority]').val(0);
        $('.date').datepicker("setDate", new Date());
    }
    $('.date').datepicker({
        format: 'dd-mm-yyyy',
        todayBtn: "linked",
        todayHighlight: true,
        clearBtn: true,
        autoclose: true
    }).datepicker("setDate", new Date());
    $('#btn-show-modal').click(function() {
        //Show modal
        $('#add-account-modal').modal({
            backdrop: 'static'
        });
    });
    $('#btn-create-new-tab').click(function() {
        let tabName = $('#tab-name').val();

        $('#tab-name').val('');
        
        // Check if account name is empty
        if (tabName === '') {
            showMessage('danger', "Type: Input Error<br/>NOTE: You must enter new account name.");
            return;
        }

        // Hide modal
        $('#add-account-modal').modal('hide');

        // Save blank outbound
        loader('show');
        $.ajax({
            url:        "outbound/save-main",
            dataType:   "json",
            type:       "post",
            data:       {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            id: 0,
                            account_name: tabName
                        },
            success: function( res ) {
                // Add new tab
                let tabNavElement = '';
                tabNavElement += '<li class="nav-item" role="presentation">';
                tabNavElement += '<a class="nav-link active" ';
                tabNavElement += ' data-toggle="tab" role="tab" aria-selected="true" ';
                tabNavElement += ' id="tab-' + tabIndex + '" ';
                tabNavElement += ' href="#ob-tab-' + tabIndex + '" ';
                tabNavElement += ' aria-controls="#ob-tab-' + tabIndex + '">';
                tabNavElement += tabName;
                tabNavElement += '</a></li>';

                let tabContent = '';
                tabContent += '<div class="tab-pane fade show active" role="tabpanel" ';
                tabContent += ' id="ob-tab-' + tabIndex + '" ';
                tabContent += ' data-idx="' + tabIndex + '" ';
                tabContent += ' aria-labelledby="tab-' +  tabIndex + '">';
                tabContent += '</div>';

                $('#outboundTabs li.nav-item a.nav-link').removeClass('active');
                $('#outboundTabs li.nav-item a.nav-link').attr('aria-selected', false);
                $('#outboundTabsContent div.tab-pane').removeClass('show');
                $('#outboundTabsContent div.tab-pane').removeClass('active');
                
                $('#outboundTabs').append(tabNavElement);
                $('#outboundTabsContent').append(tabContent);

                // Add new table to tab
                $('#ob-tab-' + tabIndex).append($('#ob-component-empty').html());
                
                // Add account name
                $('#ob-tab-' + tabIndex).find('input[name=account-name]').val(tabName);

                // Increase tab index
                tabIndex++;

                // Change outbound id
                $('#ob-tab-' + (tabIndex - 1)).find('input[name=o-id]').val(res.id);
                loader('hide');
            },
            error: function (request, status, error) {
                loader('hide');
                showMessage('danger', status);
            }
        });
    });
    $('#btn-create-new-task').click(function() {
        let action = $('#add-task-modal select[name=action]').val();
        let step = $('#add-task-modal select[name=step]').val();
        let personAccount = $('#add-task-modal input[name=person-account]').val();
        let opportunity = $('#add-task-modal input[name=opportunity]').val();
        let note = $('#add-task-modal input[name=note]').val();
        let byDate = $('#add-task-modal input[name=by-date]').val();
        let priority = $('#add-task-modal select[name=priority]').val();

        loader('show');

        $.ajax({
            url:        "outbound/save-task",
            dataType:   "json",
            type:       "post",
            data:       {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            action:             action,
                            step:               step,
                            person_account:     personAccount,
                            opportunity:        opportunity,
                            note:               note,
                            by_date:            byDate,
                            priority:           priority
                        },
            success: function( res ) {
                loader('hide');
                $('#add-task-modal').modal('hide');
                
                // Show meassge
                showMessage('success', 'New task (ID: ' + res.taskID + ') was added successfully!');
            },
            error: function (request, status, error) {
                loader('hide');
                showMessage('danger', status);
            }
        });
    });
    $(document).on('click', '.btn-add-row', function() {
        let pTable = $(this).closest('.tab-component').find('#persons-table');
        // Remove no data row
        $(pTable).find('#no-data-row').remove();
        
        // Add new row
        $(pTable).find('tbody').append($('#tr-component-empty tbody').html());
        let trObj = $(pTable).find('tbody tr').last();
        trObj[0].scrollIntoView(true);
    });
    $(document).on('change', '.tab-component .main-info input[type=text], .tab-component .main-info textarea', function() {
        let tabComponent = $(this).closest('.tab-component');
        let oId = $(tabComponent).find('input[name=o-id]').val();
        let accountName = $(tabComponent).find('input[name=account-name]').val();
        let annualReport = $(tabComponent).find('input[name=annual-report]').val();
        let prArticles = $(tabComponent).find('input[name=pr-articles]').val();
        let orgHooks = $.trim($(tabComponent).find('textarea[name=org-hooks]').val());
        let additionalNuggets = $.trim($(tabComponent).find('textarea[name=additional-nuggets]').val());
        
        loader('show');

        $.ajax({
            url:        "outbound/save-main",
            dataType:   "json",
            type:       "post",
            data:       {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            id: oId,
                            account_name: accountName,
                            annual_report: annualReport,
                            pr_articles: prArticles,
                            org_hooks: orgHooks,
                            additional_nuggets: additionalNuggets
                        },
            success: function( res ) {
                // Change outbound id
                $(tabComponent).find('input[name=o-id]').val(res.id);
                
                loader('hide');
            },
            error: function (request, status, error) {
                loader('hide');
                showMessage('danger', status);
            }
        });
    });
    $(document).on('change', '.tab-component table#persons-table input, .tab-component table#persons-table select', function() {
        let thisObj = $(this);
        let tabComponent = $(this).closest('.tab-component');
        let rowObj = $(this).closest('tr');
        let oId = $(tabComponent).find('input[name=o-id]').val();
        let accountName = $(tabComponent).find('input[name=account-name]').val();
        let id = $(rowObj).data('id');
        
        if (oId == 0) {
            showMessage('danger', "Type: Input Error<br/>NOTE: Outbound didn't create yet!");
            return;
        }
        
        let firstName = $(rowObj).find('input[name=first-name]').val();
        let lastName = $(rowObj).find('input[name=last-name]').val();
        let title = $(rowObj).find('input[name=title]').val();
        let phone = $(rowObj).find('input[name=phone]').val();
        let mobile = $(rowObj).find('input[name=mobile]').val();
        let email = $(rowObj).find('input[name=email]').val();
        let calls = $(rowObj).find('input[name=calls]').val();
        let result = $(rowObj).find('select[name=result]').val();
        let liConnected = $(rowObj).find('select[name=linkedin-connected]').val();
        let notes = $(rowObj).find('input[name=notes]').val();
        let liAddress = $(rowObj).find('input[name=linkedin-address]').val();

        loader('show');

        $.ajax({
            url:        "outbound/save-person",
            dataType:   "json",
            type:       "post",
            data:       {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            id:             id,
                            o_id:           oId,
                            first_name:     firstName,
                            last_name:      lastName,
                            title:          title,
                            phone:          phone,
                            mobile:         mobile,
                            email:          email,
                            calls:          calls,
                            result:         result,
                            li_connected:   liConnected,
                            notes:          notes,
                            li_address:     liAddress
                        },
            success: function( res ) {
                // Change outbound person id
                $(rowObj).data('id', res.id);

                loader('hide');

                // Clear add task modal
                clearAddTaskModal();

                // Check if element type is select element
                let elementName = $(thisObj).attr('name');
                
                if (elementName === 'result' && $(thisObj).val() === 'Send Info') {
                    //Show task modal
                    $('#add-task-modal input[name=person-account]').val(accountName);
                    $('#add-task-modal').modal({
                        backdrop: 'static'
                    });
                }
            },
            error: function (request, status, error) {
                loader('hide');
                showMessage('danger', status);
            }
        });
    });
    $(document).on('click', '.btn-remove-row', function() {
        let rowObj = $(this).closest('tr');
        let id = $(rowObj).data('id');

        if (id == 0) {
            // Remove row element
            $(rowObj).remove();
            return;
        }

        loader('show');

        $.ajax({
            url:        "outbound/remove-person",
            dataType:   "json",
            type:       "post",
            data:       {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            id: id
                        },
            success: function( res ) {
                // Remove row element
                $(rowObj).remove();

                loader('hide');
            },
            error: function (request, status, error) {
                loader('hide');
                showMessage('danger', status);
            }
        });
    });
    $(document).on('click', '.a-btn-remove-account', function() {
        let tabComponent = $(this).closest('.tab-component');
        let id = $(tabComponent).find('input[name=o-id]').val();
        let accountName = $(tabComponent).find('input[name=account-name]').val();

        if (id == 0) {
            showMessage('danger', 'Type: Input Error<br/>NOTE: Not saved this account!');
            return;
        }

        loader('show');

        $.ajax({
            url:        "outbound/remove-main",
            dataType:   "json",
            type:       "post",
            data:       {
                            _token: $('meta[name="csrf-token"]').attr('content'),
                            id: id
                        },
            success: function( res ) {
                // Remove tab
                let idx = $(tabComponent).parent().data('idx');
                $('#outboundTabsContent #ob-tab-' + idx).remove();
                $('#outboundTabs #tab-' + idx).parent().remove();

                // Active first tab
                $('#outboundTabs li a.nav-link').first().addClass('active');
                $('#outboundTabsContent .tab-pane').first().addClass('show active');

                loader('hide');

                showMessage('success', 'Account (' + accountName + ') was removed successfully!');
            },
            error: function (request, status, error) {
                loader('hide');
                showMessage('danger', status);
            }
        });
    });
    $(document).on('click', '.btn-download-persons', function() {
        let id = $(this).closest('.tab-component').find('input[name=o-id]').val();

        if (id == 0 || id == '' || id == undefined) {
            showMessage('danger', "Type: Output Error<br/>NOTE: You can't download these persons data now!");
            return;
        }
        let url = '/outbound/download/' + id;
        window.location.href = url;
    });
    $(document).on('click', '#btn-upload-persons', function() {
        let idx = $('#upload-file-modal').attr('data-idx');
        let pTable = $('#ob-tab-' + idx + ' .tab-component').find('#persons-table');
        let id = $('#ob-tab-' + idx + ' .tab-component').find('input[name=o-id]').val();
        let file_data = $('#upload-file-modal input[name=upload-file]').prop('files')[0];
        
        if (file_data == undefined) {
            showMessage('danger', 'Type: Input Error<br />NOTE: Please choose a upload csv file!');
            return;
        }

        let form_data = new FormData();
        
        form_data.append('upload-file', file_data);
        form_data.append('id', id);
        form_data.append('_token', $('meta[name="csrf-token"]').attr('content'));
        
        loader('show');

        $.ajax({
            url: '/outbound/upload',
            dataType: 'json',
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,
            type: 'post',
            success: function(res) {
                // Remove all rows on table
                $(pTable).find('tbody tr').remove();

                for (let i = 0; i < res.persons.length; i++) {
                    let person = res.persons[i];
                    let newRow = $('#tr-component-empty tbody tr').clone();

                    // Set values to new row
                    $(newRow).attr('data-id', person.id);
                    $(newRow).find('input[name=first-name]').val(person.first_name);
                    $(newRow).find('input[name=last-name]').val(person.last_name);
                    $(newRow).find('input[name=title]').val(person.title);
                    $(newRow).find('input[name=phone]').val(person.phone);
                    $(newRow).find('input[name=mobile]').val(person.mobile);
                    $(newRow).find('input[name=email]').val(person.email);
                    $(newRow).find('input[name=calls]').val(person.calls);
                    $(newRow).find('select[name=result]').val(person.result);
                    $(newRow).find('select[name=linkedin-connected]').val(person.li_connected);
                    $(newRow).find('input[name=notes]').val(person.notes);
                    $(newRow).find('input[name=linkedin-address]').val(person.li_address);
                    
                    // Add new row
                    $(pTable).find('tbody').append(newRow);
                }
                
                $('#upload-file-modal').modal('hide');

                loader('hide');

                showMessage('success', 'File was uploaded successfully!');
            },
            error: function (request, status, error) {
                loader('hide');
                showMessage('danger', status);
            }
        });
    });
    $(document).on('click', '.btn-upload-persons-modal', function() {
        let idx = $(this).closest('.tab-pane').attr('data-idx');
        
        $('#upload-file-modal').attr('data-idx', idx);
        $('#upload-file-modal input[name=upload-file]').val('');

        //Show modal
        $('#upload-file-modal').modal({
            backdrop: 'static'
        });
    });
    $(document).on('click', '.tab-component table#persons-table .btn.btn-counter-decrease', function() {
        let rowObj = $(this).closest('tr');
        let calls = parseInt($(rowObj).find('input[name=calls]').val());
        $(rowObj).find('input[name=calls]').val(calls - 1);
        $(rowObj).find('input[name=calls]').trigger('change');
    });
    $(document).on('click', '.tab-component table#persons-table .btn.btn-counter-increase', function() {
        let rowObj = $(this).closest('tr');
        let calls = parseInt($(rowObj).find('input[name=calls]').val());
        $(rowObj).find('input[name=calls]').val(calls + 1);
        $(rowObj).find('input[name=calls]').trigger('change');
    });
});