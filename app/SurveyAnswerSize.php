<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyAnswerSize extends Model
{
    /**
     * [$table description]
     * @var string
     */
    protected $table = 'survey_option2_size';
    /**
     * [$fillable description]
     * @var [type]
     */
    protected $fillable = [
        'title', 'size', 'question_id'
    ];
    public $timestamps = false;
}
