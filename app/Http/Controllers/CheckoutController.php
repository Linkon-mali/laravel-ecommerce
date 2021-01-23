<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use APP\Http\Requests;
use Cart;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;

class CheckoutController extends Controller
{
    public function logincheck(){

        return view('pages.login');
    }

    public function coustomerregistration(Request $request){
          
        $data=array();
        $data['coustomer_name']=$request->coustomer_name;
        $data['coustomer_email']=$request->coustomer_email;
        $data['password']=$request->password;
        $data['mobile_number']=$request->mobile_number;

            $coustomer_id=DB::table('coustomers_tbl')
              ->insertGetId($data);

            Session::put('coustomer_id', $coustomer_id);
            Session::put('coustomer_name', $request->coustomer_name);

            return Redirect::to('/checkout');
    }

    public function checkout(){

        return view('pages.checkout');
    }

    public function saveshippingdetails(Request $request){
     
        $data=array();
          
        $data['shipping_first_name']=$request->shipping_first_name;
        $data['shipping_last_name']=$request->shipping_last_name;
        $data['shipping_email']=$request->shipping_email;
        $data['shipping_address']=$request->shipping_address;
        $data['shipping_mobile_number']=$request->shipping_mobile_number;
        $data['shipping_city']=$request->shipping_city;

        // echo "<pre>";
        // print_r($data);

        $shipping_Id=DB::table('shipping_tbl')
            ->insertGetId($data);

            Session::put('shipping_id', $shipping_Id);
            return Redirect::to('/payment');

    }


    public function coustomerlogin(Request $request){

        $coustomer_email=$request->coustomer_email;
        $password=$request->password;
        $result=DB::table('coustomers_tbl')
           ->where('coustomer_email', $coustomer_email)
           ->where('password', $password)
           ->first();

        //  echo "</pre>";
        //  print_r($result);
        if($result){
            Session::put('coustomer_id', $result->coustomer_id);
            return Redirect::to('/checkout');
        } else{
            return Redirect::to('/login_check');
        }

    }

    public function coustomerlogout(){

        Session::flush();

        return Redirect::to('/');
    }

    public function payment(){

        return view('pages.payment');
    }

    public function orderplace(Request $request){
       
        $payment_gateway=$request->payment_method;
       
        $pdata=array();
        $pdata['payment_method']=$payment_gateway;
        $pdata['payment_status']='pending';

        $payment_id=DB::table('payment_tbl')
          ->insertGetId($pdata);

        $odata=array();
        $odata['coustomer_id']=Session::get('coustomer_id');
        $odata['shipping_id']=Session::get('shipping_id');
        $odata['payment_id']=$payment_id;
        $odata['order_total']=Cart::total();
        $odata['order_status']='pending';
        $order_id=DB::table('order_tbl')
          ->insertGetId($odata);
        
        $contents=Cart::content();
        $oddata=array();

        foreach($contents as $v_content){
            $oddata['order_id']=$order_id;
            $oddata['product_id']=$v_content->id;
            $oddata['product_name']=$v_content->name;
            $oddata['product_price']=$v_content->price;
            $oddata['product_sales_quantity']=$v_content->qty;

            DB::table('order_details_tbl')
               ->insert($oddata);
        }

        if($payment_gateway=='handcash'){
            Cart::destroy();
            return view('pages.handcash');
        } elseif($payment_gateway=='cart'){
            echo "Cart successfully!";
        } elseif($payment_gateway=='payple'){
            echo "Payple successfully!";
        }else{
            echo "not selected";
        }

    }

}
