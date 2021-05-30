<?php

use Illuminate\Database\Seeder;

use App\Models\Step;

class StepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $steps = array('Account', 'Agreement', 'Business Case', 'Calendar Invite', 'Case Study', 'Closed Won Emails',
        'Custom Video', 'Demo', 'Dollar Value (CRM)', 'EBR', 'Exec Intro', 'Fee Presentation', 'Forecast (CRM)',
        'Invoice', 'ITS Docs', 'Message', 'MEDDPICC (CRM)', 'Meeting', 'MSA', 'NDA', 'Next Steps (CRM)', 'Person / Attendees',
        'PoC', 'PoV', 'PR', 'Project', 'Red Flags (CRM)', 'Security Docs', 'Slides', 'SoE', 'Stage (CRM)',
        'VE Report', 'Video', "What's Changed (CRM)", 'White Paper');

        foreach ($steps as $step) {
            Step::create([
                'name' => $step
            ]);
        }
    }
}
