<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TaskStatus;
use App\Models\User;
use App\Models\Invoice;

class Task extends Model
{
    public $table = 'task';

    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'task_status_id',
        'created_by',
        'assigned_to',
        'parent_id',
        'task_hours',
        'unpaid_task_hours',
        'paid_task_hours'
    ];

    public function status()
    {
        return $this->hasOne(TaskStatus::class,'id', 'task_status_id');
    }


    public function parentTask()
    {
        return $this->hasOne(Task::class,'id', 'parent_id');
    }

    public function creator()
    {
        return $this->hasOne(User::class,'id', 'created_by');
    }

    public function assigned()
    {
        return $this->hasOne(User::class,'id', 'assigned_to');
    }

    public function subTasks()
    {
        return $this->hasMany(SubTask::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
