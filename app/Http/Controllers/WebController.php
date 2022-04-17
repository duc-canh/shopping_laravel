<?php

namespace App\Http\Controllers;

use App\Slider;
use App\Product;
use App\Category;
use Illuminate\Http\Request;

class WebController extends Controller
{
    public function index(){
        $sliders = Slider::latest()->take(3)->get();
        $categories = Category::where('parent_id',0)->get();
        $products = Product::latest()->take(6)->get();
        $productsRecoment = Product::latest('views_count','desc')->take(6)->get();
        return view('web.home.home',compact('sliders','categories','products','productsRecoment'));
    }
}
