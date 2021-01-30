<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacherinfo extends Model
{


    protected $fillable = ['tid','tname','deptcode','tactivestatus'];

    protected $hidden = ['$password', 'remember_token'];
}
