<form class="form-inline mt-4" action="{{ route('tasks.add') }}" method="POST" autocomplete="off" id="tasks-form">
    @csrf
    <h3 class="mb-0">Tasks To Complete</h3>
    <div class="row col-lg-12 col-md-12 col-sm-12">
        <div class="table-responsive table-wrapper mt-4 mb-4" id="task-table-wrapper" style="max-height: 184px; overflow-y: auto;">
            <table class="table table-hover datatable w-100 b-s-b-b" id="task-table">
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
                            <button type="button" class="btn btn-sm btn-task-c-s btn-dark btn-skip" data-id="{{ $task['id'] }}">Skip</button>
                            <button type="button" class="btn btn-sm btn-task-c-s btn-success btn-done" data-id="{{ $task['id'] }}">Done</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <h3 id="action-label" data-toggle="tooltip" data-placement="right" title="Required field!">Action</h3>
    <div class="row task-section col-md-12 col-sm-12 mb-4" id="ts-1">
        @foreach ($actions as $action)
            <div class="form-check col-2">
                <input class="form-check-input" type="radio" name="action" 
                    id="action-{{ $action->id }}" 
                    value="{{ $action->id }}" 
                    required />
                <label class="form-check-label" for="action-{{ $action->id }}">
                    {{ $action->name }}
                </label>
            </div>       
        @endforeach
        <div class="form-check col-2">
            <input class="form-check-input" type="radio" name="action" id="action-other" value="0">
            <input type="text" class="form-control mr-20" aria-label="Text input with radio button" placeholder="Other" name="action-other-name" id="action-other-name">
        </div>
    </div>
    
    <h3 id="step-label" data-toggle="tooltip" data-placement="right" title="Required field!">Step</h3>
    <div class="row task-section col-md-12 col-sm-12 mb-4" id="ts-2">
        @foreach ($steps as $step)
            <div class="form-check col-2">
                <input class="form-check-input" type="radio" name="step" 
                    id="step-{{ $step->id }}" 
                    value="{{ $step->id }}" 
                    required />
                <label class="form-check-label" for="step-{{ $step->id }}">
                    {{ $step->name }}
                </label>
            </div>
        @endforeach
        <div class="form-check col-2">
            <input class="form-check-input" type="radio" name="step" id="step-other" value="0">
            <input type="text" class="form-control mr-20" aria-label="Text input with radio button" placeholder="Other" name="step-other-name" id="step-other-name">
        </div>
    </div>

    <div class="row task-section col-md-12 col-sm-12 mb-4">
        <div class="col-2 pl-0" id="ts-3">
            <h3 id="ts-3-person-account-label" data-toggle="tooltip" data-placement="top" title="Required this or opportunity!">Person / Account</h3>
            <div class="row task-section col-md-12 col-sm-12">
                <div class="input-group w-100">
                    <input type="text" class="form-control" aria-label="Person / Account" id="ts-3-person-account" name="person-account" placeholder="Person / Account..." >
                </div>
            </div>
        </div>
        <div class="col-2 pr-0 pl-1" id="ts-6">
            <h3 id="ts-3-person-account-label" data-toggle="tooltip" data-placement="top" title="Required this or person/account!">Opportunity</h3>
            <div class="row task-section col-md-12 col-sm-12">
                <div class="input-group w-100">
                    <select name="opportunity" aria-label="Opportunity" aria-describedby="ts-6-opportunity" id="ts-6-opportunity" class="col-12 pl-0 pr-0 n-b-r">
                        <option value="0"></option>
                        @foreach ($opportunities as $opp)
                            <option value="{{ $opp->id }}">{{ $opp->opportunity }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-2 pr-0 pl-1" id="ts-6">
            <h3 id="ts-11-not-label" data-toggle="tooltip" data-placement="top" title="Required field!">Note</h3>
            <div class="row task-section col-md-12 col-sm-12">
                <div class="input-group w-100">
                    <input type="text" class="form-control" placeholder="Note..." aria-label="Note" aria-describedby="ts-11-note" id="ts-11-note" name="note" >
                </div>
            </div>
        </div>
        <div class="col-2 pr-0 pl-1" id="ts-4">
            <h3 id="ts-4-by-date-label" data-toggle="tooltip" data-placement="left" title="Required field!">By</h3>
            <div class="row task-section col-md-12 col-sm-12">
                <div class="input-group w-100">
                    <input type="text" class="form-control date" aria-label="By Date" id="ts-4-by-date" name="by-date" placeholder="dd-mm-yyyy" required>
                </div>
            </div>
        </div>
        <div class="col-2 pr-0 pl-1" id="ts-7">
            <h3 id="priority-label" data-toggle="tooltip" data-placement="left" title="Required field!">Priority</h3>
            <div class="row task-section col-md-12 col-sm-12">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="priority" id="ts-7-rg-normal" value="3">
                    <label class="form-check-label mr-4" for="ts-7-rg-normal">
                        Normal
                    </label>
                    <input class="form-check-input" type="radio" name="priority" id="ts-7-rg-medium" value="2">
                    <label class="form-check-label mr-4" for="ts-7-rg-medium">
                        Medium
                    </label>
                    <input class="form-check-input" type="radio" name="priority" id="ts-7-rg-high" value="1" required>
                    <label class="form-check-label" for="ts-7-rg-high">
                        High
                    </label>
                </div>
            </div>
        </div>
    </div>

    <div class="row task-section col-md-12 col-sm-12 mb-4" id="ts-9">
        <div class="col-2 pl-0 pr-3" id="ts-3">
            <div class="row task-section col-md-12 col-sm-12">
                <div class="input-group w-100">
                <button type="button" class="btn btn-grad text-uppercase w-100" id="btn-create-task">
                    Create Task
                </button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal -->
<div class="modal fade" id="task-add-modal" tabindex="-1" role="dialog" aria-labelledby="task-add-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content n-b-r text-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="task-add-modal-header-title">Question</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3>Would you like to add these tasks too?</h3>
                <div class="row additional-tasks">
                    @if (count($suggest_steps) > 0)
                        @foreach ($suggest_steps as $idx => $suggest_step)
                        <div class="form-row pt-1 pb-1 additional-task-item-{{ $idx }} col-12">
                            <div class="col-2">
                                <select name="suggest-action-{{ $idx }}" id="suggest-action-{{ $idx }}" class="col-12 pl-0 pr-0 n-b-r">
                                    @foreach ($suggest_actions as $suggest_action)
                                        <option value="{{ $suggest_action->id }}" @if(old('saved_action') == $suggest_action->id) selected @endif>{{ $suggest_action->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <input type="hidden" value="{{ $suggest_step->id }}" id="suggest-step-{{ $idx }}" name="suggest-step-{{ $idx }}"/>
                                <input type="text" class="form-control n-b-r" value="{{ $suggest_step->name }}" id="suggest-step-name-{{ $idx }}" name="suggest-step-name-{{ $idx }}" readonly />
                            </div>
                            <div class="col-1">
                                <input type="text" class="form-control n-b-r" value="{{ old('saved_person_account') }}" id="suggest-person-account-{{ $idx }}" name="suggest-person-account-{{ $idx }}" readonly placeholder="Person/Account..."/>
                            </div>
                            <div class="col-2">
                                <select class="col-12 pl-0 pr-0 n-b-r" id="suggest-opportunity-{{ $idx }}" name="suggest-opportunity-{{ $idx }}" readonly>
                                    @foreach ($opportunities as $opp)
                                        <option value="{{ $opp->id }}" @if (old('saved_opportunity') == $opp->id){{ 'selected' }}@else{{ 'disabled' }}@endif>{{ $opp->opportunity }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-1">
                                <input type="text" class="form-control n-b-r" id="suggest-note-{{ $idx }}" name="suggest-note-{{ $idx }}" placeholder="Note..." />
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control date n-b-r" value="{{ old('saved_by_date') }}" id="suggest-by-{{ $idx }}" name="suggest-by-{{ $idx }}" placeholder="dd-mm-yyyy" />
                            </div>
                            <div class="col-1">
                                <select name="suggest-priority-{{ $idx }}" id="suggest-priority-{{ $idx }}" class="col-12 pl-0 pr-0 n-b-r">
                                    <option value="3">Normal</option>
                                    <option value="2">Medium</option>
                                    <option value="1">High</option>
                                </select>
                            </div>
                            <div class="col-1 btn-suggest-save-wrapper">
                                <button type="button" class="btn btn-success btn-suggest-save n-b-r" data-id="{{ $idx }}">Save</button>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p class="text-center w-100">
                            No suggested additional tasks!
                        </p>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grad" data-dismiss="modal">That's All For Now</button>
            </div>
        </div>
    </div>
</div>
