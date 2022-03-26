<?php

namespace App;

use App\Category;
use App\ProductImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use softDeletes;
    protected $table = 'products';
    protected $fillable =[
        'name',
        'price',
        'feature_image_path',
        'content',
        'user_id',
        'category_id',
        'feature_image_name',
    ];
    public function images(){
        return $this->hasMany(ProductImage::class,'product_id');
    }
    public function tags(){
        return $this->belongsToMany(Tag::class,'product_tags','product_id','tag_id')->withTimestamps();
    }
    public function categories(){
        return $this->belongsTo(Category::class,'category_id');
    }
}
