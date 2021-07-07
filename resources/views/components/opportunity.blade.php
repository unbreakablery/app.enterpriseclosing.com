<div class="tab-component">
    <div class="row task-section col-md-12 col-sm-12 mb-4">
        <h4 class="mt-4 p-special-1 opportunity-tasks-title">Tasks To Complete</h4>
        <div class="col-lg-2 col-md-3 col-sm-6">
                <div class="row task-section col-md-12 col-sm-12 mt-3">
                    <div class="input-group w-100">
                        <button type="button" class="btn btn-grad n-b-r text-uppercase w-100 btn-show-task-modal">
                            Create Task
                        </button>
                    </div>
                </div>
        </div>
    </div>
    <div class="table-responsive table-wrapper task-table-wrapper mt-4 mb-4 p-special-1">
        <table class="table table-dark table-hover datatable task-table w-100 border border-white b-s-b-b" 
                id="task-table-@if (isset($main)){{ $main->id }}@else{{ 0 }}@endif">
            <thead class="thead-dark">
                <tr>
                    <th scope="col"><div class="task-table-header">Action + Step</div></th>
                    <th scope="col"><div class="task-table-header">Person / Account</div></th>
                    <th scope="col"><div class="task-table-header">Opportunity</div></th>
                    <th scope="col"><div class="task-table-header">Note</div></th>
                    <th scope="col"><div class="task-table-header">By</div></th>
                    <th scope="col"><div class="task-table-header">Priority</div></th>
                    <th scope="col" class="no-sort"><div class="task-table-header">Result</div></th>
                </tr>
            </thead>
            <tbody>
                @if (isset($tasks))
                @foreach ($tasks as $task)
                @php
                    $class_name = '';
                    $priority_name = '';
                    
                    if ($task['priority'] == '1') {
                        $class_name = 'bg-danger text-white';
                        $priority_name = 'High';
                    } elseif ($task['priority'] == '2') {
                        $class_name = 'bg-warning text-dark';
                        $priority_name = 'Medium';
                    } elseif ($task['priority'] == '3') {
                        $class_name = 'bg-light text-dark';
                        $priority_name = 'Normal';
                    } else {
                        $class_name = 'bg-light text-dark';
                        $priority_name = '';
                    }
                @endphp
                <tr class="{{ $class_name }}">
                    <td>{{ $task['action_name'] }} {{ $task['step_name'] }}</td>
                    <td>{{ $task['person_account'] }}</td>
                    <td>{{ $task['opportunity_name'] }}</td>
                    <td>
                        {{ $task['note'] }}
                    </td>
                    <td>
                        @if (!empty($task['by_date']))
                            {{ date("d-m-Y", strtotime($task['by_date'])) }}
                        @endif
                    </td>
                    <td>
                        {{ $priority_name }}
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-task-c-s btn-dark btn-skip" data-id="{{ $task['id'] }}" data-table-id="{{ $main->id }}">Skip</button>
                        <button type="button" class="btn btn-sm btn-task-c-s btn-success btn-done" data-id="{{ $task['id'] }}" data-table-id="{{ $main->id }}">Done</button>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <div class="main-info">
        <form action="{{ route('opportunity.update.main') }}" method="post" autocomplete="off">
            @csrf
            <input type="hidden" name="opp-id" value="@if (isset($main)){{ $main->id }}@else{{ 0 }}@endif">
            <input type="hidden" name="opportunity-name" value="@if (isset($main)){{ $main->opportunity }}@endif">
            <div class="row mt-4 ml-0 mr-0 pl-1 pr-1">
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="form-group">
                        <label for="usecase">Use-Case</label>
                        <input class="form-control n-b-r"
                            type="text"
                            name="usecase"
                            value="@if (isset($main)){{ $main->usecase }}@endif"
                        />
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="form-group">
                        <label for="emp_num">No. of Employees</label>
                        <input class="form-control n-b-r"
                            type="text"
                            name="emp_num"
                            value="@if (isset($main)){{ $main->emp_num }}@endif"
                        />
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="form-group">
                        <label for="close_date">Close Date</label>
                        <input class="form-control n-b-r date"
                            type="text"
                            name="close_date"
                            value="@if (isset($main) && !empty($main->close_date)){{ date("d-m-Y", strtotime($main->close_date)) }}@endif"
                        />
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="form-group">
                        <label for="stage">Stage</label>
                        <input class="form-control n-b-r"
                            type="text"
                            name="stage"
                            value="@if (isset($main)){{ $main->stage }}@endif"
                        />
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="form-group">
                        <label for="next_step">Next Step</label>
                        <input class="form-control n-b-r"
                            type="text"
                            name="next_step"
                            value="@if (isset($main)){{ $main->next_step }}@endif"
                        />
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input class="form-control n-b-r"
                            type="text"
                            name="amount"
                            value="@if (isset($main)){{ $main->amount }}@endif"
                        />
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="form-group">
                        <label for="currency">Currency</label>
                        <input class="form-control n-b-r"
                            type="text"
                            name="currency"
                            value="@if (isset($main)){{ $main->currency }}@endif"
                        />
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="form-group">
                        <label for="lead_source">Lead Source</label>
                        <input class="form-control n-b-r"
                            type="text"
                            name="lead_source"
                            value="@if (isset($main)){{ $main->lead_source }}@endif"
                        />
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="form-group">
                        <label for="compelling_event">Compelling Event</label>
                        <input class="form-control n-b-r"
                            type="text"
                            name="compelling_event"
                            value="@if (isset($main)){{ $main->compelling_event }}@endif"
                        />
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="form-group">
                        <label for="competition">Competition</label>
                        <input class="form-control n-b-r"
                            type="text"
                            name="competition"
                            value="@if (isset($main)){{ $main->competition }}@endif"
                        />
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="form-group">
                        <label for="what_new_changed">What's New / Changed</label>
                        <input class="form-control n-b-r"
                            type="text"
                            name="what_new_changed"
                            value="@if (isset($main)){{ $main->what_new_changed }}@endif"
                        />
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="form-group">
                        <label for="red_flags">Red Flags</label>
                        <input class="form-control n-b-r"
                            type="text"
                            name="red_flags"
                            value="@if (isset($main)){{ $main->red_flags }}@endif"
                        />
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="form-group">
                        <label for="folder_link">Link to Folder</label>
                        <input class="form-control n-b-r"
                            type="text"
                            name="folder_link"
                            value="@if (isset($main)){{ $main->folder_link }}@endif"
                        />
                    </div>
                </div>
            </div>
            <div class="row mt-4 ml-0 mr-0 pl-1 pr-1">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="form-group">
                                <button type="submit" class="btn btn-grad w-100 n-b-r">Save Info</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div id="accordion-@if (isset($main)){{ $main->id }}@else{{ 0 }}@endif" class="accordion-section mt-4 mb-4 p-special-1">
        <div class="card n-b-r">
            <div class="card-header bg-dark n-b-r pt-1 pb-1 pl-1"
                    id="headingMeddpicc-@if (isset($main)){{ $main->id }}@else{{ 0 }}@endif">
                <h3 class="mb-0">
                    <a class="btn btn-link text-white"
                        data-toggle="collapse"
                        data-target="#collapseMeddpicc-@if (isset($main)){{ $main->id }}@else{{ 0 }}@endif"
                        aria-expanded="true"
                        aria-controls="collapseMeddpicc-@if (isset($main)){{ $main->id }}@else{{ 0 }}@endif"
                        href="javascript:void(0)">
                        <i class="collapse-icon bi bi-chevron-down"></i> MEDDPICC
                    </a>
                </h3>
            </div>

            <div id="collapseMeddpicc-@if (isset($main)){{ $main->id }}@else{{ 0 }}@endif"
                class="collapse-section collapse show bg-black"
                aria-labelledby="headingMeddpicc-@if (isset($main)){{ $main->id }}@else{{ 0 }}@endif"
                data-parent="#accordion-@if (isset($main)){{ $main->id }}@else{{ 0 }}@endif">
                <div class="card-body">
                    <form class="meddpicc-section" action="{{ route('opportunity.save.meddpicc') }}" method="post" autocomplete="off">
                        @csrf
                        <input type="hidden" name="opp-id" value="@if (isset($main)){{ $main->id }}@else{{ 0 }}@endif">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="metrics">Metrics <i class="bi bi-info-circle-fill ml-2"></i></label>
                                            <textarea class="form-control h-3rem-2px n-b-r" name="metrics">@if (isset($meddpicc)){{ $meddpicc->metrics }}@endif</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group form-row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <label for="metrics_score">Metrics Score <i class="bi bi-info-circle-fill ml-2"></i></label>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="metrics_score" value="0" @if (!isset($meddpicc) || isset($meddpicc) && $meddpicc->metrics_score == '0'){{ 'checked' }}@endif />
                                                    <label class="form-check-label" for="metrics_score">0</label>
                                                
                                                    <input class="form-check-input" type="radio" name="metrics_score" value="1" @if (isset($meddpicc) && $meddpicc->metrics_score == '1'){{ 'checked' }}@endif />
                                                    <label class="form-check-label" for="metrics_score">1</label>
                                                
                                                    <input class="form-check-input" type="radio" name="metrics_score" value="2" @if (isset($meddpicc) && $meddpicc->metrics_score == '2'){{ 'checked' }}@endif />
                                                    <label class="form-check-label" for="metrics_score">2</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="economic_buyer">Economic Buyer <i class="bi bi-info-circle-fill ml-2"></i></label>
                                            <input class="form-control n-b-r"
                                                type="text"
                                                name="economic_buyer"
                                                value="@if (isset($meddpicc)){{ $meddpicc->economic_buyer }}@endif"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group form-row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                            <label for="economic_buyer_score">Economic Buyer Score <i class="bi bi-info-circle-fill ml-2"></i></label>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="economic_buyer_score" value="0" @if (!isset($meddpicc) || isset($meddpicc) && $meddpicc->economic_buyer_score == '0'){{ 'checked' }}@endif />
                                                    <label class="form-check-label" for="economic_buyer_score">0</label>
                                                
                                                    <input class="form-check-input" type="radio" name="economic_buyer_score" value="1" @if (isset($meddpicc) && $meddpicc->economic_buyer_score == '1'){{ 'checked' }}@endif />
                                                    <label class="form-check-label" for="economic_buyer_score">1</label>
                                                
                                                    <input class="form-check-input" type="radio" name="economic_buyer_score" value="2" @if (isset($meddpicc) && $meddpicc->economic_buyer_score == '2'){{ 'checked' }}@endif />
                                                    <label class="form-check-label" for="economic_buyer_score">2</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="decision_criteria">Decision Criteria <i class="bi bi-info-circle-fill ml-2"></i></label>
                                            <textarea class="form-control h-3rem-2px n-b-r" name="decision_criteria">@if (isset($meddpicc)){{ $meddpicc->decision_criteria }}@endif</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group form-row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                            <label for="decision_criteria_score">Decision Criteria Score <i class="bi bi-info-circle-fill ml-2"></i></label>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="decision_criteria_score" value="0" @if (!isset($meddpicc) || isset($meddpicc) && $meddpicc->decision_criteria_score == '0'){{ 'checked' }}@endif />
                                                    <label class="form-check-label" for="decision_criteria_score">0</label>
                                                
                                                    <input class="form-check-input" type="radio" name="decision_criteria_score" value="1" @if (isset($meddpicc) && $meddpicc->decision_criteria_score == '1'){{ 'checked' }}@endif />
                                                    <label class="form-check-label" for="decision_criteria_score">1</label>
                                                
                                                    <input class="form-check-input" type="radio" name="decision_criteria_score" value="2" @if (isset($meddpicc) && $meddpicc->decision_criteria_score == '2'){{ 'checked' }}@endif />
                                                    <label class="form-check-label" for="decision_criteria_score">2</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="decision_process">Decision Process <i class="bi bi-info-circle-fill ml-2"></i></label>
                                            <textarea class="form-control h-3rem-2px n-b-r" name="decision_process">@if (isset($meddpicc)){{ $meddpicc->decision_process }}@endif</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group form-row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                            <label for="decision_process_score">Decision Process Score <i class="bi bi-info-circle-fill ml-2"></i></label>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="decision_process_score" value="0" @if (!isset($meddpicc) || isset($meddpicc) && $meddpicc->decision_process_score == '0'){{ 'checked' }}@endif />
                                                    <label class="form-check-label" for="decision_process_score">0</label>
                                                
                                                    <input class="form-check-input" type="radio" name="decision_process_score" value="1" @if (isset($meddpicc) && $meddpicc->decision_process_score == '1'){{ 'checked' }}@endif />
                                                    <label class="form-check-label" for="decision_process_score">1</label>
                                                
                                                    <input class="form-check-input" type="radio" name="decision_process_score" value="2" @if (isset($meddpicc) && $meddpicc->decision_process_score == '2'){{ 'checked' }}@endif />
                                                    <label class="form-check-label" for="decision_process_score">2</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="paper_process">Paper Process <i class="bi bi-info-circle-fill ml-2"></i></label>
                                            <textarea class="form-control h-3rem-2px n-b-r" name="paper_process">@if (isset($meddpicc)){{ $meddpicc->paper_process }}@endif</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group form-row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                            <label for="paper_process_score">Paper Process Score <i class="bi bi-info-circle-fill ml-2"></i></label>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="paper_process_score" value="0" @if (!isset($meddpicc) || isset($meddpicc) && $meddpicc->paper_process_score == '0'){{ 'checked' }}@endif />
                                                    <label class="form-check-label" for="paper_process_score">0</label>
                                                
                                                    <input class="form-check-input" type="radio" name="paper_process_score" value="1" @if (isset($meddpicc) && $meddpicc->paper_process_score == '1'){{ 'checked' }}@endif />
                                                    <label class="form-check-label" for="paper_process_score">1</label>
                                                
                                                    <input class="form-check-input" type="radio" name="paper_process_score" value="2" @if (isset($meddpicc) && $meddpicc->paper_process_score == '2'){{ 'checked' }}@endif />
                                                    <label class="form-check-label" for="paper_process_score">2</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="identified_pain">Identified Pain <i class="bi bi-info-circle-fill ml-2"></i></label>
                                            <textarea class="form-control h-3rem-2px n-b-r" name="identified_pain">@if (isset($meddpicc)){{ $meddpicc->identified_pain }}@endif</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group form-row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <label for="identified_pain_score">Identified Pain Score <i class="bi bi-info-circle-fill ml-2"></i></label>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="identified_pain_score" value="0" @if (!isset($meddpicc) || isset($meddpicc) && $meddpicc->identified_pain_score == '0'){{ 'checked' }}@endif />
                                                    <label class="form-check-label" for="identified_pain_score">0</label>
                                                
                                                    <input class="form-check-input" type="radio" name="identified_pain_score" value="1" @if (isset($meddpicc) && $meddpicc->identified_pain_score == '1'){{ 'checked' }}@endif />
                                                    <label class="form-check-label" for="identified_pain_score">1</label>
                                                
                                                    <input class="form-check-input" type="radio" name="identified_pain_score" value="2" @if (isset($meddpicc) && $meddpicc->identified_pain_score == '2'){{ 'checked' }}@endif />
                                                    <label class="form-check-label" for="identified_pain_score">2</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="champion_coach">Champion/Coach <i class="bi bi-info-circle-fill ml-2"></i></label>
                                            <input class="form-control n-b-r"
                                                type="text"
                                                name="champion_coach"
                                                value="@if (isset($meddpicc)){{ $meddpicc->champion_coach }}@endif"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group form-row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <label for="champion_coach_score">Champion/Coach Score<i class="bi bi-info-circle-fill ml-2"></i></label>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="champion_coach_score" value="0" @if (!isset($meddpicc) || isset($meddpicc) && $meddpicc->champion_coach_score == '0'){{ 'checked' }}@endif />
                                                    <label class="form-check-label" for="champion_coach_score">0</label>
                                                
                                                    <input class="form-check-input" type="radio" name="champion_coach_score" value="1" @if (isset($meddpicc) && $meddpicc->champion_coach_score == '1'){{ 'checked' }}@endif />
                                                    <label class="form-check-label" for="champion_coach_score">1</label>
                                                
                                                    <input class="form-check-input" type="radio" name="champion_coach_score" value="2" @if (isset($meddpicc) && $meddpicc->champion_coach_score == '2'){{ 'checked' }}@endif />
                                                    <label class="form-check-label" for="champion_coach_score">2</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="competition">Competition <i class="bi bi-info-circle-fill ml-2"></i></label>
                                            <input class="form-control n-b-r"
                                                type="text"
                                                name="competition"
                                                value="@if (isset($meddpicc)){{ $meddpicc->competition }}@endif"
                                            />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group form-row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <label for="competition_score">Competition Score <i class="bi bi-info-circle-fill ml-2"></i></label>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="competition_score" value="0" @if (!isset($meddpicc) || isset($meddpicc) && $meddpicc->competition_score == '0'){{ 'checked' }}@endif />
                                                    <label class="form-check-label" for="competition_score">0</label>
                                                
                                                    <input class="form-check-input" type="radio" name="competition_score" value="1" @if (isset($meddpicc) && $meddpicc->competition_score == '1'){{ 'checked' }}@endif />
                                                    <label class="form-check-label" for="competition_score">1</label>
                                                
                                                    <input class="form-check-input" type="radio" name="competition_score" value="2" @if (isset($meddpicc) && $meddpicc->competition_score == '2'){{ 'checked' }}@endif />
                                                    <label class="form-check-label" for="competition_score">2</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for=""></label>
                                                    <button type="submit" class="btn btn-grad w-100 n-b-r">Save MEDDPICC</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <label for="meddpicc_score">MEDDPICC Score</label>
                                            <input class="form-control n-b-r bg-dark text-white"
                                                type="text"
                                                name="meddpicc_score"
                                                value="@if (isset($meddpicc)){{ $meddpicc->meddpicc_score }}@else{{ 0 }}@endif"
                                                readonly
                                            />
                                            <em>This field is calculated upon save</em>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>