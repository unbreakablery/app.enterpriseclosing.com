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
            'opportunity'       => [
                'name' => 'Opportunity Name', 
                'type' => '', 
                'placeholder' => '',
                'cols' => 'col-lg-6 col-md-6 col-sm-6'
            ],
            'usecase'           => [
                'name' => 'Use-Case', 
                'type' => '', 
                'placeholder' => '',
                'cols' => 'col-lg-6 col-md-6 col-sm-6'
            ],
            'emp_num'           => [
                'name' => 'No. of Employees', 
                'type' => '', 
                'placeholder' => '',
                'cols' => 'col-lg-6 col-md-6 col-sm-6'
            ],
            'close_date'        => [
                'name' => 'Close Date', 
                'type' => 'date', 
                'placeholder' => 'dd-mm-yyyy',
                'cols' => 'col-lg-6 col-md-6 col-sm-6'
            ],
            'stage'             => [
                'name' => 'Stage', 
                'type' => '', 
                'placeholder' => '',
                'cols' => 'col-lg-6 col-md-6 col-sm-6'
            ],
            'amount'            => [
                'name' => 'Amount', 
                'type' => '', 
                'placeholder' => '',
                'cols' => 'col-lg-6 col-md-6 col-sm-6'
            ],
            'currency'          => [
                'name' => 'Currency', 
                'type' => '', 
                'placeholder' => '',
                'cols' => 'col-lg-6 col-md-6 col-sm-6'
            ],
            'lead_source'       => [
                'name' => 'Lead Source', 
                'type' => '', 
                'placeholder' => '',
                'cols' => 'col-lg-6 col-md-6 col-sm-6'
            ],
            'compelling_event'  => [
                'name' => 'Compelling Event', 
                'type' => '', 
                'placeholder' => '',
                'cols' => 'col-lg-6 col-md-6 col-sm-6'
            ],
            'user_num'       => [
                'name' => 'No. of Users', 
                'type' => '', 
                'placeholder' => '',
                'cols' => 'col-lg-6 col-md-6 col-sm-6'
            ],
            'red_flags'         => [
                'name' => 'Red Flags', 
                'type' => '', 
                'placeholder' => '',
                'cols' => 'col-lg-6 col-md-6 col-sm-6'
            ],
            'opp_organisation'  => [
                'name' => 'Organisation', 
                'type' => '', 
                'placeholder' => '',
                'cols' => 'col-lg-6 col-md-6 col-sm-6'
            ],
            'next_step'         => [
                'name' => 'Next Step', 
                'type' => '', 
                'placeholder' => '',
                'cols' => 'col-lg-12 col-md-12 col-sm-12'
            ],
            'folder_link'       => [
                'name' => 'Link to Folder', 
                'type' => '', 
                'placeholder' => '',
                'cols' => 'col-lg-12 col-md-12 col-sm-12'
            ],
            'what_new_changed'  => [
                'name' => 'What\'s New / Changed', 
                'type' => 'textarea', 
                'placeholder' => '',
                'cols' => 'col-lg-12 col-md-12 col-sm-12'
            ],
            'competitive_position'  => [
                'name' => 'Competitive Position', 
                'type' => 'radio_group', 
                'placeholder' => '',
                'cols' => 'col-lg-6 col-md-6 col-sm-6'
            ],
            'progress_barometer'  => [
                'name' => 'Progress Barometer', 
                'type' => 'radio_group', 
                'placeholder' => '',
                'cols' => 'col-lg-6 col-md-6 col-sm-6'
            ],
            
        ],
        'radio_groups' => [
            'competitive_position' => [
                'unsure' => [
                    'name' => 'Unsure',
                    'type' => 'radio',
                    'value' => 1,
                    'cols' => 'col-lg-12 col-md-12 col-sm-12'
                ],
                'behind' => [
                    'name' => 'Behind',
                    'type' => 'radio',
                    'value' => 2,
                    'cols' => 'col-lg-12 col-md-12 col-sm-12'
                ],
                'same_stage' => [
                    'name' => 'Same Stage',
                    'type' => 'radio',
                    'value' => 3,
                    'cols' => 'col-lg-12 col-md-12 col-sm-12'
                ],
                'ahead' => [
                    'name' => 'Ahead',
                    'type' => 'radio',
                    'value' => 4,
                    'cols' => 'col-lg-12 col-md-12 col-sm-12'
                ],
            ],
            'progress_barometer' => [
                'stalled' => [
                    'name' => 'Stalled - Can you provide more value?',
                    'type' => 'radio',
                    'value' => 1,
                    'cols' => 'col-lg-12 col-md-12 col-sm-12'
                ],
                'progressing' => [
                    'name' => 'Progressing - What’s the next step?',
                    'type' => 'radio',
                    'value' => 2,
                    'cols' => 'col-lg-12 col-md-12 col-sm-12'
                ],
                'fast' => [
                    'name' => 'Fast - Can you multithread to move faster?',
                    'type' => 'radio',
                    'value' => 3,
                    'cols' => 'col-lg-12 col-md-12 col-sm-12'
                ]
            ],
            'sales_stage' => [
                'strength' => [
                    'weak' => [
                        'name' => 'Weak',
                        'type' => 'checkbox',
                        'value' => 1,
                        'cols' => 'col-lg-12 col-md-12 col-sm-12 pl-0'
                    ],
                    'normal' => [
                        'name' => 'Normal',
                        'type' => 'checkbox',
                        'value' => 1,
                        'cols' => 'col-lg-12 col-md-12 col-sm-12 pl-0'
                    ],
                    'strong' => [
                        'name' => 'Strong',
                        'type' => 'checkbox',
                        'value' => 1,
                        'cols' => 'col-lg-12 col-md-12 col-sm-12 pl-0'
                    ]
                ],
                'stage_progress' => [
                    'not_started' => [
                        'name' => 'Not Started',
                        'type' => 'radio',
                        'value' => 1,
                        'cols' => 'col-lg-12 col-md-12 col-sm-12',
                        'default' => 1
                    ],
                    'in_progress' => [
                        'name' => 'In Progress',
                        'type' => 'radio',
                        'value' => 2,
                        'cols' => 'col-lg-12 col-md-12 col-sm-12',
                        'default' => 0
                    ],
                    'completed' => [
                        'name' => 'Completed',
                        'type' => 'radio',
                        'value' => 3,
                        'cols' => 'col-lg-12 col-md-12 col-sm-12',
                        'default' => 0
                    ]
                ]
                
            ]
        ],
        'dropdown_values' => [
            'org_chart_role' => [
                'default' => [
                    'name' => '',
                    'value' => 0
                ],
                'spoc' => [
                    'name' => 'SPOC',
                    'value' => 1
                ],
                'influencer' => [
                    'name' => 'Influencer',
                    'value' => 2
                ],
                'decision_maker' => [
                    'name' => 'Decision Maker',
                    'value' => 3
                ]
            ],
            'org_chart_engagement' => [
                'default' => [
                    'name' => '',
                    'value' => 0
                ],
                'low' => [
                    'name' => 'Low',
                    'value' => 1
                ],
                'medium' => [
                    'name' => 'Medium',
                    'value' => 2
                ],
                'high' => [
                    'name' => 'High',
                    'value' => 3
                ]
            ],
            'jpp_soe_completed' => [
                'default' => [
                    'name' => 'No',
                    'value' => 0
                ],
                'wip' => [
                    'name' => 'WIP',
                    'value' => 1
                ],
                'yes' => [
                    'name' => 'Yes',
                    'value' => 2
                ]
            ]
        ]
    ]
];