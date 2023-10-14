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
        'task_id',
        'task_status_id',
    ];

    public function status()
    {
        return $this->hasOne(TaskStatus::class,'id', 'task_status_id');
    }

    public function task()
    {
        return $this->hasOne(Task::class,'id', 'task_id');
    }
}
