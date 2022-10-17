<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(){
        $categories=Category::all();
        return view('dashboard.product.index',compact('categories'));
    }

    public function productinsert(Request $request){
        $request->validate([
            'category_id'=>'required',
            'product_name'=>'required',
            'product_short_description'=>'required',
            'product_long_description'=>'required',
            'product_regular_price'=>'required',
            // 'product_discounted_price'=>'required',
            'product_additional_information'=>'required',
            'product_quantity'=>'required',
        ],[
            'category_id.required'=>'The category name field is required.'
        ]);

        // return $request;
        if(!$request->product_discounted_price){
            $product_discounted_price=$request->product_regular_price;
        }
        else{
            $product_discounted_price=$request->product_discounted_price;
        }
        //echo $product_discounted_price;
        if($request->product_discounted_price > $request->product_regular_price){
            // echo "not possible";
            return back()->with('product_discount_e','Product Discount Price Can Not Over Then Regular Price');
        }
        else{

            // echo $request->category_id;
            // if(!$request->category_id){
            //     echo "hobe na";
            //     //return back()->with('category_empty','Category can not be empty!!!');
            // }
            // else{
            //     return $request->category_id;
            // }

            $product_id=Product::insertGetId([
               'category_id'=>$request->category_id,
               'product_name'=>$request->product_name,
               'product_short_description'=>$request->product_short_description,
               'product_long_description'=>$request->product_long_description,
               'product_regular_price'=>$request->product_regular_price,
               'product_discounted_price'=>$product_discounted_price,
               'product_additional_information'=>$request->product_additional_information,
               'product_quantity'=>$request->product_quantity,
               'created_at'=>Carbon::now(),
            ]);
            if($request->hasFile('product_thumbnail_photo')){
                $product_thumbnail_photo=$request->file('product_thumbnail_photo');
                $new_name=Str::slug($request->product_name)."-".Str::random(10).".".$product_thumbnail_photo->getClientOriginalExtension();
                $upload_link=base_path('public/uploads/product_thumbnail_photo/'.$new_name);
                Image::make($product_thumbnail_photo)->resize(800,609)->save($upload_link);
                Product::find($product_id)->update([
                    'product_thumbnail_photo'=>$new_name,
                ]);
            }
        }
        return back()->with('product_add_suc','Product add successfuly!!!');
        //return view('dashboard.product.index');
    }

}
