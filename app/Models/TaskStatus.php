<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    public $table = 'task_status';

    protected $fillable = [
        'name'
    ];
}
