<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyQuestion extends Model
{
    /**
     * [$table description]
     * @var string
     */
    protected $table = 'survey_questions';
    /**
     * [$fillable description]
     * @var [type]
     */
    protected $fillable = [
        'title', 'type'
    ];
    public $timestamps = false;
}
