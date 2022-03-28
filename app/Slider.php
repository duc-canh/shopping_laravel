<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Slider extends Model
{
    use softDeletes;
    protected $table = 'sliders';
    protected $fillable =[
        'name',
        'description',
        'image_path',
        'image_name',
    ];
}
