<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TaskStatus;
use App\Models\User;
use App\Models\Task;

class SubTask extends Model
{
    public $table = 'sub_task';

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'task_id',
        'task_status_id',
        'created_by',
        'assigned_to',
    ];

    public function status()
    {
        return $this->hasOne(TaskStatus::class,'id', 'task_status_id');
    }

    public function creator()
    {
        return $this->hasOne(User::class,'id', 'created_by');
    }

    public function assigned()
    {
        return $this->hasOne(User::class,'id', 'created_by');
    }

    public function task()
    {
        return $this->hasOne(Task::class,'id', 'task');
    }
}
