<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Cart;
use Illuminate\Support\Facades\Validator;
use App\Mail\SendMail;
use Mail;
use Session;
//use Stripe;
use Stripe;

use RealRashid\SweetAlert\Facades\Alert;
session_start();


class CheckoutConteoller extends Controller
{
    public $cde;
    public function login_check(){
        $this->authcheck3();
        return view('pages.login');
    }

   public function customer_registration(Request $request){

              
                
               
                

                $cd= array();
                
                $cd['customer_name'] = $request->customer_name;
                $cd['email_address']  = $request->email_address;
                $cd['mobile_number']  = $request->mobile_number;
                $cd['password']  = md5(md5($request->password));
                Session::put('cus_info',$cd);
                $rsub = "Registration Conformation Code";
                $code = rand(10000,99999);
                $rmsg ="Yor code is : ".$code;
                Session::put('cd',$code);
                Mail::to($cd['email_address'])->send(new SendMail($rsub,$rmsg));
                
                return view('pages.confirm_code');
                //     $customer_id = DB::table('tbl_customer')
                //     ->insertGetId($cd);
                //   if($customer_id){
                  
                //     Session::put('customer_id',$customer_id);
                //     Session::put('customer_name',$request->customer_name);
                //     Alert::success('Successful', 'Welcome to E-deal');
                //     return Redirect::to('/checkout');
                //   }else{
                //     Alert::warning('Unsuccessful','Please try again');
                //     return Redirect::to('/login-check');
                //   }
                   
                
            
                

   }
   
   public function confirm_code(Request $request){
           $code = Session::get('co');
           
           $input_code = $request->code;

           if($code == $input_code){
            $cd2 = array();
            $cd2 = Session::get('cus_info');
            $customer_id = DB::table('tbl_customer')
                ->insertGetId($cd2);
            
              
                Session::put('customer_id',$customer_id);
                Session::put('customer_name',$cd2['customer_name']);
                Alert::success('Successful', 'Welcome to E-deal');
                return Redirect::to('/checkout');
             
            }else{
                Alert::warning('Wrong','Please try again');
                return Redirect::to('/login-check');
            }

   }
   public function checkout(){
        $this->authcheck();
        return view('pages.checkout');

   }

   public function authcheck(){
    $customer_id =Session::get('customer_id');
    if($customer_id){
      return;
    }else{
        return Redirect::to('/login-check')->send();
    }

   }
   public function authcheck3(){
    $customer_id =Session::get('customer_id');
    if($customer_id){
        return Redirect::to('/')->send();
    }else{
        return;
    }

   }



   public function shipping(Request $request)
   {
       $shipping_data = array();
       $shipping_data['email_address'] = $request->email_address;
       $shipping_data['shipping_first_name'] = $request->shipping_first_name;

       $shipping_data['shipping_last_name'] = $request->shipping_last_name;

       $shipping_data['shipping_address'] = $request->shipping_address;
       $shipping_data['shipping_mobile_number'] = $request->mobile_number;
       $shipping_data['shipping_city'] = $request->shipping_city;

       $shipping_id = DB::table('tbl_shipping')
           ->insertGetId($shipping_data);

        Session::put('shipping_id',$shipping_id);   
        return Redirect::to('/payment');   



   }
   public function customer_login(Request $request){
    
            //     $validator = Validator::make(

            //         array('email_address' => 'required|email'),
            //         array('password' => 'required')
                    

            //     );
            
            // if($validator->fails()){
            //     Session::put('m','Invalid login');

            //     return Redirect()->back()->withErrors($validator)->withInput();
            // }

            
    
            $email = $request->email_address;
            $password = md5(md5($request->password));
            $customer_details = DB::table('tbl_customer')
                ->where('email_address',$email)
                ->where('password',$password)
                ->first();

            
            if($customer_details != NULL){
                Session::put('customer_id',$customer_details->customer_id);
                Session::put('customer_name',$customer_details->customer_name);
                
                return Redirect::to('/checkout');
            }else{
                
                return Redirect::to('/login-check');
            }   
    

    }

    public function customer_logout(){
        Session::flush();
        return Redirect::to('/');


    }
    public function payment(){
        // return view('welcome')
        //        ->with('pages.payment');
        $this->authcheck2();
        return view('pages.payment');

    }
   
   
    public function order_place(Request $request){
        $this->authcheck2();
        $payment_method = $request->payment_method;
        $payment = array();
        $payment['payment_method'] = $payment_method;
        $payment['payment_status'] = 'pendding';
        $payment_id = DB::table('tbl_payment')
                    ->insertGetId($payment);

        $odata = array();
        $tax=200.00;
        $subtotal = 0;
        $sum = 0;
        $odata['customer_id'] = Session::get('customer_id');
        $odata['shipping_id'] = Session::get('shipping_id');
        $odata['payment_id'] =  $payment_id;
        
       $remail =   DB::table('tbl_customer')
                ->select('tbl_customer.email_address')
                ->where('customer_id', $odata['customer_id'])
                ->first();
         $email = $remail->email_address;  

        $contents  = Cart::getcontent(); 
        foreach($contents as $to){
            $p = $to->price;
            $q = $to->quantity;
            $total = $p*$q;
            $subtotal = $subtotal +$total;
            $d = Session::get('dis');
            $sum2 = $subtotal - ($subtotal*($d/100));
            $sum = $tax + $sum2;



        } 
        $odata['order_total'] =  $sum;
        $am = $sum;
        $odata['order_status'] =  'pendding';
        if($odata['order_total'] > 200){
        $order_id = DB::table('tbl_order')
                    ->insertGetId($odata);

        
        $oddata = array();     
        foreach($contents as $c){
            $oddata['order_id'] = $order_id;
            $oddata['product_id'] = $c->id;
            $oddata['product_name'] = $c->name;
            $oddata['product_price'] = $c->price;
            $oddata['product_sales_quantity'] = $c->quantity;
            
            DB::table('tbl_order_details')
              ->insert($oddata);
        }  
        if($payment_method == 'handcash'){
            Session::put('dis',null);
         
            $rsub = "Order conformation";
            $rmsg = "Your order has been received";
            Mail::to($email)->send(new SendMail($rsub,$rmsg));
            Alert::success('Order Conformation', 'Success');
           

            return Redirect::to('/');
        }elseif($payment_method == 'card'){
            $this->authcheck2();
            return view('pages.stripe_payment');
        }elseif($payment_method == 'bkash'){
            Session::put('dis',null);
            return view('pages.order_success');
        }else{
            Session::put('dis',null);
            echo 'not match';
        }    

       }else{
        Alert::warning('Unsuccessfull', 'Please add product in your cart');
        return Redirect::to('/');
       }

    }
    

    public function stripepayment(){
          $this->authcheck2();
        return view('pages.stripe_payment');
    }

    public function submit_payment(Request $request){
     
    $usam = 200;

    Stripe\Stripe::setApiKey('sk_test_ZpM0r4nXpKlO8XlWiFCimK2h00XpkztfYO');
    
    $a = Stripe\Charge::create ([
                "amount" => $usam * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com." 
        ]);

    if($a){
    Alert::success('Successful', 'Payment received successfully'); 
    return Redirect::to('/');
    }else{
        Alert::warning('Unsuccessful', 'Payment fail'); 
        return Redirect::back();   
    }

}
public function authcheck2(){
    $shipping_id =Session::get('shipping_id');
    if($shipping_id){
      return;
    }else{
        return Redirect::to('/checkout')->send();
    }


}
}


