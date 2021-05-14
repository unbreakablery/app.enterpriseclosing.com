<h1 class="mt-4">Settings</h1>
<form class="form-inline mt-4" action="{{ route('settings.save') }}" method="POST" autocomplete="off">
	<h3>Action</h3>
	<div class="row task-section col-md-12 col-sm-12 mb-4" id="ts-1">
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="action" id="ts-1-rg-add" value="Add" required>
			<label class="form-check-label" for="ts-1-rg-add">
				Add
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="action" id="ts-1-rg-approve" value="Approve">
			<label class="form-check-label" for="ts-1-rg-approve">
				Approve
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="action" id="ts-1-rg-call" value="Call">
			<label class="form-check-label" for="ts-1-rg-call">
				Call
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="action" id="ts-1-rg-change" value="Change">
			<label class="form-check-label" for="ts-1-rg-change">
				Change
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="action" id="ts-1-rg-close" value="Close">
			<label class="form-check-label" for="ts-1-rg-close">
				Close
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="action" id="ts-1-rg-create" value="Create">
			<label class="form-check-label" for="ts-1-rg-create">
				Create
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="action" id="ts-1-rg-decline" value="Decline">
			<label class="form-check-label" for="ts-1-rg-decline">
				Decline
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="action" id="ts-1-rg-do" value="Do">
			<label class="form-check-label" for="ts-1-rg-do">
				Do
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="action" id="ts-1-rg-email" value="Email">
			<label class="form-check-label" for="ts-1-rg-email">
				Email
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="action" id="ts-1-rg-get" value="Get">
			<label class="form-check-label" for="ts-1-rg-get">
				Get
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="action" id="ts-1-rg-plan" value="Plan">
			<label class="form-check-label" for="ts-1-rg-plan">
				Plan
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="action" id="ts-1-rg-request" value="Request">
			<label class="form-check-label" for="ts-1-rg-request">
				Request
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="action" id="ts-1-rg-research" value="Research">
			<label class="form-check-label" for="ts-1-rg-research">
				Research
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="action" id="ts-1-rg-review" value="Review">
			<label class="form-check-label" for="ts-1-rg-review">
				Review
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="action" id="ts-1-rg-schedule" value="Schedule">
			<label class="form-check-label" for="ts-1-rg-schedule">
				Schedule
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="action" id="ts-1-rg-send" value="Send">
			<label class="form-check-label" for="ts-1-rg-send">
				Send
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="action" id="ts-1-rg-share" value="Share">
			<label class="form-check-label" for="ts-1-rg-share">
				Share
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="action" id="ts-1-rg-update" value="Update">
			<label class="form-check-label" for="ts-1-rg-update">
				Update
			</label>
		</div>
	</div>
	
	<h3>Step</h3>
	<div class="row task-section col-md-12 col-sm-12 mb-4" id="ts-2">
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-account" value="Account" required>
			<label class="form-check-label" for="ts-2-rg-account">
				Account
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-agreement" value="Agreement">
			<label class="form-check-label" for="ts-2-rg-agreement">
				Agreement
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-business-case" value="Business Case">
			<label class="form-check-label" for="ts-2-rg-business-case">
				Business Case
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-calendar-invite" value="Calendar Invite">
			<label class="form-check-label" for="ts-2-rg-calendar-invite">
				Calendar Invite
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-case-study" value="Case Study">
			<label class="form-check-label" for="ts-2-rg-case-study">
				Case Study
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-closed-won-emails" value="Closed Won Emails">
			<label class="form-check-label" for="ts-2-rg-closed-won-emails">
				Closed Won Emails
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-custom-video" value="Custom Video">
			<label class="form-check-label" for="ts-2-rg-custom-video">
				Custom Video
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-demo" value="Demo">
			<label class="form-check-label" for="ts-2-rg-demo">
				Demo
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-dollar-value" value="Dollar Value (CRM)">
			<label class="form-check-label" for="ts-2-rg-dollar-value">
				Dollar Value (CRM)
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-ebr" value="EBR">
			<label class="form-check-label" for="ts-2-rg-ebr">
				EBR
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-exec-intro" value="Exec Intro">
			<label class="form-check-label" for="ts-2-rg-exec-intro">
				Exec Intro
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-fee-presentation" value="Fee Presentation">
			<label class="form-check-label" for="ts-2-rg-fee-presentation">
				Fee Presentation
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-forecast" value="Forecast (CRM)">
			<label class="form-check-label" for="ts-2-rg-forecast">
				Forecast (CRM)
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-invoice" value="Invoice">
			<label class="form-check-label" for="ts-2-rg-invoice">
				Invoice
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-its-docs" value="ITS Docs">
			<label class="form-check-label" for="ts-2-rg-its-docs">
				ITS Docs
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-message" value="Message">
			<label class="form-check-label" for="ts-2-rg-message">
				Message
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-meddpicc" value="MEDDPICC (CRM)">
			<label class="form-check-label" for="ts-2-rg-meddpicc">
				MEDDPICC (CRM)
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-meeting" value="Meeting">
			<label class="form-check-label" for="ts-2-rg-meeting">
				Meeting
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-msa" value="MSA">
			<label class="form-check-label" for="ts-2-rg-msa">
				MSA
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-nda" value="NDA">
			<label class="form-check-label" for="ts-2-rg-nda">
				NDA
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-next-steps" value="Next Steps (CRM)">
			<label class="form-check-label" for="ts-2-rg-next-steps">
				Next Steps (CRM)
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-person-attendees" value="Person / Attendees">
			<label class="form-check-label" for="ts-2-rg-person-attendees">
				Person / Attendees
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-poc" value="PoC">
			<label class="form-check-label" for="ts-2-rg-poc">
				PoC
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-pov" value="PoV">
			<label class="form-check-label" for="ts-2-rg-pov">
				PoV
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-pr" value="PR">
			<label class="form-check-label" for="ts-2-rg-pr">
				PR
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-project" value="Project">
			<label class="form-check-label" for="ts-2-rg-project">
				Project
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-red-flags" value="Red Flags (CRM)">
			<label class="form-check-label" for="ts-2-rg-red-flags">
				Red Flags (CRM)
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-security-docs" value="Security Docs">
			<label class="form-check-label" for="ts-2-rg-security-docs">
				Security Docs
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-slides" value="Slides">
			<label class="form-check-label" for="ts-2-rg-slides">
				Slides
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-soe" value="SoE">
			<label class="form-check-label" for="ts-2-rg-soe">
				SoE
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-stage" value="Stage (CRM)">
			<label class="form-check-label" for="ts-2-rg-stage">
				Stage (CRM)
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-ve-report" value="VE Report">
			<label class="form-check-label" for="ts-2-rg-ve-report">
				VE Report
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-video" value="Video">
			<label class="form-check-label" for="ts-2-rg-video">
				Video
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-whats-changed" value="What's Changed (CRM)">
			<label class="form-check-label" for="ts-2-rg-whats-changed">
				What's Changed (CRM)
			</label>
		</div>
		<div class="form-check col-20">
			<input class="form-check-input" type="checkbox" name="step" id="ts-2-rg-white-paper" value="White Paper">
			<label class="form-check-label" for="ts-2-rg-white-paper">
				White Paper
			</label>
		</div>
	</div>

	<div class="row task-section col-md-12 col-sm-12 mb-4" id="ts-9">
		<button type="submit" class="btn btn-dark col-20 col-sm-3 n-b-r" id="btn-save-settings">
			Save Settings
		</button>
	</div>
</form>
