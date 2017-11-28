<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * [$table description]
     * @var string
     */
    protected $table = 'categories';
    /**
     * [$fillable description]
     * @var [type]
     */
    protected $fillable = [
        'category_name', 'category_img'
    ];
    public $timestamps = false;
}
