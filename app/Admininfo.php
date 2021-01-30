<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Admininfo extends Model
{

    protected $fillable = ['empname','empid','emppw','deptcode' , 'empactivitystatus'];
}
