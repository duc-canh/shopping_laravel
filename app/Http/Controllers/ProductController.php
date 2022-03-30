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
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    use StorageImageTrait;
    use DeleteModelTrait;
    private $pro = Product::class;
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
        $this->validate($request,[
            'name'=>'required',
            'price'=>'required',
            'feature_image_path'=>'required',
            'content'=>'required',
            'tags'=>'required',
            'image_path'=>'required',
        ]);
        
        try{
            DB::beginTransaction();
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
            DB::commit();
            return redirect()->route('admin.product.index')->with('success','create successfully');
        }catch(Exception $exception){
            DB::rollBack();
            Log::error('Message : '.$exception->getMessage().'; Line : '.$exception->getLine());
        };
        
    }
    public function edit($id){
        $product = Product::find($id);
        $htlmOption = $this->getCategory($product->category_id);
        return view('admin.product.edit',compact('htlmOption','product'));
    }
    public function update($id,Request $request){
        $this->validate($request,[
            'name'=>'required',
            'price'=>'required',
            'content'=>'required',
            'tags'=>'required',
        ]);
        $product = Product::find($id);
        try{
            DB::beginTransaction();
            $dataProductUpdate = [
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
                $dataProductUpdate['feature_image_path'] = $dataUploadFeatureImage['file_path'];
                $dataProductUpdate['feature_image_name'] = $dataUploadFeatureImage['file_name'];
            }else{
                $dataProductUpdate['feature_image_path'] = $product->feature_image_path;
                $dataProductUpdate['feature_image_name'] = $product->feature_image_name;
            }
           Product::find($id)->update($dataProductUpdate);
           
            //insert data to product_images
            if($request->hasFile('image_path')){
                ProductImage::where('product_id',$id)->delete();
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
            $product->tags()->sync($tagIds);
            DB::commit();
            return redirect()->route('admin.product.index')->with('success','create successfully');
        }catch(Exception $exception){
            DB::rollBack();
            Log::error('Message : '.$exception->getMessage().'; Line : '.$exception->getLine());
        };
    }
    public function delete($id){
        return $this->deleteModelTrait($id,$this->pro);
    }
}
