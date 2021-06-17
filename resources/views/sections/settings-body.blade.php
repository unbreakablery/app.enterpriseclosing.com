<h3 class="text-uppercase font-weight-bold mt-4 mb-4">Settings</h3>
<form class="main-info" action="{{ route('settings.store.general') }}" method='post' autocomplete="off">
    @csrf
    <input type="hidden" name="user_id" value="{{ $user->id }}" />
    <h3>General Settings</h3>
    <div class="row col-lg-12 col-md-12 col-sm-12 mt-2">
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
                <label for="password">New Password</label>
                <input class="form-control n-b-r @error('password') is-invalid @enderror"
                        type="password"
                        id="password"
                        name="password"
                        value="{{ old('password') }}"
                        placeholder="You can enter new password..."
                />
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6">
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input class="form-control n-b-r @error('password') is-invalid @enderror"
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        value="{{ old('password_confirmation') }}"
                        placeholder="Please enter confirmation password..."
                />
                @error('confirmation')
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
            <div class="form-group">
                <button type="submit" class="btn btn-dark n-b-r col-lg-2 col-md-3 col-sm-6" id="btn-save-general-settings">
                    Save Settings
                </button>
            </div>
        </div>
    </div>
</form>

<h3 class="mt-4 text-uppercase" style="font-size: 1.3rem; font-weight: 600;">Settings Per Page</h3>
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
                <div class="form-check col-20">
                    <a href="javascript:void(0)" id="check-all-actions" class="select-all ml-2 mr-2">Check All</a>
                    <span class="select-all-slash">/</span>
                    <a href="javascript:void(0)" id="uncheck-all-actions" class="select-all ml-2">Uncheck All</a>
                </div>
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
                </div>
                
                <h3>Step</h3>
                <div class="form-check col-20">
                    <a href="javascript:void(0)" id="check-all-steps" class="select-all ml-2 mr-2">Check All</a>
                    <span class="select-all-slash">/</span>
                    <a href="javascript:void(0)" id="uncheck-all-steps" class="select-all ml-2">Uncheck All</a>
                </div>
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
                    <button type="submit" class="btn btn-dark col-20 col-sm-3 n-b-r" id="btn-save-settings">
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
                    <button type="submit" class="btn btn-dark col-20 col-sm-3 n-b-r" id="btn-save-outbound-settings">
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
            <form id="form_opportunities_setting" class="form-inline mt-4" action="" method='post' autocomplete="off">
                @csrf
                <div class="row task-section col-md-12 col-sm-12 mb-4" id="ts-9">
                    <button type="submit" class="btn btn-dark col-20 col-sm-3 n-b-r" id="btn-save-opportunities-settings">
                            Save Settings
                    </button>
                </div>
            </form>
        </div>
        <div class="tab-pane fade"
            id="settings-tab-scripts"
            data-idx="scripts"
            role="tabpanel"
            aria-labelledby="tab-scripts">
            <form id="form_scripts_setting" class="mt-4" action="" method='post' autocomplete="off">
                <h3>New Script</h3>
                <div class="row col-lg-12 col-md-12 col-sm-12 mt-2 mb-2">
                    <div class="col-lg-12 col-md-12 col-sm-12">
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
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="script_content">Script Content</label>
                            <textarea name="script_content"
                                id="script_content"
                                class="form-control h-px-100 n-b-r"
                                placeholder="Enter script content..."></textarea>
                        </div>
                    </div>
                    
                    <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                        <div class="form-group">
                            <button type="button" class="btn btn-dark n-b-r col-lg-2 col-md-3 col-sm-6" id="btn-save-scripts-settings">
                                Save Script
                            </button>
                        </div>
                    </div>
                </div>

                <h3>Script List</h3>
                <div class="table-responsive table-wrapper mt-2 mb-4 pr-4">
                    <div class="scripts-table-wrapper">
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
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-success n-b-r btn-edit-script" title="Edit this script">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger n-b-r btn-remove-script" title="Remove this script">
                                                <i class="bi bi-x"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr id="no-data-row">
                                        <td class="text-center text-white pt-3" colspan="3">No Scripts</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
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
                <h3>New Email</h3>
                <div class="row col-lg-12 col-md-12 col-sm-12 mt-2 mb-2">
                    <div class="col-lg-12 col-md-12 col-sm-12">
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
                    <div class="col-lg-12 col-md-12 col-sm-12">
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
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label for="body">Body</label>
                            <textarea name="body"
                                id="body"
                                class="form-control h-px-100 n-b-r"
                                placeholder="Enter body..."></textarea>
                        </div>
                    </div>
                    
                    <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                        <div class="form-group">
                            <button type="button" class="btn btn-dark n-b-r col-lg-2 col-md-3 col-sm-6" id="btn-save-emails-settings">
                                Save Email
                            </button>
                        </div>
                    </div>
                </div>

                <h3>Email List</h3>
                <div class="table-responsive table-wrapper mt-2 mb-4 pr-4">
                    <div class="emails-table-wrapper">
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
                                        <td class="text-center">
                                            <button type="button" class="btn btn-sm btn-success n-b-r btn-edit-email" title="Edit this email">
                                                <i class="bi bi-pencil-fill"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger n-b-r btn-remove-email" title="Remove this email">
                                                <i class="bi bi-x"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    <tr id="no-data-row">
                                        <td class="text-center text-white pt-3" colspan="4">No Emails</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
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
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <h3>New Main Skill</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="main_skill_name">Main Skill Name</label>
                                            <input class="form-control n-b-r"
                                                    type="text"
                                                    id="main_skill_name"
                                                    name="main_skill_name"
                                                    value=""
                                                    placeholder="Enter main skill name..."
                                                    required
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-dark n-b-r col-lg-2 col-md-3 col-sm-6" id="btn-save-main-skill-settings">
                                                Save Skill
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9 col-md-8 col-sm-6">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <h3>New Sub Skill</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="main_skill">Main Skill</label>
                                            <select name="main_skill"
                                                id="main_skill"
                                                class="form-control n-b-r">
                                            @foreach ($skillSetting as $skill)
                                                <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="sub_skill_name">Sub Skill Name</label>
                                            <input class="form-control n-b-r"
                                                    type="text"
                                                    id="sub_skill_name"
                                                    name="sub_skill_name"
                                                    value=""
                                                    placeholder="Enter sub skill name..."
                                                    required
                                            />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <button type="button" class="btn btn-dark n-b-r col-lg-2 col-md-3 col-sm-6" id="btn-save-sub-skill-settings">
                                                Save Skill
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <h3>Skills</h3>
                <div class="table-responsive table-wrapper mt-2 mb-4 pr-4">
                    <div class="skills-table-wrapper">
                        <table class="table table-hover table-bordered w-100 mb-0" id="skills-table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col" class="no-sort pl-2 pr-2" width="30%">Main Skill</th>
                                    <th scope="col" class="no-sort pl-2 pr-2">Sub Skills</th>
                                    <th scope="col" class="text-center no-sort pl-2 pr-2" width="70">Actions</th>
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
                                            <td class="text-center text-white pl-2 pr-2 align-middle" rowspan="{{ count($skill->sub_skills->ids) }}">
                                                {{ $skill->name }}
                                                <button type="button" class="btn btn-sm btn-success n-b-r btn-edit-main-skill ml-2" title="Edit this skill">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger n-b-r btn-remove-main-skill" title="Remove this skill">
                                                    <i class="bi bi-x"></i>
                                                </button>
                                            </td>
                                            @endif
                                            <td class="text-white pl-2 pr-2">{{ $skill->sub_skills->names[$idx] }}</td>
                                            <td class="text-center">
                                                <button type="button" class="btn btn-sm btn-success n-b-r btn-edit-sub-skill" title="Edit this skill">
                                                    <i class="bi bi-pencil-fill"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm btn-danger n-b-r btn-remove-sub-skill" title="Remove this skill">
                                                    <i class="bi bi-x"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endforeach
                                @else
                                    <tr id="no-data-row">
                                        <td class="text-center text-white pt-3 pb-3" colspan="3">No Skills</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
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

<!-- Edit Script Modal -->
<div class="modal fade" id="edit-script-modal" tabindex="-1" role="dialog" aria-labelledby="edit-script-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content n-b-r text-dark">
            <div class="modal-header">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="btn-update-script">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Email Modal -->
<div class="modal fade" id="edit-email-modal" tabindex="-1" role="dialog" aria-labelledby="edit-email-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content n-b-r text-dark">
            <div class="modal-header">
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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-success" id="btn-update-email">Update</button>
            </div>
        </div>
    </div>
</div>