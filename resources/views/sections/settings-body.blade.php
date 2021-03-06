@if(count($errors) > 0 )
<div class="alert alert-danger alert-dismissible fade show mt-4 mr-4" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <ul class="p-0 m-0" style="list-style: none;">
        @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<h3 class="text-uppercase font-weight-normal mt-4 mb-4">Settings</h3>
<form class="main-info" action="{{ route('settings.store.general') }}" method='post' autocomplete="off">
    @csrf
    <input type="hidden" name="user_id" value="{{ $user->id }}" />
    <h3 class="setting-sub-title">General Settings</h3>
    <div class="row col-lg-12 col-md-12 col-sm-12 mt-2 n-p-lr">
        <div class="col-lg-3 col-md-3 col-sm-6">
            <div class="form-group">
                <label for="first_name">First Name</label>
                <input class="form-control n-b-r @error('first_name') is-invalid @enderror"
                        type="text"
                        id="first_name"
                        name="first_name"
                        value="{{ old('first_name', $user->first_name) }}"
                        placeholder="At least 3 characters..."
                        required
                />
                @error('first_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6">
            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input class="form-control n-b-r @error('last_name') is-invalid @enderror"
                        type="text"
                        id="last_name"
                        name="last_name"
                        value="{{ old('last_name', $user->last_name) }}"
                        placeholder="At least 3 characters..."
                        required
                />
                @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6">
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control n-b-r @error('email') is-invalid @enderror"
                        type="text"
                        id="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        placeholder="example: test@test.com"
                        required
                />
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6">
            <div class="form-group">
                <label for="phone">Phone</label>
                <input class="form-control n-b-r"
                        type="text"
                        id="phone"
                        name="phone"
                        value="{{ old('phone', $user->phone) }}"
                        placeholder="You can enter your phone number..."
                />
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6">
            <div class="form-group">
                <label for="organisation">Organisation</label>
                <input class="form-control n-b-r"
                        type="text"
                        id="organisation"
                        name="organisation"
                        value="{{ old('organisation', $user->organisation) }}"
                        placeholder="You can enter your organisation..."
                />
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6">
            <div class="form-group">
                <label for="region">Region</label>
                <select id="region" name="region" class="form-control n-b-r">
                    <option value=""></option>
                    <option value="APAC" @if (old('region', $user->region) == 'APAC'){{ 'selected' }}@endif>APAC</option>
                    <option value="EMEA" @if (old('region', $user->region) == 'EMEA'){{ 'selected' }}@endif>EMEA</option>
                    <option value="North America" @if (old('region', $user->region) == 'North America'){{ 'selected' }}@endif>North America</option>
                    <option value="South America" @if (old('region', $user->region) == 'South America'){{ 'selected' }}@endif>South America</option>
                </select>
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6">
            <div class="form-group">
                <label for="industry">Industry</label>
                <input class="form-control n-b-r"
                        type="text"
                        id="industry"
                        name="industry"
                        value="{{ old('industry', $user->industry) }}"
                        placeholder="You can enter industry..."
                />
            </div>
        </div>
        <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
            <div class="form-group d-flex justify-content-between">
                <div class="d-flex justify-content-start">
                    <button type="submit" class="btn btn-grad btn-w-normal" id="btn-save-general-settings">
                        Save Settings
                    </button>
                    <button type="button" class="btn btn-grad btn-w-normal ml-4" id="btn-change-password">
                        Change Password
                    </button>
                </div>
                <div class="d-flex justify-content-end align-items-center">
                    <a class="text-right text-danger text-uppercase a-btn-remove-account justify-content-end n-p-lr">
                        Delete Account
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>

<h3 class="mt-4 setting-sub-title">Settings Per Page</h3>
<div class="row col-md-12 col-sm-12 mt-4">
    <ul class="nav nav-tabs" id="settingsTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active"
                id="tab-tasks"
                data-toggle="tab"
                href="#settings-tab-tasks"
                role="tab"
                aria-controls="settings-tab-tasks"
                aria-selected="true">
                Tasks
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link"
                id="tab-outbound"
                data-toggle="tab"
                href="#settings-tab-outbound"
                role="tab"
                aria-controls="settings-tab-outbound"
                aria-selected="true">
                Outbound
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link"
                id="tab-opportunities"
                data-toggle="tab"
                href="#settings-tab-opportunities"
                role="tab"
                aria-controls="settings-tab-opportunities"
                aria-selected="true">
                Opportunities
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link"
                id="tab-scripts"
                data-toggle="tab"
                href="#settings-tab-scripts"
                role="tab"
                aria-controls="settings-tab-scripts"
                aria-selected="true">
                Scripts
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link"
                id="tab-emails"
                data-toggle="tab"
                href="#settings-tab-emails"
                role="tab"
                aria-controls="settings-tab-emails"
                aria-selected="true">
                Emails
            </a>
        </li>
        <!-- <li class="nav-item" role="presentation">
            <a class="nav-link"
                id="tab-contacts"
                data-toggle="tab"
                href="#settings-tab-contacts"
                role="tab"
                aria-controls="settings-tab-contacts"
                aria-selected="true">
                Contacts
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link"
                id="tab-resources"
                data-toggle="tab"
                href="#settings-tab-resources"
                role="tab"
                aria-controls="settings-tab-resources"
                aria-selected="true">
                Resources
            </a>
        </li> -->
        <li class="nav-item" role="presentation">
            <a class="nav-link"
                id="tab-skills"
                data-toggle="tab"
                href="#settings-tab-skills"
                role="tab"
                aria-controls="settings-tab-skills"
                aria-selected="true">
                Skills
            </a>
        </li>
    </ul>
</div>
<div class="row col-md-12 col-sm-12 mb-4">
    <div class="tab-content w-100 border" id="settingsTabsContent">
        <div class="tab-pane fade show active"
            id="settings-tab-tasks"
            data-idx="tasks"
            role="tabpanel"
            aria-labelledby="tab-tasks">
            <form id="form_setting" class="form-inline mt-4" action="{{ route('settings.store.tasks')}}" method='post' autocomplete="off">
                @csrf
                <h3>Action</h3>
                <div class="row task-section col-md-12 col-sm-12 mb-4" id="ts-1">
                    @foreach ($actions as $action)
                    <div class="form-check col-2">
                        <input class="form-check-input input-action" type="checkbox" name="actions[]" 
                            id="ts-{{$action->id}}-rg-add" 
                            value="{{$action->id}}"
                            @foreach($taskSettings as $setting)
                                @if($action->id == $setting->section_id && $setting->section_type == 1 ) checked @endif
                            @endforeach
                            >
                        <label class="form-check-label" for="ts-{{$action->id}}-rg-add">
                            {{$action->name}}
                        </label>
                    </div>
                    @endforeach
                    <div class="col-lg-12 col-md-12 col-sm-12 pl-0 pt-1">
                        <div class="form-check col-2 pl-1">
                            <a href="javascript:void(0)" id="check-all-actions" class="select-all mr-2">Check All</a>
                            <span class="select-all-slash">/</span>
                            <a href="javascript:void(0)" id="uncheck-all-actions" class="select-all ml-2">Uncheck All</a>
                        </div>
                    </div>
                </div>
                                
                <h3>Step</h3>
                <div class="row task-section col-md-12 col-sm-12 mb-4" id="ts-2">
                    @foreach ($steps as $step)
                    <div class="form-check col-2">
                        <input class="form-check-input input-step" type="checkbox" name="steps[]" 
                            id="ts-{{$step->id}}-rg-account" 
                            value="{{$step->id}}"
                            @foreach($taskSettings as $setting)
                                @if($step->id == $setting->section_id && $setting->section_type == 2 ) checked @endif
                            @endforeach
                            >
                        <label class="form-check-label" for="ts-{{$step->id}}-rg-account">
                            {{$step->name}}
                        </label>
                    </div>
                    @endforeach
                    <div class="col-lg-12 col-md-12 col-sm-12 pl-0 pt-1">
                        <div class="form-check col-20 pl-1">
                            <a href="javascript:void(0)" id="check-all-steps" class="select-all mr-2">Check All</a>
                            <span class="select-all-slash">/</span>
                            <a href="javascript:void(0)" id="uncheck-all-steps" class="select-all ml-2">Uncheck All</a>
                        </div>
                    </div>
                </div>

                <h3>Sub Step</h3>
                <div id="suggest_step" class="row task-section col-md-12 col-sm-12 mb-4 {{(!isset($suggestSettings)) ? 'suggest-step-deactive' : ''}}">
                    <ul id="tabs" class="nav nav-tabs" role="tablist" >
                        @foreach ($steps as $step)
                        <li id="item-{{$step->id}}" 
                            class="nav-item suggest-item item-{{$step->id}} 
                            @php
                                $flag = false;
                                foreach($taskSettings as $setting) {
                                    if ($step->id == $setting->section_id && $setting->section_type == 2) {
                                        $flag = true;
                                        echo 'suggest-step-item-active';
                                    }
                                }
                                if ($flag === false) {
                                    echo 'suggest-step-item-deactive';
                                }
                            @endphp
                            ">
                            <a id="tab_{{$step->id}}" href="#pane-{{$step->id}}" 
                                data-toggle="tab"
                                role="tab"
                                class="nav-link {{( count($suggestSettings) != 0) ? (( $suggestSettings[0]->step_id == $step->id ) ? 'active' : '') : ''}}"
                            >{{$step->name}}</a>
                        </li>
                        @endforeach
                    </ul>
                    <div id="content" class="tab-content" role="tablist">
                        @foreach ($steps as $step)
                        <div id="pane-{{$step->id}}" class="tab-pane p-4 border fade show {{( count($stepSetting) != 0) ? (( $stepSetting[0]->section_id == $step->id ) ? 'active' : '') : ''}}" role="tabpanel" aria-labelledby="tab_{{$step->id}}">
                            @foreach ($steps as $substep)
                            <div class="form-check col-2">
                                <input class="form-check-input" type="checkbox" name="suggest_steps[]" 
                                    id="suggest-{{$step->id}}-{{$substep->id}}-rg" 
                                    value="{{$step->id}}:{{$substep->id}}"
                                    @foreach($suggestSettings as $subSetting)
                                        @if($substep->id == $subSetting->suggest_step_id && $subSetting->step_id == $step->id ) checked @endif
                                    @endforeach
                                >
                                <label class="form-check-label" for="suggest-{{$step->id}}-{{$substep->id}}-rg">
                                    {{$substep->name}}
                                </label>
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="row task-section col-md-12 col-sm-12 mb-4" id="ts-9">
                    <button type="submit" class="btn btn-grad btn-w-normal" id="btn-save-settings">
                            Save Settings
                    </button>
                </div>
            </form>
        </div>
        <div class="tab-pane fade"
            id="settings-tab-outbound"
            data-idx="outbound"
            role="tabpanel"
            aria-labelledby="tab-outbound">
            <form id="form_outbound_setting" class="form-inline mt-4" action="" method='post' autocomplete="off">
                @csrf    
                <div class="row task-section col-md-12 col-sm-12 mb-4" id="ts-9">
                    <button type="submit" class="btn btn-grad btn-w-normal" id="btn-save-outbound-settings">
                        Save Settings
                    </button>
                </div>
            </form>
        </div>
        <div class="tab-pane fade"
            id="settings-tab-opportunities"
            data-idx="opportunities"
            role="tabpanel"
            aria-labelledby="tab-opportunities">
            <div class="row">
                <div class="col-xl-3 col-lg-4 col-md-12 col-sm-12">
                    <div class="row col-lg-12 col-md-12 col-sm-12 d-flex">
                        <form id="form_opportunities_setting" class="form-inline mt-4" action="" method="post" autocomplete="off">
                            @csrf
                            <h3>Available Input Fields</h3>
                            <div class="row task-section col-lg-12 col-md-12 col-sm-12 mb-4">
                                @foreach ($oppIFs as $idx => $input)
                                <div class="form-check col-lg-12 col-md-12 col-sm-12">
                                    <input class="form-check-input input-field" type="checkbox" name="input_fields[]" 
                                        id="{{ $input->key }}" 
                                        value="{{ $input->key }}"
                                        @if ($input->checked){{ 'checked' }}@endif
                                        >
                                    <label class="form-check-label" for="{{ $input->key }}">
                                        {{ $input->value }}
                                    </label>
                                </div>
                                @endforeach
                                <div class="col-lg-12 col-md-12 col-sm-12 pl-0 pt-1">
                                    <div class="form-check pl-1">
                                        <a href="javascript:void(0)" id="check-all-inputs" class="select-all mr-2">Check All</a>
                                        <span class="select-all-slash">/</span>
                                        <a href="javascript:void(0)" id="uncheck-all-inputs" class="select-all ml-2">Uncheck All</a>
                                    </div>
                                </div>
                            </div>
                            <div class="row task-section col-lg-12 col-md-12 col-sm-12 mb-4 pl-4">
                                <button type="button" class="btn btn-grad btn-w-normal" id="btn-save-opportunities-settings">
                                        Save Settings
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="row col-lg-12 col-md-12 col-sm-12 d-flex">
                        <form action="" class="form-inline" id="ownership-setting-form">
                            <h3 class="setting-sub-title mt-4">Setting For Ownership</h3>
                            <div class="task-section col-1g-12 col-md-12 col-sm-12 pl-2">
                                <div class="form-check pl-0">
                                    <input type="checkbox"
                                            name="opp-org-tick"
                                            id="opp-org-tick"
                                            class="form-check-input n-b-r"
                                            @if ($ownership == 1 || $ownership == 3){{ 'checked' }}@endif
                                    />
                                    <label class="form-check-label" for="opp-org-tick">Organisation</label>
                                </div>
                                <div class="form-check pl-0">
                                    <input type="checkbox"
                                            name="user-company-tick"
                                            id="user-company-tick"
                                            class="form-check-input n-b-r"
                                            @if ($ownership == 2 || $ownership == 3){{ 'checked' }}@endif
                                    />
                                    <label class="form-check-label" for="user-company-tick">Company user works for</label>
                                </div>
                            </div>
                            <div class="row task-section col-lg-12 col-md-12 col-sm-12 mt-4 mb-4 ml-0 pl-2">
                                <button type="button" class="btn btn-grad btn-w-normal" id="btn-save-ownership-setting">
                                    Save Settings
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xl-9 col-lg-8 col-md-12 col-sm-12">
                    <div class="row col-lg-12 col-md-12 col-sm-12 d-flex">
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <form action="" class="form-inline" id="sales-stage-form">
                                <h3 class="setting-sub-title mt-4">Create Sales Stage</h3>
                                <div class="task-section col-1g-12 col-md-12 col-sm-12">
                                    <div class="form-group mb-2">
                                        <label for="sales-stage">Sales Stage Name</label>
                                        <input type="text" name="sales-stage" id="sales-stage" class="form-control n-b-r" placeholder="Enter Sales Stage...">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="sales-stage-order">Order</label>
                                        <input type="text" name="sales-stage-order" id="sales-stage-order" class="form-control n-b-r" value="0" placeholder="Enter Sales Stage Order..." min="0">
                                    </div>
                                    <div class="form-check pl-0">
                                        <input type="checkbox" name="show-stage-progress" id="show-stage-progress" class="form-check-input n-b-r">
                                        <label class="form-check-label" for="show-stage-progress">Show stage progress</label>
                                    </div>
                                    <div class="form-check pl-0">
                                        <input type="checkbox" name="show-strength-indicators" id="show-strength-indicators" class="form-check-input n-b-r">
                                        <label class="form-check-label" for="show-strength-indicators">Show strength indicators</label>
                                    </div>
                                </div>
                                <div class="row task-section col-lg-12 col-md-12 col-sm-12 mt-4 mb-4 ml-0">
                                    <button type="button" class="btn btn-grad btn-w-normal" id="btn-save-sales-stage">
                                        Save Sales Stage
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-12 pr-0">
                            <h3 class="setting-sub-title mt-4">Sales Stages</h3>
                            <div class="table-responsive table-wrapper mt-2 mb-4">
                                <div class="sales-stage-table-wrapper border-bottom border-white">
                                    <table class="table table-hover w-100 mb-0" id="sales-stage-table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col" class="no-sort pl-2 pr-2">Name</th>
                                                <th scope="col" class="no-sort pl-2 pr-2">Show stage progress</th>
                                                <th scope="col" class="no-sort pl-2 pr-2">Show strength indicators</th>
                                                <th scope="col" class="no-sort pl-2 pr-2">Order</th>
                                                <th scope="col" class="text-center no-sort pl-2 pr-2" width="65">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($salesStages) > 0)
                                                @foreach ($salesStages as $s)
                                                <tr data-id="{{ $s->id }}" data-ssn="{{ $s->o_value }}" data-ssi="{{ $s->o_value1 }}" data-ssp="{{ $s->o_value2 }}" data-sso="{{ $s->o_value3 }}">
                                                    <td class="text-white pl-2 pr-2">{{ $s->o_value }}</td>
                                                    <td class="text-white pl-2 pr-2">@if($s->o_value2 == 1){{ 'Yes' }}@else{{ 'No' }}@endif</td>
                                                    <td class="text-white pl-2 pr-2">@if($s->o_value1 == 1){{ 'Yes' }}@else{{ 'No' }}@endif</td>
                                                    <td class="text-white pl-2 pr-2">{{ $s->o_value3 }}</td>
                                                    <td class="text-white text-center">
                                                        <button type="button" class="btn btn-sm btn-success n-b-r btn-edit-sales-stage" title="Edit">
                                                            <i class="bi bi-pencil-fill"></i>
                                                        </button><button type="button" class="btn btn-sm btn-danger n-b-r btn-remove-sales-stage" title="Remove">
                                                            <i class="bi bi-x"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <tr class="no-data">
                                                    <td colspan="5" class="text-danger text-center">
                                                        No Sales Stages
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row col-lg-12 col-md-12 col-sm-12 d-flex">
                        <div class="col-lg-5 col-md-5 col-sm-12">
                            <form action="" class="form-inline" id="task-event-form">
                                <h3 class="setting-sub-title mt-4">Create Task / Event</h3>
                                <div class="task-section col-1g-12 col-md-12 col-sm-12">
                                    <div class="form-group mb-2">
                                        <label for="task-event">Task / Event</label>
                                        <input type="text" name="task-event" id="task-event" class="form-control n-b-r" placeholder="Enter Task / Event...">
                                    </div>
                                </div>
                                <div class="row task-section col-lg-12 col-md-12 col-sm-12 mt-4 mb-4 ml-0">
                                    <button type="button" class="btn btn-grad btn-w-normal" id="btn-save-task-event">
                                        Save Task / Event
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-7 col-md-7 col-sm-12 pr-0">
                            <h3 class="setting-sub-title mt-4">Task / Events</h3>
                            <div class="table-responsive table-wrapper mt-2 mb-4">
                                <div class="task-event-table-wrapper border-bottom border-white">
                                    <table class="table table-hover w-100 mb-0" id="task-event-table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col" class="no-sort pl-2 pr-2">Name</th>
                                                <th scope="col" class="text-center no-sort pl-2 pr-2" width="65">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($taskEvents) > 0)
                                                @foreach ($taskEvents as $t)
                                                <tr data-id="{{ $t->id }}" data-name="{{ $t->o_value }}">
                                                    <td class="text-white pl-2 pr-2">{{ $t->o_value }}</td>
                                                    <td class="text-white text-center">
                                                        <button type="button" class="btn btn-sm btn-success n-b-r btn-edit-task-event" title="Edit">
                                                            <i class="bi bi-pencil-fill"></i>
                                                        </button><button type="button" class="btn btn-sm btn-danger n-b-r btn-remove-task-event" title="Remove">
                                                            <i class="bi bi-x"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @else
                                                <tr class="no-data">
                                                    <td colspan="2" class="text-danger text-center">
                                                        No Task / Event(s)
                                                    </td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row col-lg-12 col-md-12 col-sm-12 meddpicc-tooltip-texts-settings pr-0">
                        <div class="row col-lg-12 col-md-12 col-sm-12">
                            <h3 class="setting-sub-title pl-3 mt-4 w-100">MEDDPICC Tooltip Texts</h3>
                        </div>
                        <div class="row col-lg-12 col-md-12 col-sm-12 pr-0">
                            <div class="col-lg-6 col-md-6 col-sm-12 pr-0">
                                <div class="col-1g-12 col-md-12 col-sm-12 pr-0">
                                    <div class="form-group mb-2">
                                        <label for="ttt-metrics">Metrics</label>
                                        <textarea name="ttt-metrics"
                                            id="ttt-metrics"
                                            class="form-control n-b-r h-3rem-2px"
                                            rows="2"
                                            placeholder="Enter tooltip text for metrics...">@if(isset($meddpiccTooltip)){{ $meddpiccTooltip->metrics }}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 pr-0">
                                <div class="col-1g-12 col-md-12 col-sm-12 pr-0">
                                    <div class="form-group mb-2">
                                        <label for="ttt-metrics-score">Metrics Score</label>
                                        <textarea name="ttt-metrics-score"
                                            id="ttt-metrics-score"
                                            class="form-control n-b-r h-3rem-2px"
                                            rows="2"
                                            placeholder="Enter tooltip text for metrics score...">@if(isset($meddpiccTooltip)){{ $meddpiccTooltip->metrics_score }}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row col-lg-12 col-md-12 col-sm-12 pr-0">
                            <div class="col-lg-6 col-md-6 col-sm-12 pr-0">
                                <div class="col-1g-12 col-md-12 col-sm-12 pr-0">
                                    <div class="form-group mb-2">
                                        <label for="ttt-economic-buyer">Economic Buyer / Sponsor</label>
                                        <textarea name="ttt-economic-buyer"
                                            id="ttt-economic-buyer"
                                            class="form-control n-b-r h-3rem-2px"
                                            rows="2"
                                            placeholder="Enter tooltip text for economic buyer / sponsor...">@if(isset($meddpiccTooltip)){{ $meddpiccTooltip->economic_buyer }}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 pr-0">
                                <div class="col-1g-12 col-md-12 col-sm-12 pr-0">
                                    <div class="form-group mb-2">
                                        <label for="ttt-economic-buyer-score">Economic Buyer / Sponsor Score</label>
                                        <textarea name="ttt-economic-buyer-score"
                                            id="ttt-economic-buyer-score"
                                            class="form-control n-b-r h-3rem-2px"
                                            rows="2"
                                            placeholder="Enter tooltip text for economic buyer / sponsor score...">@if(isset($meddpiccTooltip)){{ $meddpiccTooltip->economic_buyer_score }}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row col-lg-12 col-md-12 col-sm-12 pr-0">
                            <div class="col-lg-6 col-md-6 col-sm-12 pr-0">
                                <div class="col-1g-12 col-md-12 col-sm-12 pr-0">
                                    <div class="form-group mb-2">
                                        <label for="ttt-decision-criteria">Decision Criteria</label>
                                        <textarea name="ttt-decision-criteria"
                                            id="ttt-decision-criteria"
                                            class="form-control n-b-r h-3rem-2px"
                                            rows="2"
                                            placeholder="Enter tooltip text for decision criteria...">@if(isset($meddpiccTooltip)){{ $meddpiccTooltip->decision_criteria }}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 pr-0">
                                <div class="col-1g-12 col-md-12 col-sm-12 pr-0">
                                    <div class="form-group mb-2">
                                        <label for="ttt-decision-criteria-score">Decision Criteria Score</label>
                                        <textarea name="ttt-decision-criteria-score"
                                            id="ttt-decision-criteria-score"
                                            class="form-control n-b-r h-3rem-2px"
                                            rows="2"
                                            placeholder="Enter tooltip text for decision criteria score...">@if(isset($meddpiccTooltip)){{ $meddpiccTooltip->decision_criteria_score }}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row col-lg-12 col-md-12 col-sm-12 pr-0">
                            <div class="col-lg-6 col-md-6 col-sm-12 pr-0">
                                <div class="col-1g-12 col-md-12 col-sm-12 pr-0">
                                    <div class="form-group mb-2">
                                        <label for="ttt-decision-process">Decision Process</label>
                                        <textarea name="ttt-decision-process"
                                            id="ttt-decision-process"
                                            class="form-control n-b-r h-3rem-2px"
                                            rows="2"
                                            placeholder="Enter tooltip text for decision process...">@if(isset($meddpiccTooltip)){{ $meddpiccTooltip->decision_process }}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 pr-0">
                                <div class="col-1g-12 col-md-12 col-sm-12 pr-0">
                                    <div class="form-group mb-2">
                                        <label for="ttt-decision-process-score">Decision Process Score</label>
                                        <textarea name="ttt-decision-process-score"
                                            id="ttt-decision-process-score"
                                            class="form-control n-b-r h-3rem-2px"
                                            rows="2"
                                            placeholder="Enter tooltip text for decision process score...">@if(isset($meddpiccTooltip)){{ $meddpiccTooltip->decision_process_score }}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row col-lg-12 col-md-12 col-sm-12 pr-0">
                            <div class="col-lg-6 col-md-6 col-sm-12 pr-0">
                                <div class="col-1g-12 col-md-12 col-sm-12 pr-0">
                                    <div class="form-group mb-2">
                                        <label for="ttt-paper-process">Paper Process</label>
                                        <textarea name="ttt-paper-process"
                                            id="ttt-paper-process"
                                            class="form-control n-b-r h-3rem-2px"
                                            rows="2"
                                            placeholder="Enter tooltip text for paper process...">@if(isset($meddpiccTooltip)){{ $meddpiccTooltip->paper_process }}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 pr-0">
                                <div class="col-1g-12 col-md-12 col-sm-12 pr-0">
                                    <div class="form-group mb-2">
                                        <label for="ttt-paper-process-score">Paper Process Score</label>
                                        <textarea name="ttt-paper-process-score"
                                            id="ttt-paper-process-score"
                                            class="form-control n-b-r h-3rem-2px"
                                            rows="2"
                                            placeholder="Enter tooltip text for paper process score...">@if(isset($meddpiccTooltip)){{ $meddpiccTooltip->paper_process_score }}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row col-lg-12 col-md-12 col-sm-12 pr-0">
                            <div class="col-lg-6 col-md-6 col-sm-12 pr-0">
                                <div class="col-1g-12 col-md-12 col-sm-12 pr-0">
                                    <div class="form-group mb-2">
                                        <label for="ttt-identified-pain">Identified Pain</label>
                                        <textarea name="ttt-identified-pain"
                                            id="ttt-identified-pain"
                                            class="form-control n-b-r h-3rem-2px"
                                            rows="2"
                                            placeholder="Enter tooltip text for identified pain...">@if(isset($meddpiccTooltip)){{ $meddpiccTooltip->identified_pain }}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 pr-0">
                                <div class="col-1g-12 col-md-12 col-sm-12 pr-0">
                                    <div class="form-group mb-2">
                                        <label for="ttt-identified-pain-score">Identified Pain Score</label>
                                        <textarea name="ttt-identified-pain-score"
                                            id="ttt-identified-pain-score"
                                            class="form-control n-b-r h-3rem-2px"
                                            rows="2"
                                            placeholder="Enter tooltip text for identified pain score...">@if(isset($meddpiccTooltip)){{ $meddpiccTooltip->identified_pain_score }}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row col-lg-12 col-md-12 col-sm-12 pr-0">
                            <div class="col-lg-6 col-md-6 col-sm-12 pr-0">
                                <div class="col-1g-12 col-md-12 col-sm-12 pr-0">
                                    <div class="form-group mb-2">
                                        <label for="ttt-champion-coach">Champion / Coach</label>
                                        <textarea name="ttt-champion-coach"
                                            id="ttt-champion-coach"
                                            class="form-control n-b-r h-3rem-2px"
                                            rows="2"
                                            placeholder="Enter tooltip text for champion / coach...">@if(isset($meddpiccTooltip)){{ $meddpiccTooltip->champion_coach }}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 pr-0">
                                <div class="col-1g-12 col-md-12 col-sm-12 pr-0">
                                    <div class="form-group mb-2">
                                        <label for="ttt-champion-coach-score">Champion / Coach Score</label>
                                        <textarea name="ttt-champion-coach-score"
                                            id="ttt-champion-coach-score"
                                            class="form-control n-b-r h-3rem-2px"
                                            rows="2"
                                            placeholder="Enter tooltip text for champion / coach score...">@if(isset($meddpiccTooltip)){{ $meddpiccTooltip->champion_coach_score }}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row col-lg-12 col-md-12 col-sm-12 pr-0 mb-4">
                            <div class="col-lg-6 col-md-6 col-sm-12 pr-0">
                                <div class="col-1g-12 col-md-12 col-sm-12 pr-0">
                                    <div class="form-group mb-2">
                                        <label for="ttt-competition">Competition</label>
                                        <textarea name="ttt-competition"
                                            id="ttt-competition"
                                            class="form-control n-b-r h-3rem-2px"
                                            rows="2"
                                            placeholder="Enter tooltip text for competition...">@if(isset($meddpiccTooltip)){{ $meddpiccTooltip->competition }}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 pr-0">
                                <div class="col-1g-12 col-md-12 col-sm-12 pr-0">
                                    <div class="form-group mb-2">
                                        <label for="ttt-competition-score">Competition Score</label>
                                        <textarea name="ttt-competition-score"
                                            id="ttt-competition-score"
                                            class="form-control n-b-r h-3rem-2px"
                                            rows="2"
                                            placeholder="Enter tooltip text for competition score...">@if(isset($meddpiccTooltip)){{ $meddpiccTooltip->competition_score }}@endif</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row col-lg-12 col-md-12 col-sm-12 pr-0 mb-4">
                            <div class="col-lg-6 col-md-6 col-sm-12 pr-0">
                                <div class="col-1g-12 col-md-12 col-sm-12 pr-0">
                                    <button type="button" class="btn btn-grad btn-w-normal" id="btn-save-tooltips">
                                        Save Tooltips
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade"
            id="settings-tab-scripts"
            data-idx="scripts"
            role="tabpanel"
            aria-labelledby="tab-scripts">
            <form id="form_scripts_setting" class="mt-4" action="" method='post' autocomplete="off">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 pr-30-px">
                                <h3 class="font-weight-normal">New Script</h3>
                                <div class="col-lg-12 col-md-12 col-sm-12 pl-0 pr-0">
                                    <div class="form-group">
                                        <label for="script_name">Script Name</label>
                                        <input class="form-control n-b-r"
                                                type="text"
                                                id="script_name"
                                                name="script_name"
                                                value=""
                                                placeholder="Enter script name..."
                                                required
                                        />
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 pl-0 pr-0">
                                    <div class="form-group">
                                        <label for="script_content">Script Content</label>
                                        <textarea name="script_content"
                                            id="script_content"
                                            class="form-control h-px-100 n-b-r"
                                            placeholder="Enter script content..."></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 pl-0 pr-0 mt-4">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-grad btn-w-normal" id="btn-save-scripts-settings">
                                            Save Script
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 pl-0">
                                <h3 class="font-weight-normal">Script List</h3>
                                <div class="table-responsive table-wrapper mt-2 mb-4 pr-30-px">
                                    <div class="scripts-table-wrapper border-bottom border-white">
                                        <table class="table table-hover w-100 mb-0" id="scripts-table">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col" class="no-sort pl-2 pr-2" width="200">Name</th>
                                                    <th scope="col" class="no-sort pl-2 pr-2">Content</th>
                                                    <th scope="col" class="text-center no-sort pl-2 pr-2" width="65">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($scriptSetting) && count($scriptSetting) > 0)
                                                    @foreach ($scriptSetting as $script)
                                                    <tr data-id="{{ $script->id }}">
                                                        <td class="text-white pl-2 pr-2">{{ $script->name }}</td>
                                                        <td class="text-white pl-2 pr-2">{{ $script->content }}</td>
                                                        <td class="text-white text-center">
                                                            <button type="button" class="btn btn-sm btn-success n-b-r btn-edit-script" title="Edit this script">
                                                                <i class="bi bi-pencil-fill"></i>
                                                            </button><button type="button" class="btn btn-sm btn-danger n-b-r btn-remove-script" title="Remove this script">
                                                                <i class="bi bi-x"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr id="no-data-row">
                                                        <td class="text-center text-white" colspan="3">No Scripts</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>                    
                </div>
            </form>
        </div>
        <div class="tab-pane fade"
            id="settings-tab-emails"
            data-idx="emails"
            role="tabpanel"
            aria-labelledby="tab-emails">
            <form id="form_emails_setting" class="mt-4" action="" method='post' autocomplete="off">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 pr-30-px">
                                <h3 class="font-weight-normal">New Email</h3>
                                <div class="col-lg-12 col-md-12 col-sm-12 n-p-lr">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input class="form-control n-b-r"
                                                type="text"
                                                id="title"
                                                name="title"
                                                value=""
                                                placeholder="Enter title..."
                                                required
                                        />
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 n-p-lr">
                                    <div class="form-group">
                                        <label for="subject">Subject</label>
                                        <input class="form-control n-b-r"
                                                type="text"
                                                id="subject"
                                                name="subject"
                                                value=""
                                                placeholder="Enter subject..."
                                                required
                                        />
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 n-p-lr">
                                    <div class="form-group">
                                        <label for="body">Body</label>
                                        <textarea name="body"
                                            id="body"
                                            class="form-control h-px-100 n-b-r"
                                            placeholder="Enter body..."></textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 mt-4 n-p-lr">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-grad btn-w-normal" id="btn-save-emails-settings">
                                            Save Email
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 pl-0">
                                <h3 class="font-weight-normal">Email List</h3>
                                <div class="table-responsive table-wrapper mt-2 mb-4 pr-30-px">
                                    <div class="emails-table-wrapper border-bottom border-white">
                                        <table class="table table-hover w-100 mb-0" id="emails-table">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col" class="no-sort pl-2 pr-2" width="200">Title</th>
                                                    <th scope="col" class="no-sort pl-2 pr-2" width="200">Subject</th>
                                                    <th scope="col" class="no-sort pl-2 pr-2">Body</th>
                                                    <th scope="col" class="text-center no-sort pl-2 pr-2" width="65">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (isset($emailSetting) && count($emailSetting) > 0)
                                                    @foreach ($emailSetting as $email)
                                                    <tr data-id="{{ $email->id }}">
                                                        <td class="text-white pl-2 pr-2">{{ $email->title }}</td>
                                                        <td class="text-white pl-2 pr-2">{{ $email->subject }}</td>
                                                        <td class="text-white pl-2 pr-2">{{ $email->body }}</td>
                                                        <td class="text-center text-white">
                                                            <button type="button" class="btn btn-sm btn-success n-b-r btn-edit-email" title="Edit this email">
                                                                <i class="bi bi-pencil-fill"></i>
                                                            </button><button type="button" class="btn btn-sm btn-danger n-b-r btn-remove-email" title="Remove this email">
                                                                <i class="bi bi-x"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                    <tr id="no-data-row">
                                                        <td class="text-center text-white" colspan="4">No Emails</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="tab-pane fade"
            id="settings-tab-skills"
            data-idx="skills"
            role="tabpanel"
            aria-labelledby="tab-skills">
            <form id="form_skills_setting" class="mt-4" action="" method='post' autocomplete="off">
                <div class="row mt-2 pr-4">
                    <div class="col-lg-3 col-md-4 col-sm-12 pl-0">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <h3 class="font-weight-normal">Create Group</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="main_skill_name">Group Name</label>
                                        <input class="form-control n-b-r"
                                                type="text"
                                                id="main_skill_name"
                                                name="main_skill_name"
                                                value=""
                                                placeholder="Enter group name..."
                                                required
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-grad btn-w-normal" id="btn-save-main-skill-settings">
                                            Save Group
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-1g-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-check mt-4 mb-4 pl-0">
                                        <input type="checkbox" class="form-check-input" id="acmt" @if ($skillACMT == '1'){{ 'checked' }}@endif>
                                        <label class="form-check-label" for="acmt">Auto Create Monthly Skill Assessment Task</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-1g-12 col-md-12 col-sm-12">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <h3 class="font-weight-normal">Select Start Month</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="start_month">Month</label>
                                        <select class="form-control n-p-lr n-b-r"
                                                name="start_month"
                                                id="start_month">
                                            @for ($i = 1; $i <= 12; $i++)
                                                @php
                                                    $dateObj   = DateTime::createFromFormat('!m', $i);
                                                    $monthName = $dateObj->format('F');
                                                @endphp
                                                <option value="{{ formatWithZero($i) }}" @if ($i == $skillStartAt->month){{ 'selected' }}@endif>{{ $monthName }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="start_year">Year</label>
                                        <select class="form-control n-p-lr n-b-r"
                                                name="start_year"
                                                id="start_year">
                                            @for ($i = 0; $i < 5; $i++)
                                                <option value="{{ date('Y') - $i }}" @if ($skillStartAt->year == date('Y') - $i){{ 'selected' }}@endif>{{ date('Y') - $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-grad btn-w-normal" id="btn-save-start-month-settings">
                                            Save Month
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-12 pl-0">
                        <div class="col-lg-12 col-md-12 col-sm-12 pl-0 pr-0">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <h3 class="font-weight-normal">Create Skill</h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <label for="sub_skill_name">Skill Name</label>
                                        <input class="form-control n-b-r"
                                                type="text"
                                                id="sub_skill_name"
                                                name="sub_skill_name"
                                                value=""
                                                placeholder="Enter skill name..."
                                                required
                                        />
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 form-inline">
                                    <div class="row task-section pl-0 mt-1">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <h6>Groups</h6>
                                        </div>
                                    </div>
                                    <div class="row task-section col-md-12 col-sm-12 mb-4 radio-group">
                                        @foreach ($skillSetting as $skill)
                                        <div class="form-check col-12">
                                            <input class="form-check-input"
                                                type="radio"
                                                name="main_skill"
                                                id="main_skill_{{ $skill->id }}"
                                                value="{{ $skill->id }}"
                                            />
                                            <label class="form-check-label" for="main_skill_{{ $skill->id }}">
                                                {{$skill->name}}
                                            </label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-grad btn-w-normal" id="btn-save-sub-skill-settings">
                                            Save Skill
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-8 col-sm-12" style="margin: 0 -4px !important">
                        <h3 class="font-weight-normal">Skills</h3>
                        <div class="table-responsive table-wrapper mt-2 mb-4">
                            <div class="skills-table-wrapper border-bottom border-white">
                                <table class="table table-hover w-100 mb-0" id="skills-table">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col" class="no-sort pl-2 pr-2" width="25%">Groups</th>
                                            <th scope="col" class="text-center no-sort pl-2 pr-2" width="63">Actions</th>
                                            <th scope="col" class="no-sort pl-2 pr-2">Skills</th>
                                            <th scope="col" class="text-center no-sort pl-2 pr-2" width="63">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($skillSetting) && count($skillSetting) > 0)
                                            @foreach ($skillSetting as $skill)
                                                @foreach ($skill->sub_skills->ids as $idx => $sub_skill_id)
                                                <tr data-main-id="{{ $skill->id }}" 
                                                    data-main-name="{{ $skill->name }}" 
                                                    data-sub-id="{{ $sub_skill_id }}" 
                                                    data-sub-name="{{ $skill->sub_skills->names[$idx] }}">
                                                    @if ($idx == 0)
                                                    <td class="text-white pl-2 pr-2" rowspan="{{ count($skill->sub_skills->ids) }}">
                                                        <span class="skill-name">{{ $skill->name }}</span>
                                                    </td>
                                                    <td class="text-white text-center" rowspan="{{ count($skill->sub_skills->ids) }}">
                                                        <button type="button" class="btn btn-sm btn-success n-b-r btn-edit-main-skill" title="Edit this group">
                                                            <i class="bi bi-pencil-fill"></i>
                                                        </button><button type="button" class="btn btn-sm btn-danger n-b-r btn-remove-main-skill" title="Remove this group">
                                                            <i class="bi bi-x"></i>
                                                        </button>
                                                    </td>
                                                    @endif
                                                    <td class="text-white pl-2 pr-2">{{ $skill->sub_skills->names[$idx] }}</td>
                                                    <td class="text-white text-center">
                                                        @if (!empty($sub_skill_id))
                                                        <button type="button" class="btn btn-sm btn-success n-b-r btn-edit-sub-skill" title="Edit this skill">
                                                            <i class="bi bi-pencil-fill"></i>
                                                        </button><button type="button" class="btn btn-sm btn-danger n-b-r btn-remove-sub-skill" title="Remove this skill">
                                                            <i class="bi bi-x"></i>
                                                        </button>
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endforeach
                                        @else
                                            <tr id="no-data-row">
                                                <td class="text-center text-white" colspan="3">No Skills</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Script Modal -->
<div class="modal fade" id="edit-script-modal" tabindex="-1" role="dialog" aria-labelledby="edit-script-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content n-b-r text-dark">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="edit-script-modal-header-title">Edit Script</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mt-2 mb-2 pl-4 pr-4">
                    <input type="hidden" name="edit_script_id" id="edit_script_id" />
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="edit_script_name">Script Name</label>
                            <input class="form-control n-b-r"
                                    type="text"
                                    id="edit_script_name"
                                    name="edit_script_name"
                                    value=""
                                    placeholder="Enter script name..."
                                    required
                            />
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="edit_script_content">Script Content</label>
                            <textarea name="edit_script_content"
                                id="edit_script_content"
                                class="form-control h-px-100 n-b-r"
                                placeholder="Enter script content..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-modal-close btn-w-normal" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-grad btn-w-normal" id="btn-update-script">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Email Modal -->
<div class="modal fade" id="edit-email-modal" tabindex="-1" role="dialog" aria-labelledby="edit-email-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content n-b-r text-dark">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="edit-email-modal-header-title">Edit Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mt-2 mb-2 pl-4 pr-4">
                    <input type="hidden" name="edit_email_id" id="edit_email_id" />
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="edit_email_title">Title</label>
                            <input class="form-control n-b-r"
                                    type="text"
                                    id="edit_email_title"
                                    name="edit_email_title"
                                    value=""
                                    placeholder="Enter email title..."
                                    required
                            />
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="edit_email_subject">Subject</label>
                            <input class="form-control n-b-r"
                                    type="text"
                                    id="edit_email_subject"
                                    name="edit_email_subject"
                                    value=""
                                    placeholder="Enter email subject..."
                            />
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="edit_email_body">Body</label>
                            <textarea name="edit_email_body"
                                id="edit_email_body"
                                class="form-control h-px-100 n-b-r"
                                placeholder="Enter email body..."></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-modal-close btn-w-normal" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-grad btn-w-normal" id="btn-update-email">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Main Skill Modal -->
<div class="modal fade" id="edit-main-skill-modal" tabindex="-1" role="dialog" aria-labelledby="edit-main-skill-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content n-b-r text-dark">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="edit-main-skill-modal-header-title">Edit Group</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mt-2 mb-2 pl-4 pr-4">
                    <input type="hidden" name="edit_main_skill_id" id="edit_main_skill_id" />
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="edit_main_skill_name">Group Name</label>
                            <input class="form-control n-b-r"
                                    type="text"
                                    id="edit_main_skill_name"
                                    name="edit_main_skill_name"
                                    value=""
                                    placeholder="Enter main skill name..."
                                    required
                            />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-modal-close btn-w-normal" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-grad btn-w-normal" id="btn-update-main-skill">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Sub Skill Modal -->
<div class="modal fade" id="edit-sub-skill-modal" tabindex="-1" role="dialog" aria-labelledby="edit-sub-skill-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content n-b-r text-dark">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="edit-sub-skill-modal-header-title">Edit Sub Skill</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mt-2 mb-2 pl-4 pr-4">
                    <input type="hidden" name="edit_sub_skill_id" id="edit_sub_skill_id" />
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="edit_sub_skill_name">Skill Name</label>
                            <input class="form-control n-b-r"
                                    type="text"
                                    id="edit_sub_skill_name"
                                    name="edit_sub_skill_name"
                                    value=""
                                    placeholder="Enter sub skill name..."
                                    required
                            />
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="edit_sub_skill_p_id">Parent Skill</label>
                            <select name="edit_sub_skill_p_id"
                                id="edit_sub_skill_p_id"
                                class="form-control n-b-r">
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-modal-close btn-w-normal" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-grad btn-w-normal" id="btn-update-sub-skill">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="delete-account-modal" tabindex="-1" role="dialog" aria-labelledby="delete-account-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 600px">
        <div class="modal-content n-b-r text-dark">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="delete-account-modal-header-title">Delete Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mt-4 mb-4 pl-4 pr-4">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="">Are you sure you want to delete your account?</label>
                        </div>
                        <div class="form-group mb-0">
                            <label class="mb-0">All your data will be lost and your account will be cancelled.</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-grad btn-w-bigger" data-dismiss="modal">No, I was having a moment...</button>
                <button type="button" class="btn btn-modal-close btn-w-bigger" id="btn-delete-account">Yes, I'm allergic to money!</button>
            </div>
        </div>
    </div>
</div>

<!-- Change Password Modal -->
<div class="modal fade" id="change-password-modal" tabindex="-1" role="dialog" aria-labelledby="change-password-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content n-b-r text-dark">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="edit-script-modal-header-title">Change Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mt-2 mb-2 pl-4 pr-4">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input class="form-control n-b-r"
                                    type="password"
                                    id="new_password"
                                    name="new_password"
                                    value=""
                                    placeholder="Enter new password..."
                            />
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input class="form-control n-b-r"
                                    type="password"
                                    id="confirm_password"
                                    name="confirm_password"
                                    value=""
                                    placeholder="Enter confirm password..."
                            />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-modal-close btn-w-normal" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-grad btn-w-normal" id="btn-update-password">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Sales Stage Modal -->
<div class="modal fade" id="edit-sales-stage-modal" tabindex="-1" role="dialog" aria-labelledby="edit-sales-stage-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content n-b-r text-dark">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="edit-sales-stage-modal-header-title">Edit Sales Stage</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mt-2 mb-2 pl-4 pr-4">
                    <input type="hidden" name="edit-ss-id" id="edit-ss-id" />
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="edit-ssn">Sales Stage</label>
                            <input class="form-control n-b-r"
                                    type="text"
                                    id="edit-ssn"
                                    name="edit-ssn"
                                    value=""
                                    placeholder="Enter Sales Stage..."
                            />
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="edit-sso">Order</label>
                            <input class="form-control n-b-r"
                                    type="number"
                                    id="edit-sso"
                                    name="edit-sso"
                                    value=""
                                    min="0"
                                    placeholder="Enter Sales Stage order..."
                            />
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="edit-ssp">Show Stage Progress</label>
                            <select name="edit-ssp"
                                id="edit-ssp"
                                class="form-control n-b-r">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="edit-ssi">Show Strength Indicators</label>
                            <select name="edit-ssi"
                                id="edit-ssi"
                                class="form-control n-b-r">
                                <option value="0">No</option>
                                <option value="1">Yes</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-modal-close btn-w-normal" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-grad btn-w-normal" id="btn-update-sales-stage">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Task / Event Modal -->
<div class="modal fade" id="edit-task-event-modal" tabindex="-1" role="dialog" aria-labelledby="edit-task-event-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content n-b-r text-dark">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title" id="edit-task-event-modal-header-title">Edit Task / Event</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row mt-2 mb-2 pl-4 pr-4">
                    <input type="hidden" name="edit-task-event-id" id="edit-task-event-id" />
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="edit-task-event-name">Task / Event</label>
                            <input class="form-control n-b-r"
                                    type="text"
                                    id="edit-task-event-name"
                                    name="edit-task-event-name"
                                    value=""
                                    placeholder="Enter Task / Event..."
                            />
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-top-0">
                <button type="button" class="btn btn-modal-close btn-w-normal" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-grad btn-w-normal" id="btn-update-task-event">Update</button>
            </div>
        </div>
    </div>
</div>