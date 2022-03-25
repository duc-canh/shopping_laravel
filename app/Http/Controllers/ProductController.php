<?php

namespace App\Http\Controllers;

use App\Tag;
use Storage;
use App\Product;
use App\Category;
use App\ProductTag;
use App\ProductImage;
use Illuminate\Support\Str;
use App\Components\Recusive;
use Illuminate\Http\Request;
use App\Traits\StorageImageTrait;

class ProductController extends Controller
{
    use StorageImageTrait;
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

    public function store(Request $request){
        $dataProductCreate = [
            'name'=>$request->name,
            'price'=>$request->price,
            'feature_image_path'=>$request->name,
            'content'=>$request->content,
            'user_id'=>auth()->id(),
            'category_id'=>$request->category_id,
            'feature_image_name'=>$request->name,
        ];
        $dataUploadFeatureImage = $this->storageTraitUpload($request,'feature_image_path','product');
        if(!empty($dataUploadFeatureImage)){
            $dataProductCreate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
            $dataProductCreate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
        }
        $product = Product::create($dataProductCreate);
        //insert data to product_images
        if($request->hasFile('image_path')){
            foreach($request->image_path as $fileItem){
                $dataProductImageDetail = $this->storageTraitUploadMutiple($fileItem,'product');
                $product->images()->create([
                    'image_path'=>$dataProductImageDetail['file_path'],
                    'image_name'=>$dataProductImageDetail['file_name'],
                ]);
            }
        }
        //insert tags for product
        foreach($request->tags as $tagItem){
            $tagInsten = Tag::firstOrCreate(['name' => $tagItem]);
            $tagIds[] = $tagInsten->id;
        }
        $product->tags()->attach($tagIds);
    }
}
