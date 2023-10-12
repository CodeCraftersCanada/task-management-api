<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\TaskStatus;
use App\Models\User;

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
        'hours_to_complete'
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
}
