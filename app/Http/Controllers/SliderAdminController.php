<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;
use App\Traits\DeleteModelTrait;
use App\Traits\StorageImageTrait;
use Illuminate\Support\Facades\Log;

class SliderAdminController extends Controller
{
    use StorageImageTrait;
    use DeleteModelTrait;
    private $sli = Slider::class;
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
        $slider = Slider::find($id);
        return view('admin.slider.edit',compact('slider'));
    }
    public function update($id,Request $request){
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required',
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
            Slider::find($id)->update($dataInsert);
            return redirect()->route('admin.slider.index')->with('success','update successfully');
        }catch(Exception $ex){
            Log::error('Message : '.$ex->getMessage().'; Line : '.$ex->getLine());
        }
    }
    public function delete($id){
        return $this->deleteModelTrait($id,$this->sli);
    }
}
