<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function banner(){
        return view('dashboard.banner.index');
    }
    public function insert(Request $request){
        
    }
}
