<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    /**
     * [$table description]
     * @var string
     */
    protected $table = 'galleries';
    /**
     * [$fillable description]
     * @var [type]
     */
    protected $fillable = [
        'style_id', 'gallery_img'
    ];
    public $timestamps = false;
}
