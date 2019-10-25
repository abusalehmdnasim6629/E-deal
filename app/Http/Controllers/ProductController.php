<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;


use Session;
session_start();

class ProductController extends Controller
{
    public function index()
    {
        $this->authcheck();
        return view('admin.add_product');
    }

    public function save_product(Request $request)
    {
        $this->authcheck();
        $data= array();
        $data['product_id'] = $request->product_id;
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->category_id;
        $data['manufacture_id'] = $request->manufacture_id;
        $data['product_long_description'] = $request->product_long_description;
        $data['product_short_description'] = $request->product_short_description;
        $data['product_price'] = $request->product_price;
        $data['product_size'] = $request->product_size;
        $data['product_color'] = $request->product_color;
        $data['publication_status'] = $request->publication_status;  
        
        
        

        
    if($request->hasfile('product_image'))
        {
            $image = $request->file('product_image');
            
            $image_name = Str::random(20);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $upload_path = 'image/';
            $image_url = $upload_path.$image_full_name;
            $success = $image->move($upload_path,$image_full_name);

            if($success)
            {
                $data['product_image'] = $image_url;
                DB::table('tbl_product')->insert($data);
                Session::put('messege','Add product successfully!!..');
                return Redirect('/add-product');
            
                
            }
           
            
        }
        else{
            $data['product_image'] ='';
            DB::table('tbl_product')->insert($data);
            Session::put('messege','Add product successfully without image!!..');
            return Redirect('/add-product');
        }    

    }

    public function all_product(){
         
        $this->authcheck();
        $all_product_info = DB::table('tbl_product')
                        ->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id') 
                        ->join('tbl_manufacture','tbl_product.manufacture_id','=','tbl_manufacture.manufacture_id')
                        ->select('tbl_product.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
                  
                        ->orderBy('product_id','asc')
                        ->get();



        $manage_product = view('admin.all_product')
                       ->with('all_product_info',$all_product_info);
        
            return view('admin_layout')
               ->with('admin.all_product',$manage_product);
  
      }

    public function deactive_product($product_id)
      {
        $this->authcheck();
         
        DB::table('tbl_product')
              ->where('product_id', $product_id)
              ->update(['publication_status'=>0]);
              
              
        //  $n=DB::table('tbl_product')
        //     ->where('product_id', $product_id)
        //     ->first();
            
            // echo "<pre>";
            //  print_r($n);
            //  echo "</pre>";

             
          return Redirect::to('/all-product');
           
      }

    public function active_product($product_id)
    {
        $this->authcheck();
       DB::table('tbl_product')
           ->where('product_id',$product_id)
           ->update(['publication_status'=>1]);

        //    $n=DB::table('tbl_product')
        //    ->where('product_id', $product_id)
        //    ->first();
           
        //    echo "<pre>";
        //     print_r($n);
        //     echo "</pre>";

           
          return Redirect::to('/all-product');
         
    }

    public function delete_product($product_id)
    {
        $this->authcheck();
        DB::table('tbl_product')
        ->where('product_id',$product_id)
        ->delete(); 
        Session::put('messege','delete product successfully!!..');
        return Redirect::to('/all-product');
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
