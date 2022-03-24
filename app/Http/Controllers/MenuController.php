<?php

namespace App\Http\Controllers;

use App\Menu;
use Illuminate\Http\Request;
use App\Components\MenuRecusive;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    private $menuRecusive;
    public function __construct(MenuRecusive $menuRecusive){
        $this->menuRecusive = $menuRecusive;
    }
    public function index(){
        $menus = Menu::latest()->paginate(10);
        return view('admin.menu.index',compact('menus'));
    }
    public function create(){
        $optionSelect = $this->menuRecusive->menuRecusiveAdd();
        return view('admin.menu.add',compact('optionSelect'));
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'parent_id'=>'required',
        ]);
        $slug = Str::slug($request->name);
        $checkSlug = Menu::where('slug',$slug)->first();

        while($checkSlug){
            $slug = $checkSlug->slug . Str::random(2);
        }
        Menu::create([
            'name'=>$request->name,
            'parent_id'=>$request->parent_id,
            'slug'=>$slug,
        ]);

        return redirect()->route('admin.menu.index')->with('success','create successfully');
    }
    public function edit($id){
        $menu = Menu::find($id);
        $optionSelect = $this->menuRecusive->menuRecusiveEdit($menu->parent_id);
        return view('admin.menu.edit',compact('optionSelect','menu'));
    }
    public function update($id,Request $request){
        $this->validate($request,[
            'name'=>'required',
        ]);
        $slug = Str::slug($request->name);
        $checkSlug = Menu::where('slug',$slug)->first();
        while($checkSlug){
            $slug = $checkSlug->slug . Str::random(2);
        }
        Menu::find($id)->update([
            'name'=>$request->name,
            'parent_id'=>$request->parent_id,
            'slug'=>$slug,
        ]);
        return redirect()->route('admin.menu.index')->with('success','update successfully');
    }
    public function delete($id){
        Menu::find($id)->delete();
        return redirect()->route('admin.menu.index')->with('success','delete successfully');
    }
}
