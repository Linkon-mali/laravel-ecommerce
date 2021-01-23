<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use APP\Http\Requests;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
Session_start();

class HomeController extends Controller
{
    public function index(){

        $allpublish_product=DB::table('products_tbl')
        ->join('catagory_tbl','products_tbl.catagory_id','=','catagory_tbl.catagory_id')
        ->join('manufacture_tbl','products_tbl.manufacture_id','=','manufacture_tbl.manufacture_id')
        ->select('products_tbl.*','catagory_tbl.catagory_name','manufacture_tbl.manufacture_name')
        ->where('products_tbl.publication_status', 1)
        ->limit(9)
        ->get();

     //    echo "<pre>";
     //    print_r($allproduct_info);
     //    exit();

     $manage_publlish_product=view('pages.home_content')
        ->with('allpublish_product_info', $allpublish_product);

     return view('layout')
       ->with('pages.home_content', $manage_publlish_product);


        // return view('pages.home_content');
    }

    public function showproduct_bycatagory($catagory_id){

        $productby_catagory=DB::table('products_tbl')
        ->join('catagory_tbl','products_tbl.catagory_id','=','catagory_tbl.catagory_id')
        
        ->select('products_tbl.*','catagory_tbl.catagory_name')
        ->where('catagory_tbl.catagory_id', $catagory_id)
        ->where('products_tbl.publication_status', 1)
        ->limit(18)
        ->get();

     //    echo "<pre>";
     //    print_r($allproduct_info);
     //    exit();

     $manage_productby_catagory=view('pages.catagoryby_product')
        ->with('prodouctby_catagory', $productby_catagory);

     return view('layout')
       ->with('pages.catagoryby_product', $manage_productby_catagory);


    }

    public function showproduct_bymanufacture($manufacture_id){

        $productby_manufacture=DB::table('products_tbl')

        ->join('catagory_tbl','products_tbl.catagory_id','=','catagory_tbl.catagory_id')
        ->join('manufacture_tbl','products_tbl.manufacture_id','=','manufacture_tbl.manufacture_id')
        ->select('products_tbl.*','catagory_tbl.catagory_name','manufacture_tbl.manufacture_name')
        ->where('manufacture_tbl.manufacture_id', $manufacture_id)
        ->where('products_tbl.publication_status', 1)
        ->limit(18)
        ->get();

        // echo "<pre>";
        // print_r($productby_manufacture);
        // exit();

     $manage_productby_manufacture=view('pages.manufactureby_product')
        ->with('prodouctby_manufacture', $productby_manufacture);

     return view('layout')
       ->with('pages.manufactureby_product', $manage_productby_manufacture);


    }

    public function product_view_details($product_id){

        $product_view=DB::table('products_tbl')
        ->join('catagory_tbl','products_tbl.catagory_id','=','catagory_tbl.catagory_id')
        ->join('manufacture_tbl','products_tbl.manufacture_id','=','manufacture_tbl.manufacture_id')
        ->select('products_tbl.*', 'manufacture_tbl.*', 'catagory_tbl.catagory_name')
        ->where('products_tbl.product_id', $product_id)
        ->where('products_tbl.publication_status', 1)
        ->first();

     //    echo "<pre>";
     //    print_r($allproduct_info);
     //    exit();

     $manage_product_view_details=view('pages.product_details')
        ->with('prodouct_view_details', $product_view);

     return view('layout')
       ->with('pages.product_details', $manage_product_view_details);


    }
}
