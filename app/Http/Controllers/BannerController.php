<?php

namespace App\Http\Controllers;
use App\Models\Banner;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function banner(){
        return view('dashboard.banner.index');
    }
    public function insert(Request $request){
        $request->validate([
           'product_category'=>'required',
        ]);
        Banner::insert([
            'created_at'=>Carbon::now(),
        ]);
    }
}
