<?php

namespace App\Components;

use App\Menu;

class MenuRecusive{
    private $html;
    public function __construct(){
        $this->html = '';
    }
    public function menuRecusiveAdd($parent_id = 0,$markText =''){
        $data = Menu::where('parent_id',$parent_id)->get();
        foreach($data as $dataItem){
            $this->html .= '<option value="'.$dataItem->id.'">'.$markText.$dataItem->name.'</option>';
            $this->menuRecusiveAdd($dataItem->id,$markText.'--');
        }
        return $this->html;
    }
    public function menuRecusiveEdit($MenuParentId,$parent_id = 0,$markText =''){
        $data = Menu::where('parent_id',$parent_id)->get();
        foreach($data as $dataItem){
            if($dataItem->id == $MenuParentId){
                $this->html .= "<option selected value='".$dataItem['id']."'>" . $markText . $dataItem['name']. "</option>";
            }else{
                $this->html .= "<option value='".$dataItem['id']."'>" . $markText . $dataItem['name']. "</option>";
            }
           
            $this->menuRecusiveEdit($dataItem->parent_id,$dataItem->id,$markText.'--');
        }
        return $this->html;
    }
}