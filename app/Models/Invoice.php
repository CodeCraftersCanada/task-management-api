<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Task;
use App\Models\User;

class Invoice extends Model
{
    public $table = 'invoice';

    protected $fillable = [
        'paid_to',
        'task_id',
        'status_id',
        'total_hours',
        'hourly_rate',
        'amount'
    ];


    public function payee()
    {
        return $this->hasOne(User::class,'id', 'paid_to');
    }

    public function task()
    {
        return $this->hasOne(Task::class,'id', 'task_id');
    }
}
