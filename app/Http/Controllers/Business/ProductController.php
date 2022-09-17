<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessProducts;
use App\Http\Controllers\CommonUtility;
use Validator;

class ProductController extends CommonUtility
{
    
    public function add_product(Request $request){
        $rules = [
            'product_category'=>'required',
            'product_image'=>['required'],
            'product_video_url'=>'required',
            'product_name'=>'required',
            'product_brand'=>'required', 
            'unit_id'=>'required',
            'minimum_qty'=>'required',
            'product_tags'=>'required',
            'is_refundable'=>'required',
            'is_cod'=>'required',
            'product_description'=>'required',
            'unit_price'=>'required',
            'sales_price'=>'required',
            'dicount'=>'required',
            'product_type'=>'required',
            'colors'=>'required',
            'sizes'=>'required',
            'units'=>'required',
            'qty'=>'required',
            'warning_qty'=>'required',
            'product_tax'=>'required',
            'tax_type'=>'required',
            'service_company'=>'required',
            'delivery_type'=>'required',
            'pin_code'=>'required'
        ];
       
        $validation  = Validator::make($request->all(), $rules);
        if($validation->fails()){
            return $this->get_response(true, $validation->errors()->first(), null, 400);
        }
        else{
            $product_image = $request->product_image;
            $array_img_paths=array();
            foreach($product_image as $img){
                $image_path = time().'.'.$img->getClientOriginalName();
                $img-> move(public_path('public/Image/'.$request->product_category_id), $image_path);
                array_push($array_img_paths,$image_path);
            }
            $product_detail                      = new BusinessProducts;
            $product_detail->product_category    = $request->product_category;
            $product_detail->product_image       = json_encode($array_img_paths);
            $product_detail->product_video_url   = $request->product_video_url;
            $product_detail->product_name        = $request->product_name;
            $product_detail->product_brand       = $request->product_brand;
            $product_detail->unit_id             = $request->unit_id;
            $product_detail->minimum_qty         = $request->minimum_qty;
            $product_detail->product_tags        = $request->product_tags;
            $product_detail->is_refundable       = $request->is_refundable;
            $product_detail->is_cod              = $request->is_cod;
            $product_detail->product_description = $request->product_description;
            $product_detail->unit_price          = $request->unit_price;
            $product_detail->sales_price         = $request->sales_price;
            $product_detail->dicount             = $request->dicount;
            $product_detail->product_type        = $request->product_type;
            $product_detail->color_id            = $request->colors;
            $product_detail->size_id             = $request->sizes;
            $product_detail->units_id            = $request->units;
            $product_detail->qty                 = $request->qty;
            $product_detail->warning_qty         = $request->warning_qty;
            $product_detail->product_tax         = $request->product_tax;
            $product_detail->tax_type            = $request->tax_type;
            $product_detail->service_company     = $request->service_company;
            $product_detail->delivery_type_id    = $request->delivery_type_id;
            $product_detail->pin_code            = $request->pin_code;
            if($product_detail->save()){
                return $this->get_response(false, 'Product added successfully', ['product_added'=>true], 200);
            }else{
                return $this->get_response(false, 'error', ['product_added'=>false], 500);
            }
        }
    }
    public function update_product(Request $request){
        $product_image = $request->product_image;
        $array_img_paths=array();
        foreach($product_image as $img){
            $image_path = time().'.'.$img->getClientOriginalName();
            $img-> move(public_path('public/Image/'.$request->product_category_id), $image_path);
            array_push($array_img_paths,$image_path);
        }
        $product_detail                      = BusinessProducts::find($request->product_id);
        $product_detail->product_category    = $request->product_category;
        $product_detail->product_image       = json_encode($array_img_paths);
        $product_detail->product_video_url   = $request->product_video_url;
        $product_detail->product_name        = $request->product_name;
        $product_detail->product_brand       = $request->product_brand;
        $product_detail->unit_id             = $request->unit_id;
        $product_detail->minimum_qty         = $request->minimum_qty;
        $product_detail->product_tags        = $request->product_tags;
        $product_detail->is_refundable       = $request->is_refundable;
        $product_detail->is_cod              = $request->is_cod;
        $product_detail->product_description = $request->product_description;
        $product_detail->unit_price          = $request->unit_price;
        $product_detail->sales_price         = $request->sales_price;
        $product_detail->dicount             = $request->dicount;
        $product_detail->product_type        = $request->product_type;
        $product_detail->color_id            = $request->colors;
        $product_detail->size_id             = $request->sizes;
        $product_detail->units_id            = $request->units;
        $product_detail->qty                 = $request->qty;
        $product_detail->warning_qty         = $request->warning_qty;
        $product_detail->product_tax         = $request->product_tax;
        $product_detail->tax_type            = $request->tax_type;
        $product_detail->service_company     = $request->service_company;
        $product_detail->delivery_type_id    = $request->delivery_type_id;
        $product_detail->pin_code            = $request->pin_code;
        if($product_detail->save()){
            return $this->get_response(false, 'Product updated successfully', ['product_updated'=>true], 200);
        }else{
            return $this->get_response(false, 'error', ['product_updated'=>false], 500);
        }
        
    }
    public function delete_product(Request $request){
        $rules = [
            "product_id"=>'required',          
        ];
        Validator::make($request->all(), $rules);
        if(BusinessProducts::find($request->product_id)->delete()){
            return $this->get_response(false, 'deleted successfully', ['product_deleted'=>true], 200);
        }else{
            return $this->get_response(false, 'error', ['product_deleted'=>false], 500);
        }
    }

    public function get_all_product_details(){
        $productDetails = BusinessProducts::all();
        return $this->get_response(false, 'Product fetch successfully', ['productDetails'=>$productDetails], 200);
    }
    public function get_product_details($id){
        $productDetails = BusinessProducts::where(['id'=>$id])->first();
        return $this->get_response(false, 'Product fetch successfully', ['productDetails'=>$productDetails], 200);
    }
    public function get_all_products_in_travel(){
        $tProducts = BusinessProducts::where(['product_type'=>1])->get();
        return $this->get_response(false, 'Product fetch successfully', ['travelProducts'=>$tProducts], 200);
    }
    public function get_all_products_in_fasion(){
        $fProducts = BusinessProducts::where(['product_type'=>2])->get();
        return $this->get_response(false, 'Product fetch successfully', ['fashionProducts'=>$fProducts], 200);
    }
    public function get_all_products_in_lifestyle(){
        $lfProducts = BusinessProducts::where(['product_type'=>3])->get();
        return $this->get_response(false, 'Product fetch successfully', ['lifestyleProducts'=>$lfProducts], 200);
    }
    public function get_all_products_in_food(){
        $fProducts = BusinessProducts::where(['product_type'=>4])->get();
        return $this->get_response(false, 'Product fetch successfully', ['foodProducts'=>$fProducts], 200);
    }
   
}
