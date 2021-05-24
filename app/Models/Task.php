<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';

    protected $fillable = [
        'user',
        'action',
        'step',
        'person_account',
        'opportunity',
        'note',
        'priority',
        'by_date',
        'completed_at',
        'status'
    ];
}
