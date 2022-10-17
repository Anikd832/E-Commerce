<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $contacts=contact::all();
        // $contacts=contact::latest()->get();
        //  $contacts=contact::orderBy('status','desc')->get();
         return view('dashboard.home');
        //return view('dashboard.home');
    }
    public function profile(){
        return view('dashboard.profile');
    }
    public function changename(Request $request){
        //return $requests;
        // echo auth()->user()->id;
        // echo auth()->id();
        $old_name=auth()->user()->name;
        User::find(auth()->user()->id)->update([
            'name'=>$request->name,
        ]);
        // return back()->with('name_change_success', "Your name change from $old_name to $request->name successfuly!");
        return redirect('profile#name_change')->with('name_change_success', "Your name change from $old_name to $request->name successfuly!");
        //return back()->with('name_change_success','Your name change from '.$old_name . ' to '.$request->name.'   successfuly!');
    }
    public function changepassword(Request $request){
        // $request->validate([
        //     'current_password'=>'required',
        //     'new_password'=>'required',
        //     'confirm_password'=>'required'
        // ]);
        //return bcrypt($request->current_password) ;
        //auth()->user()->password;
        //return Hash::check($request->current_password, auth()->user()->password);
        if(Hash::check($request->current_password, auth()->user()->password)){
            if($request->new_password == $request->confirm_password){

                // User::find(auth()->user()->id)->update([
                User::find(auth()->id())->update([
                    'password'=>bcrypt($request->new_password)
                ]);
                // return back()->with('p_success','Password changed successfully!!!');
                return redirect('profile#p_change')->with('p_success','Password changed successfully!!!');
            }
            else{
                // return back()->with('p_not_match','New & Confirm password dose not match!!!');
                return redirect('profile#p_change')->with('p_not_match','New & Confirm password dose not match!!!');
            }
        }
        else{
            return redirect('profile#p_change')->with('p_not_match','Current password not match!!!');
        }

    }
    public function change_profilephoto(Request $request){
        $request->validate([
            'profile_photo'=>'required',
        ]);
        //echo $request->file('profile_photo');
        //echo $profile_photo->getClientOriginalExtension();
        //echo $extention_check=$request->profile_photo->getClientOriginalExtension();
        //echo  Str::slug(auth()->user()->name)."-".auth()->user()->id.".".$request->file('profile_photo')->getClientOriginalExtension();
        if(auth()->user()->profile_photo != "default_profile_photo.png"){
            $delete_profile_link=base_path('public/uploads/profile_photos/'.auth()->user()->profile_photo);
            unlink($delete_profile_link);
        }
        $profile_photo = $request->file('profile_photo');
        $new_name = Str::slug(auth()->user()->name)."-".auth()->user()->id.".".$profile_photo->getClientOriginalExtension();
        $upload_link= base_path('public/uploads/profile_photos/'.$new_name);
        // upload via image intervention
        // Image::make($profile_photo)->resize(20,20)->save($link);
        Image::make($profile_photo)->save($upload_link);
        User::find(auth()->id())->update([
            'profile_photo'=>$new_name,
        ]);
        // return back()->with('profile_p_success','Profile photo add successfuly');
        return redirect('profile#profile_photo_change')->with('profile_p_success','Profile photo add successfuly');
    }
    public function change_coverphoto(Request $request){
        $request->validate([
            'cover_photo'=>'required',
        ]);
        if(auth()->user()->cover_photo !='default_cover_photo.jpg'){
            $delete_cover_p_link=base_path('public/uploads/cover_photos/'.auth()->user()->cover_photo);
            unlink($delete_cover_p_link);
        }
        $cover_photo=$request->file('cover_photo');
        $new_name=Str::slug(auth()->user()->name)."-".auth()->user()->id.".".$cover_photo->getClientOriginalExtension();
        $upload_link=base_path('public/uploads/cover_photos/'.$new_name);
        Image::make($cover_photo)->resize(1600,451)->save($upload_link);
        User::find(auth()->id())->update([
            'cover_photo'=>$new_name,
        ]);
        // return back()->with('Cover_p_success','Cover photo add successfuly');
        return redirect('profile#c_photo_change')->with('Cover_p_success','Cover photo add successfuly');
    }
    public function messages()
    {
        $contacts=Contact::orderBy('status','desc')->get();
        return view('dashboard.messages',compact('contacts'));
    }
    public function deletemessage($id){
        // echo $id;
        Contact::find($id)->delete();
        return back();
    }
    public function readmessage($id){
        Contact::find($id)->update([
            'status'=>'read',
        ]);
        return back();

    }

}
