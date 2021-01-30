<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActiveSemester extends Model
{
    protected $fillable = ['semester','year','dept'];
}
