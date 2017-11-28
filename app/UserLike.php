<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLike extends Model
{
    /**
     * [$table description]
     * @var string
     */
    protected $table = 'likes';
    /**
     * [$fillable description]
     * @var [type]
     */
    protected $fillable = [
        'image_id', 'user_id', 'like_type'
    ];
    public $timestamps = false;
}
