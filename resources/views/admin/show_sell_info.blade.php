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
						<form class="form-horizontal" action="{{url('/sell-info')}}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
						  <fieldset>


						  <div class="control-group">
							  <label class="control-label" for="date01">From:</label>
							  <div class="controls">
								<input type="date" class="input-xlarge" name="from_date" required="" >
							  </div>
							</div>

							<div class="control-group">
							  <label class="control-label" for="date01">To:</label>
							  <div class="controls">
								<input type="date" class="input-xlarge" name="to_date" required="" >
							  </div>
							</div>
                            

							<div class="form-actions">
							  <button type="submit" class="btn btn-primary">Show sell info</button>
							  <button type="reset" class="btn">Cancel</button>
							</div>
						  </fieldset>
						</form>   

					</div>
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Product code</th>
                                  <th>Product image</th>
								  <th>Product name</th>
								  <th>Sell date</th>
								  <th>Per Product Price</th>
								  <th>Quantity</th>	
								  <th>Discount</th>
								  <th>total price</th>
								  <th>Action</th>
							  </tr>
						  </thead>   

						@foreach($all_product_info as $p)
						  <tbody>
							<tr>
								
								<td class="center">{{ $p->product_code }}</td>
								<td><img src="{{URL::to($p->product_image)}}" alt="product image" style="height:70px; width:70px"> </td>
                                <td>{{ $p->product_name}}</td>
								<td>{{ $p->sell_date}}</td>
								<td>{{ $p->product_price}}</td>
								<td>{{ $p->product_quantity}}</td>
								<td>{{ $p->discount}}</td>
								<td>{{ $p->total_price}}</td>
		
								<td class="center">
									
									<a class="btn btn-danger" href="{{URL::to('/delete-sell/'.$p->product_code)}}">
										<i class="halflings-icon white trash"></i> 
									</a>
								</td>
							</tr>
							
						  </tbody>

						@endforeach

					  </table>            
					</div>
				</div><!--/span-->
				<?php 
				
				$tt_date = date("Y-m-d");
                


                $info = DB::table('tbl_sell')
                            ->where('sell_date','=',$tt_date)
                            ->get();
				
				$total = 0;

				foreach($info as $i){
					 
					$total = $total+ $i->total_price;


				}
				
				
				?>
				<p>Total sell amount = {{ $total }}</p>
			
			</div><!--/row-->
@endsection