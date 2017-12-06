<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyAnswer1 extends Model
{
    /**
     * [$table description]
     * @var string
     */
    protected $table = 'survey_option1';
    /**
     * [$fillable description]
     * @var [type]
     */
    protected $fillable = [
        'title', 'img_name', 'size', 'question_id'
    ];
    public $timestamps = false;
}
