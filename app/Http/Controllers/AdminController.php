<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Session;
use App\Mail\SendMail;
use Mail;
session_start();

class AdminController extends Controller
{
    
    public function index(){

        return view('admin_login');

    }
    
    
    public function dashboard(Request $request){
         $admin_email = $request->admin_email;
         $admin_password = md5($request->admin_password);
         
         $result = DB::table('tbl_admin')
                ->where('admin_email',$admin_email)
                ->where('admin_password',$admin_password)
                ->first();
                 if($result)
                 {
                    Session::put('admin_name',$result->admin_name);
                    Session::put('admin_id',$result->admin_id);
                    return Redirect::to('/dashboard');
                 }else{
                    Session::put('message','Email or password Invalid');
                    return Redirect::to('/admin');
                 }
        
    }
    public function admin_register(){



        return view('admin_reg');
    }

    public function admin_save(Request $request){

        // $request->validate([
        //     'admin_email' => 'required|email|unique:tbl_admin',
        //     'admin_password' => 'required|max:8',
        //     'admin_name' => 'required',
        //     'admin_phone' => 'required',
        // ]);
        $validator = Validator::make(

              array('admin_email' => 'required|email|unique:tbl_admin'),
              array('admin_password' => 'required|max:8'),
              array( 'admin_name' => 'required'),
              array('admin_phone' => 'required|unique:tbl_admin')


        );
        
        if($validator->fails()){
            Session::put('message','Invalid registration');

            return Redirect()->back()->withErrors($validator)->withInput();
        }
        $ad= array();
                
        $ad['admin_email'] = $request->admin_email;
        $ad['admin_password']  =md5($request->admin_password); 
        $ad['admin_name']  = $request->admin_name;
        $ad['admin_phone']  = $request->admin_phone;
        DB::table('tbl_admin')
            ->insert($ad);
        
        return Redirect::to('/admin');
    
        
        
    }
    
    public function addvendor(){

         $this->authcheck();
        return view('admin.add_vendor');
    }

    public function saveVendor(Request $request)
    {
       
        $d= array();
           
        $d['vendor_name'] = $request->vendor_name;
        $d['vendor_address'] = $request->vendor_address;
       
       
       
        DB::table('tbl_vendor')->insert($d);
            return Redirect::to('/add-vendor');
                
        }



        public function all_vendor(){
            $this->authcheck();
            $vendor = DB::table('tbl_vendor')
                    ->select('tbl_vendor.*')
                    ->get();


           return view('admin.all_vendor')->with('vendor',$vendor);         


        }

        public function delete_vendor($vendor_id){

                 DB::table('tbl_vendor')
                 ->where('vendor_id',$vendor_id)
                 ->delete();

                 return Redirect::to('/all-vendor');
        }


        public function purchase(){

            $this->authcheck();
            return view('admin.purchase');
        }


        public function saveStock(Request $request)
            {
               
                $dd= array();
                
                $dd['v_name'] = $request->vendor_name;
                $dd['p_code'] = $request->product_name;
                $dd['p_description'] = $request->product_description;
                $dd['per_p_price'] = $request->per_product_price;
                $dd['p_quantity'] = $request->product_quantity;
                $dd['a_quantity'] = $request->product_quantity;
                $dd['discount'] = $request->discount;
                $dd['payment_status'] = $request->p_p;
                $dd['partial_payment'] = $request->p_a;
                $dd['purchase_date'] = date('Y-m-d');
                $dd['remaining_due'] = $request->r_d;

                $dd['delivary_status'] = $request->delivary_status;
                
            

                $dd['p_total_price'] = ($dd['per_p_price']*$dd['p_quantity'])- (($dd['per_p_price']*$dd['p_quantity'])*(($request->discount)/100));
            
                
        
                
            if($request->hasfile('p_image'))
                {
                    $image = $request->file('p_image');
                    
                    $image_name = Str::random(20);
                    $ext = strtolower($image->getClientOriginalExtension());
                    $image_full_name = $image_name.'.'.$ext;
                    $upload_path = 'image/';
                    $image_url = $upload_path.$image_full_name;
                    $success = $image->move($upload_path,$image_full_name);
        
                    if($success)
                    {
                        $dd['p_image'] = $image_url;
                   
                        DB::table('tbl_pur')->insert($dd);
                       
                        Session::put('message','Add product successfully!!..');
                        return Redirect('/purchase');
                    
                        
                    }
                   
                    
                }
                else{
                    $dd['p_image'] ='';
                    DB::table('tbl_pur')->insert($dd);
                    return Redirect('/purchase');
                }    
            
            }
       
            public function all_stock(){
                $this->authcheck();
                $all_product_info = DB::table('tbl_pur')
                                ->join('tbl_product','tbl_pur.p_code','=','tbl_product.product_id')
                                ->select('tbl_pur.*','tbl_product.product_name')
                                ->orderBy('pur_id','asc')
                                ->get();
        
                 
        
                $manage_product = view('admin.stock')
                               ->with('all_product_info',$all_product_info);
                
                    return view('admin_layout')
                       ->with('admin.stock',$manage_product);
          
              }

              public function sell(){
                $this->authcheck();
                return view('admin.sell');
            }

            public function saveSell(Request $request){
                      
                $sell = array();

                $sell['product_code'] = $request->product_code;
                $sell['product_quantity'] = $request->quantity;
                $sell['discount'] = $request->discount;
                $sell['sell_date'] = date("Y-m-d");

                $res = DB::table('tbl_product')
                       ->where('product_id',$request->product_code)
                       ->get();
                  $price = 0;
                 foreach($res as $r){

                    $price = $r->product_price;
                 } 
                 
                 $sell['total_price'] =( $price * $request->quantity ) - (( $price * $request->quantity )*($request->discount/100));
                 DB::table('tbl_sell')->insert($sell);


                $pq =  DB::table('tbl_pur')
                 ->where('p_code',$request->product_code)
                 ->get();

                 $p = 0;
                 foreach($pq as $pq){

                   $p = $pq->p_quantity;
                 }
                $p = $p - $request->quantity;
                DB::table('tbl_pur')
                 ->where('p_code',$request->product_code)
                 ->update(['a_quantity'=> $p]);
                 //->update('p_quantity',$p);

                 return Redirect::to('/sell');
            }

            public function showSellInfo()
            {
                $this->authcheck();
                $t_date = date("Y-m-d");
                


                $sellInfo = DB::table('tbl_sell')
                            ->join('tbl_product','tbl_sell.product_code','=','tbl_product.product_id')
                            ->select('tbl_sell.*','tbl_product.product_name','tbl_product.product_image','tbl_product.product_price')
                            ->where('sell_date','=',$t_date)
                            ->get();
                
                 return view('admin.show_sell_info')->with('all_product_info',$sellInfo);           
                 


            }

            public function show(Request $request){


                $f_date = $request->from_date;
                 $to_date = $request->to_date;
                 $t = 0;
                
                $r = DB::table('tbl_sell')
                            ->join('tbl_product','tbl_sell.product_code','=','tbl_product.product_id')
                            ->select('tbl_sell.*','tbl_product.product_name','tbl_product.product_image','tbl_product.product_price')
                            ->where('sell_date','>=',$f_date)
                            ->where('sell_date','<=',$to_date)
                            ->get();

             
            return view('admin.show_sell_info2')->with('all_product_info',$r); 
            }

            public function cost(){
                $this->authcheck();
                return view('admin.add_cost');
            }

            public function save_cost(Request $request){

                $ex = array();
                $ex['employee_salary'] = $request->employee_salary;
                $ex['income_tax'] = $request->income_tax;
                $ex['extra_cost'] = $request->extra;
                $ex['date'] = date('Y-m-d');


                DB::table('tbl_cost')->insert($ex);

                return Redirect::to('/add-cost');





       }

       public function all_cost(){
        $this->authcheck();
        $all_cost_info = DB::table('tbl_cost')
                        ->select('tbl_cost.*')
                        ->orderBy('cost_id','asc')
                        ->get();


        $manage_cost = view('admin.all_cost')
                       ->with('all_cost_info',$all_cost_info);
        
            return view('admin_layout')
               ->with('admin.all_cost',$manage_cost);
  
      }

      public function report(){

        $this->authcheck();
        return view('admin.report');
      }

      public function getprice()      {
                 
              
        $id = $_GET['txt'];
        
        $res = DB::table('tbl_product')
                ->select('tbl_product.product_price')
                ->where('product_id',$id)
                ->get();
         
        foreach($res as $r){


            echo $r->product_price;
        }     
    }
        public function getdiscount() {
                 
              
            $id = $_GET['txt'];
            
            $res = DB::table('tbl_discount')
                    ->select('tbl_discount.*')
                    ->where('discount_code',$id)
                    ->get();
             $di=0;
            foreach($res as $r){
    
    
                $di=$r->discount_percentage;
                echo $di;
            }     
            Session::put('dis',$di);

            }

            public function addpromo(){
                
                return Redirect::to('/show-cart');
            }

            public function add_discount(){
                $this->authcheck();
                return view('admin.add_discount');
            }

            public function save_discount(Request $request){

                   $dis = array();

                   $dis['discount_code'] = $request->discount_code;
                   $dis['discount_percentage'] = $request->discount_percentage;
                    

                   DB::table('tbl_discount')
                      ->insert($dis);
                  
                  return Redirect::to('/add-discount');    


            }

            public function all_discount(){
                $this->authcheck();
                $discount = DB::table('tbl_discount')
                                ->select('tbl_discount.*')
                                ->orderBy('discount_id','asc')
                                ->get();
        
        
                $manage_discount = view('admin.all_discount')
                               ->with('discount',$discount);
                
                    return view('admin_layout')
                       ->with('admin.all_discount',$manage_discount);
          
              }
               

              public function link(){

                $this->authcheck();
                return view('admin.add_link');
              }


              public function save_link(Request $request){

                $link = array();

                $link['link_name'] = $request->link_name;
                $link['link_address'] = $request->link_address;
                 

                DB::table('tbl_link')
                   ->insert($link);
               
               return Redirect::to('/add-link');    


         }

         public function all_link(){
         
            $this->authcheck(); 
            $link = DB::table('tbl_link')
                            ->select('tbl_link.*')
                            ->orderBy('link_id','asc')
                            ->get();
    
    
            $manage_link = view('admin.all_link')
                           ->with('link',$link);
            
                return view('admin_layout')
                   ->with('admin.all_link',$manage_link);
      
          }

            
          public function delete_link($link_id){

            DB::table('tbl_link')
            ->where('link_id',$link_id)
            ->delete();
      
            return Redirect::to('/all-link');
   }

            public function add_email_phone(){

                $this->authcheck();
                return view('admin.company_email_phone');
            }

            public function save_contact(Request $request){
                 
                $con = array();

                $con['cmp_email'] = $request->company_email;
                $con['cmp_phone'] = $request->company_phone;

                DB::table('tbl_cmp_contact')->insert($con);

                return Redirect::to('/add-contact');



            }

            public function all_contact(){
                $this->authcheck();
                $con = DB::table('tbl_cmp_contact')
                                ->select('tbl_cmp_contact.*')
                                ->orderBy('cmp_id','asc')
                                ->get();
        
        
                $manage_con = view('admin.all_cmp_contact')
                               ->with('con',$con);
                
                    return view('admin_layout')
                       ->with('admin.all_cmp_contact',$manage_con);
          
              }

              public function sendReview(Request $request){
                   
                   

                   $rsub = $request->rname;
                   $rmail = $request->rmail;
                   $rmsg = $request->sms;

                   $review = array();
                   $review['product_id'] = Session::get('pid');
                   $review['review_subject']= $rsub;
                   $review['review_mail']= $rmail;
                   $review['review_sms']= $rmsg;
                  
                   Mail::to($rmail)->send(new SendMail($rsub,$rmsg));
                  
                  $insert =  DB::table('tbl_review')
                   ->insert($review);
                   
                   if($insert){
                   
                    return Redirect::to('/');
                   }else{
                
                    return Redirect::to('/');
                   }
                   
                     

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
