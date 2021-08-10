<div class="tab-component">
    <div class="row task-section col-md-12 col-sm-12 mb-4">
        <h4 class="mt-4 p-special-1 opportunity-tasks-title font-weight-normal">Tasks To Complete</h4>
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="row task-section col-md-12 col-sm-12 mt-3">
                <div class="input-group w-100">
                    <button type="button" class="btn btn-grad btn-w-normal text-uppercase btn-show-task-modal">
                        Create Task
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="table-responsive table-wrapper task-table-wrapper mt-4 mb-4 p-special-1" style="max-height: 156px; overflow-y: auto;">
        <table class="table table-hover datatable task-table w-100 b-s-b-b" 
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

    <form action="{{ route('opportunity.save') }}" method="post" autocomplete="off" class="opp-main-info-form">
        @csrf
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="main-info">
                    <input type="hidden" name="opp-id" value="@if (isset($main)){{ $main->id }}@else{{ 0 }}@endif">
                    <input type="hidden" name="opportunity-name" value="@if (isset($main)){{ $main->opportunity }}@endif">
                    <div class="row mt-4 ml-0 mr-0 pl-1 pr-1">
                        @foreach ($ifs as $input)
                            @if ($input->checked)
                                @if ($input->type == 'textarea')
                                    <div class="{{ $input->cols }}">
                                        <div class="form-group">
                                            <label for="{{ $input->key}}">{{ $input->value}}</label>
                                            <textarea class="form-control n-b-r" name="{{ $input->key}}" rows="3" placeholder="{{ $input->placeholder }}">@if(isset($main)){{ $main->{$input->key} }}@endif</textarea>
                                        </div>
                                    </div>
                                @elseif ($input->type == 'radio_group')
                                    @php
                                        $radios = config('app_setting.opportunities.radio_groups.' . $input->key);
                                    @endphp
                                    <div class="{{ $input->cols }}">
                                        <label>{{ $input->value }}</label>
                                        <div class="row radio-group ml-1 mr-0 mb-3">
                                        @foreach ($radios as $key => $radio)
                                            <div class="form-check {{ $radio['cols'] }}">
                                                <input class="form-check-input"
                                                    type="{{ $radio['type'] }}"
                                                    name="{{ $input->key }}"
                                                    id="{{ $key }}"
                                                    value="{{ $radio['value'] }}"
                                                    @if(isset($main) && $radio['value'] == $main->{$input->key}){{ 'checked' }}@endif
                                                />
                                                <label class="form-check-label pl-2" for="{{ $key }}">{{ $radio['name'] }}</label>
                                            </div>
                                        @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div class="{{ $input->cols }}">
                                        <div class="form-group">
                                            <label for="{{ $input->key}}">{{ $input->value}}</label>
                                            <input class="form-control n-b-r {{ $input->type }}"
                                                type="text"
                                                name="{{ $input->key}}"
                                                value="@if (isset($main) && !empty($main->{$input->key}) && $input->type == 'date'){{ date('d-m-Y', strtotime($main->{$input->key})) }}@elseif(isset($main)){{ $main->{$input->key} }}@endif"
                                                placeholder="{{ $input->placeholder }}"
                                            />
                                        </div>
                                    </div>
                                @endif
                            @endif
                        @endforeach
                        <!-- Sales Stages -->
                        @if (isset($salesStages) && count($salesStages) > 0)
                            <div class="col-lg-12 col-md-12 col-sm-12 sales-stage-section">
                                <label>Sales Stages</label>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    @php
                                        $checkboxes = config('app_setting.opportunities.radio_groups.sales_stage.strength');
                                        $radios = config('app_setting.opportunities.radio_groups.sales_stage.stage_progress');
                                    @endphp
                                    @foreach ($salesStages as $s)
                                        <div class="col-lg-12 col-md-12 col-sm-12 mr-0">
                                            @if ($s->ssp == 1 || $s->ssi == 1)
                                                <label>{{ $s->ssn }}</label>
                                            @endif
                                            <div class="row col-lg-12 col-md-12 col-sm-12 ml-2 mr-0 d-flex">
                                                @if ($s->ssp == 1)
                                                <div class="stage-progress-section mr-4">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <label>Stage Progress</label>
                                                        </div>
                                                    </div>
                                                    <div class="row radio-group ml-0 mr-0 mb-3">
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            @foreach ($radios as $key => $radio)
                                                                <div class="form-check {{ $radio['cols'] }}">
                                                                    <input class="form-check-input"
                                                                        type="{{ $radio['type'] }}"
                                                                        name="{{ 'ss-sp-' . $s->id }}"
                                                                        id="{{ $key . '-' . $s->id }}"
                                                                        value="{{ $radio['value'] }}"
                                                                        @if((isset($s) && $radio['value'] == $s->progress) || $radio['default']){{ 'checked' }}@endif
                                                                    />
                                                                    <label class="form-check-label pl-1" for="{{ $key . '-' . $s->id }}">{{ $radio['name'] }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                @if ($s->ssi == 1)
                                                <div class="strength-indicator-section">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <label>Strength Indicator</label>
                                                        </div>
                                                    </div>
                                                    <div class="row radio-group mr-0 mb-3">
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            @foreach ($checkboxes as $key => $checkbox)
                                                                <div class="form-check {{ $checkbox['cols'] }}">
                                                                    <input class="form-check-input"
                                                                        type="{{ $checkbox['type'] }}"
                                                                        name="{{ 'ss-si-' . $key . '-' . $s->id }}"
                                                                        id="{{ $key . '-' . $s->id }}"
                                                                        value="{{ $checkbox['value'] }}"
                                                                        @if(isset($s) && $s->{$key} == 1){{ 'checked' }}@endif
                                                                    />
                                                                    <label class="form-check-label" for="{{ $key . '-' . $s->id }}">{{ $checkbox['name'] }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            @php
                                $checkboxes = config('app_setting.opportunities.radio_groups.sales_stage.strength');
                                $radios = config('app_setting.opportunities.radio_groups.sales_stage.stage_progress');
                                $salesStages = getOppSalesStagesSettings(1);
                            @endphp
                            @if (count($salesStages) > 0)
                            <div class="col-lg-12 col-md-12 col-sm-12 sales-stage-section">
                                <label>Sales Stages</label>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    @foreach ($salesStages as $s)
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            @if ($s->ssp == 1 || $s->ssi == 1)
                                                <label>{{ $s->ssn }}</label>
                                            @endif
                                            <div class="row col-lg-12 col-md-12 col-sm-12 ml-2 mr-0 d-flex">
                                                @if ($s->ssp == 1)
                                                <div class="stage-progress-section mr-4">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <label>Stage Progress</label>
                                                        </div>
                                                    </div>
                                                    <div class="row radio-group ml-0 mr-0 mb-3">
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            @foreach ($radios as $key => $radio)
                                                                <div class="form-check {{ $radio['cols'] }}">
                                                                    <input class="form-check-input"
                                                                        type="{{ $radio['type'] }}"
                                                                        name="{{ 'ss-sp-' . $s->id }}"
                                                                        id="{{ $key . '-' . $s->id }}"
                                                                        value="{{ $radio['value'] }}"
                                                                        @if ($radio['default'] == 1){{ 'checked' }}@endif
                                                                    />
                                                                    <label class="form-check-label pl-1" for="{{ $key . '-' . $s->id }}">{{ $radio['name'] }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                @if ($s->ssi == 1)
                                                <div class="strength-indicator-section">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <label>Strength Indicator</label>
                                                        </div>
                                                    </div>
                                                    <div class="row radio-group mr-0 mb-3">
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            @foreach ($checkboxes as $key => $checkbox)
                                                                <div class="form-check {{ $checkbox['cols'] }}">
                                                                    <input class="form-check-input ml-0"
                                                                        type="{{ $checkbox['type'] }}"
                                                                        name="{{ 'ss-si-' . $key . '-' . $s->id }}"
                                                                        id="{{ $key . '-' . $s->id }}"
                                                                        value="{{ $checkbox['value'] }}"
                                                                    />
                                                                    <label class="form-check-label" for="{{ $key . '-' . $s->id }}">{{ $checkbox['name'] }}</label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        @endif
                    </div>
                    <div class="row mt-4 ml-0 mr-0 pl-1 pr-1">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-grad btn-w-normal btn-save-opp">Save Info</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div id="accordion-@if (isset($main)){{ $main->id }}@else{{ 0 }}@endif" class="accordion-section mt-4 mb-4 p-special-1">
                    <div class="card n-b-r bg-transparent border border-white">
                        <div class="card-header bg-dark n-b-r pt-0 pb-0 pl-1"
                                id="headingMeddpicc-@if (isset($main)){{ $main->id }}@else{{ 0 }}@endif">
                            <h3 class="mb-0">
                                <a class="btn btn-link text-white pt-0 pb-0 text-decoration-none font-weight-bolder"
                                    data-toggle=""
                                    data-target="#collapseMeddpicc-@if (isset($main)){{ $main->id }}@else{{ 0 }}@endif"
                                    aria-expanded="true"
                                    aria-controls="collapseMeddpicc-@if (isset($main)){{ $main->id }}@else{{ 0 }}@endif"
                                    href="javascript:void(0)">
                                    MEDDPICC Score = <span id="meddpicc-score">@if (isset($meddpicc)){{ $meddpicc->meddpicc_score }}@else{{ 0 }}@endif</span>
                                    <input class="form-control n-b-r bg-dark text-white"
                                        type="hidden"
                                        name="m_meddpicc_score"
                                        value="@if (isset($meddpicc)){{ $meddpicc->meddpicc_score }}@else{{ 0 }}@endif"
                                        readonly
                                    />
                                </a>
                            </h3>
                        </div>

                        <div id="collapseMeddpicc-@if (isset($main)){{ $main->id }}@else{{ 0 }}@endif"
                            class="collapse-section collapse show"
                            aria-labelledby="headingMeddpicc-@if (isset($main)){{ $main->id }}@else{{ 0 }}@endif"
                            data-parent="#accordion-@if (isset($main)){{ $main->id }}@else{{ 0 }}@endif">
                            <div class="card-body meddpicc-section">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="row">
                                            <div class="col-lg-8 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for="m_metrics">Metrics <i class="bi bi-info-circle-fill ml-2"></i></label>
                                                    <textarea class="form-control h-3rem-2px n-b-r" name="m_metrics">@if (isset($meddpicc)){{ $meddpicc->metrics }}@endif</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-6">
                                                <div class="form-group form-row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <label for="m_metrics_score">Metrics Score <i class="bi bi-info-circle-fill ml-2"></i></label>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 d-flex">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 n-p-lr">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="m_metrics_score" value="0" @if (!isset($meddpicc) || isset($meddpicc) && $meddpicc->metrics_score == '0'){{ 'checked' }}@endif />
                                                                <label class="form-check-label" for="m_metrics_score">0</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-4 n-p-lr">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="m_metrics_score" value="1" @if (isset($meddpicc) && $meddpicc->metrics_score == '1'){{ 'checked' }}@endif />
                                                                <label class="form-check-label" for="m_metrics_score">1</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-4 n-p-lr">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="m_metrics_score" value="2" @if (isset($meddpicc) && $meddpicc->metrics_score == '2'){{ 'checked' }}@endif />
                                                                <label class="form-check-label" for="m_metrics_score">2</label>
                                                            </div>
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
                                            <div class="col-lg-8 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for="m_economic_buyer">Economic Buyer / Sponsor <i class="bi bi-info-circle-fill ml-2"></i></label>
                                                    <input class="form-control n-b-r"
                                                        type="text"
                                                        name="m_economic_buyer"
                                                        value="@if (isset($meddpicc)){{ $meddpicc->economic_buyer }}@endif"
                                                    />
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-6">
                                                <div class="form-group form-row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <label for="m_economic_buyer_score">Economic Buyer / Sponsor Score <i class="bi bi-info-circle-fill ml-2"></i></label>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 d-flex">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 n-p-lr">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="m_economic_buyer_score" value="0" @if (!isset($meddpicc) || isset($meddpicc) && $meddpicc->economic_buyer_score == '0'){{ 'checked' }}@endif />
                                                                <label class="form-check-label" for="m_economic_buyer_score">0</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-4 n-p-lr">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="m_economic_buyer_score" value="1" @if (isset($meddpicc) && $meddpicc->economic_buyer_score == '1'){{ 'checked' }}@endif />
                                                                <label class="form-check-label" for="m_economic_buyer_score">1</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-4 n-p-lr">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="m_economic_buyer_score" value="2" @if (isset($meddpicc) && $meddpicc->economic_buyer_score == '2'){{ 'checked' }}@endif />
                                                                <label class="form-check-label" for="m_economic_buyer_score">2</label>
                                                            </div>
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
                                            <div class="col-lg-8 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for="m_decision_criteria">Decision Criteria <i class="bi bi-info-circle-fill ml-2"></i></label>
                                                    <textarea class="form-control h-3rem-2px n-b-r" name="m_decision_criteria">@if (isset($meddpicc)){{ $meddpicc->decision_criteria }}@endif</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-6">
                                                <div class="form-group form-row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <label for="m_decision_criteria_score">Decision Criteria Score <i class="bi bi-info-circle-fill ml-2"></i></label>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 d-flex">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 n-p-lr">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="m_decision_criteria_score" value="0" @if (!isset($meddpicc) || isset($meddpicc) && $meddpicc->decision_criteria_score == '0'){{ 'checked' }}@endif />
                                                                <label class="form-check-label" for="m_decision_criteria_score">0</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-4 n-p-lr">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="m_decision_criteria_score" value="1" @if (isset($meddpicc) && $meddpicc->decision_criteria_score == '1'){{ 'checked' }}@endif />
                                                                <label class="form-check-label" for="m_decision_criteria_score">1</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-4 n-p-lr">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="m_decision_criteria_score" value="2" @if (isset($meddpicc) && $meddpicc->decision_criteria_score == '2'){{ 'checked' }}@endif />
                                                                <label class="form-check-label" for="m_decision_criteria_score">2</label>
                                                            </div>
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
                                            <div class="col-lg-8 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for="m_decision_process">Decision Process <i class="bi bi-info-circle-fill ml-2"></i></label>
                                                    <textarea class="form-control h-3rem-2px n-b-r" name="m_decision_process">@if (isset($meddpicc)){{ $meddpicc->decision_process }}@endif</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-6">
                                                <div class="form-group form-row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <label for="m_decision_process_score">Decision Process Score <i class="bi bi-info-circle-fill ml-2"></i></label>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 d-flex">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 n-p-lr">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="m_decision_process_score" value="0" @if (!isset($meddpicc) || isset($meddpicc) && $meddpicc->decision_process_score == '0'){{ 'checked' }}@endif />
                                                                <label class="form-check-label" for="m_decision_process_score">0</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-4 n-p-lr">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="m_decision_process_score" value="1" @if (isset($meddpicc) && $meddpicc->decision_process_score == '1'){{ 'checked' }}@endif />
                                                                <label class="form-check-label" for="m_decision_process_score">1</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-4 n-p-lr">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="m_decision_process_score" value="2" @if (isset($meddpicc) && $meddpicc->decision_process_score == '2'){{ 'checked' }}@endif />
                                                                <label class="form-check-label" for="m_decision_process_score">2</label>
                                                            </div>
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
                                            <div class="col-lg-8 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for="m_paper_process">Paper Process <i class="bi bi-info-circle-fill ml-2"></i></label>
                                                    <textarea class="form-control h-3rem-2px n-b-r" name="m_paper_process">@if (isset($meddpicc)){{ $meddpicc->paper_process }}@endif</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-6">
                                                <div class="form-group form-row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <label for="m_paper_process_score">Paper Process Score <i class="bi bi-info-circle-fill ml-2"></i></label>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 d-flex">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 n-p-lr">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="m_paper_process_score" value="0" @if (!isset($meddpicc) || isset($meddpicc) && $meddpicc->paper_process_score == '0'){{ 'checked' }}@endif />
                                                                <label class="form-check-label" for="m_paper_process_score">0</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-4 n-p-lr">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="m_paper_process_score" value="1" @if (isset($meddpicc) && $meddpicc->paper_process_score == '1'){{ 'checked' }}@endif />
                                                                <label class="form-check-label" for="m_paper_process_score">1</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-4 n-p-lr">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="m_paper_process_score" value="2" @if (isset($meddpicc) && $meddpicc->paper_process_score == '2'){{ 'checked' }}@endif />
                                                                <label class="form-check-label" for="m_paper_process_score">2</label>
                                                            </div>
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
                                            <div class="col-lg-8 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for="m_identified_pain">Identified Pain <i class="bi bi-info-circle-fill ml-2"></i></label>
                                                    <textarea class="form-control h-3rem-2px n-b-r" name="m_identified_pain">@if (isset($meddpicc)){{ $meddpicc->identified_pain }}@endif</textarea>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-6">
                                                <div class="form-group form-row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <label for="m_identified_pain_score">Identified Pain Score <i class="bi bi-info-circle-fill ml-2"></i></label>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 d-flex">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 n-p-lr">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="m_identified_pain_score" value="0" @if (!isset($meddpicc) || isset($meddpicc) && $meddpicc->identified_pain_score == '0'){{ 'checked' }}@endif />
                                                                <label class="form-check-label" for="m_identified_pain_score">0</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-4 n-p-lr">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="m_identified_pain_score" value="1" @if (isset($meddpicc) && $meddpicc->identified_pain_score == '1'){{ 'checked' }}@endif />
                                                                <label class="form-check-label" for="m_identified_pain_score">1</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-4 n-p-lr">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="m_identified_pain_score" value="2" @if (isset($meddpicc) && $meddpicc->identified_pain_score == '2'){{ 'checked' }}@endif />
                                                                <label class="form-check-label" for="m_identified_pain_score">2</label>
                                                            </div>
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
                                            <div class="col-lg-8 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for="m_champion_coach">Champion / Coach <i class="bi bi-info-circle-fill ml-2"></i></label>
                                                    <input class="form-control n-b-r"
                                                        type="text"
                                                        name="m_champion_coach"
                                                        value="@if (isset($meddpicc)){{ $meddpicc->champion_coach }}@endif"
                                                    />
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-6">
                                                <div class="form-group form-row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <label for="m_champion_coach_score">Champion / Coach Score<i class="bi bi-info-circle-fill ml-2"></i></label>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 d-flex">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 n-p-lr">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="m_champion_coach_score" value="0" @if (!isset($meddpicc) || isset($meddpicc) && $meddpicc->champion_coach_score == '0'){{ 'checked' }}@endif />
                                                                <label class="form-check-label" for="m_champion_coach_score">0</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-4 n-p-lr">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="m_champion_coach_score" value="1" @if (isset($meddpicc) && $meddpicc->champion_coach_score == '1'){{ 'checked' }}@endif />
                                                                <label class="form-check-label" for="m_champion_coach_score">1</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-4 n-p-lr">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="m_champion_coach_score" value="2" @if (isset($meddpicc) && $meddpicc->champion_coach_score == '2'){{ 'checked' }}@endif />
                                                                <label class="form-check-label" for="m_champion_coach_score">2</label>
                                                            </div>
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
                                            <div class="col-lg-8 col-md-6 col-sm-6">
                                                <div class="form-group">
                                                    <label for="m_competition">Competition <i class="bi bi-info-circle-fill ml-2"></i></label>
                                                    <input class="form-control n-b-r"
                                                        type="text"
                                                        name="m_competition"
                                                        value="@if (isset($meddpicc)){{ $meddpicc->competition }}@endif"
                                                    />
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-6">
                                                <div class="form-group form-row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <label for="m_competition_score">Competition Score <i class="bi bi-info-circle-fill ml-2"></i></label>
                                                    </div>
                                                    <div class="col-lg-12 col-md-12 col-sm-12 d-flex">
                                                        <div class="col-lg-4 col-md-4 col-sm-4 n-p-lr">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="m_competition_score" value="0" @if (!isset($meddpicc) || isset($meddpicc) && $meddpicc->competition_score == '0'){{ 'checked' }}@endif />
                                                                <label class="form-check-label" for="m_competition_score">0</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-4 n-p-lr">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="m_competition_score" value="1" @if (isset($meddpicc) && $meddpicc->competition_score == '1'){{ 'checked' }}@endif />
                                                                <label class="form-check-label" for="m_competition_score">1</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 col-sm-4 n-p-lr">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="m_competition_score" value="2" @if (isset($meddpicc) && $meddpicc->competition_score == '2'){{ 'checked' }}@endif />
                                                                <label class="form-check-label" for="m_competition_score">2</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="row col-lg-12 col-md-12 col-sm-12 mt-4 pr-0">
        <div class="col-lg-6 col-md-6 col-sm-12 pl-0">
            <h4 class="p-special-1">Org Chart</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 pr-1 mb-1">
            <div class="row ml-0 mr-0 pl-1 task-section action-group justify-content-end">
                <button type="button" class="btn btn-grad text-uppercase btn-upload-orgcharts-modal mr-1" title="Upload From CSV">
                    <i class="bi bi-upload"></i>
                </button>
                <button type="button" class="btn btn-grad text-uppercase btn-download-orgcharts mr-1" title="Download To CSV">
                    <i class="bi bi-download"></i>
                </button>
                <button type="button" class="btn btn-grad text-uppercase btn-add-orgchart-row">
                    Add Row
                </button>
            </div>
        </div>
    </div>
    <div class="table-responsive table-wrapper mb-4 p-special-1">
        <div class="orgchart-table-wrapper border-bottom border-white">
            <table class="table table-hover w-100 mb-0" id="orgchart-table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-left no-sort" width="46">Order</th>
                        <th scope="col" class="text-left no-sort" width="100">First Name</th>
                        <th scope="col" class="text-left no-sort" width="100">Last Name</th>
                        <th scope="col" class="text-left no-sort" width="">Title</th>
                        <th scope="col" class="text-left no-sort" width="">Email</th>
                        <th scope="col" class="text-left no-sort" width="100">Landline</th>
                        <th scope="col" class="text-left no-sort" width="100">Mobile</th>
                        <th scope="col" class="text-left no-sort" width="110">Role</th>
                        <th scope="col" class="text-left no-sort" width="90">Engagement</th>
                        <th scope="col" class="text-left no-sort" width="">Notes</th>
                        <th scope="col" class="text-left no-sort" width="35"></th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($orgCharts) && count($orgCharts) > 0)
                        @foreach ($orgCharts as $chart)
                            <x-opp-org-chart-row :row="$chart" />
                        @endforeach
                    @else
                        <tr id="no-data-row">
                            <td class="text-center text-danger" colspan="11">No Data</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <div class="row col-lg-12 col-md-12 col-sm-12 mt-4 pr-0">
        <div class="col-lg-6 col-md-6 col-sm-12 pl-0">
            <h4 class="p-special-1">Joint Project Plan / SoE</h4>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 pr-1 mb-1">
            <div class="row ml-0 mr-0 pl-1 task-section action-group justify-content-end">
                <!-- <button type="button" class="btn btn-grad text-uppercase btn-upload-jppsoe-modal mr-1" title="Upload From CSV">
                    <i class="bi bi-upload"></i>
                </button> -->
                <button type="button" class="btn btn-grad text-uppercase btn-download-jppsoe mr-1" title="Download To CSV">
                    <i class="bi bi-download"></i>
                </button>
                <button type="button" class="btn btn-grad text-uppercase btn-add-jppsoe-row">
                    Add Row
                </button>
            </div>
        </div>
    </div>
    <div class="table-responsive table-wrapper mb-4 p-special-1">
        <div class="jppsoe-table-wrapper border-bottom border-white">
            <table class="table table-hover w-100 mb-0" id="jppsoe-table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-left no-sort" width="46">No.</th>
                        <th scope="col" class="text-left no-sort" width="">Task / Event</th>
                        <th scope="col" class="text-left no-sort" width="">Ownership</th>
                        <th scope="col" class="text-left no-sort" width="">Target Date</th>
                        <th scope="col" class="text-left no-sort" width="">Completed</th>
                        <th scope="col" class="text-left no-sort" width="">Coments</th>
                        <th scope="col" class="text-left no-sort" width="35"></th>
                    </tr>
                </thead>
                <tbody>
                    @if (isset($jppSoes) && count($jppSoes) > 0)
                        @foreach ($jppSoes as $js)
                            <x-opp-jpp-soe-row :row="$js" />
                        @endforeach
                    @else
                        <tr id="no-data-row">
                            <td class="text-center text-danger" colspan="7">No Data</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div> 
</div>