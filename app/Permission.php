<?php

namespace App;

use App\Permission;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function permissionsChildrent(){
        return $this->hasMany(Permission::class,'parent_id');
    }
}
