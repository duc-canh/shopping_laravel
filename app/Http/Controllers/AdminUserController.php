<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminUserController extends Controller
{
    public function index(){
        $users = User::latest()->paginate(10);
        return view('admin.user.index',compact('users'));
    }
    public function create(){
        $roles = Role::all();
        return view('admin.user.add',compact('roles'));
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
        ]);
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);
       
        $user->roles()->attach($request->role_id);
        return redirect()->route('admin.user.index')->with('success','create successfully');
        // foreach($roleIds as $roleItem){
        //     DB::table('user_role')->insert([
        //         'role_id'=>$roleItem,
        //         'user_id'=>$user->id,
        //     ]);
        // }
    }
}
