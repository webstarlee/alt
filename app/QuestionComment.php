<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionComment extends Model
{
    /**
     * [$table description]
     * @var string
     */
    protected $table = 'question_comments';
    /**
     * [$fillable description]
     * @var [type]
     */
    protected $fillable = [
        'question_id', 'user_id', 'comment', 'publish'
    ];
    public $timestamps = false;
}
