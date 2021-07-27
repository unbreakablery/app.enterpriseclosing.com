<div class="scripts-wrapper mt-4">
    <div class="row task-section col-md-12 col-sm-12 mb-4">
        <h3 class="text-uppercase font-weight-normal mt-2 mr-4">Scripts</h3>
    </div>

    <div class="row col-md-12 col-sm-12">
        <ul class="nav nav-tabs" id="scriptTabs" role="tablist">
            @foreach ($data as $idx => $script)
            <li class="nav-item" role="presentation">
                <a class="nav-link @if ($idx == 0){{ 'active' }}@endif"
                    id="tab-{{ $idx }}"
                    data-toggle="tab"
                    href="#script-tab-{{ $idx }}"
                    role="tab"
                    aria-controls="script-tab-{{ $idx }}"
                    aria-selected="@if ($idx == 0){{ 'true' }}@else{{ 'false' }}@endif">
                    {{ $script->main->name }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="row col-md-12 col-sm-12 mb-4">
        <div class="tab-content w-100 border" id="scriptTabsContent">
            @foreach ($data as $idx => $script)
            <div class="tab-pane fade @if ($idx == 0){{ 'show active' }}@endif"
                id="script-tab-{{ $idx }}"
                data-idx="{{ $idx }}"
                role="tabpanel"
                aria-labelledby="tab-{{ $idx }}">
                <x-script
                    :scriptMain="$script->main"
                />
            </div>
            @endforeach
        </div>
    </div>
</div>