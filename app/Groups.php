<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model 
{

    protected $table = 'groups';
    public $timestamps = true;
    public $guarded = [];
    public function members()
    {
        return $this->hasMany('App\GroupMemeber', 'group_id');
    }

    public function questions()
    {
        return $this->hasManyThrough('App\Questions', 'App\GroupQuestions', 'question_id');
    }

}