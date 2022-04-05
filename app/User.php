<?php

namespace App;

use App\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use softDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles(){
        return $this->belongsToMany(Role::class,'user_role','user_id','role_id');
    }
    public function checkPermissionAccess($permissioncheck){
        $roles = auth()->user()->roles;
        foreach($roles as $role){
            $permissions = $role->permissions;
            if($permissions->contains('key_code',$permissioncheck)){
                return true;
            }
        }
        //b1 lấy được tất cả quyền của user đang login vào hệ thống
        //b2 so sánh giá trị đưa vào của các route hiện tại xem có tồn tại trong các quyền mà mình lấy được hay không
        return false;
    }
}
