<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLove extends Model
{
    /**
     * [$table description]
     * @var string
     */
    protected $table = 'user_loves';
    /**
     * [$fillable description]
     * @var [type]
     */
    protected $fillable = [
        'image_id', 'user_id', 'love_type', 'pos_top', 'pos_left'
    ];
    public $timestamps = false;
}
