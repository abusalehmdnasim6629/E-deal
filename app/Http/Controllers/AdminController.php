<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Validator;
use Session;
session_start();

class AdminController extends Controller
{
    
    public function index(){

        return view('admin_login');

    }
    
    
    public function dashboard(Request $request){
         $admin_email = $request->admin_email;
         $admin_password = md5($request->admin_password);
         
         $result = DB::table('tbl_admin')
                ->where('admin_email',$admin_email)
                ->where('admin_password',$admin_password)
                ->first();
                 if($result)
                 {
                    Session::put('admin_name',$result->admin_name);
                    Session::put('admin_id',$result->admin_id);
                    return Redirect::to('/dashboard');
                 }else{
                    Session::put('message','Email or password Invalid');
                    return Redirect::to('/admin');
                 }
        
    }
    public function admin_register(){



        return view('admin_reg');
    }

    public function admin_save(Request $request){

        // $request->validate([
        //     'admin_email' => 'required|email|unique:tbl_admin',
        //     'admin_password' => 'required|max:8',
        //     'admin_name' => 'required',
        //     'admin_phone' => 'required',
        // ]);
        $validator = Validator::make(

              array('admin_email' => 'required|email|unique:tbl_admin'),
              array('admin_password' => 'required|max:8'),
              array( 'admin_name' => 'required'),
              array('admin_phone' => 'required|unique:tbl_admin')


        );
        
        if($validator->fails()){
            Session::put('message','Invalid registration');

            return Redirect()->back()->withErrors($validator)->withInput();
        }
        $ad= array();
                
        $ad['admin_email'] = $request->admin_email;
        $ad['admin_password']  =md5($request->admin_password); 
        $ad['admin_name']  = $request->admin_name;
        $ad['admin_phone']  = $request->admin_phone;
        DB::table('tbl_admin')
            ->insert($ad);
        
        return Redirect::to('/admin');
    
        
        
    }
    
}
