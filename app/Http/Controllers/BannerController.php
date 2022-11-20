<?php

namespace App\Http\Controllers;
use App\Models\Banner;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function banner(){
        $categories=Category::all();
        $banners=Banner::all();
        return view('dashboard.banner.index',compact('categories','banners'));
    }
    public function insert(Request $request){
        $request->validate([
           'product_category'=>'required',
           'product_banner_photo'=>'required',
           'product_name'=>'required',
           'product_regular_price'=>'required',
        ]);
        Banner::insert([
            'category_id'=>$request->category_id,
            'product_banner_photo'=>$request->product_banner_photo,
            'product_name'=>$request->product_name,
            'product_work'=>$request->product_work,
            'product_short_breff'=>$request->product_short_breff,
            'product_regular_price'=>$request->product_regular_price,
            'product_discounted_price'=>$request->product_discounted_price,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('banner_add_s','Banner Added Successfuly!!');
    }
}
