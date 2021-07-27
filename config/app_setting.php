<?php

return  [
    'roles' => [
        '0' => 'Removed User',
        '1' => 'Super Admin',
        '2' => 'Administrator',
        '3' => 'User'
    ],
    'permissions' => [
        'manage-user' => ['1']
    ],
    'opportunities' => [
        'input_fields' => [
            'usecase'           => ['name' => 'Use-Case', 'type' => '', 'placeholder' => ''],
            'emp_num'           => ['name' => 'No. of Employees', 'type' => '', 'placeholder' => ''],
            'close_date'        => ['name' => 'Close Date', 'type' => 'date', 'placeholder' => 'dd-mm-yyyy'],
            'stage'             => ['name' => 'Stage', 'type' => '', 'placeholder' => ''],
            'next_step'         => ['name' => 'Next Step', 'type' => '', 'placeholder' => ''],
            'amount'            => ['name' => 'Amount', 'type' => '', 'placeholder' => ''],
            'currency'          => ['name' => 'Currency', 'type' => '', 'placeholder' => ''],
            'lead_source'       => ['name' => 'Lead Source', 'type' => '', 'placeholder' => ''],
            'compelling_event'  => ['name' => 'Compelling Event', 'type' => '', 'placeholder' => ''],
            'competition'       => ['name' => 'Competition', 'type' => '', 'placeholder' => ''],
            'what_new_changed'  => ['name' => 'What\'s New / Changed', 'type' => '', 'placeholder' => ''],
            'red_flags'         => ['name' => 'Red Flags', 'type' => '', 'placeholder' => ''],
            'folder_link'       => ['name' => 'Link to Folder', 'type' => '', 'placeholder' => '']
        ]
    ]
];