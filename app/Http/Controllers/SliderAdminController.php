<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\Log;

class SliderAdminController extends Controller
{
    use StorageImageTrait;
    public function index(){
        $sliders = Slider::latest()->paginate(5);
        return view('admin.slider.index',compact('sliders'));
    }
    public function create(){
        return view('admin.slider.add');
    }
    public function store(Request $request){
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required',
            'image_path'=>'required',
        ]);
        try{
            $dataInsert = [
                'name'=>$request->name,
                'description'=>$request->description,
            ];
            $dataImageSlider = $this->storageTraitUpload($request,'image_path','slider');
            if(!empty($dataImageSlider)){
            $dataImageSlider = $this->storageTraitUpload($request,'image_path','slider');
                $dataInsert['image_path'] = $dataImageSlider['file_path'];
                $dataInsert['image_name'] = $dataImageSlider['file_name'];
            }
            Slider::create($dataInsert);
            return redirect()->route('admin.slider.index')->with('success','create successfully');
        }catch(Exception $ex){
            Log::error('Message : '.$ex->getMessage().'; Line : '.$ex->getLine());
        }
       
    }
    public function edit($id){
        
    }
    public function delete($id){

    }
}
