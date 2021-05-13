<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'user',
        'action',
        'step',
        'from_to_account',
        'opportunity',
        'priority',
        'by_date',
        'completed_at'
    ];

    public $timestamps = true;
}
