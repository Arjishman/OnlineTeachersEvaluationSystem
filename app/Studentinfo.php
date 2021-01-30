<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studentinfo extends Model
{
    protected $fillable = ['sid','sname','semail','deptcode'];
}
