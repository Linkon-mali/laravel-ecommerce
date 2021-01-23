<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use APP\Http\Requests;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
Session_start();


class ProductController extends Controller
{
    public function index(){

        $this->adminAuth();
        
        return view('admin.add_product');
    }

    public function saveproduct(Request $request){

        $this->adminAuth();
    
    $data = array();
    $data['product_name']=$request->product_name;
    $data['catagory_id']=$request->catagory_id;

    $data['manufacture_id']=$request->manufacture_id;
    $data['product_short_description']=$request->product_short_description;
    $data['product_long_description']=$request->product_long_description;
    $data['product_price']=$request->product_price;
    $data['product_size']=$request->product_size;
    $data['product_color']=$request->product_color;
    $data['publication_status']=$request->publication_status;

    $image=$request->file('product_image');

    if($image){
        $image_name=str_random(20);
        $ext=strtolower($image->getClientOriginalExtension());
        $image_full_name=$image_name.'.'.$ext;
        $upload_path='image/';
        $image_url=$upload_path.$image_full_name;
        $success=$image->move($upload_path,$image_full_name);

        if($success){
            $data['product_image']=$image_url;

            DB::table('products_tbl')->insert($data);
            Session::put('exception','Product added successfully!');
            return Redirect::to('/add_product');
        }
    }
    $data['product_image']='';
           DB::table('products_tbl')->insert($data);
           Session::put('exception','Product added successfully!');
           return Redirect::to('/add_product');

    }

    public function allproduct(){

        $this->adminAuth();
              
        $allproduct_info=DB::table('products_tbl')
           ->join('catagory_tbl','products_tbl.catagory_id','=','catagory_tbl.catagory_id')
           ->join('manufacture_tbl','products_tbl.manufacture_id','=','manufacture_tbl.manufacture_id')
           ->select('products_tbl.*','catagory_tbl.catagory_name','manufacture_tbl.manufacture_name')
           ->get();

        //    echo "<pre>";
        //    print_r($allproduct_info);
        //    exit();

        $manage_catagory=view('admin.all_product')
           ->with('allproduct_info', $allproduct_info);

        return view('admin_layout')
          ->with('admin.all_product', $manage_catagory);


    }

    public function unactiveproduct($product_id){

        $this->adminAuth();
        
        DB::table('products_tbl')
            ->where('product_id', $product_id)
            ->update(['publication_status'=> '0']);
            Session::put('exception', 'Product unactive successfully!');
            return Redirect::to('/all_product');
    }

    public function activeproduct($product_id){

        $this->adminAuth();
        
        DB::table('products_tbl')
            ->where('product_id', $product_id)
            ->update(['publication_status'=> '1']);
            Session::put('exception', 'Product active successfully!');
            return Redirect::to('/all_product');
    }

    public function editproduct($product_id){

        $this->adminAuth();

        $product_info=DB::table('products_tbl')
           ->where('product_id', $product_id)
           ->first();

        $manage_product=view('admin.edit_product')
           ->with('allproduct_info', $product_info);

        return view('admin_layout')
          ->with('admin.edit_product', $manage_product);
        
     return view('/admin.edit_product');

    }

    public function updateproduct(Request $request, $product_id){

        $this->adminAuth();

        $data=array();
        $data['product_name']=$request->product_name;
        $data['product_price']=$request->product_price;
        $data['product_short_description']=$request->product_short_description;

        // echo "</pre>";
        // print_r($data);

        DB::table('products_tbl')
        ->where('product_id', $product_id)
        ->update($data);
        Session::put('exception', 'Product update successfully!');
        return Redirect::to('/all_product');
    }

    public function deleteproduct($product_id){

        $this->adminAuth();
        
        DB::table('products_tbl')
          ->where('product_id', $product_id)
          ->delete();

          Session::put('exception', 'Product delete successfully!');
          return Redirect::to('/all_product');
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
