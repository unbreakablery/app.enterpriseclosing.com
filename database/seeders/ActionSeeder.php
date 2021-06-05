<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Action;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $actions = array('Add', 'Approve', 'Call', 'Change', 'Close', 'Create', 'Decline', 'Do', 'Email',
        'Get', 'Plan', 'Request', 'Research', 'Review', 'Schedule', 'Send', 'Share', 'Update');
        foreach ($actions as $action) {
            Action::create([
                'name' => $action
            ]);
        }
    }
}
