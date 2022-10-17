<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Category;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function index(){
        // $categories= Category::all();
        $categories= Category::orderby('is_top_category','desc')->get();
        return view('dashboard.category.index',compact('categories'));
    }
    public function indexinsert(Request $request){
        $request->validate([
            'category_name'=>'required',
            'category_photo'=>'required'
        ]);
        if (isset($request->is_top_category)) {
            $is_top_category="yes";
        }
        else{
            $is_top_category="no";
        }
        $category_photo= $request->file('category_photo');
        $new_name=Str::slug($request->category_name)."-".Str::random(5).".".$category_photo->getClientOriginalExtension();
        $upload_link=base_path('public/uploads/category_photos/'.$new_name);
        Image::make($category_photo)->resize(200,256)->save($upload_link);
        Category::insert([
            'category_name'=>$request->category_name,
            'category_photo'=>$new_name,
            'is_top_category'=>$is_top_category,
            'created_at'=>Carbon::now(),
        ]);

        return back()->with('category_add_s','Category add successfuly!!!');
    }
    public function categorydelete($id){

        $d_category_photo=Category::find($id)->category_photo;
        $category_delete_link=base_path('public/uploads/category_photos/'.$d_category_photo);
        unlink($category_delete_link);

        Category::find($id)->delete();
        return back();
    }
    public function categoryedit($id){
        $category=Category::find($id);
        return view('dashboard/category/edit',compact('category'));
    }
    public function categoryupdate(Request $request, $id ){
        // if($request->is_top_category){
        if(isset($request->is_top_category)){
            $is_top_category= "yes";
        }
        else{
            $is_top_category="no";
        }
        Category::find($id)->update([
            'is_top_category'=> $is_top_category,
            'category_name'=>$request->category_name,
        ]);
        if($request->hasFile('category_photo')){

            $current_category_photo= Category::find($id)->category_photo;
            $delete_category_photo_link=base_path('public/uploads/category_photos/'.$current_category_photo);
            unlink($delete_category_photo_link);

            $new_category_photo=$request->file('category_photo');
            $new_name=Str::slug($request->category_name)."-".Str::random(5).".".$new_category_photo->getClientOriginalExtension();
            $new_photo_upload_link=base_path('public/uploads/category_photos/'.$new_name);
            Image::make($new_category_photo)->resize(200,256)->save($new_photo_upload_link);
            Category::find($id)->update([
                'category_photo'=>$new_name,
            ]);
        }
        return back()->with('edit_succ','Edited Successfully');
    }
}
