<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table = 'permissions';
    protected $fillable =[
        'name',
        'display_name',
        'parent_id',
        'key_code',
    ];
    public function permissionsChildrent(){
        return $this->hasMany(Permission::class,'parent_id');
    }
}
