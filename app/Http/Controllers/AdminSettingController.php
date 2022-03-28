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
}
