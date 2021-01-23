<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Redirect;
use Session;
Session_start();

class AdminController extends Controller
{
    public function index(){
        return view('admin_login');
    }

    public function dashboard(Request $request)
    {

       $email = $request->admin_email;
       $password = md5($request->admin_password);
       $result = DB::table('admin_tbl')
       ->where('admin_email', $email)
       ->where('admin_password', $password)
       ->first();

    //    echo "</pre>";
    //    print_r($result);

    if($result){
        // echo "wellcome";
        Session::put('admin_id',$result->admin_id);
        Session::put('admin_name', $result->admin_name);
        Session::put('admin_email',$result->admin_email);
        return Redirect::to('/dashboard');
    } else{
        Session::put('exception','Email or password invalid!');
        return Redirect::to('/admin');
    }


    }

    
}