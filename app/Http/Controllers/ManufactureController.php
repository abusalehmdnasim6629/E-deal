<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


use Session;
session_start();

class ManufactureController extends Controller
{
    public function index(){
        $this->authcheck();
        return view('admin.add_brand');
    }

    public function save_brand(Request $request)
    {
        $this->authcheck();
        $data= array();
        $data['manufacture_id'] = $request->manufacture_id;
        $data['manufacture_name'] = $request->manufacture_name;
        $data['manufacture_description'] = $request->manufacture_description;
        $data['publication_status'] = $request->publication_status;     
        
        DB::table('tbl_manufacture')->insert($data);
        Session::put('messege','Added manufacture successfully!!..');
        return Redirect('/add-brand');
        

    }

    public function all_brand(){
         
        $this->authcheck();
        $all_manufacture_info = DB::table('tbl_manufacture')->get();
        $manage_manufacture = view('admin.all_brand')
                       ->with('all_manufacture_info',$all_manufacture_info);
        
            return view('admin_layout')
               ->with('admin.all_brand',$manage_manufacture);
  
      }
    
    public function deactive_brand($manufacture_id)
    {
        $this->authcheck();
      DB::table('tbl_manufacture')
           ->where('manufacture_id',$manufacture_id)
           ->update(['publication_status'=>0]);
           
           return Redirect::to('/all-brand');
         
    }

    public function active_brand($manufacture_id)
    {
        $this->authcheck();
      DB::table('tbl_manufacture')
           ->where('manufacture_id',$manufacture_id)
           ->update(['publication_status'=>1]);
           
           return Redirect::to('/all-brand');
         
    }

    public function edit_brand($manufacture_id)
    {
        $this->authcheck();
        $manufacture_info = DB::table('tbl_manufacture')
        ->where('manufacture_id',$manufacture_id)
        ->first();
        $manufacture = view('admin.edit_brand')
                     ->with('manufacture_info',$manufacture_info);
      
          return view('admin_layout')
             ->with('admin.edit_brand',$manufacture);
    }

    public function update_brand(Request $request, $manufacture_id)
    {   
        $this->authcheck();
        $data = array();
        $data['manufacture_name'] = $request->manufacture_name;
        $data['manufacture_description'] = $request->manufacture_description;

        DB::table('tbl_manufacture')
           ->where('manufacture_id',$manufacture_id)
           ->update($data);
           Session::put('messege','Upadte brand successfully!!..');
           
           return Redirect::to('/all-brand');
           
    }

    public function delete_brand($manufacture_id)
    {
        $this->authcheck();
        DB::table('tbl_manufacture')
        ->where('manufacture_id',$manufacture_id)
        ->delete(); 
        Session::put('messege','delete brand successfully!!..');
        return Redirect::to('/all-brand');
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
