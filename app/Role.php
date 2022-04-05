<?php

namespace App;

use App\Role;
use App\Permission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Role extends Model
{
    use softDeletes;
    protected $table = 'roles';
    protected $fillable =[
        'name',
        'display_name',
    ];
    public function permissions(){
        return $this->belongsToMany(Permission::class,'permission_role','role_id','permission_id');
    }
}
