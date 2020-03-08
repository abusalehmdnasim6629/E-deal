<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;


use Session;
session_start();

class DelivarymanController extends Controller
{
    public function add_delivaryman(Request $request){
               $this->authcheck();
               return view('admin.delivaryman_manage');

    }

    public function save_delivaryman(Request $request)
    {
        $da= array();
        $da['delivaryman_id'] = $request->delivaryman_id;
        $da['delivaryman_name'] = $request->delivaryman_name;
        $da['publication_status'] = $request->publication_status;  
        
        
        

        
            if($request->hasfile('delivaryman_image'))
                {
                    $ima = $request->file('delivaryman_image');
                    $ima_name = Str::random(20);
                    $ex = strtolower($ima->getClientOriginalExtension());
                    $ima_full_name = $ima_name.'.'.$ex;
                    $up_path = 'image/';
                    $ima_url = $up_path.$ima_full_name;
                    $succ = $ima->move($up_path,$ima_full_name);

                    if($succ)
                    {
                       $da['delivaryman_image'] = $ima_url;
                        DB::table('tbl_delivaryman')->insert($da);
                        Session::put('me','Add delivaryman successfully!!..');
                        return Redirect::to('/add-delivaryman');
                    
                        
                    }
                
                    
                }
                else{
                    $da['delivaryman_image'] ='';
                    DB::table('tbl_delivaryman')->insert($da);
                    Session::put('me','Add product successfully without image!!..');
                    return Redirect::to('/add-delivaryman');
                }    

        

    }

    public function all_delivaryman(){
         
        $this->authcheck();
        $all_delivaryman_info = DB::table('tbl_delivaryman')
                        
                        ->select('tbl_delivaryman.*')
                  
                        ->orderBy('delivaryman_id','asc')
                        ->get();



        $manage_delivaryman = view('admin.all_delivaryman')
                       ->with('all_delivaryman_info',$all_delivaryman_info);
        
            return view('admin_layout')
               ->with('admin.all_delivaryman',$manage_delivaryman);
  
      }

      public function deactive_delivaryman($delivaryman_id)
      {
   
        $this->authcheck();
        DB::table('tbl_delivaryman')
              ->where('delivaryman_id', $delivaryman_id)
              ->update(['publication_status'=>0]);
              

             
          return Redirect::to('/all-delivaryman');
           
      }

      public function active_delivaryman($delivaryman_id)
      {
        $this->authcheck();
         DB::table('tbl_delivaryman')
             ->where('delivaryman_id',$delivaryman_id)
             ->update(['publication_status'=>1]);
  
             
            return Redirect::to('/all-delivaryman');
           
      }

      public function delete_delivaryman($delivaryman_id)
      {
         
          DB::table('tbl_delivaryman')
          ->where('delivaryman_id',$delivaryman_id)
          ->delete(); 
          Session::put('messege','delete delivaryman successfully!!..');
          return Redirect::to('/all-delivaryman');
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
