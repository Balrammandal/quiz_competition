<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupQuestions extends Model 
{

    protected $table = 'group_questions';
    public $timestamps = true;
    public $guarded = [];

    use SoftDeletes;

    protected $dates = ['deleted_at'];

}