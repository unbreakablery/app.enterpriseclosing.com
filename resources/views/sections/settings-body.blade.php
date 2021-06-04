<h3 class="text-uppercase font-weight-bold mt-4">Settings</h3>
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
        <li class="nav-item" role="presentation">
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
        </li>
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
        <li class="nav-item" role="presentation">
            <a class="nav-link"
                id="tab-analytics"
                data-toggle="tab"
                href="#settings-tab-analytics"
                role="tab"
                aria-controls="settings-tab-analytics"
                aria-selected="true">
                Analytics
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
            <form id="form_setting" class="form-inline mt-4" action="{{ route('settings.store')}}" method='post' autocomplete="off">
                @csrf
                <h3>Action</h3>
                <div class="form-check col-20">
                    <a href="javascript:void(0)" id="select-all-actions" class="select-all ml-2">Select All</a>
                </div>
                <div class="row task-section col-md-12 col-sm-12 mb-4" id="ts-1">
                    @foreach ($actions as $action)
                    <div class="form-check col-20">
                        <input class="form-check-input input-action" type="checkbox" name="actions[]" 
                            id="ts-{{$action->id}}-rg-add" 
                            value="{{$action->id}}"
                            @foreach($settings as $setting)
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
                    <a href="javascript:void(0)" id="select-all-steps" class="select-all ml-2">Select All</a>
                </div>
                <div class="row task-section col-md-12 col-sm-12 mb-4" id="ts-2">
                    @foreach ($steps as $step)
                    <div class="form-check col-20">
                        <input class="form-check-input input-step" type="checkbox" name="steps[]" 
                            id="ts-{{$step->id}}-rg-account" 
                            value="{{$step->id}}"
                            @foreach($settings as $setting)
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
                    <div class="col-20">
                        <ul id="tabs" class="nav nav-tabs" role="tablist" >
                            @foreach ($steps as $step)
                            <li id="item-{{$step->id}}" 
                                class="nav-item suggest-item item-{{$step->id}} 
                                @php
                                    $flag = false;
                                    foreach($settings as $setting) {
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
                    </div>		
                    <div id="content" class="tab-content" role="tablist">
                        @foreach ($steps as $step)
                        <div id="pane-{{$step->id}}" class="tab-pane fade show {{( count($step_setting) != 0) ? (( $step_setting[0]->section_id == $step->id ) ? 'active' : '') : ''}}" role="tabpanel" aria-labelledby="tab_{{$step->id}}">
                            @foreach ($steps as $substep)
                            <div class="form-check col-3">
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
            <form id="form_scripts_setting" class="form-inline mt-4" action="" method='post' autocomplete="off">
                @csrf
                <div class="row task-section col-md-12 col-sm-12 mb-4" id="ts-9">
                    <button type="submit" class="btn btn-dark col-20 col-sm-3 n-b-r" id="btn-save-scripts-settings">
                            Save Settings
                    </button>
                </div>
            </form>
        </div>
        <div class="tab-pane fade"
            id="settings-tab-emails"
            data-idx="emails"
            role="tabpanel"
            aria-labelledby="tab-emails">
            <form id="form_emails_setting" class="form-inline mt-4" action="" method='post' autocomplete="off">
                @csrf
                <div class="row task-section col-md-12 col-sm-12 mb-4" id="ts-9">
                    <button type="submit" class="btn btn-dark col-20 col-sm-3 n-b-r" id="btn-save-emails-settings">
                            Save Settings
                    </button>
                </div>
            </form>
        </div>
        <div class="tab-pane fade"
            id="settings-tab-contacts"
            data-idx="contacts"
            role="tabpanel"
            aria-labelledby="tab-contacts">
            <form id="form_contacts_setting" class="form-inline mt-4" action="" method='post' autocomplete="off">
                @csrf
                <div class="row task-section col-md-12 col-sm-12 mb-4" id="ts-9">
                    <button type="submit" class="btn btn-dark col-20 col-sm-3 n-b-r" id="btn-save-contacts-settings">
                            Save Settings
                    </button>
                </div>
            </form>
        </div>
        <div class="tab-pane fade"
            id="settings-tab-resources"
            data-idx="resources"
            role="tabpanel"
            aria-labelledby="tab-resources">
            <form id="form_resources_setting" class="form-inline mt-4" action="" method='post' autocomplete="off">
                @csrf
                <div class="row task-section col-md-12 col-sm-12 mb-4" id="ts-9">
                    <button type="submit" class="btn btn-dark col-20 col-sm-3 n-b-r" id="btn-save-resources-settings">
                            Save Settings
                    </button>
                </div>
            </form>
        </div>
        <div class="tab-pane fade"
            id="settings-tab-skills"
            data-idx="skills"
            role="tabpanel"
            aria-labelledby="tab-skills">
            <form id="form_skills_setting" class="form-inline mt-4" action="" method='post' autocomplete="off">
                @csrf
                <div class="row task-section col-md-12 col-sm-12 mb-4" id="ts-9">
                    <button type="submit" class="btn btn-dark col-20 col-sm-3 n-b-r" id="btn-save-skills-settings">
                            Save Settings
                    </button>
                </div>
            </form>
        </div>
        <div class="tab-pane fade"
            id="settings-tab-analytics"
            data-idx="analytics"
            role="tabpanel"
            aria-labelledby="tab-analytics">
            <form id="form_analytics_setting" class="form-inline mt-4" action="" method='post' autocomplete="off">
                @csrf
                <div class="row task-section col-md-12 col-sm-12 mb-4" id="ts-9">
                    <button type="submit" class="btn btn-dark col-20 col-sm-3 n-b-r" id="btn-save-analytics-settings">
                            Save Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
