<?php

namespace App\Http\Controllers;
use App\Models\Banner;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
class BannerController extends Controller
{
    public function banner(){
        $categories=Category::all();
        $banners=Banner::all();
        return view('dashboard.banner.index',compact('categories','banners'));
    }
    public function insert(Request $request){
        $request->validate([
           'category_id'=>'required',
           'product_banner_photo'=>'required',
           'product_name'=>'required',
           'product_regular_price'=>'required',
        ],[
            'product_category.required'=>'The product category field is required.'
        ]);
        if(!$request->product_discounted_price){
            $product_discounted_price= $request->product_regular_price;
        }
        if($request->product_discounted_price > $request->product_regular_price){
            return back()->with('discount_e','Product Discount Price Can Not Over Then Regular Price');
        }
        else{
            $product_discounted_price=$request->product_discounted_price;
        }

        $banner_photo=$request->file('product_banner_photo');
        $new_name=Str::slug($request->product_name)."-".$request->category_id.".".$banner_photo->getClientOriginalExtension();
        $upload_link=base_path('public/uploads/banner_photos/'.$new_name);
        Image::make($banner_photo)->resize(844,517)->save($upload_link);
        // echo $new_name;
        // echo $upload_link;
        // return $request;
        Banner::insert([
            'category_id'=>$request->category_id,
            'product_banner_photo'=>$new_name,
            'product_name'=>$request->product_name,
            'product_work'=>$request->product_work,
            'product_short_breff'=>$request->product_short_breff,
            'product_regular_price'=>$request->product_regular_price,
            'product_discounted_price'=>$product_discounted_price,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('banner_add_s','Banner Added Successfuly!!');
    }
    public function edit($id){
        $categories=Category::all();
        $category=Category::all();
        $banner=Banner::find($id);
        // return ($category);
        return view('dashboard.banner.edit',compact('categories','banner'));
    }
    public function update(Request $request,$id){

        if(!$request->product_discounted_price){
            $product_discounted_price= $request->product_regular_price;
        }
        if($request->product_discounted_price > $request->product_regular_price){
            return back()->with('discount_e','Product Discount Price Can Not Over Then Regular Price');
        }
        else{
            $product_discounted_price=$request->product_discounted_price;
        }
        Banner::find($id)->update([
            'category_id'=>$request->category_id,
            'product_name'=>$request->product_name,
            'product_work'=>$request->product_work,
            'product_short_breff'=>$request->product_short_breff,
            'product_regular_price'=>$request->product_regular_price,
            'product_discounted_price'=>$product_discounted_price,
            'created_at'=>Carbon::now(),
        ]);
        if($request->hasFile('product_banner_photo')){

            $banner_photo=$request->file('product_banner_photo');
            $new_name=Str::slug($request->product_name)."-".$request->category_id.".".$banner_photo->getClientOriginalExtension();
            $upload_link=base_path('public/uploads/banner_photos/'.$new_name);
            Image::make($banner_photo)->resize(844,517)->save($upload_link);
            Banner::find($id)->update([
                'product_banner_photo'=>$new_name,
            ]);
        }
        return back()->with('banner_up_s','Banner Added Successfuly!!');
    }
    public function delete($id){
        $d_banner_photo=Banner::find($id)->product_banner_photo;
        $delete_link=base_path('public/uploads/banner_photos/'.$d_banner_photo);
        unlink($delete_link);
        Banner::find($id)->delete();
        return back();
    }
}
