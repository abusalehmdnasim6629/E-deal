<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class HomeController extends Controller
{
    public function index(){

        $all_published_product = DB::table('tbl_product')
                        ->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id') 
                        ->join('tbl_manufacture','tbl_product.manufacture_id','=','tbl_manufacture.manufacture_id')
                        ->select('tbl_product.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
                        ->limit(18)
                        ->where('tbl_product.publication_status',1)
                        ->get();



        $manage_product = view('pages.home')
                       ->with('all_published_product',$all_published_product);
        
            return view('welcome')
               ->with('pages.home',$manage_product);
  
        
        
        //return view('pages.home');

    }

   public function view_product_by_category($category_id){

            $view_product_by_category = DB::table('tbl_product')
                ->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id') 
                ->join('tbl_manufacture','tbl_product.manufacture_id','=','tbl_manufacture.manufacture_id')
                ->select('tbl_product.*','tbl_category.category_id','tbl_manufacture.manufacture_name')
                ->limit(18)
                ->where('tbl_category.category_id',$category_id)
                ->get();



            $manage_view_product_by_category = view('pages.view_product_by_category')
                         ->with('view_product_by_category',$view_product_by_category);

            return view('welcome')
                   ->with('pages.view_product_by_category',$manage_view_product_by_category);




   }

   public function view_product_by_manufacture($manufacture_id){

    $view_product_by_manufacture = DB::table('tbl_product')
        ->join('tbl_manufacture','tbl_product.manufacture_id','=','tbl_manufacture.manufacture_id') 
        ->select('tbl_product.*','tbl_manufacture.manufacture_id','tbl_manufacture.manufacture_name')
        ->limit(18)
        ->where('tbl_manufacture.manufacture_id',$manufacture_id)
        ->get();



    $manage_view_product_by_manufacture = view('pages.view_product_by_manufacture')
                 ->with('view_product_by_manufacture',$view_product_by_manufacture);

    return view('welcome')
           ->with('pages.view_product_by_manufacture',$manage_view_product_by_manufacture);




}

    

    public function view_product($product_code){

        $view_product = DB::table('tbl_product')
        ->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id') 
        ->join('tbl_manufacture','tbl_product.manufacture_id','=','tbl_manufacture.manufacture_id')
        ->select('tbl_product.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
        ->where('tbl_product.product_code',$product_code)
        ->where('tbl_product.publication_status',1)
        ->first();


         Session::put('pid',$view_product->product_id);
        $manage_view_product = view('pages.view_product')
            ->with('view_product',$view_product);

       

        return view('welcome')
        ->with('pages.view_product',$manage_view_product);

    }
    public function contact(){

        return view('pages.contact');
    }
    public function add_comment(Request $request)
    {
        $contact = array();
        $contact['user_name'] = $request->name;
        $contact['user_email'] = $request->email;
        $contact['user_subject'] = $request->subject;
        $contact['comment'] = $request->message;
        DB::table('tbl_contact')
            ->insert($contact);    
            Session::put('msg','Message sent successfully..');   
        return Redirect::to('/contact'); 
    }
 public function search(Request $request){

        $s = $request->search;
        
        $search_item = DB::table('tbl_product')
                    ->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id') 
                    ->join('tbl_manufacture','tbl_product.manufacture_id','=','tbl_manufacture.manufacture_id')
                    ->select('tbl_product.*','tbl_category.category_name','tbl_manufacture.manufacture_name')
                    ->where('product_name','like','%'.$s.'%')
                    ->get();


     $manage_serach = view('pages.search')
                    ->with('search_item',$search_item);
     
         return view('welcome')
            ->with('pages.search',$manage_serach);



         

    }
    public function social_link(){


        
    }
}
