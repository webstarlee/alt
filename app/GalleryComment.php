<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GalleryComment extends Model
{
    /**
     * [$table description]
     * @var string
     */
    protected $table = 'gallery_comments';
    /**
     * [$fillable description]
     * @var [type]
     */
    protected $fillable = [
        'image_id', 'user_id', 'comment'
    ];
    public $timestamps = false;
}
