<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class OrderController extends Controller
{
   public function manageorder(){

    $all_order_info=DB::table('order_tbl')
       ->join('coustomers_tbl', 'order_tbl.coustomer_id','=','coustomers_tbl.coustomer_id')
       ->select('order_tbl.*','coustomers_tbl.coustomer_name')
       ->get();

    $manage_order=view('admin.manage_order')
       ->with('all_order_info',$all_order_info);

    return view('admin_layout')
       ->with('admin.manage_order', $manage_order);
   }

   public function vieworder($order_id){
         
    $order_by_id=DB::table('order_tbl')
        ->join('coustomers_tbl', 'order_tbl.coustomer_id','=','coustomers_tbl.coustomer_id')
        ->join('order_details_tbl', 'order_tbl.order_id','=','order_details_tbl.order_id')
        ->join('shipping_tbl', 'order_tbl.shipping_id','=','shipping_tbl.shipping_id')
        ->select('order_tbl.*', 'order_details_tbl.*','shipping_tbl.*','coustomers_tbl.*')
        ->first();

    $view_order=view('admin.view_order')
        ->with('order_by_id',$order_by_id);

    return view('admin_layout')
        ->with('admin.view_order', $view_order);

    // echo "</pre>";
    // print_r($order_by_id);

   }
}
