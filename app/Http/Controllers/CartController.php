<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use DB;
use Cart;

class CartController extends Controller
{
   public function addtocart(Request $request){

       $qty=$request->qty;
       $product_id=$request->product_id;

       $product_info=DB::table('products_tbl')
           ->where('product_id', $product_id)
           ->first();

           echo "</pre>";
           print_r($product_info);

        $data['qty']=$qty;
        $data['id']=$product_info->product_id;
        $data['name']=$product_info->product_name;
        $data['price']=$product_info->product_price;
        $data['options']['image']=$product_info->product_image;

        Cart::add($data);
        return Redirect::to('/show_cart');
   }

   public function showcart(){
        
        $all_published_catagory=DB::table('catagory_tbl')
            ->where('publication_status', 1)
            ->get();

        $manage_published_catagory=view('pages.addto_card')
            ->with('all_published_catagory', $all_published_catagory);
  
        return view('layout')
            ->with('pages.addto_card', $manage_published_catagory);
  
   }

   public function deletetocart($rowId){

     Cart::update($rowId, 0);
     return Redirect('/show_cart');
   }

   public function updatecart(Request $request){

     $qty=$request->qty;
     $rowId=$request->rowId;

    //  echo $qty;
    //  echo "</br>";
    //  echo $rowId;

    Cart::update($rowId, $qty);
    return Redirect::to('/show_cart');

   }


}
