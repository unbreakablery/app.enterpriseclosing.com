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
                    <button type="button" class="btn btn-app-default n-b-r text-uppercase w-100" id="btn-show-modal">
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
                    {{ $opp->main->opportunity }}
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
                <input type="text" class="form-control" name="tab-name" id="tab-name" value="" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="btn-create-new-tab">Create</button>
            </div>
        </div>
    </div>
</div>