<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


use Session;
session_start();

class OrderController extends Controller
{
    public function manage_order(){

        $all_order_info = DB::table('tbl_order')
        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id') 
        
        ->select('tbl_order.*','tbl_customer.customer_name','tbl_customer.customer_id')
         
        ->orderBy('order_id','asc')
        ->get();



        $manage_order = view('admin.manage_order')
            ->with('all_order_info',$all_order_info);

        return view('admin_layout')
        ->with('admin.manage_order',$manage_order);

            }


    public function order_details($order_id){

                     
                    $all_customer_info = DB::table('tbl_order')
                                    ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')  
                                    ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id') 
                                    ->join('tbl_order_details','tbl_order_details.order_id','=','tbl_order.order_id')   
                                    ->select('tbl_order.*','tbl_customer.*','tbl_shipping.*','tbl_order_details.*')
                                    ->where('tbl_order.order_id',$order_id)
                                    ->get();

            
                        $manage_customer = view('admin.order-details')
                            ->with('all_customer_info',$all_customer_info);
                        
                            return view('admin_layout')
                           ->with('admin.order-details',$manage_customer); 

                           

                        
              
               
                                    

       }     
 public function delete_order($order_id)
    {
        
        DB::table('tbl_order')
        ->where('order_id',$order_id)
        ->delete(); 
        
        DB::table('tbl_order_details')
        ->where('order_id',$order_id)
        ->delete(); 
		

        
        return Redirect::to('/manage-order');
    }
}
