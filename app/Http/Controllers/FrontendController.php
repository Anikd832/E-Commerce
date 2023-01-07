<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use App\Models\ProductBrand;
use Illuminate\Http\Request;
use Carbon\Carbon;

class FrontendController extends Controller
{
    function index(){
        // $categories=Category::all();
        $top_categories=Category::Where('is_top_category','yes')->get();
        $productbrands=ProductBrand::orderby('is_top_product_brand','desc')->get();
        $products=Product::latest()->limit(6)->get();
        $bannaers=Banner::all();
        return view('frontend.index',compact('top_categories','productbrands','products','bannaers'));
    }
    function productdetails($product_id){
        // echo $product_id."<br>";
        // $categories=Category::all();
        $product= Product::find($product_id);
        $related_products=Product::where('category_id',$product->category_id)->where('id','!=',$product_id)->get();
        return view('frontend.productdetails',compact('product','related_products'));
    }
    function about(){
        // $name='anik das';
        // $students=['ajad','nilou','hasim','airer'];
        // return view('about' ,compact('name','students'));
        // $categories=Category::all();
        return view('frontend.about');

    }

    function categorywiseproduct($category_id){
        // $products= Product::where('category_id', $category_id)->get();
        // $products= Product::where('category_id', $category_id)->simplepaginate(1);
        $categories=Category::all();
        $products= Product::latest()->where('category_id', $category_id)->paginate(10);
        return view('frontend.categoriesproduct',compact('products','categories'));
    }
    function history(){
        return view('history');
    }
    function contact(){
        return view('contact');
    }
    function contactpost(Request $request){
        // return $_POST;
        //return $_POST['name'];
        //return $_POST['email'];
        //return $_POST['message'];
        //return $request->email;
        // echo $request->name;
        // echo $request->email;
        // echo $request->message;
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'message'=>'required',
        ],[
            'name.required'=>'tor name de vai',
            'email.required'=>'tor email de vai',
            'message.required'=>'tor message de vai',
        ]);
        Contact::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'message'=> $request->message,
            'created_at'=> Carbon::now()
        ]);
        return back()->with('success_message','Message send successfuly!');
        // return redirect('index');
    }

}
