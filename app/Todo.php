<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
       protected $fillable = [
        'user_id','name', 'due_date', 'status'
    ];
}
