<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluatemcq extends Model
{
    protected $fillable = ['cregid','qidmcq','response'];
}
