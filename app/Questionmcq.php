<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Questionmcq extends Model
{
   protected $fillable = ['qset','categoryid','categorydesc','qdescription','qopdes1','qopdes2','qopdes3','qopdes4','qopdes5','deptcode'];
}
