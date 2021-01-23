<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use APP\Http\Requests;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
Session_start();

class SliderController extends Controller
{
    public function index(){
        return view('admin.add_slider');
    }

    public function saveslider(Request $request){

    
    $data = array();
    $data['publication_status']=$request->publication_status;

    $image=$request->file('slider_image');

    if($image){
        $image_name=str_random(20);
        $ext=strtolower($image->getClientOriginalExtension());
        $image_full_name=$image_name.'.'.$ext;
        $upload_path='slider/';
        $image_url=$upload_path.$image_full_name;
        $success=$image->move($upload_path,$image_full_name);

        if($success){
            $data['slider_image']=$image_url;

            DB::table('slider_tbl')->insert($data);
            Session::put('exception','Slider added successfully!');
            return Redirect::to('/add_slider');
        }
    }
    $data['slider_image']='';
           DB::table('products_tbl')->insert($data);
           Session::put('exception','Slider added successfully!');
           return Redirect::to('/add_slider');
    }

    public function allslider(){

        $this->adminAuth();

        $slider_info=DB::table('slider_tbl')
            ->get();

        //    echo "<pre>";
        //    print_r($allproduct_info);
        //    exit();

        $manage_slider=view('admin.all_slider')
           ->with('allslider_info', $slider_info);

        return view('admin_layout')
          ->with('admin.all_slider', $manage_slider);


    }

    public function unactiveslider($slider_id){

        $this->adminAuth();

        DB::table('slider_tbl')
        ->where('slider_id', $slider_id)
        ->update(['publication_status'=> '0']);
        Session::put('exception', 'Slider unactive successfully!');
        return Redirect::to('/all_slider');
    }

    public function activeslider($slider_id){

        $this->adminAuth();

        DB::table('slider_tbl')
        ->where('slider_id', $slider_id)
        ->update(['publication_status'=> '1']);
        Session::put('exception', 'Slider unactive successfully!');
        return Redirect::to('/all_slider');
    }

    public function deleteslider($slider_id){

        $this->adminAuth();
        
        DB::table('slider_tbl')
          ->where('slider_id', $slider_id)
          ->delete();

          Session::put('exception', 'Slider delete successfully!');
          return Redirect::to('/all_slider');
    }

       // auth controller
       public function adminAuth(){
       
        $admin_id=Session::get('admin_id');
        if($admin_id){
            return ;
        } else{
            return Redirect::to('/admin')->send(); // send function use na korle admin page pathabe na
        }
    }
}
