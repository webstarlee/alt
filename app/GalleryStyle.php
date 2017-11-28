<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GalleryStyle extends Model
{
    /**
     * [$table description]
     * @var string
     */
    protected $table = 'gallery_styles';
    /**
     * [$fillable description]
     * @var [type]
     */
    protected $fillable = [
        'style_title', 'style_name', 'style_img', 'style_completed_user', 'category_id'
    ];
    public $timestamps = false;
}
