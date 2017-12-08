<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOptionA extends Model
{
    /**
     * [$table description]
     * @var string
     */
    protected $table = 'survey_option1_results';
    /**
     * [$fillable description]
     * @var [type]
     */
    protected $fillable = [
        'question_id', 'user_id', 'option_id', 'number'
    ];
    public $timestamps = false;
}
