<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


use Session;
session_start();


class SuperAdminController extends Controller
{
    public function index(){

        $this->authcheck();
        return view('admin.admin_home');

    }

    public function logout(){

        //Session::put('admin_name',null);
        //Session::put('admin_id',null);
        Session::flush();
        return Redirect::to('/admin');

    }

    public function authcheck(){
        $admin_id =Session::get('admin_id');
        if($admin_id){
          return;
        }else{
            return Redirect::to('/admin')->send();
        }


    }
}
