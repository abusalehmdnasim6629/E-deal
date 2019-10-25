<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


use Session;
session_start();




class CategoryController extends Controller
{
    public function index(){
        $this->authcheck();
        return view('admin.add_category');

    }

    public function all_category(){
         
      $this->authcheck();
      $all_category_info = DB::table('tbl_category')
                        ->orderBy('category_id','asc')
                        ->get();
      $manage_category = view('admin.all_category')
                     ->with('all_category_info',$all_category_info);
      
          return view('admin_layout')
             ->with('admin.all_category',$manage_category);

    }
    public function save_category(Request $request)
    {   $this->authcheck();
        $data= array();
        $data['category_id'] = $request->category_id;
        $data['category_name'] = $request->category_name;
        $data['category_description'] = $request->category_description;
        $data['publication_status'] = $request->publication_status;     
        
        DB::table('tbl_category')->insert($data);
        Session::put('messege','Added category successfully!!..');
        return Redirect('/add-category');
        

    }
    public function deactive_category($category_id)
    {
        $this->authcheck();  
      DB::table('tbl_category')
           ->where('category_id',$category_id)
           ->update(['publication_status'=>0]);
           
           return Redirect::to('/all-category');
         
    }
    public function active_category($category_id)
    {
      DB::table('tbl_category')
           ->where('category_id',$category_id)
           ->update(['publication_status'=>1]);
           
           return Redirect::to('/all-category');
         
    }

    public function edit_category($category_id)
    {   
        $this->authcheck();
        $category_info = DB::table('tbl_category')
        ->where('category_id',$category_id)
        ->first();
        $category = view('admin.edit_category')
                     ->with('category_info',$category_info);
      
          return view('admin_layout')
             ->with('admin.edit_category',$category);
    }
    public function update_category(Request $request, $category_id)
    {   
        $this->authcheck();
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['category_description'] = $request->category_description;

        DB::table('tbl_category')
           ->where('category_id',$category_id)
           ->update($data);
           Session::put('messege','Upadte category successfully!!..');
           
           return Redirect::to('/all-category');
           
    }
    public function delete_category($category_id)
    {
        $this->authcheck();
        DB::table('tbl_category')
        ->where('category_id',$category_id)
        ->delete(); 
        Session::put('messege','delete category successfully!!..');
        return Redirect::to('/all-category');
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
