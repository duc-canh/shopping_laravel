<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use App\Traits\DeleteModelTrait;
use Illuminate\Support\Facades\DB;

class AdminUserController extends Controller
{
    use DeleteModelTrait;
    private $user = User::class;
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
        try{    
            DB::beginTransaction();
            $user = User::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
            ]);
            $user->roles()->attach($request->role_id);
            DB::commit();
            return redirect()->route('admin.user.index')->with('success','create successfully');
        }catch(Exception $ex){
            DB::rollBack();
            Log::error('Message : '.$exception->getMessage().'; Line : '.$exception->getLine());
        }
      
       
        
        // foreach($roleIds as $roleItem){
        //     DB::table('user_role')->insert([
        //         'role_id'=>$roleItem,
        //         'user_id'=>$user->id,
        //     ]);
        // }
    }
    public function edit($id){
        $roles = Role::all();
        $user = User::find($id);
        $rolesofuser = $user->roles;
      
        return view('admin.user.edit',compact('roles','user','rolesofuser'));
    }
    public function update($id,Request $request){
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
        ]);
        try{    
            DB::beginTransaction();
            User::find($id)->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>bcrypt($request->password),
            ]);
            $user = User::find($id);
            $user->roles()->sync($request->role_id);
            DB::commit();
            return redirect()->route('admin.user.index')->with('success','create successfully');
        }catch(Exception $ex){
            DB::rollBack();
            Log::error('Message : '.$exception->getMessage().'; Line : '.$exception->getLine());
        }
    }
    public function delete($id){
        return $this->deleteModelTrait($id,$this->user);
    }
}
