<h1 class="mt-4">Settings</h1>
<form id="form_setting" class="form-inline mt-4" action="{{ route('settings.store')}}" method='post' autocomplete="off">
	@csrf
	<h3>Action</h3>
	<div class="form-check col-20">
		<input class="form-check-input select-all" type="checkbox" 
				name="select-all-actions" 
				id="select-all-actions" 
				title="Select/Deselect All" 
		/>
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
		<input class="form-check-input select-all" type="checkbox" 
				name="select-all-steps" 
				id="select-all-steps" 
				title="Select/Deselect All" 
		/>
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
