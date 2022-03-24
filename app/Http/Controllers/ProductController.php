<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Components\Recusive;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::latest()->paginate(10);
        return view('admin.product.index',compact('products'));
    }
    public function getCategory($parentId){
        $data = Category::all();
        $recusive = new Recusive($data);
        $htlmOption = $recusive->categoryRecusive($parentId); 
        return $htlmOption;
    }
    public function create(){
        $htlmOption = $this->getCategory($parentId = '');
        return view('admin.product.add',compact('htlmOption'));
    }
}
