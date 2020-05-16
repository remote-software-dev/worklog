<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $dates = ['created_at'];
    protected $fillable = ['time','requester', 'issue', 'comment', 'doneBy','status'];
}
