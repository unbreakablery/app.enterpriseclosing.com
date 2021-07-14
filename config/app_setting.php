<?php

return  [
    'roles' => [
        '0' => 'super_admin',
        '1' => 'administrator',
        '2' => 'user'
    ],
    'opportunities' => [
        'input_fields' => [
            'usecase'           => ['name' => 'Use-Case', 'type' => ''],
            'emp_num'           => ['name' => 'No. of Employees', 'type' => ''],
            'close_date'        => ['name' => 'Close Date', 'type' => 'date'],
            'stage'             => ['name' => 'Stage', 'type' => ''],
            'next_step'         => ['name' => 'Next Step', 'type' => ''],
            'amount'            => ['name' => 'Amount', 'type' => ''],
            'currency'          => ['name' => 'Currency', 'type' => ''],
            'lead_source'       => ['name' => 'Lead Source', 'type' => ''],
            'compelling_event'  => ['name' => 'Compelling Event', 'type' => ''],
            'competition'       => ['name' => 'Competition', 'type' => ''],
            'what_new_changed'  => ['name' => 'What\'s New / Changed', 'type' => ''],
            'red_flags'         => ['name' => 'Red Flags', 'type' => ''],
            'folder_link'       => ['name' => 'Link to Folder', 'type' => '']
        ]
    ]
];