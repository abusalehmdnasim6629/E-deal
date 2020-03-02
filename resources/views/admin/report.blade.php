@extends('admin_layout')
@section('admin_content')

           <ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Tables</a></li>
			</ul>
            
			<div class="row-fluid sortable">		
				<div class="box span12">
					<div class="box-header" data-original-title>
						<h2><i class="halflings-icon user"></i><span class="break"></span>Today's Report</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>



					<?php 
					$t_date = date("Y-m-d");

					$res = DB::table('tbl_sell')
					     ->join('tbl_product','tbl_sell.product_code','=','tbl_product.product_id')
					     ->select('tbl_sell.*','tbl_product.product_name','tbl_product.product_price')  
						 ->where('sell_date',$t_date)
						 ->get();

					$tp=0;
					$product = '';
					foreach($res as $r){	

						$tp = $tp + $r->total_price;
						$product = $r->product_code;
					}


					
					$res2 = DB::table('tbl_pur')
					     ->join('tbl_product','tbl_pur.p_code','=','tbl_product.product_id')
					     ->select('tbl_pur.*','tbl_product.product_name')  
						 ->where('purchase_date',$t_date)
						 ->get();

					$tp1=0;
					$rd =0;
						 foreach($res2 as $r2){	
	 
							 $tp1 = $tp1 + $r2->p_total_price;
							 $rd = $rd + $r2->remaining_due;

							 
						 }
						 
					   $res3 = DB::table('tbl_cost')
							 ->select('tbl_cost.*')
							 ->where('date',$t_date)
							 ->get();
                        $tc =0;
                        foreach($res3 as $r3){
                                
                          $tc = $r3->employee_salary + $r3->income_tax + $r3->extra_cost;
						}


					?>
					<h3>Today's date: <span>{{ date('Y-m-d') }}</span> </h3> <br> <br>
                    <h3>Sells report</h3>
					<table style="border:1px solid black;">
					 
					 <tr style="border:1px solid black;">
					    <th style="border:1px solid black;">Sell Product </th>
						<th style="border:1px solid black;">per product price</th>
						<th style="border:1px solid black;">product quantity</th>
						<th style="border:1px solid black;">Total price</th>
					 
					 </tr>
                   <?php foreach( $res as $res) { ?>
					 <tr>
					     <td style="border:1px solid black;">{{$res->product_name}}</td>
						 <td style="border:1px solid black;">{{$res->product_price}}</td>
						 <td style="border:1px solid black;">{{$res->product_quantity}}</td>
						 <td style="border:1px solid black;">{{$res->total_price}}</td>
					 
					 
					 </tr>
					
				   <?php } ?>
					
					
					</table>
                     <h3>Total Sell totday : {{$tp}} tk</h3> <br> <br>
					<h3>Purchase report</h3>
					<table style="border:1px solid black;">
					 
					 <tr style="border:1px solid black;">
					    <th style="border:1px solid black;">Purchase Id </th>
						<th style="border:1px solid black;">Product name </th>
						<th style="border:1px solid black;">per product price</th>
						<th style="border:1px solid black;">product quantity</th>
						<th style="border:1px solid black;">Total price</th>
						<th style="border:1px solid black;">Remaining due</th>
					 
					 </tr>
                   <?php foreach( $res2 as $res2) { ?>
					 <tr>
					     <td style="border:1px solid black;">{{$res2->pur_id}}</td>
					     <td style="border:1px solid black;">{{$res2->product_name}}</td>
						 <td style="border:1px solid black;">{{$res2->per_p_price}}</td>
						 <td style="border:1px solid black;">{{$res2->p_quantity}}</td>
						 <td style="border:1px solid black;">{{$res2->p_total_price}}</td>
						 <td style="border:1px solid black;">{{$res2->remaining_due}}</td>
					 
					 
					 </tr>
					
				   <?php } ?>
					
					
					</table>

					 <h3>Total purchase totday : {{$tp1}} tk</h3>
					 <h3>Total due totday : {{$rd}} tk</h3> <br> <br>

                     <h3>Today Cost report</h3>
					<table style="border:1px solid black;">
					 
					 <tr style="border:1px solid black;">
					    <th style="border:1px solid black;">Employee salary </th>
						<th style="border:1px solid black;">Income tax</th>
						<th style="border:1px solid black;">Extra cost</th>
						
					 
					 </tr>
                   <?php foreach( $res3 as $res3) { ?>
					 <tr>
					     <td style="border:1px solid black;">{{$res3->employee_salary}}</td>
						 <td style="border:1px solid black;">{{$res3->income_tax}}</td>
						 <td style="border:1px solid black;">{{$res3->extra_cost}}</td>
						 
					 
					 
					 </tr>
					
				   <?php } ?>
					
					
					</table>
					<h3>Total cost totday : {{$tc}} tk</h3> 
                     
					
					
					          
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
@endsection