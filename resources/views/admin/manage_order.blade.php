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
						<h2><i class="halflings-icon user"></i><span class="break"></span>Members</h2>
						<div class="box-icon">
							<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Order id</th>
								  <th>Customer name</th>
								  <th>Order total</th>
								  <th>status</th>
								  <th>Action</th>
							  </tr>
						  </thead>   

						@foreach($all_order_info as $ct)
						  <tbody>
							<tr>
								<td>{{ $ct->order_id}}</td>
								<td class="center">{{ $ct->customer_name}}</td>
								<td class="center">{{ $ct->order_total}}</td>
								
								<td class="center">
								    
										<span class="label label-success">{{$ct->order_status}}</span>
									
								<td class="center">
								
									<a class="btn btn-danger" href="#">
										<i class="halflings-icon white thumbs-down"></i>  
									</a>
								
								
								

									<a class="btn btn-info" href="{{URL::to('/order-details/'.$ct->order_id)}}">
										<i class="halflings-icon white edit"></i>  
									</a>
									<a class="btn btn-danger" href="{{URL::to('/delete-order/'.$ct->order_id)}}">
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