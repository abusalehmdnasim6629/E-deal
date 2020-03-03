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
						<h2><i class="halflings-icon user"></i><span class="break"></span>Vendors</h2>
						<div class="box-icon">
							
							<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
							<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
						</div>
					</div>
					
					<div class="box-content">
						<table class="table table-striped table-bordered bootstrap-datatable datatable">
						  <thead>
							  <tr>
								  <th>Link id</th>
								  <th>Link name</th>
                                  <th>Link address</th>
								  
								  <th>Action</th>
							  </tr>
						  </thead>   

						@foreach($link as $p)
						  <tbody>
							<tr>
								<td>{{ $p->link_id}}</td>
								
                                <td>{{ $p->link_name}}</td>
								<td>{{ $p->link_address}}</td>
								
								<td class="center">
									
									<a class="btn btn-danger" href="{{URL::to('/delete-link/'.$p->link_id)}}">
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