<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(){
        $users = User::latest()->paginate(10);
        return view('admin.user.index',compact('users'));
    }
}
