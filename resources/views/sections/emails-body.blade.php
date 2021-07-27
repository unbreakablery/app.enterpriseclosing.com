<div class="emails-wrapper mt-4">
    <div class="row task-section col-md-12 col-sm-12 mb-4">
        <h3 class="text-uppercase font-weight-normal mt-2 mr-4">Emails</h3>
    </div>

    <div class="row col-md-12 col-sm-12">
        <ul class="nav nav-tabs" id="emailTabs" role="tablist">
            @foreach ($data as $idx => $email)
            <li class="nav-item" role="presentation">
                <a class="nav-link @if ($idx == 0){{ 'active' }}@endif"
                    id="tab-{{ $idx }}"
                    data-toggle="tab"
                    href="#email-tab-{{ $idx }}"
                    role="tab"
                    aria-controls="email-tab-{{ $idx }}"
                    aria-selected="@if ($idx == 0){{ 'true' }}@else{{ 'false' }}@endif">
                    {{ $email->main->title }}
                </a>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="row col-md-12 col-sm-12 mb-4">
        <div class="tab-content w-100 border" id="emailTabsContent">
            @foreach ($data as $idx => $email)
            <div class="tab-pane fade @if ($idx == 0){{ 'show active' }}@endif"
                id="email-tab-{{ $idx }}"
                data-idx="{{ $idx }}"
                role="tabpanel"
                aria-labelledby="tab-{{ $idx }}">
                <x-email
                    :emailMain="$email->main"
                />
            </div>
            @endforeach
        </div>
    </div>
</div>