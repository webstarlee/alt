<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserOptionB extends Model
{
    /**
     * [$table description]
     * @var string
     */
    protected $table = 'survey_option2_results';
    /**
     * [$fillable description]
     * @var [type]
     */
    protected $fillable = [
        'question_id', 'user_id', 'size_id', 'img_ids'
    ];
    public $timestamps = false;
}
