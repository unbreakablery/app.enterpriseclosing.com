<form class="form-inline mt-4" action="{{ route('tasks.add') }}" method="POST" autocomplete="off" id="tasks-form">
	@csrf
	<h3 class="mb-0">Tasks To Complete</h3>
	<div class="table-responsive table-wrapper mt-4 mb-4">
		<table class="table table-hover datatable w-100" id="task-table">
			<thead class="thead-dark">
				<tr>
					<th scope="col" class="text-center">Action + Step</th>
					<th scope="col" class="text-center">Person / Account / Opportunity</th>
					<th scope="col" class="text-center">Note</th>
					<th scope="col" class="text-center">By</th>
					<th scope="col" class="text-center">Priority</th>
					<th scope="col" class="text-center no-sort">Result</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($tasks as $task)
				@php
					$class_name = '';
					$priority_name = '';
					
					if ($task['priority'] == '1') {
						$class_name = 'bg-danger text-white';
						$priority_name = 'High';
					} elseif ($task['priority'] == '2') {
						$class_name = 'bg-warning';
						$priority_name = 'Medium';
					} elseif ($task['priority'] == '3') {
						$class_name = 'bg-light';
						$priority_name = 'Normal';
					} else {
						$class_name = 'bg-light';
						$priority_name = '';
					}
				@endphp
				<tr class="{{ $class_name }}">
					<td>{{ $task['action_name'] }} {{ $task['step_name'] }}</td>
					<td class="text-center">
						@if (empty($task['opportunity']))
							{{ $task['person_account'] }}
						@else
							{{ $task['opportunity'] }}
						@endif
					</td>
					<td>
						{{ $task['note'] }}
					</td>
					<td class="text-center">
						@if (!empty($task['by_date']))
							{{ date("d-m-Y", strtotime($task['by_date'])) }}
						@endif
					</td>
					<td class="text-center">
						{{ $priority_name }}
					</td>
					<td class="text-center">
						<button type="button" class="btn btn-sm btn-task-c-s btn-dark btn-skip" data-id="{{ $task['id'] }}">Skip</button>
						<button type="button" class="btn btn-sm btn-task-c-s btn-success btn-done" data-id="{{ $task['id'] }}">Done</button>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<h3 id="action-label" data-toggle="tooltip" data-placement="right" title="Required field!">Action</h3>
	<div class="row task-section col-md-12 col-sm-12 mb-4" id="ts-1">
		@foreach ($settings as $setting)
			@foreach ($actions as $action)
				@if ($setting->section_type == 1 && $action->id == $setting->section_id)
				<div class="form-check col-20">
					<input class="form-check-input" type="radio" name="action" 
						id="action-{{ $action->id }}" 
						value="{{ $action->id }}" 
						required />
					<label class="form-check-label" for="action-{{ $action->id }}">
						{{ $action->name }}
					</label>
				</div>
				@endif
			@endforeach
		@endforeach
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="action" id="action-other" value="">
			<input type="text" class="form-control mr-20" aria-label="Text input with radio button" placeholder="Other" name="action-other-name" id="action-other-name">
		</div>
	</div>
	
	<h3 id="step-label" data-toggle="tooltip" data-placement="right" title="Required field!">Step</h3>
	<div class="row task-section col-md-12 col-sm-12 mb-4" id="ts-2">
		@foreach ($settings as $setting)
			@foreach ($steps as $step)
				@if ($setting->section_type == 2 && $step->id == $setting->section_id)
				<div class="form-check col-20">
					<input class="form-check-input" type="radio" name="step" 
						id="step-{{ $step->id }}" 
						value="{{ $step->id }}" 
						required />
					<label class="form-check-label" for="step-{{ $step->id }}">
						{{ $step->name }}
					</label>
				</div>
				@endif
			@endforeach
		@endforeach
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="step-other" value="">
			<input type="text" class="form-control mr-20" aria-label="Text input with radio button" placeholder="Other" name="step-other-name" id="step-other-name">
		</div>
	</div>

	<div class="row task-section col-md-12 col-sm-12 mb-4">
		<div class="col-20" id="ts-3">
			<h3 id="ts-3-person-account-label" data-toggle="tooltip" data-placement="top" title="Required this or opportunity!">Person / Account</h3>
			<div class="row task-section col-md-12 col-sm-12">
				<div class="input-group w-100">
					<input type="text" class="form-control" aria-label="Person / Account" id="ts-3-person-account" name="person-account" placeholder="Person / Account..." >
				</div>
			</div>
		</div>
		<div class="col-20" id="ts-6">
			<h3 id="ts-3-person-account-label" data-toggle="tooltip" data-placement="top" title="Required this or person/account!">Opportunity</h3>
			<div class="row task-section col-md-12 col-sm-12">
				<div class="input-group w-100">
					<input type="text" class="form-control" placeholder="Opportunity..." aria-label="Opportunity" aria-describedby="ts-6-opportunity" id="ts-6-opportunity" name="opportunity" >
				</div>
			</div>
		</div>
		<div class="col-20" id="ts-6">
			<h3 id="ts-11-not-label" data-toggle="tooltip" data-placement="top" title="Required field!">Note</h3>
			<div class="row task-section col-md-12 col-sm-12">
				<div class="input-group w-100">
					<input type="text" class="form-control" placeholder="Note..." aria-label="Note" aria-describedby="ts-11-note" id="ts-11-note" name="note" >
				</div>
			</div>
		</div>
		<div class="col-20" id="ts-4">
			<h3 id="ts-4-by-date-label" data-toggle="tooltip" data-placement="left" title="Required field!">By</h3>
			<div class="row task-section col-md-12 col-sm-12">
				<div class="input-group w-100">
					<input type="text" class="form-control date" aria-label="By Date" id="ts-4-by-date" name="by-date" placeholder="dd-mm-yyyy" required>
				</div>
			</div>
		</div>
		<div class="col-20" id="ts-7">
			<h3 id="priority-label" data-toggle="tooltip" data-placement="left" title="Required field!">Priority</h3>
			<div class="row task-section col-md-12 col-sm-12">
				<div class="form-check">
					<input class="form-check-input" type="radio" name="priority" id="ts-7-rg-high" value="1" required>
					<label class="form-check-label mr-4" for="ts-7-rg-high">
						High
					</label>
				<!-- </div>
				<div class="form-check col-md-4 col-sm-4 mr-1 mw-unset"> -->
					<input class="form-check-input" type="radio" name="priority" id="ts-7-rg-medium" value="2">
					<label class="form-check-label mr-4" for="ts-7-rg-medium">
						Medium
					</label>
				<!-- </div>
				<div class="form-check col-md-4 col-sm-4 mr-1 mw-unset"> -->
					<input class="form-check-input" type="radio" name="priority" id="ts-7-rg-normal" value="3">
					<label class="form-check-label" for="ts-7-rg-normal">
						Normal
					</label>
				</div>
			</div>
		</div>
	</div>

	<div class="row task-section col-md-12 col-sm-12 mb-4" id="ts-9">
		
		<div class="col-20" id="ts-3">
			<div class="row task-section col-md-12 col-sm-12">
				<div class="input-group w-100">
				<button type="button" class="btn n-b-r text-uppercase w-100" id="btn-create-task">
					Create Task
				</button>
				</div>
			</div>
		</div>
	</div>

	<!-- <div class="table-responsive table-wrapper mt-4 mb-4">
		<table class="table table-hover datatable w-100" id="table-1">
			<thead class="thead-dark">
				<tr>
					<th scope="col" class="text-center">Created By User</th>
					<th scope="col" class="text-center">Date Created</th>
					<th scope="col" class="text-center">Date Modified</th>
					<th scope="col" class="text-center">Date Completed</th>
					<th scope="col" class="text-center">Days To Completed</th>
				</tr>
			</thead>
			<tbody>
				<tr class="bg-danger text-white">
					<td>Mark</td>
					<td class="text-center">01-05-2021</td>
					<td class="text-center">10-05-2021</td>
					<td class="text-center">11-05-2021</td>
					<td class="text-right">10</td>
				</tr>
				<tr class="bg-light">
					<td>Anthony</td>
					<td class="text-center">09-05-2021</td>
					<td class="text-center">10-05-2021</td>
					<td class="text-center">11-05-2021</td>
					<td class="text-right">2</td>
				</tr>
				<tr class="bg-warning">
					<td>Jacob</td>
					<td class="text-center">21-04-2021</td>
					<td class="text-center">10-05-2021</td>
					<td class="text-center">11-05-2021</td>
					<td class="text-right">20</td>
				</tr>
				<tr class="bg-danger text-white">
					<td>Alex</td>
					<td class="text-center">01-05-2021</td>
					<td class="text-center">10-05-2021</td>
					<td class="text-center">11-05-2021</td>
					<td class="text-right">10</td>
				</tr>
				<tr class="bg-light">
					<td>Emma</td>
					<td class="text-center">09-05-2021</td>
					<td class="text-center">10-05-2021</td>
					<td class="text-center">11-05-2021</td>
					<td class="text-right">2</td>
				</tr>
				<tr class="bg-warning">
					<td>Tony</td>
					<td class="text-center">21-04-2021</td>
					<td class="text-center">10-05-2021</td>
					<td class="text-center">11-05-2021</td>
					<td class="text-right">20</td>
				</tr>
				<tr class="bg-danger text-white">
					<td>James</td>
					<td class="text-center">01-05-2021</td>
					<td class="text-center">10-05-2021</td>
					<td class="text-center">11-05-2021</td>
					<td class="text-right">10</td>
				</tr>
				<tr class="bg-light">
					<td>Toby</td>
					<td class="text-center">09-05-2021</td>
					<td class="text-center">10-05-2021</td>
					<td class="text-center">11-05-2021</td>
					<td class="text-right">2</td>
				</tr>
				<tr class="bg-warning">
					<td>Marco</td>
					<td class="text-center">21-04-2021</td>
					<td class="text-center">10-05-2021</td>
					<td class="text-center">11-05-2021</td>
					<td class="text-right">20</td>
				</tr>
				<tr class="bg-warning">
					<td>Andrew</td>
					<td class="text-center">21-04-2021</td>
					<td class="text-center">10-05-2021</td>
					<td class="text-center">11-05-2021</td>
					<td class="text-right">20</td>
				</tr>
			</tbody>
		</table>
	</div> -->
</form>

<!-- Modal -->
<div class="modal fade" id="task-add-modal" tabindex="-1" role="dialog" aria-labelledby="task-add-modal-title" aria-hidden="true">
	<div class="modal-dialog modal-xl modal-dialog-centered" role="document">
		<div class="modal-content n-b-r text-dark">
			<div class="modal-header">
				<h5 class="modal-title" id="task-add-modal-header-title">Question</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<h3>Would you like to add these tasks too?</h3>
				<div class="row additional-tasks">
					@if (count($suggest_steps) > 0)
						@foreach ($suggest_steps as $idx => $suggest_step)
						<div class="form-row pt-1 pb-1 additional-task-item-{{ $idx }}">
							<div class="col">
								<select name="suggest-action-{{ $idx }}" id="suggest-action-{{ $idx }}" class="form-control">
									@foreach ($suggest_actions as $suggest_action)
										<option value="{{ $suggest_action->id }}" @if(old('saved_action') == $suggest_action->id) selected @endif>{{ $suggest_action->name }}</option>
									@endforeach
								</select>
							</div>
							<div class="col">
								<input type="hidden" value="{{ $suggest_step->id }}" id="suggest-step-{{ $idx }}" name="suggest-step-{{ $idx }}"/>
								<input type="text" class="form-control" value="{{ $suggest_step->name }}" id="suggest-step-name-{{ $idx }}" name="suggest-step-name-{{ $idx }}" readonly />
							</div>
							<div class="col">
								<input type="text" class="form-control" value="{{ old('saved_person_account') }}" id="suggest-person-account-{{ $idx }}" name="suggest-person-account-{{ $idx }}" readonly placeholder="Person/Account..."/>
							</div>
							<div class="col">
								<input type="text" class="form-control" value="{{ old('saved_opportunity') }}" id="suggest-opportunity-{{ $idx }}" name="suggest-opportunity-{{ $idx }}" readonly placeholder="Opportunity..."/>
							</div>
							<div class="col">
								<input type="text" class="form-control" id="suggest-note-{{ $idx }}" name="suggest-note-{{ $idx }}" placeholder="Note..." />
							</div>
							<div class="col">
								<input type="text" class="form-control date" id="suggest-by-{{ $idx }}" name="suggest-by-{{ $idx }}" placeholder="dd-mm-yyyy" />
							</div>
							<div class="col">
								<select name="suggest-priority-{{ $idx }}" id="suggest-priority-{{ $idx }}" class="form-control">
									<option value="1">High</option>
									<option value="2">Medium</option>
									<option value="3">Normal</option>
								</select>
							</div>
							<div class="btn-suggest-save-wrapper">
								<button type="button" class="btn btn-success btn-suggest-save" data-id="{{ $idx }}">Save</button>			
							</div>
						</div>
						@endforeach
					@else
						<p class="text-center w-100">
							No suggested additional tasks!
						</p>
					@endif
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" data-dismiss="modal">That's All For Now</button>
			</div>
		</div>
	</div>
</div>
