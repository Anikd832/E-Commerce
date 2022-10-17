<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ProductBrand;
use Intervention\Image\Facades\Image;
class ProductBrandController extends Controller
{
    public function productbrand(){
        $productbrands=ProductBrand::orderby('is_top_product_brand','desc')->get();
        return view('dashboard.product_brand',compact('productbrands'));
    }
    public function productbrand_insert(Request $request){
        // return $request->file('product_brand_logo');
        $request->validate([
            'required'=>'product_brand_name',
            'required'=>'product_brand_logo',
        ]);
        if(isset($request->is_top_product_brand)=='on'){
            $is_top_product_brand='yes';
        }
        else{
            $is_top_product_brand='no';
        }
        $brand_photo=$request->file('product_brand_logo');
        $new_name=Str::slug($request->product_brand_name)."-".Str::random(5).".".$brand_photo->getClientOriginalExtension() ;
        $upload_link=base_path('public/uploads/product_brands/'.$new_name);
        Image::make($brand_photo)->resize(353,83)->save($upload_link);
        ProductBrand::insert([
            'product_brand_name'=>$request->product_brand_name,
            'product_brand_logo'=>$new_name,
            'is_top_product_brand'=>$is_top_product_brand,
            'created_at'=> Carbon::now()
        ]);
        return back()->with('brand_add_suc','Brand Add Successfuly');
    }
    public function productbrand_delete($id){
        // ProductBrand::find($id)->delete();
        // return back();
        echo $id;
    }
}
