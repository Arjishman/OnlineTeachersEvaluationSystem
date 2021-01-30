<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evaluationresult extends Model
{
    protected $fillable = ['courseid','year','semester','tid','positive_response','mean_score','total_weight'];
}
