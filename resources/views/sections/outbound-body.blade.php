<div id="ob-component-empty" hidden>
    <x-outbound-usertable :outbound-main="null" :outbound-persons="null" />
</div>
<table id="tr-component-empty" hidden>
    <tbody><x-outbound-usertable-row :person="null" /></tbody>
</table>

<form class=" mt-4" autocomplete="off">
    <div class="row task-section col-md-12 col-sm-12 mb-4">
        <h3 class="text-uppercase font-weight-normal mt-1 mr-4">Outbound</h3>
        <div class="col-lg-2 col-md-3 col-sm-6">
            <div class="row task-section col-md-12 col-sm-12">
                <div class="w-100">
                    <button type="button" class="btn btn-grad btn-w-normal text-uppercase" id="btn-show-modal">
                        Create Account
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row col-md-12 col-sm-12">
        <ul class="nav nav-tabs" id="outboundTabs" role="tablist">
            @foreach ($data as $idx => $outbound)
            <li class="nav-item" role="presentation">
                <a class="nav-link @if ($idx == 0){{ 'active' }}@endif"
                    id="tab-{{ $idx }}"
                    data-toggle="tab"
                    href="#ob-tab-{{ $idx }}"
                    role="tab"
                    aria-controls="ob-tab-{{ $idx }}"
                    aria-selected="@if ($idx == 0){{ 'true' }}@else{{ 'false' }}@endif">
                    {{ $outbound->main->account_name }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="row col-md-12 col-sm-12 mb-4">
        <div class="tab-content w-100 border" id="outboundTabsContent">
            @foreach ($data as $idx => $outbound)
            <div class="tab-pane fade @if ($idx == 0){{ 'show active' }}@endif"
                id="ob-tab-{{ $idx }}"
                data-idx="{{ $idx }}"
                role="tabpanel"
                aria-labelledby="tab-{{ $idx }}">
                <x-outbound-usertable :outboundMain="$outbound->main" :outboundPersons="$outbound->persons" />
            </div>
            @endforeach
        </div>
    </div>
</form>

<!-- Add Account Modal -->
<div class="modal fade" id="add-account-modal" tabindex="-1" role="dialog" aria-labelledby="add-account-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content n-b-r text-dark">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="add-account-modal-header-title">Question</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3>New Account Name</h3>
                <input type="text" class="form-control n-b-r" name="tab-name" id="tab-name" value="" />
            </div>
            <div class="modal-footer border-top-0">
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
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="add-task-modal-header-title">Question</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3>Do you want to turn this into a task?</h3>
                <form class="form-inline mt-4" autocomplete="off" method="post">
                    <div class="row col-md-12 col-sm-12">
                        <label class="col-lg-4 col-md-4 col-sm-6 justify-content-end" for="">
                            Action:
                        </label>
                        <select name="action" class="form-control n-b-r col-lg-8 col-md-8 col-sm-6">
                            @foreach ($actions as $action)
                            <option value="{{ $action->id }}">{{ $action->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row col-md-12 col-sm-12">
                        <label class="col-lg-4 col-md-4 col-sm-6 justify-content-end" for="">
                            Step:
                        </label>
                        <select name="step" class="form-control n-b-r col-lg-8 col-md-8 col-sm-6">
                            @foreach ($steps as $step)
                            <option value="{{ $step->id }}">{{ $step->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row col-md-12 col-sm-12">
                        <label class="col-lg-4 col-md-4 col-sm-6 justify-content-end" for="">
                            Person / Account:
                        </label>
                        <input type="text" class="form-control n-b-r col-lg-8 col-md-8 col-sm-6" name="person-account" readonly/>
                    </div>
                    <div class="row col-md-12 col-sm-12">
                        <label class="col-lg-4 col-md-4 col-sm-6 justify-content-end" for="">
                            Opportunity:
                        </label>
                        <input type="text" class="form-control n-b-r col-lg-8 col-md-8 col-sm-6" name="opportunity" readonly/>
                    </div>
                    <div class="row col-md-12 col-sm-12">
                        <label class="col-lg-4 col-md-4 col-sm-6 justify-content-end" for="">
                            Note:
                        </label>
                        <input type="text" class="form-control n-b-r col-lg-8 col-md-8 col-sm-6" name="note" />
                    </div>
                    <div class="row col-md-12 col-sm-12">
                        <label class="col-lg-4 col-md-4 col-sm-6 justify-content-end" for="">
                            By:
                        </label>
                        <input type="text" class="form-control n-b-r date col-lg-8 col-md-8 col-sm-6" name="by-date" />
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
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-modal-close" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-grad" id="btn-create-new-task">Create</button>
            </div>
        </div>
    </div>
</div>

<!-- Upload File Modal -->
<div class="modal fade" id="upload-file-modal" tabindex="-1" role="dialog" aria-labelledby="upload-file-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content n-b-r text-dark">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="upload-file-modal-header-title">Question</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3>Upload File:</h3>
                <input type="file" class="form-control" name="upload-file" accept=".csv" />
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-modal-close" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-grad" id="btn-upload-persons">Upload</button>
            </div>
        </div>
    </div>
</div>