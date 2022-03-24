<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable =[
        'name',
        'price',
        'feature_image_path',
        'content',
        'user_id',
        'category_id',
    ];
}
