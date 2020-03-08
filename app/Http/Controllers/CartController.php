<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
use Cart;
session_start();

class CartController extends Controller
{
    public function add_to_cart(Request $request ,$product_id){
      
      $qty = $request->qty;
      $product_id = $request->product_id;
      $product_detail = DB::table('tbl_product')
               ->where('product_id',$product_id)
               ->first();
      $data = array();
      $data['quantity']= $qty;
      $data['id']= $product_detail->product_id;
      $data['name']= $product_detail->product_name;
      $data['price']= $product_detail->product_price;
      $data['image']= $product_detail->product_image;
      Cart::add($data);
      return Redirect::to('/show-cart');

    }

    public function show_cart(){
        
        $this->authcheck();
        $all_cart_info = DB::table('tbl_product')
                        ->where('publication_status',1)
                        ->first();
        $manage_cart = view('pages.add_to_cart')
                     ->with('all_cart_info',$all_cart_info);
      
          return view('welcome')
             ->with('pages.add_to_cart',$manage_cart);
    }

    public function authcheck(){
        $customer_id =Session::get('customer_id');
        if($customer_id){
          return;
        }else{
            return Redirect::to('/login-check')->send();
        }


    }
    public function delete_cart($id){
        Cart::remove($id);
        return Redirect::to('/show-cart');

    }
    public function update_cart(Request $request, $id){
        Cart::update($id, array(
            'quantity' => $request->quantity
          ));
          return Redirect::to('/show-cart');
    }
}
