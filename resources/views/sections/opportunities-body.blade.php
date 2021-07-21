<div id="opp-component-empty" hidden>
    <x-opportunity
        :opportunityMain="null"
        :opportunityIfs="$opportunityIfs"
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
                    :opportunityIfs="$opportunityIfs"
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
                        <select name="action" class="form-control n-b-r col-lg-8 col-md-8 col-sm-6">
                            @foreach ($actions as $action)
                            <option value="{{ $action->id }}">{{ $action->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row col-md-12 col-sm-12 mb-2">
                        <label class="col-lg-4 col-md-4 col-sm-6 justify-content-end" for="">
                            Step:
                        </label>
                        <select name="step" class="form-control n-b-r col-lg-8 col-md-8 col-sm-6">
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
                        <select name="priority" class="form-control n-b-r col-lg-8 col-md-8 col-sm-6">
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
                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grad n-b-r" data-dismiss="modal">That's All For Now</button>
            </div>
        </div>
    </div>
</div>