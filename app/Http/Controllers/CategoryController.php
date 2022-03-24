<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Components\Recusive;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    private $category;
    public function __construct(Category $category){
        $this->category = $category;
    }
    public function create(){
        $htlmOption = $this->getCategory($parentId = '');
        return view('admin.category.add',compact('htlmOption'));
    }

    public function index(){
        $categories = Category::latest()->paginate(5);
        return view('admin.category.index',compact('categories'));
    }

    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'parent_id'=>'required',
        ]);
        $slug = Str::slug($request->name);
        $checkSlug = Category::where('slug',$slug)->first();

        while($checkSlug){
            $slug = $checkSlug->slug . Str::random(2);
        }
        Category::create([
            'name'=>$request->name,
            'slug'=>$slug,
            'parent_id'=>$request->parent_id,
        ]);

        return redirect()->route('admin.category.index')->with('success','create successfully');
    }

    public function getCategory($parentId){
        $data = $this->category->all();
        $recusive = new Recusive($data);
        $htlmOption = $recusive->categoryRecusive($parentId); 
        return $htlmOption;
    }

    public function edit($id){
        $category = Category::find($id);
        $htlmOption = $this->getCategory($category->parent_id);
        return view('admin.category.edit',compact('category','htlmOption'));
    }
    public function update(Request $request,$id){
        $this->validate($request,[
            'name'=>'required',
            'parent_id'=>'required',
        ]);
        $slug = Str::slug($request->name);
        $checkSlug = Category::where('slug',$slug)->first();
        $this->category->find($id)->update([
            'name'=>$request->name,
            'slug'=>$slug,
            'parent_id'=>$request->parent_id,
        ]);
        return redirect()->route('admin.category.index')->with('success','update successfully');
    }

    public function delete($id){
       $this->category->find($id)->delete();
       return redirect()->route('admin.category.index')->with('success','delete successfully');
    }
}
