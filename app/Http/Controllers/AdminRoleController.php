<?php

namespace App\Http\Controllers;

use App\Role;
use App\Permission;
use Illuminate\Http\Request;
use App\Traits\DeleteModelTrait;

class AdminRoleController extends Controller
{
    use DeleteModelTrait;
    private $rol = Role::class;
    public function index(){
        $roles = Role::paginate();
        return view('admin.role.index',compact('roles'));
    }
        
    public function create(){
        $permissionParent = Permission::where('parent_id',0)->get();
        
        return view('admin.role.add',compact('permissionParent'));
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'display_name'=>'required',
        ]);
        $role = Role::create([
            'name'=>$request->name,
            'display_name'=>$request->display_name,
        ]);
        $role->permissions()->attach($request->permission_id);
        return redirect()->route('admin.role.index')->with('success','create successfully');
    }
    public function edit($id){
        $permissionParent = Permission::where('parent_id',0)->get();
        $role = Role::find($id);
        $permissionChecked = $role->permissions;
        return view('admin.role.edit',compact('permissionParent','role','permissionChecked'));
    }
    public function update($id,Request $request){
        $this->validate($request,[
            'name'=>'required',
            'display_name'=>'required',
        ]);
        Role::find($id)->update([
            'name'=>$request->name,
            'display_name'=>$request->display_name,
        ]);
        $role = Role::find($id);
        $role->permissions()->sync($request->permission_id);
        return redirect()->route('admin.role.index')->with('success','update successfully');
    }
    public function delete($id){
        return $this->deleteModelTrait($id,$this->rol);
        
    }
}
