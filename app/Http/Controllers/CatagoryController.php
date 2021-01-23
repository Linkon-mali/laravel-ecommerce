<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
Session_start();

class CatagoryController extends Controller
{
    public function index(){

        $this->adminAuth();

        return view('admin.add_catagory');
    }

    public function allcatagory(){

        $this->adminAuth();
      
        $allcatagory_info=DB::table('catagory_tbl')
           ->get();
        $manage_catagory=view('admin.all_catagory')
           ->with('allcatagory_info', $allcatagory_info);

        return view('admin_layout')
          ->with('admin.all_catagory', $manage_catagory);


        // return view('admin.all_catagory');
    }

    public function savecatagory(Request $request){

        $this->adminAuth();
        
        $data=array();
        $data['catagory_id']=$request->catagory_id;
        $data['catagory_name']=$request->catagory_name;
        $data['catagory_description']=$request->catagory_description;
        $data['publication_status']=$request->publication_status;

        // echo "</pre>";
        // print_r($data);

        DB::table('catagory_tbl')->insert($data);
        Session::put('exception', 'Catagory added successfully!');
        return Redirect::to('/add_catagory');
    }

    public function unactivecatagory($catagory_id){

        $this->adminAuth();
        
        DB::table('catagory_tbl')
            ->where('catagory_id', $catagory_id)
            ->update(['publication_status'=> '0']);
            Session::put('exception', 'Catagory unactive successfully!');
            return Redirect::to('/all_catagory');
    }

    public function activecatagory($catagory_id){

        $this->adminAuth();
        
        DB::table('catagory_tbl')
            ->where('catagory_id', $catagory_id)
            ->update(['publication_status'=> '1']);
            Session::put('exception', 'Catagory active successfully!');
            return Redirect::to('/all_catagory');
    }

    public function editcatagory($catagory_id){

        $this->adminAuth();

        $catagory_info=DB::table('catagory_tbl')
           ->where('catagory_id', $catagory_id)
           ->first();

        $manage_catagory=view('admin.edit_catagory')
           ->with('allcatagory_info', $catagory_info);

        return view('admin_layout')
          ->with('admin.edit_catagory', $manage_catagory);
        
    //  return view('/admin.edit_catagory');

    }

    public function updatecatagory(Request $request, $catagory_id){

        $this->adminAuth();

        $data=array();
        $data['catagory_name']=$request->catagory_name;
        $data['catagory_description']=$request->catagory_description;

        // echo "</pre>";
        // print_r($data);

        DB::table('catagory_tbl')
        ->where('catagory_id', $catagory_id)
        ->update($data);
        Session::put('exception', 'Catagory update successfully!');
        return Redirect::to('/all_catagory');
    }

    public function deletcatagory($catagory_id){

        $this->adminAuth();
        
        DB::table('catagory_tbl')
          ->where('catagory_id', $catagory_id)
          ->delete();

          Session::put('exception', 'Catagory delete successfully!');
          return Redirect::to('/all_catagory');
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
