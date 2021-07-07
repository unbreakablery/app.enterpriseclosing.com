<div id="opp-component-empty" hidden>
    <x-opportunity
        :opportunityMain="null"
        :opportunityTasks="null"
        :opportunityMeddpicc="null"
    />
</div>

<div class="opportunities-wrapper mt-4">
    <div class="row task-section col-md-12 col-sm-12 mb-4">
        <h3 class="text-uppercase font-weight-bold mt-2 mr-4">Opportunities</h3>
        <div class="col-lg-3 col-md-4 col-sm-6">
            <div class="row task-section col-md-12 col-sm-12">
                <div class="input-group w-100">
                    <button type="button" class="btn btn-grad n-b-r text-uppercase w-100" id="btn-show-modal">
                        Create Opportunity
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row col-md-12 col-sm-12">
        <ul class="nav nav-tabs" id="oppTabs" role="tablist">
            @foreach ($data as $idx => $opp)
            <li class="nav-item" role="presentation">
                <a class="nav-link @if ($idx == 0){{ 'active' }}@endif"
                    id="tab-{{ $idx }}"
                    data-toggle="tab"
                    href="#opp-tab-{{ $idx }}"
                    role="tab"
                    aria-controls="opp-tab-{{ $idx }}"
                    aria-selected="@if ($idx == 0){{ 'true' }}@else{{ 'false' }}@endif">
                    {{ $opp->main->opportunity }} <strong>@if (count($opp->tasks) > 0){{ '*' }}@endif</strong>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="row col-md-12 col-sm-12 mb-4">
        <div class="tab-content w-100 border" id="oppTabsContent">
            @foreach ($data as $idx => $opp)
            <div class="tab-pane fade @if ($idx == 0){{ 'show active' }}@endif"
                id="opp-tab-{{ $idx }}"
                data-idx="{{ $idx }}"
                role="tabpanel"
                aria-labelledby="tab-{{ $idx }}">
                <x-opportunity
                    :opportunityMain="$opp->main"
                    :opportunityTasks="$opp->tasks"
                    :opportunityMeddpicc="$opp->meddpicc"
                />
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Add Opportunity Modal -->
<div class="modal fade" id="add-opportunity-modal" tabindex="-1" role="dialog" aria-labelledby="add-opportunity-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content n-b-r text-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="add-opportunity-modal-header-title">Question</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3>New Opportunity Name</h3>
                <input type="text" class="form-control n-b-r" name="tab-name" id="tab-name" value="" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-modal-close" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-grad" id="btn-create-new-tab">Create</button>
            </div>
        </div>
    </div>
</div>

<!-- Add Task Modal -->
<div class="modal fade" id="add-task-modal" tabindex="-1" role="dialog" aria-labelledby="add-task-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content n-b-r text-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="add-task-modal-header-title">Question</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3>Do you want to add new task?</h3>
                <form class="form-inline mt-4" autocomplete="off" method="post">
                    <div class="row col-md-12 col-sm-12 mb-2">
                        <label class="col-lg-4 col-md-4 col-sm-6 justify-content-end" for="">
                            Action:
                        </label>
                        <select name="action" class="selectpicker form-control n-b-r col-lg-8 col-md-8 col-sm-6">
                            @foreach ($actions as $action)
                            <option value="{{ $action->id }}">{{ $action->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row col-md-12 col-sm-12 mb-2">
                        <label class="col-lg-4 col-md-4 col-sm-6 justify-content-end" for="">
                            Step:
                        </label>
                        <select name="step" class="selectpicker form-control n-b-r col-lg-8 col-md-8 col-sm-6">
                            @foreach ($steps as $step)
                            <option value="{{ $step->id }}">{{ $step->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row col-md-12 col-sm-12 mb-2">
                        <label class="col-lg-4 col-md-4 col-sm-6 justify-content-end" for="">
                            Person / Account:
                        </label>
                        <input type="text" class="form-control n-b-r col-lg-8 col-md-8 col-sm-6 h-default-input" name="person-account" readonly/>
                    </div>
                    <div class="row col-md-12 col-sm-12 mb-2">
                        <label class="col-lg-4 col-md-4 col-sm-6 justify-content-end" for="">
                            Opportunity:
                        </label>
                        <input type="hidden" name="opportunity-id"/>
                        <input type="text" class="form-control n-b-r col-lg-8 col-md-8 col-sm-6 h-default-input" name="opportunity" readonly/>
                    </div>
                    <div class="row col-md-12 col-sm-12 mb-2">
                        <label class="col-lg-4 col-md-4 col-sm-6 justify-content-end" for="">
                            Note:
                        </label>
                        <input type="text" class="form-control n-b-r col-lg-8 col-md-8 col-sm-6 h-default-input" name="note" placeholder="Note..." />
                    </div>
                    <div class="row col-md-12 col-sm-12 mb-2">
                        <label class="col-lg-4 col-md-4 col-sm-6 justify-content-end" for="">
                            By:
                        </label>
                        <input type="text" class="form-control n-b-r date col-lg-8 col-md-8 col-sm-6 h-default-input" name="by-date" placeholder="dd-mm-yyyy (required)" />
                    </div>
                    <div class="row col-md-12 col-sm-12">
                        <label class="col-lg-4 col-md-4 col-sm-6 justify-content-end" for="">
                            Priority:
                        </label>
                        <select name="priority" class="selectpicker form-control n-b-r col-lg-8 col-md-8 col-sm-6">
                            <option value="3">Normal</option>    
                            <option value="2">Medium</option>
                            <option value="1">High</option>    
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-modal-close" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-grad" id="btn-create-new-task">Create</button>
            </div>
        </div>
    </div>
</div>

<!-- Suggest Task Modal -->
<div class="modal fade" id="suggest-task-modal" tabindex="-1" role="dialog" aria-labelledby="suggest-task-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content n-b-r text-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="suggest-task-modal-header-title">Question</h5>
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
                                <select name="suggest-action-{{ $idx }}" id="suggest-action-{{ $idx }}" class="selectpicker col-12 pl-0 pr-0 n-b-r">
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
                                <select class="selectpicker col-12 pl-0 pr-0 n-b-r" id="suggest-opportunity-{{ $idx }}" name="suggest-opportunity-{{ $idx }}" readonly>
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
                                <select name="suggest-priority-{{ $idx }}" id="suggest-priority-{{ $idx }}" class="selectpicker col-12 pl-0 pr-0 n-b-r">
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
                <button type="button" class="btn btn-grad n-b-r" data-dismiss="modal">That's All For Now</button>
            </div>
        </div>
    </div>
</div>