@extends('admin_layout')
@section('admin_content')
     <div class="row-fluid sortable">	
				<div class="box span6">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Customer details</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-bordered">
							  <thead>
								  <tr>
									  <th>Customer name</th>
									  <th>Mobile number</th>                                          
								  </tr>
							  </thead>   
							  <tbody>
                              <?php foreach($all_customer_info as $ac){
                                  ?>
                                  <tr>
                                <td class="center">{{ $ac->customer_name}}</td>
                                <td class="center">{{ $ac->mobile_number}}</td>                                  
								</tr>
                                <?php
                              }
								?>
								
								
								                           
							  </tbody>
						 </table>  
						 
					</div>
				</div><!--/span-->

                <div class="box span6">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Shipping details</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-condensed">
							  <thead>
								  <tr>
									  <th>Username</th>
									  <th>Address</th>
									  <th>Mobile number</th>
									                                        
								  </tr>
							  </thead>   
							  <tbody>
                              <?php foreach($all_customer_info as $c){
                                  ?>
                                  <tr>
                                <td class="center">{{ $c->shipping_first_name.$c->shipping_last_name}}</td>
                                <td class="center">{{ $c->shipping_address}}</td>  
                                <td class="center">{{ $c->shipping_mobile_number}}</td>                                  
								</tr>
                                <?php
                              }
								?>
								
								                                 
							  </tbody>
						 </table>  
						 
					</div>
				</div><!--/span-->

                <div class="row-fluid sortable">	
				<div class="box span12">
					<div class="box-header">
						<h2><i class="halflings-icon align-justify"></i><span class="break"></span>Order details</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					<div class="box-content">
						<table class="table table-bordered table-striped table-condensed">
							  <thead>
								  <tr>
									  <th>Id</th>
									  <th>Product name</th>
									  <th>Product price</th>
									  <th>Product sales quantity</th> 
                                      <th>Product total</th>                                           
								  </tr>
							  </thead>   
							  <tbody>
                              <?php foreach($all_customer_info as $c){
                                  ?>
                                <tr>
                                <td class="center">{{ $c->order_id }} </td>
                                <td class="center">{{ $c->product_name }} </td>  
                                <td class="center">{{ $c->product_price }} </td> 
                                <td class="center">{{ $c->product_sales_quantity }}</td> 
                                <td class="center">{{ $c->product_price * $c->product_sales_quantity }}</td>                                  
								</tr>
                                <?php
                              }
								?>
								
								                         
							  </tbody>
						 </table>  
						 
					</div>
				</div><!--/span-->
			</div><!--/row-->

                @endsection