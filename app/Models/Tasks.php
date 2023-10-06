<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TaskStatus;

class Tasks extends Model
{
    public $table = 'tasks';

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'task_status_id'
    ];

    public function taskStatus()
    {
        return $this->belongsTo(TaskStatus::class);
    }
}
