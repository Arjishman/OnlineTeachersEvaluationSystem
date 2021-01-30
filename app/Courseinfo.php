<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courseinfo extends Model
{
    protected $fillable = ['qsetmcq','qsetopen','courseid','year','semester','part','teacherinfo_id','deptcode','openforevaluation'];
}
