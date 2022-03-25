<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    protected $table = 'product_tags';
    protected $fillable =[
        'tag_id',
        'product_id',
    ];
}
