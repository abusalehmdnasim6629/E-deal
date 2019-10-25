<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;


use Session;
session_start();
class SliderController extends Controller
{
    public function index()
    {
        return view('admin.add_slider');
    }

    public function save_slider(Request $request)
    {
        
        $data= array();
        $data['slider_id'] = $request->slider_id;
        $data['publication_status'] = $request->publication_status;  
        
        
        

        
    if($request->hasfile('slider_image'))
        {
            $image = $request->file('slider_image');
            
            $image_name = Str::random(20);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'image/slider/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path,$image_full_name);

            if($success)
            {
                $data['slider_image'] = $image_url;
                DB::table('tbl_slider')->insert($data);
                Session::put('messege','Add product successfully!!..');
                return Redirect('/add-slider');
            
                
            }
           
            
        }
        
    }

    public function all_slider(){
        
        $all_slider_info = DB::table('tbl_slider')
                          ->orderBy('slider_id','asc')
                          ->get();
        $manage_slider = view('admin.all_slider')
                       ->with('all_slider_info',$all_slider_info);
        
            return view('admin_layout')
               ->with('admin.all_slider',$manage_slider);
  
      }

      public function deactive_slider($slider_id)
      {
       
         
        DB::table('tbl_slider')
              ->where('slider_id', $slider_id)
              ->update(['publication_status'=>0]);
              
              
        //  $n=DB::table('tbl_product')
        //     ->where('product_id', $product_id)
        //     ->first();
            
            // echo "<pre>";
            //  print_r($n);
            //  echo "</pre>";

             
          return Redirect::to('/all-slider');
           
      }  

      public function active_slider($slider_id)
      {
       
         
        DB::table('tbl_slider')
              ->where('slider_id', $slider_id)
              ->update(['publication_status'=>1]);
              
              
        //  $n=DB::table('tbl_product')
        //     ->where('product_id', $product_id)
        //     ->first();
            
            // echo "<pre>";
            //  print_r($n);
            //  echo "</pre>";

             
          return Redirect::to('/all-slider');
           
      }  

      public function delete_slider($slider_id)
      {
       
         
        DB::table('tbl_slider')
              ->where('slider_id', $slider_id)
              ->delete();
              
              
        //  $n=DB::table('tbl_product')
        //     ->where('product_id', $product_id)
        //     ->first();
            
            // echo "<pre>";
            //  print_r($n);
            //  echo "</pre>";

             
          return Redirect::to('/all-slider');
           
      }  

    
}
