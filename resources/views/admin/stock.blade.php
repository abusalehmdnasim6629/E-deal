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
						<h2><i class="halflings-icon user"></i><span class="break"></span>Products</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  
                                  <th>Product image</th>
								  <th>Vendor name</th>
								  <th>Product name</th>
								  <th>Per Product price</th>
								  <th>Product Purchase Quantity</th>
								  <th>Product available Quantity</th>
								  <th>Discount(in %)</th>
								  <th>Product total price</th>
								  <th>Payment status</th>
								  <th>Partial Payment</th>
								  <th>Remaining Due</th>
								  <th>Delivary status</th>
								  <th>Action</th>
							  </tr>
						  </thead>   

						@foreach($all_product_info as $p)
						  <tbody>
							<tr>
								
								
								<td><img src="{{URL::to($p->p_image)}}" alt="product image" style="height:70px; width:70px"> </td>
								<td>{{ $p->v_name}}</td>
								<td>{{ $p->product_name}}</td>
								<td>{{ $p->per_p_price}}</td>
								<td>{{ $p->p_quantity}}</td>
								<td>{{ $p->a_quantity}}</td>
								<td>{{ $p->discount}}</td>
								<td>{{ $p->p_total_price}}</td>
								<td>{{ $p->payment_status}}</td>
								<td>{{ $p->partial_payment}}</td>
								<td>{{ $p->remaining_due}}</td>
								<td>{{ $p->delivary_status}}</td>
								<td class="center">
								
									<a class="btn btn-danger" href="{{URL::to('/delete-stock/'.$p->pur_id)}}">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							
						  </tbody>

						@endforeach

					  </table>            
					</div>
				</div><!--/span-->
			
			</div><!--/row-->
@endsection