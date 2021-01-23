<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
Session_start();

class SuperAdminController extends Controller
{
    public function index(){
        $this->adminAuth();
        return view('admin.dashboard');
    }

    public function adminAuth(){
       
        $admin_id=Session::get('admin_id');
        if($admin_id){
            return ;
        } else{
            return Redirect::to('/admin')->send(); // send function use na korle admin page pathabe na
        }
    }

    public function logout(){
        // Session::put('admin_id', null);
        // Session::put('admin_name', null);
        // Session::put('admin_email', null);

        Session::flush(); 

        return Redirect::to('/admin');

    }
}
