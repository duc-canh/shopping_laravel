<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function index(){
        $settings = Setting::latest()->paginate(10);
        return view('admin.setting.index',\compact('settings'));
    }
    public function create(){
        return view('admin.setting.add');
    }
    public function store(Request $request){
        $this->validate($request,[
            'config_key'=>'required',
            'config_value'=>'required',
        ]);
        Setting::create([
            'config_key'=>$request->config_key,
            'config_value'=>$request->config_value,
            'type'=>$request->type,
        ]);
        return redirect()->route('admin.setting.index')->with('success','create successfully');
    }
    public function edit($id){
        $setting = Setting::find($id);
        return view('admin.setting.edit',compact('setting'));
    }
    public function update($id,Request $request){
        $this->validate($request,[
            'config_key'=>'required',
            'config_value'=>'required',
        ]);
       
        Setting::find(id)->update([
            'config_key'=>$request->config_key,
            'config_value'=>$request->config_value,
            'type'=>$request->type,
        ]);
        return redirect()->route('admin.setting.index')->with('success','update successfully');
    }
}
