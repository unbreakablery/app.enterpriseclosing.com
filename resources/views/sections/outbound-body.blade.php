<div id="ob-component-empty" hidden><x-outbound-usertable :outbound-main="null" :outbound-persons="null" /></div>
<table id="tr-component-empty" hidden>
    <tbody><x-outbound-usertable-row :person="null" /></tbody>
</table>

<h3 class="mt-4 text-uppercase font-weight-bold">Outbound</h3>
<form class="form-inline mt-4" autocomplete="off">
    <div class="row task-section col-md-12 col-sm-12 mb-4">
        <div class="col-20">
            <div class="row task-section col-md-12 col-sm-12">
                <div class="input-group w-100">
                    <button type="button" class="btn btn-app-default n-b-r text-uppercase w-100" id="btn-show-modal">
                        Create New Account
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

<!-- Modal -->
<div class="modal fade" id="add-account-modal" tabindex="-1" role="dialog" aria-labelledby="add-account-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content n-b-r text-dark">
            <div class="modal-header">
                <h5 class="modal-title" id="add-account-modal-header-title">Question</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3>New Account Name</h3>
                <input type="text" class="form-control" name="tab-name" id="tab-name" value="" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="btn-create-new-tab">Creat</button>
            </div>
        </div>
    </div>
</div>