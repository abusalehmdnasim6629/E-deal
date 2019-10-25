<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Cart;

use Session;
session_start();

class CustomerController extends Controller
{
    public function all_customer(){
         
  
        $all_customer_info = DB::table('tbl_customer')
                        
                        ->select('tbl_customer.*')
                  
                        ->orderBy('customer_id','asc')
                        ->get();



        $manage_customer = view('admin.all_customer')
                       ->with('all_customer_info',$all_customer_info);
        
            return view('admin_layout')
               ->with('admin.all_customer',$manage_customer);
  
      }

      public function delete_customer($customer_id)
    {
    
        DB::table('tbl_customer')
        ->where('customer_id',$customer_id)
        ->delete(); 
        Session::put('messege','delete customer successfully!!..');
        return Redirect::to('/all-customer');
    }
}
