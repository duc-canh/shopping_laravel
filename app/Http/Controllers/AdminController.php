<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function loginAdmin(){
        if(auth()->check()){
            return redirect()->to('home');
        }
        return view('admin.login');
    }
    public function postLoginAdmin(Request $request){
        
        $remember = $request->has('remember_me') ? true:false;
        if(auth()->attempt(['email'=>$request->email,'password'=>$request->password],$remember)){
            return redirect()->to('home');
        }else{
            echo 'login fail';
        }
    }
    public function logout(){
        Auth::logout();
        echo 'logout success';
    }
    public function myName(){

        $roles = Role::all();
        $user = User::find(auth()->user()->id);
        $rolesofuser = $user->roles;
        return view('admin.user.myName',compact('user','roles','rolesofuser'));
    }
}
