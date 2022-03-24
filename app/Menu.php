<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use softDeletes;
    protected $table = 'menus';
    protected $fillable =[
        'name',
        'slug',
        'parent_id',
    ];
}
