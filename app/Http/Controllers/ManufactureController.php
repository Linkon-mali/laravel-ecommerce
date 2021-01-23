<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
Session_start();

class ManufactureController extends Controller
{
    public function index(){

        $this->adminAuth();

        return view('admin.add_manufacture');
    }

    public function savemanufacture(Request $request){

        $this->adminAuth();
         
        $data=array();
        $data['manufacture_id']=$request->manufacture_id;
        $data['manufacture_name']=$request->manufacture_name;
        $data['manufacture_description']=$request->manufacture_description;
        $data['publication_status']=$request->publication_status;

        echo "</pre>";
        print_r($data);

        DB::table('manufacture_tbl')->insert($data);
        Session::put('exception', 'Manufacture added successfully!');
        return Redirect::to('/add_manufacture');
    }

    public function allmanufacture(){

        $this->adminAuth();
      
        $allmanufacture_info=DB::table('manufacture_tbl')
           ->get();
        $manage_manufacture=view('admin.all_manufacture')
           ->with('allmanufacture_info', $allmanufacture_info);

        return view('admin_layout')
          ->with('admin.all_manufacture', $manage_manufacture);


        // return view('admin.all_catagory');
    }

    public function unactivemanufacture($catagory_id){

        $this->adminAuth();
        
        DB::table('manufacture_tbl')
            ->where('manufacture_id', $catagory_id)
            ->update(['publication_status'=> '0']);
            Session::put('exception', 'Manufacture unactive successfully!');
            return Redirect::to('/all_manufacture');
    }

    public function activemanufacture($manufacture_id){

        $this->adminAuth();
        
        DB::table('manufacture_tbl')
            ->where('manufacture_id', $manufacture_id)
            ->update(['publication_status'=> '1']);
            Session::put('exception', 'Manufacture active successfully!');
            return Redirect::to('/all_manufacture');
    }

    public function editmanufacture($manufacture_id){

        $this->adminAuth();

        $manufacture_info=DB::table('manufacture_tbl')
           ->where('manufacture_id', $manufacture_id)
           ->first();

        $manage_manufacture=view('admin.edit_manufacture')
           ->with('allmanufacture_info', $manufacture_info);

        return view('admin_layout')
          ->with('admin.edit_manufacture', $manage_manufacture);
        
    //  return view('/admin.edit_catagory');

    }

    public function updatemanufacture(Request $request, $manufacture_id){

        $this->adminAuth();

        $data=array();
        $data['manufacture_name']=$request->manufacture_name;
        $data['manufacture_description']=$request->manufacture_description;

        echo "</pre>";
        print_r($data);

        DB::table('manufacture_tbl')
        ->where('manufacture_id', $manufacture_id)
        ->update($data);
        Session::put('exception', 'Manufacture update successfully!');
        return Redirect::to('/all_manufacture');
    }

    public function deletemanufacture($manufacture_id){

        $this->adminAuth();
        
        DB::table('manufacture_tbl')
          ->where('manufacture_id', $manufacture_id)
          ->delete();

          Session::put('exception', 'Manufacture delete successfully!');
          return Redirect::to('/all_manufacture');
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
