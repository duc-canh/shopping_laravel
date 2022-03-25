<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';
    protected $fillable =[
        'image_path',
        'image_name',
        'product_id',
    ];
}
