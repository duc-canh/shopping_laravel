<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use softDeletes;
    protected $table = 'settings';
    protected $fillable =[
        'config_key',
        'config_value',
        'type',
    ];
}
