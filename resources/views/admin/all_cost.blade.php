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
						<h2><i class="halflings-icon user"></i><span class="break"></span>Expanse</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Cost id</th>
								  <th>Employee Salary</th>
                                  <th>Income Tax</th>
								  <th>Extra Cost</th>
								  <th>Date</th>
								 
								  
								  <th>Action</th>
							  </tr>
						  </thead>   

						@foreach($all_cost_info as $p)
						  <tbody>
							<tr>
								<td>{{ $p->cost_id}}</td>
								
                                <td>{{ $p->employee_salary}}</td>
								<td>{{ $p->income_tax}}</td>
								<td>{{ $p->extra_cost}}</td>
								<td>{{ $p->date}}</td>
								
								<td class="center">
									
									<a class="btn btn-danger" href="{{URL::to('/delete-cost/'.$p->cost_id)}}">
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