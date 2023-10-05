<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    public $table = 'user_type';

    protected $fillable = [
        'name'
    ];
}
