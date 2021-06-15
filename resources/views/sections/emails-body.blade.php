<div class="emails-wrapper mt-4">
    <div class="row task-section col-md-12 col-sm-12 mb-4">
        <h3 class="text-uppercase font-weight-bold mt-2 mr-4">Emails</h3>
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

<!-- Message box -->
<div class="position-fixed bottom-0 right-0 p-3" style="z-index: 99999; left: 50%; top: 0; transform: translateX(-50%);">
    <div id="liveToast" class="toast hide" role="alert" aria-live="assertive" aria-atomic="true" data-delay="5000">
        <div class="toast-header bg-success text-white">
            <strong class="mr-auto">Message</strong>
            <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body bg-white text-secondary">
            Hello, world! This is a toast message.
        </div>
    </div>
</div>