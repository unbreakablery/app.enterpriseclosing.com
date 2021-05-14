<form class="form-inline mt-4" action="{{ route('tasks.add') }}" method="POST" autocomplete="off" id="tasks-form">
	@csrf
	<h3 class="mb-0">Tasks To Complete</h3>
	<div class="table-responsive table-wrapper mt-4 mb-4">
		<table class="table table-hover datatable w-100" id="table-2">
			<thead class="thead-dark">
				<tr>
					<th scope="col" class="text-center">Action + Step</th>
					<th scope="col" class="text-center">From / To / Account / Opportunity</th>
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
					<td>{{ $task['action'] }} {{ $task['step'] }}</td>
					<td class="text-center">
						@if (!empty($task['from_to_account']))
							{{ $task['from_to_account'] }}
						@else
							{{ $task['opportunity'] }}
						@endif
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
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="action" id="ts-1-rg-add" value="Add" required>
			<label class="form-check-label" for="ts-1-rg-add">
				Add
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="action" id="ts-1-rg-approve" value="Approve">
			<label class="form-check-label" for="ts-1-rg-approve">
				Approve
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="action" id="ts-1-rg-call" value="Call">
			<label class="form-check-label" for="ts-1-rg-call">
				Call
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="action" id="ts-1-rg-change" value="Change">
			<label class="form-check-label" for="ts-1-rg-change">
				Change
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="action" id="ts-1-rg-close" value="Close">
			<label class="form-check-label" for="ts-1-rg-close">
				Close
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="action" id="ts-1-rg-create" value="Create">
			<label class="form-check-label" for="ts-1-rg-create">
				Create
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="action" id="ts-1-rg-decline" value="Decline">
			<label class="form-check-label" for="ts-1-rg-decline">
				Decline
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="action" id="ts-1-rg-do" value="Do">
			<label class="form-check-label" for="ts-1-rg-do">
				Do
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="action" id="ts-1-rg-email" value="Email">
			<label class="form-check-label" for="ts-1-rg-email">
				Email
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="action" id="ts-1-rg-get" value="Get">
			<label class="form-check-label" for="ts-1-rg-get">
				Get
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="action" id="ts-1-rg-plan" value="Plan">
			<label class="form-check-label" for="ts-1-rg-plan">
				Plan
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="action" id="ts-1-rg-request" value="Request">
			<label class="form-check-label" for="ts-1-rg-request">
				Request
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="action" id="ts-1-rg-research" value="Research">
			<label class="form-check-label" for="ts-1-rg-research">
				Research
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="action" id="ts-1-rg-review" value="Review">
			<label class="form-check-label" for="ts-1-rg-review">
				Review
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="action" id="ts-1-rg-schedule" value="Schedule">
			<label class="form-check-label" for="ts-1-rg-schedule">
				Schedule
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="action" id="ts-1-rg-send" value="Send">
			<label class="form-check-label" for="ts-1-rg-send">
				Send
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="action" id="ts-1-rg-share" value="Share">
			<label class="form-check-label" for="ts-1-rg-share">
				Share
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="action" id="ts-1-rg-update" value="Update">
			<label class="form-check-label" for="ts-1-rg-update">
				Update
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="action" id="ts-1-rg-other" value="">
			<input type="text" class="form-control mr-20" aria-label="Text input with radio button" placeholder="Other" name="ts-1-other" id="ts-1-other">
		</div>
	</div>
	
	<h3 id="step-label" data-toggle="tooltip" data-placement="right" title="Required field!">Step</h3>
	<div class="row task-section col-md-12 col-sm-12 mb-4" id="ts-2">
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-account" value="Account" required>
			<label class="form-check-label" for="ts-2-rg-account">
				Account
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-agreement" value="Agreement">
			<label class="form-check-label" for="ts-2-rg-agreement">
				Agreement
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-business-case" value="Business Case">
			<label class="form-check-label" for="ts-2-rg-business-case">
				Business Case
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-calendar-invite" value="Calendar Invite">
			<label class="form-check-label" for="ts-2-rg-calendar-invite">
				Calendar Invite
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-case-study" value="Case Study">
			<label class="form-check-label" for="ts-2-rg-case-study">
				Case Study
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-closed-won-emails" value="Closed Won Emails">
			<label class="form-check-label" for="ts-2-rg-closed-won-emails">
				Closed Won Emails
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-custom-video" value="Custom Video">
			<label class="form-check-label" for="ts-2-rg-custom-video">
				Custom Video
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-demo" value="Demo">
			<label class="form-check-label" for="ts-2-rg-demo">
				Demo
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-dollar-value" value="Dollar Value (CRM)">
			<label class="form-check-label" for="ts-2-rg-dollar-value">
				Dollar Value (CRM)
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-ebr" value="EBR">
			<label class="form-check-label" for="ts-2-rg-ebr">
				EBR
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-exec-intro" value="Exec Intro">
			<label class="form-check-label" for="ts-2-rg-exec-intro">
				Exec Intro
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-fee-presentation" value="Fee Presentation">
			<label class="form-check-label" for="ts-2-rg-fee-presentation">
				Fee Presentation
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-forecast" value="Forecast (CRM)">
			<label class="form-check-label" for="ts-2-rg-forecast">
				Forecast (CRM)
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-invoice" value="Invoice">
			<label class="form-check-label" for="ts-2-rg-invoice">
				Invoice
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-its-docs" value="ITS Docs">
			<label class="form-check-label" for="ts-2-rg-its-docs">
				ITS Docs
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-message" value="Message">
			<label class="form-check-label" for="ts-2-rg-message">
				Message
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-meddpicc" value="MEDDPICC (CRM)">
			<label class="form-check-label" for="ts-2-rg-meddpicc">
				MEDDPICC (CRM)
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-meeting" value="Meeting">
			<label class="form-check-label" for="ts-2-rg-meeting">
				Meeting
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-msa" value="MSA">
			<label class="form-check-label" for="ts-2-rg-msa">
				MSA
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-nda" value="NDA">
			<label class="form-check-label" for="ts-2-rg-nda">
				NDA
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-next-steps" value="Next Steps (CRM)">
			<label class="form-check-label" for="ts-2-rg-next-steps">
				Next Steps (CRM)
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-person-attendees" value="Person / Attendees">
			<label class="form-check-label" for="ts-2-rg-person-attendees">
				Person / Attendees
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-poc" value="PoC">
			<label class="form-check-label" for="ts-2-rg-poc">
				PoC
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-pov" value="PoV">
			<label class="form-check-label" for="ts-2-rg-pov">
				PoV
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-pr" value="PR">
			<label class="form-check-label" for="ts-2-rg-pr">
				PR
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-project" value="Project">
			<label class="form-check-label" for="ts-2-rg-project">
				Project
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-red-flags" value="Red Flags (CRM)">
			<label class="form-check-label" for="ts-2-rg-red-flags">
				Red Flags (CRM)
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-security-docs" value="Security Docs">
			<label class="form-check-label" for="ts-2-rg-security-docs">
				Security Docs
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-slides" value="Slides">
			<label class="form-check-label" for="ts-2-rg-slides">
				Slides
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-soe" value="SoE">
			<label class="form-check-label" for="ts-2-rg-soe">
				SoE
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-stage" value="Stage (CRM)">
			<label class="form-check-label" for="ts-2-rg-stage">
				Stage (CRM)
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-ve-report" value="VE Report">
			<label class="form-check-label" for="ts-2-rg-ve-report">
				VE Report
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-video" value="Video">
			<label class="form-check-label" for="ts-2-rg-video">
				Video
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-whats-changed" value="What's Changed (CRM)">
			<label class="form-check-label" for="ts-2-rg-whats-changed">
				What's Changed (CRM)
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-white-paper" value="White Paper">
			<label class="form-check-label" for="ts-2-rg-white-paper">
				White Paper
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="radio" name="step" id="ts-2-rg-other" value="">
			<input type="text" class="form-control mr-20" aria-label="Text input with radio button" placeholder="Other" name="ts-2-other" id="ts-2-other">
		</div>
	</div>

	<div class="row task-section col-md-12 col-sm-12 mb-4">
		<div class="col-20" id="ts-3">
			<h3 id="ts-3-from-to-label" data-toggle="tooltip" data-placement="top" title="Required this or opportunity!">From / To / Account</h3>
			<div class="row task-section col-md-12 col-sm-12">
				<div class="input-group w-100">
					<input type="text" class="form-control" aria-label="From / To / Account" id="ts-3-from-to" name="from-to-account" placeholder="From / To / Account..." >
				</div>
			</div>
		</div>
		<div class="col-20" id="ts-6">
			<h3 id="ts-3-from-to-label" data-toggle="tooltip" data-placement="top" title="Required this or from/to/account!">Opportunity</h3>
			<div class="row task-section col-md-12 col-sm-12">
				<div class="input-group w-100">
					<input type="text" class="form-control" placeholder="Opportunity..." aria-label="Opportunity" aria-describedby="ts-6-opportunity" id="ts-6-opportunity" name="opportunity" >
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
		<div class="col-lg-4 col-md-4 col-sm-4 n-p-lr" id="ts-7">
			<h3 id="priority-label" data-toggle="tooltip" data-placement="left" title="Required field!">Priority</h3>
			<div class="row task-section col-md-12 col-sm-12">
				<div class="form-check col-md-3 col-sm-3 mr-4 mw-unset">
					<input class="form-check-input" type="radio" name="priority" id="ts-7-rg-high" value="1" required>
					<label class="form-check-label" for="ts-7-rg-high">
						High
					</label>
				</div>
				<div class="form-check col-md-3 col-sm-3 mr-4 mw-unset">
					<input class="form-check-input" type="radio" name="priority" id="ts-7-rg-medium" value="2">
					<label class="form-check-label" for="ts-7-rg-medium">
						Medium
					</label>
				</div>
				<div class="form-check col-md-3 col-sm-3 mr-4 mw-unset">
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
				<button type="button" class="btn btn-light n-b-r text-uppercase w-100" id="btn-create-task">
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
